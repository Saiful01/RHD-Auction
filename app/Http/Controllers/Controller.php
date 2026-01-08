<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\BidderAuctionRequest;
use App\Models\Document;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function home()
    {
        $auctions = Auction::with(['financial_year', 'road', 'package', 'lots', 'employees'])
            ->whereIn('status', ['active', 'under_review', 'rejected'])
            ->get();
        return view('frontend.home.index', compact('auctions'));
    }

    public function auction_details(Auction $auction)
    {
        $auction->load(['financial_year', 'road', 'package', 'lots.lotLotItems', 'employees']);

        // check if auction is active or not
        $now = now();
        $bidActive =
            $auction->bid_start_time &&
            $auction->bid_end_time &&
            $now->between($auction->bid_start_time, $auction->bid_end_time);
        // check if bidder has already submitted a bid
        $alreadyBid = false;
        if (auth('bidder')->check()) {
            $alreadyBid = $auction->bids()
                ->where('bidder_id', auth('bidder')->id())
                ->exists();
        }

        return view('frontend.home.auction_details', compact('auction', 'alreadyBid', 'bidActive'));
    }

    public function auction_bid_rules()
    {
        return view('frontend.home.auction_bid_rules');
    }

    // bidder interested auction form

    // show interest form
    public function showInterestForm(Auction $auction)
    {
        $bidder = Auth::guard('bidder')->user();

        // check if bidder already submitted request
        $bidderRequest = BidderAuctionRequest::where('auction_id', $auction->id)
            ->where('bidder_id', $bidder->id)
            ->first();

        return view('frontend.auction.interest-create', compact('auction', 'bidderRequest'));
    }

    public function storeInterest(Request $request, Auction $auction)
    {
        $bidder = Auth::guard('bidder')->user();

        // duplicate interest form submit protection
        $exists  = BidderAuctionRequest::where('auction_id', $auction->id)
            ->where('bidder_id', $bidder->id)
            ->exists();
        if ($exists) {
            return response()->json([
                'message' => 'You already submitted interest for this auction'
            ], 422);
        }

        // validation
        $request->validate([
            'pay_amount' => 'required|numeric',
            'is_condition_accept' => 'required',
            'pay_order.*' => 'required|file',
            'auto_chalan.*' => 'required|file',
            'nid_copy.*' => 'required|file',
            'passport_photo.*' => 'required|file',
            'trade_license.*' => 'required|file',
            'tax_certificate.*' => 'required|file',
            'wood_license.*' => 'required|file',
            'bank_guarantee.*' => 'required|file',
            'mobile_signature.*' => 'required|file',
        ]);

        $bidderRequest = BidderAuctionRequest::create([
            'bidder_id' => $bidder->id,
            'auction_id' => $auction->id,
            'pay_amount' => $request->pay_amount,
            'is_condition_accept' => $request->has('is_condition_accept') ? 1 : 0,
            'status' => '1', // pending
        ]);

        // save uploaded documents
        $docFields = [
            'pay_order',
            'auto_chalan',
            'nid_copy',
            'passport_photo',
            'trade_license',
            'tax_certificate',
            'wood_license',
            'bank_guarantee',
            'mobile_signature',
        ];

        foreach ($docFields as $field) {
            if ($request->hasFile($field)) {
                foreach ($request->file($field) as $file) {
                    $bidderRequest
                        ->addMedia($file)
                        ->toMediaCollection($field);
                }
            }
        }

        // return with pending and pdf 
        return response()->json([
            'pdf_url' => route('bidder.interest.print', $bidderRequest->id),
            'redirect_url' => route('bidderInterest.pending'),
        ]);

        // return redirect()->route('bidderInterest.pending');
    }

    // show pending requests
    public function pendingInterest()
    {
        $bidder = Auth::guard('bidder')->user();

        $pendingRequests = BidderAuctionRequest::with('auction')
            ->where('bidder_id', $bidder->id)
            ->where('status', '1')
            ->get();

        return view('frontend.auction.pending', compact('pendingRequests'));
    }

    // public function interestPdf(BidderAuctionRequest $interest)
    // {
    //     $interest->load('auction.lots.lotLotItems');
    //     $documents = Document::all();

    //     $pdf = Pdf::loadView('frontend.auction.pdf.bidder-interest', [
    //         'interest' => $interest,
    //         'auction' => $interest->auction,
    //         'documents' => $documents,
    //     ]);


    //     return $pdf->stream('bidder-interest.pdf');
    // }



    public function interestPrint($id)
    {
        $interest = BidderAuctionRequest::with('auction.lots.lotLotItems')->findOrFail($id);
        $auction = $interest->auction;
        $documents = Document::all();
        return view('frontend.auction.pdf.bidder-interest', compact('interest', 'auction', 'documents'));
    }
}
