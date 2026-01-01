<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function home()
    {
        $auctions = Auction::with(['financial_year', 'road', 'package', 'lots', 'employees'])->get();
        return view('frontend.home.index', compact('auctions'));
    }

    public function auction_details(Auction $auction)
    {
        $auction->load(['financial_year', 'road', 'package', 'lots.lotLotItems', 'employees']);
        return view('frontend.home.auction_details', compact('auction'));
    }

    // bidder registration form
    
}
