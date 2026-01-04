<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBidderRequest;
use App\Http\Requests\StoreBidderRequest;
use App\Http\Requests\UpdateBidderRequest;
use App\Models\Bidder;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BidderController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('bidder_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bidders = Bidder::with(['media'])->get();

        return view('admin.bidders.index', compact('bidders'));
    }

    public function create()
    {
        abort_if(Gate::denies('bidder_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bidders.create');
    }

    public function store(StoreBidderRequest $request)
    {
        $bidder = Bidder::create($request->all());

        if ($request->input('profile_image', false)) {
            $bidder->addMedia(storage_path('tmp/uploads/' . basename($request->input('profile_image'))))->toMediaCollection('profile_image');
        }

        if ($request->input('nid_file', false)) {
            $bidder->addMedia(storage_path('tmp/uploads/' . basename($request->input('nid_file'))))->toMediaCollection('nid_file');
        }

        if ($request->input('tin_file', false)) {
            $bidder->addMedia(storage_path('tmp/uploads/' . basename($request->input('tin_file'))))->toMediaCollection('tin_file');
        }

        if ($request->input('bin_file', false)) {
            $bidder->addMedia(storage_path('tmp/uploads/' . basename($request->input('bin_file'))))->toMediaCollection('bin_file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $bidder->id]);
        }

        return redirect()->route('admin.bidders.index');
    }

    public function edit(Bidder $bidder)
    {
        abort_if(Gate::denies('bidder_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bidders.edit', compact('bidder'));
    }

    public function update(UpdateBidderRequest $request, Bidder $bidder)
    {
        $bidder->update($request->all());

        if ($request->input('profile_image', false)) {
            if (! $bidder->profile_image || $request->input('profile_image') !== $bidder->profile_image->file_name) {
                if ($bidder->profile_image) {
                    $bidder->profile_image->delete();
                }
                $bidder->addMedia(storage_path('tmp/uploads/' . basename($request->input('profile_image'))))->toMediaCollection('profile_image');
            }
        } elseif ($bidder->profile_image) {
            $bidder->profile_image->delete();
        }

        if ($request->input('nid_file', false)) {
            if (! $bidder->nid_file || $request->input('nid_file') !== $bidder->nid_file->file_name) {
                if ($bidder->nid_file) {
                    $bidder->nid_file->delete();
                }
                $bidder->addMedia(storage_path('tmp/uploads/' . basename($request->input('nid_file'))))->toMediaCollection('nid_file');
            }
        } elseif ($bidder->nid_file) {
            $bidder->nid_file->delete();
        }

        if ($request->input('tin_file', false)) {
            if (! $bidder->tin_file || $request->input('tin_file') !== $bidder->tin_file->file_name) {
                if ($bidder->tin_file) {
                    $bidder->tin_file->delete();
                }
                $bidder->addMedia(storage_path('tmp/uploads/' . basename($request->input('tin_file'))))->toMediaCollection('tin_file');
            }
        } elseif ($bidder->tin_file) {
            $bidder->tin_file->delete();
        }

        if ($request->input('bin_file', false)) {
            if (! $bidder->bin_file || $request->input('bin_file') !== $bidder->bin_file->file_name) {
                if ($bidder->bin_file) {
                    $bidder->bin_file->delete();
                }
                $bidder->addMedia(storage_path('tmp/uploads/' . basename($request->input('bin_file'))))->toMediaCollection('bin_file');
            }
        } elseif ($bidder->bin_file) {
            $bidder->bin_file->delete();
        }

        return redirect()->route('admin.bidders.index');
    }

    public function show(Bidder $bidder)
    {
        abort_if(Gate::denies('bidder_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bidder->load('bidderBidderAuctionRequests', 'bidderBids');

        return view('admin.bidders.show', compact('bidder'));
    }

    public function destroy(Bidder $bidder)
    {
        abort_if(Gate::denies('bidder_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bidder->delete();

        return back();
    }

    public function massDestroy(MassDestroyBidderRequest $request)
    {
        $bidders = Bidder::find(request('ids'));

        foreach ($bidders as $bidder) {
            $bidder->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('bidder_create') && Gate::denies('bidder_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Bidder();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    // Toggle status
    public function toggleStatus(Bidder $bidder)
    {
        abort_if(Gate::denies('bidder_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $bidder->status  = $bidder->status == 1 ? 0 : 1;
        $bidder->save();
        return back()->with('success', 'Bidder status updated successfully.');
    }
}
