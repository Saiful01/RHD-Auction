@extends('frontend_layouts.frontend')

@section('title', 'Account Under Review')

@section('content')
    <!-- Start Waiting Page -->
    <div class="error-page pt-110 mb-110">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="error-wrap">

                        <div class="error-content text-center">
                            <h1>আপনার অ্যাকাউন্ট বর্তমানে রিভিউ অবস্থায় রয়েছে</h1>

                            <div class="container pt-5 mb-3">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <div class="alert alert-warning text-center py-4 px-3"
                                            style="border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.15); font-size: 1.1rem;">

                                            <p>
                                                আপনি সফলভাবে bidder হিসেবে নিবন্ধন সম্পন্ন করেছেন। বর্তমানে আপনার অ্যাকাউন্ট
                                                বর্তমানে আমাদের অ্যাডমিন টিম আপনার প্রদত্ত তথ্য যাচাই করছে।
                                                <br><br>
                                                যাচাই ও অনুমোদন সম্পন্ন হলে আপনাকে ইমেইল ঠিকানার মাধ্যমে অবহিত করা হবে।
                                                <br><br>
                                                অনুগ্রহ করে নিশ্চিত করুন যে, আপনার নিবন্ধনের সময় ব্যবহৃত <strong>ইমেইল
                                                    ঠিকানা</strong> এবং <strong>মোবাইল নম্বর</strong> সক্রিয় রয়েছে।
                                                প্রয়োজন হলে এই মাধ্যমগুলোর মাধ্যমে আপনার সাথে যোগাযোগ করা হবে।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="back-btn d-flex justify-content-center">
                                <a class="primary-btn btn-hover" href="{{ route('bidder.login') }}">
                                    Login
                                    <span></span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Waiting Page -->
@endsection
