<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBidderAuctionRequestRequest;
use App\Http\Requests\StoreBidderAuctionRequestRequest;
use App\Http\Requests\UpdateBidderAuctionRequestRequest;
use App\Models\Auction;
use App\Models\Bidder;
use App\Models\BidderAuctionRequest;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BidderAuctionRequestController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('bidder_auction_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bidderAuctionRequests = BidderAuctionRequest::with(['bidder', 'auction', 'media'])->get();

        return view('admin.bidderAuctionRequests.index', compact('bidderAuctionRequests'));
    }

    public function create()
    {
        abort_if(Gate::denies('bidder_auction_request_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bidders = Bidder::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $auctions = Auction::pluck('memo_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bidderAuctionRequests.create', compact('auctions', 'bidders'));
    }

    public function store(StoreBidderAuctionRequestRequest $request)
    {
        $bidderAuctionRequest = BidderAuctionRequest::create($request->all());

        foreach ($request->input('pay_order', []) as $file) {
            $bidderAuctionRequest->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('pay_order');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $bidderAuctionRequest->id]);
        }

        return redirect()->route('admin.bidder-auction-requests.index');
    }

    public function edit(BidderAuctionRequest $bidderAuctionRequest)
    {
        abort_if(Gate::denies('bidder_auction_request_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bidders = Bidder::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $auctions = Auction::pluck('memo_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bidderAuctionRequest->load('bidder', 'auction');

        return view('admin.bidderAuctionRequests.edit', compact('auctions', 'bidderAuctionRequest', 'bidders'));
    }

    public function update(UpdateBidderAuctionRequestRequest $request, BidderAuctionRequest $bidderAuctionRequest)
    {
        $bidderAuctionRequest->update($request->all());

        if (count($bidderAuctionRequest->pay_order) > 0) {
            foreach ($bidderAuctionRequest->pay_order as $media) {
                if (! in_array($media->file_name, $request->input('pay_order', []))) {
                    $media->delete();
                }
            }
        }
        $media = $bidderAuctionRequest->pay_order->pluck('file_name')->toArray();
        foreach ($request->input('pay_order', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $bidderAuctionRequest->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('pay_order');
            }
        }

        return redirect()->route('admin.bidder-auction-requests.index');
    }

    public function show(BidderAuctionRequest $bidderAuctionRequest)
    {
        abort_if(Gate::denies('bidder_auction_request_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bidderAuctionRequest->load('bidder', 'auction');

        return view('admin.bidderAuctionRequests.show', compact('bidderAuctionRequest'));
    }

    public function destroy(BidderAuctionRequest $bidderAuctionRequest)
    {
        abort_if(Gate::denies('bidder_auction_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bidderAuctionRequest->delete();

        return back();
    }

    public function massDestroy(MassDestroyBidderAuctionRequestRequest $request)
    {
        $bidderAuctionRequests = BidderAuctionRequest::find(request('ids'));

        foreach ($bidderAuctionRequests as $bidderAuctionRequest) {
            $bidderAuctionRequest->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('bidder_auction_request_create') && Gate::denies('bidder_auction_request_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new BidderAuctionRequest();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
