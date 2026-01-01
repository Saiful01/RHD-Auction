<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckBidderStatus
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('bidder')->check()) {
            $bidder = Auth::guard('bidder')->user();

            if ($bidder->status !== 1) {
                Auth::guard('bidder')->logout();

                return redirect()
                    ->route('bidder.pending')
                    ->withErrors([
                        'email' => 'Your account is not approved yet.'
                    ]);
            }
        }

        return $next($request);
    }
}
