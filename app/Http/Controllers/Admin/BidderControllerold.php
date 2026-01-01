<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\BidderApprovedMail;
use App\Models\Bidder;
use Illuminate\Support\Facades\Mail;

class BidderController extends Controller
{
    // bidder approve function
    public function approve(Bidder $bidder)
    {
        $bidder->status = 'approved';
        $bidder->save();

        // Send email
        Mail::to($bidder->email)->send(new BidderApprovedMail($bidder));

        return back()->with('success', 'Bidder approved and email sent.');
    }
}
