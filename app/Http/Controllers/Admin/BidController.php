<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBidRequest;
use App\Http\Requests\StoreBidRequest;
use App\Http\Requests\UpdateBidRequest;
use App\Models\Auction;
use App\Models\Bid;
use App\Models\Bidder;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BidController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bid_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auctions = Auction::withCount('bids')->get();

        return view('admin.bids.auctions', compact('auctions'));
    }

    public function auctionBids(Auction $auction)
    {
        abort_if(Gate::denies('bid_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bids = Bid::where('auction_id', $auction->id)->with(['bidder', 'auction'])->get();

        return view('admin.bids.index', compact('bids', 'auction'));
    }

    public function create()
    {
        abort_if(Gate::denies('bid_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bidders = Bidder::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $auctions = Auction::pluck('memo_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bids.create', compact('auctions', 'bidders'));
    }

    public function store(StoreBidRequest $request)
    {
        $bid = Bid::create($request->all());

        return redirect()->route('admin.bids.index');
    }

    public function edit(Bid $bid)
    {
        abort_if(Gate::denies('bid_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bidders = Bidder::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $auctions = Auction::pluck('memo_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bid->load('bidder', 'auction');

        return view('admin.bids.edit', compact('auctions', 'bid', 'bidders'));
    }

    public function update(UpdateBidRequest $request, Bid $bid)
    {
        $bid->update($request->all());

        return redirect()->route('admin.bids.index');
    }

    public function show(Bid $bid)
    {
        abort_if(Gate::denies('bid_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bid->load('bidder', 'auction');

        return view('admin.bids.show', compact('bid'));
    }

    public function destroy(Bid $bid)
    {
        abort_if(Gate::denies('bid_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bid->delete();

        return back();
    }

    public function massDestroy(MassDestroyBidRequest $request)
    {
        $bids = Bid::find(request('ids'));

        foreach ($bids as $bid) {
            $bid->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function toggleStatus(Bid $bid)
    {
        abort_if(Gate::denies('bid_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bid->status = match ($bid->status) {
            '1' => '2',  // Pending -> Accept
            '2' => '3',  // Accept -> Reject
            '3' => '1',  // Reject -> Pending
            default => '1',
        };

        $bid->save();

        return back()->with('success', 'Bid status updated successfully.');
    }

    public function toggleWinner(Bid $bid)
    {
        abort_if(Gate::denies('bid_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bid->is_winner = $bid->is_winner ? 0 : 1;
        $bid->save();

        return back()->with('success', 'Bid winner status updated successfully.');
    }
}
