<?php

namespace App\Http\Controllers\Bidder;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\Bid;
use App\Models\BidderBidItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BidController extends Controller
{
    // bid page
    public function showBidPage(Auction $auction)
    {
        $bidder = auth('bidder')->user();
        $now = now();
        // Check bid start or end time
        if (!$auction->bid_start_time || !$auction->bid_end_time || $now->lt($auction->bid_start_time) || $now->gt($auction->bid_end_time)) {
            abort(403, 'Bidding is not active at this time.');
        }

        // Check if bidder is approved for this auction
        $interest = $bidder->bidderBidderAuctionRequests()
            ->where('auction_id', $auction->id)
            ->where('status', 2)
            ->first();

        if (!$interest) {
            abort(403, 'You are not approved to bid for this auction.');
        }

        // Check if bidder has already submitted a bid
        $alreadyBid = $auction->bids()
            ->where('bidder_id', $bidder->id)
            ->exists();

        if ($alreadyBid) {
            return redirect()->route('bidder.dashboard')
                ->with('info', 'You have already submitted a bid for this auction.');
        }

        $auction->load('lots.lotLotItems');

        return view('frontend.bidder.bids.create', compact('auction'));
    }

    // bid sumbit function
    public function submitBid(Request $request, Auction $auction)
    {
        // return $request->all();
        $bidder = auth('bidder')->user();
        $now = now();

        // Check if bidding is active
        if (!$auction->bid_start_time || !$auction->bid_end_time || $now->lt($auction->bid_start_time) || $now->gt($auction->bid_end_time)) {
            return back()->withErrors('Bidding is not active at this time.');
        }

        // Validate
        $request->validate([
            'is_condition_accept' => 'required',
            'bids' => 'required|array',
            'bid_amount' => 'required|numeric|min:0',
            'vat' => 'required|numeric|min:0',
            'tax' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
        ]);

        if ($request->bid_amount < $auction->base_value_amount) {
            return back()->withErrors('Total Bid Amount must be greater than base amount.');
        }


        $bid = Bid::create([
            'bidder_id' => $bidder->id,
            'auction_id' => $auction->id,
            'bid_amount' => $request->bid_amount,
            'vat' => $request->vat,
            'tax' => $request->tax,
            'total_amount' => $request->total_amount,
            'is_condition_accept' => 1,
            'status' => 1,
            'is_winner' => 0,
        ]);


        foreach ($request->bids as $lotItemId => $unitPrice) {
            BidderBidItem::create([
                'bid_id' => $bid->id,
                'bidder_id' => $bidder->id,
                'lot_item_id' => $lotItemId,
                'unit_price' => $unitPrice,
            ]);
        }

        return redirect()->route('bidder.dashboard')->with('success', 'Bid submitted successfully.');
    }
}
