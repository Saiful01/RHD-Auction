<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyRoadRequest;
use App\Http\Requests\StoreRoadRequest;
use App\Http\Requests\UpdateRoadRequest;
use App\Models\Division;
use App\Models\Road;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class RoadController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('road_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roads = Road::with(['division', 'media'])->get();

        return view('admin.roads.index', compact('roads'));
    }

    public function create()
    {
        abort_if(Gate::denies('road_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $divisions = Division::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.roads.create', compact('divisions'));
    }

    public function store(StoreRoadRequest $request)
    {
        $road = Road::create($request->all());

        foreach ($request->input('image', []) as $file) {
            $road->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
        }

        foreach ($request->input('files', []) as $file) {
            $road->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $road->id]);
        }

        return redirect()->route('admin.roads.index');
    }

    public function edit(Road $road)
    {
        abort_if(Gate::denies('road_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $divisions = Division::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $road->load('division');

        return view('admin.roads.edit', compact('divisions', 'road'));
    }

    public function update(UpdateRoadRequest $request, Road $road)
    {
        $road->update($request->all());

        if (count($road->image) > 0) {
            foreach ($road->image as $media) {
                if (! in_array($media->file_name, $request->input('image', []))) {
                    $media->delete();
                }
            }
        }
        $media = $road->image->pluck('file_name')->toArray();
        foreach ($request->input('image', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $road->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
            }
        }

        if (count($road->files) > 0) {
            foreach ($road->files as $media) {
                if (! in_array($media->file_name, $request->input('files', []))) {
                    $media->delete();
                }
            }
        }
        $media = $road->files->pluck('file_name')->toArray();
        foreach ($request->input('files', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $road->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
            }
        }

        return redirect()->route('admin.roads.index');
    }

    public function show(Road $road)
    {
        abort_if(Gate::denies('road_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $road->load('division', 'roadPackages', 'roadLots', 'roadAuctions');

        return view('admin.roads.show', compact('road'));
    }

    public function destroy(Road $road)
    {
        abort_if(Gate::denies('road_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $road->delete();

        return back();
    }

    public function massDestroy(MassDestroyRoadRequest $request)
    {
        $roads = Road::find(request('ids'));

        foreach ($roads as $road) {
            $road->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('road_create') && Gate::denies('road_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Road();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
