<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\BidderApprovedMail;
use App\Models\Bidder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    // bidder login page
    public function showLogin()
    {
        return view('frontend.auth.login');
    }

    // bidder login credentials check
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        Auth::guard('web')->logout();
        Auth::guard('bidder')->logout();

        // session regenerate
        $request->session()->invalidate();
        $request->session()->regenerateToken();


        if (Auth::guard('bidder')->attempt($credentials)) {

            $bidder = Auth::guard('bidder')->user();
            if ($bidder->status != 'approved') {
                Auth::guard('bidder')->logout();
                return redirect()->route('bidder.pending')
                    ->withErrors(['email' => 'Your account is not approved yet. Please wait for approval.']);
            }
            $request->session()->regenerate();
            return redirect()->route('bidder.dashboard');
        }
        return back()->withErrors([
            'email' => 'Invalid bidder credentials',
        ]);
    }

    // bidder signup page
    public function showSignup()
    {
        return view('frontend.auth.signup');
    }

    // bidder sigup store
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:bidders,email',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|string',
            'nid_number' => 'required|string',
            'tin_number' => 'nullable|string',
            'bin_number' => 'nullable|string',
            'photo' => 'nullable|file|mimes:jpg,jpeg,png',
            'nid_file' => 'required|file|mimes:jpg,jpeg,png,pdf',
            'tin_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'bin_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        // file upload
        $photoFile = $request->file('photo')->store('bidders/photo', 'public');
        $nidFile = $request->file('nid_file')->store('bidders/nid', 'public');
        $tinFile = $request->file('tin_file')?->store('bidders/tin', 'public');
        $binFile = $request->file('bin_file')?->store('bidders/bin', 'public');



        // create bidder
        $bidder = Bidder::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,

            'nid_number' => $request->nid_number,
            'tin_number' => $request->tin_number,
            'bin_number' => $request->bin_number,

            'photo' => $photoFile,
            'nid_file' => $nidFile,
            'tin_file' => $tinFile,
            'bin_file' => $binFile,
            'status' => 'pending',
        ]);

        return redirect()->route('bidder.pending');
    }


    // bidder pending page

    public function pending()
    {
        return view('frontend.auth.pending');
    }

    // bidder dashboard page
    public function dashboard()
    {
        $bidder = auth('bidder')->user();
        return view('frontend.bidder.dashboard', compact('bidder'));
    }

    // bidder logout
    public function logout(Request $request)
    {
        Auth::guard('bidder')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('bidder.login');
    }

    public function profile()
    {
        $bidder = auth('bidder')->user();
        return view('frontend.bidder.profile', compact('bidder'));
    }

    public function update(Request $request)
    {
        $bidder = auth('bidder')->user();

        $request->validate([
            'name'      => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'address'   => 'nullable|string|max:500',
            'email'     => 'nullable|email|unique:bidders,email,' . $bidder->id,
            'phone'     => 'nullable|string|max:20',
            'photo'     => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        // যদি নতুন photo আসে, replace করো
        if ($request->hasFile('photo')) {
            if ($bidder->photo && Storage::disk('public')->exists($bidder->photo)) {
                Storage::disk('public')->delete($bidder->photo);
            }
            $bidder->photo = $request->file('photo')->store('bidders/photo', 'public');
        }

        $bidder->update([
            'name'      => $request->name ?? $bidder->name,
            'last_name' => $request->last_name ?? $bidder->last_name,
            'address'   => $request->address ?? $bidder->address,
            'email'     => $request->email ?? $bidder->email,
            'phone'     => $request->phone ?? $bidder->phone,
            'photo'     => $bidder->photo,
        ]);

        return back()->with('success', 'Profile updated successfully');
    }
}
