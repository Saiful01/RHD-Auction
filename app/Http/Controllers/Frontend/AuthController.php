<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // bidder login page
    public function showLogin()
    {
        return view('frontend.auth.login');
    }

    // bidder signup page
    public function showSignup()
    {
        return view('frontend.auth.signup');
    }
}