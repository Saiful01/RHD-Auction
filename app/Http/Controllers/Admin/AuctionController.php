<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAuctionRequest;
use App\Http\Requests\StoreAuctionRequest;
use App\Http\Requests\UpdateAuctionRequest;
use App\Models\Auction;
use App\Models\Employee;
use App\Models\FinancialYear;
use App\Models\Lot;
use App\Models\LotItem;
use App\Models\Package;
use App\Models\Road;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class AuctionController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('auction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auctions = Auction::with(['financial_year', 'road', 'package', 'lots.lotLotItems', 'employees'])->get();

        return view('admin.auctions.index', compact('auctions'));
    }

    public function create()
    {
        abort_if(Gate::denies('auction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $financial_years = FinancialYear::pluck('year', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roads = Road::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $packages = Package::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lots = Lot::with('lotLotItems')->get();

        $employees = Employee::all()->mapWithKeys(function ($e) {
            return [
                $e->id => $e->name_en . ' - ' . $e->personnel
            ];
        });

        return view('admin.auctions.create', compact('employees', 'financial_years', 'lots', 'packages', 'roads'));
    }

    public function store(StoreAuctionRequest $request)
    {
        $data = $request->all();

        $data = $request->all();
        $data['status'] = auth()->user()->is_admin ? 'active' : 'under_review';
        $auction = Auction::create($data);
        $auction->lots()->sync($request->input('lots', []));
        $auction->employees()->sync($request->input('employees', []));
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $auction->id]);
        }

        return redirect()->route('admin.auctions.index');
    }

    public function edit(Auction $auction, Request $request)
    {
        abort_if(Gate::denies('auction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (!$request->user()->is_admin && $auction->status !== 'under_review') {
            return redirect()->route('admin.auctions.index')
                ->with('error', 'You cannot edit this auction.');
        }

        $financial_years = FinancialYear::pluck('year', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roads = Road::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $packages = Package::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lots = Lot::with('lotLotItems')->get();

        $employees = Employee::all()->mapWithKeys(function ($e) {
            return [
                $e->id => $e->personnel . ' - ' . $e->name_en
            ];
        });

        $auction->load('financial_year', 'road', 'package', 'lots', 'employees');

        return view('admin.auctions.edit', compact('auction', 'employees', 'financial_years', 'lots', 'packages', 'roads'));
    }

    public function update(UpdateAuctionRequest $request, Auction $auction)
    {
        if (!$request->user()->is_admin && $auction->status !== 'under_review') {
            return redirect()->route('admin.auctions.index')
                ->with('error', 'You cannot update this auction.');
        }
        $auction->update($request->all());
        $auction->lots()->sync($request->input('lots', []));
        $auction->employees()->sync($request->input('employees', []));

        return redirect()->route('admin.auctions.index');
    }

    public function show(Auction $auction)
    {
        abort_if(Gate::denies('auction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auction->load('financial_year', 'road', 'package', 'lots', 'employees');

        return view('admin.auctions.show', compact('auction'));
    }

    public function destroy(Auction $auction)
    {
        abort_if(Gate::denies('auction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auction->delete();

        return back();
    }

    public function massDestroy(MassDestroyAuctionRequest $request)
    {
        $auctions = Auction::find(request('ids'));

        foreach ($auctions as $auction) {
            $auction->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('auction_create') && Gate::denies('auction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Auction();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    /**
     * Approve an auction (Admin only)
     */
    public function approve(Auction $auction)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Only admin can approve auctions.');
        }

        if ($auction->status !== 'under_review') {
            return redirect()->back()->with('error', 'Only under review auctions can be approved.');
        }

        $auction->status = 'active';
        $auction->update();

        return redirect()->back()->with('success', 'Auction approved and is now active.');
    }

    /**
     * Reject an auction (Admin only)
     */
    public function reject(Auction $auction)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Only admin can reject auctions.');
        }

        if ($auction->status !== 'under_review') {
            return redirect()->back()->with('error', 'Only under review auctions can be rejected.');
        }

        $auction->status = 'rejected';
        $auction->update();

        return redirect()->back()->with('success', 'Auction has been rejected.');
    }

    public function toggleStatus(Auction $auction)
    {

        if (!auth()->user()->is_admin) {
            return redirect()->back()->with('error', 'Only admin can change status.');
        }

        switch ($auction->status) {
            case 'under_review':
                $auction->status = 'active';
                break;
            case 'active':
                $auction->status = 'rejected';
                break;
            case 'rejected':
                $auction->status = 'under_review';
                break;
        }

        $auction->save();

        return redirect()->back()->with('success', 'Auction status updated.');
    }
}
