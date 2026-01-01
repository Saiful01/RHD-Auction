<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Mail\BidderApprovedMail;
use App\Models\Bidder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;



class AuthController extends Controller
{
    use MediaUploadingTrait;
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

        $bidder = Bidder::where('email', $request->email)->first();

        if (!$bidder) {
            return back()->withErrors([
                'email' => 'Account not found. Please signup first.',
            ]);
        }

        if ($bidder->status != 1) {
            // Auth::guard('bidder')->logout();
            return redirect()->route('bidder.pending')
                ->withErrors(['email' => 'Your account is not approved yet. Please wait for approval.']);
        }

        if (!Auth::guard('bidder')->attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Invalid email or password.',
            ]);
        }


        return redirect()->route('bidder.dashboard');
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
            'nid_no' => 'required|string',
            'tin_no' => 'nullable|string',
            'bin_no' => 'nullable|string',
            'profile_image' => 'nullable|file|mimes:jpg,jpeg,png',
            'nid_file' => 'required|file|mimes:jpg,jpeg,png,pdf',
            'tin_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'bin_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        // // file upload
        // $photoFile = $request->file('profile_image')->store('bidders/photo', 'public');
        // $nidFile = $request->file('nid_file')->store('bidders/nid', 'public');
        // $tinFile = $request->file('tin_file')?->store('bidders/tin', 'public');
        // $binFile = $request->file('bin_file')?->store('bidders/bin', 'public');




        // create bidder
        $bidder = Bidder::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,

            'nid_no' => $request->nid_no,
            'tin_no' => $request->tin_no,
            'bin_no' => $request->bin_no,
            'status' => 0,
        ]);

        // file save
        if ($request->hasFile('profile_image')) {
            $tmpPath = $request->file('profile_image')->store('tmp/uploads');
            $bidder->addMedia(storage_path('app/' . $tmpPath))->toMediaCollection('profile_image');
        }

        if ($request->hasFile('nid_file')) {
            $tmpPath = $request->file('nid_file')->store('tmp/uploads');
            $bidder->addMedia(storage_path('app/' . $tmpPath))->toMediaCollection('nid_file');
        }

        if ($request->hasFile('tin_file')) {
            $tmpPath = $request->file('tin_file')->store('tmp/uploads');
            $bidder->addMedia(storage_path('app/' . $tmpPath))->toMediaCollection('tin_file');
        }

        if ($request->hasFile('bin_file')) {
            $tmpPath = $request->file('bin_file')->store('tmp/uploads');
            $bidder->addMedia(storage_path('app/' . $tmpPath))->toMediaCollection('bin_file');
        }
        // return $request->all();



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
