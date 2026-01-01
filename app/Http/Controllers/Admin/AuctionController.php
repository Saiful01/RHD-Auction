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

        $auctions = Auction::with(['financial_year', 'road', 'package', 'lots', 'employees'])->get();

        return view('admin.auctions.index', compact('auctions'));
    }

    public function create()
    {
        abort_if(Gate::denies('auction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $financial_years = FinancialYear::pluck('year', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roads = Road::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $packages = Package::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lots = Lot::with('lotLotItems')->get();

        $employees = Employee::pluck('personnel', 'id');

        return view('admin.auctions.create', compact('employees', 'financial_years', 'lots', 'packages', 'roads'));
    }

    public function store(StoreAuctionRequest $request)
    {
        $auction = Auction::create($request->all());
        $auction->lots()->sync($request->input('lots', []));
        $auction->employees()->sync($request->input('employees', []));
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $auction->id]);
        }

        return redirect()->route('admin.auctions.index');
    }

    public function edit(Auction $auction)
    {
        abort_if(Gate::denies('auction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $financial_years = FinancialYear::pluck('year', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roads = Road::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $packages = Package::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lots = Lot::with('lotLotItems')->get();

        $employees = Employee::pluck('personnel', 'id');

        $auction->load('financial_year', 'road', 'package', 'lots', 'employees');

        return view('admin.auctions.edit', compact('auction', 'employees', 'financial_years', 'lots', 'packages', 'roads'));
    }

    public function update(UpdateAuctionRequest $request, Auction $auction)
    {
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
}
