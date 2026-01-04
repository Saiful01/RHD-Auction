@extends('frontend_layouts.frontend')

@section('content')
    <!-- Start Breadcrumb section -->
    <div class="breadcrumb-section"
        style="background-image: url(../assets/img/inner-pages/breadcrumb-bg1.png), linear-gradient(87.29deg, #FDF8E7 0%, #E4FFF0 99.71%);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center">
                    <div class="banner-content">
                        <h1>কিভাবে বিড করবেন ?</h1>
                        <ul class="breadcrumb-list">
                            <li><a href="{{ route('home') }}">হোম</a></li>
                            <li>কিভাবে বিড করবেন</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb section -->

    <!-- Start How To Sell section -->
    <div class="how-to-sell-section pt-110 mb-110">
        <div class="container">
            <div class="row justify-content-center mb-70">
                <div class="col-lg-10">
                    <div class="how-to-sell-wrap">

                        <div class="row mb-25">
                            <div class="col-lg-5 col-md-6">
                                <div class="single-step">
                                    <span>Step-01</span>
                                    <h2>রেজিস্ট্রেশন</h2>
                                    <p>
                                        নিলামে অংশগ্রহণ করতে প্রথমে ওয়েবসাইটে একটি অ্যাকাউন্ট তৈরি করুন।
                                        সঠিক তথ্য দিয়ে রেজিস্ট্রেশন সম্পন্ন করে লগইন করুন।
                                    </p>
                                    <div class="arrow">
                                        <svg width="11" height="11" viewBox="0 0 11 11"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.501 10.501L2.99848 10.501L2.99848 9.66931L9.07931 9.66931L0.498476 1.08897L1.08848 0.500977L9.66764 9.07965L9.66764 2.99515L10.501 2.99515L10.501 10.501Z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-end mb-25">
                            <div class="col-lg-5 col-md-6">
                                <div class="single-step two">
                                    <span>Step-02</span>
                                    <h2>নিলাম তালিকা দেখুন</h2>
                                    <p>
                                        চলমান নিলামগুলো ব্রাউজ করুন।
                                        প্রপার্টি বা আইটেমের বিস্তারিত তথ্য, শর্তাবলি ও বর্তমান বিড মূল্য যাচাই করুন।
                                    </p>
                                    <div class="arrow">
                                        <svg width="11" height="11" viewBox="0 0 11 11"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.501 10.501L2.99848 10.501L2.99848 9.66931L9.07931 9.66931L0.498476 1.08897L1.08848 0.500977L9.66764 9.07965L9.66764 2.99515L10.501 2.99515L10.501 10.501Z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-25">
                            <div class="col-lg-5 col-md-6">
                                <div class="single-step">
                                    <span>Step-03</span>
                                    <h2>বিড করুন</h2>
                                    <p>
                                        আপনার পছন্দের নিলামে নির্ধারিত নিয়ম অনুযায়ী বিড করুন।
                                        প্রতিবার বিড করার সময় বর্তমান সর্বোচ্চ বিডের চেয়ে বেশি পরিমাণ প্রদান করতে হবে।
                                    </p>
                                    <div class="arrow">
                                        <svg width="11" height="11" viewBox="0 0 11 11"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.501 10.501L2.99848 10.501L2.99848 9.66931L9.07931 9.66931L0.498476 1.08897L1.08848 0.500977L9.66764 9.07965L9.66764 2.99515L10.501 2.99515L10.501 10.501Z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-end mb-25">
                            <div class="col-lg-5 col-md-6">
                                <div class="single-step two">
                                    <span>Step-04</span>
                                    <h2>নিলাম জিতুন</h2>
                                    <p>
                                        নিলাম শেষ হওয়ার সময় যদি আপনার বিড সর্বোচ্চ থাকে,
                                        তাহলে আপনিই বিজয়ী হবেন এবং আপনাকে নোটিফিকেশনের মাধ্যমে জানানো হবে।
                                    </p>
                                    <div class="arrow">
                                        <svg width="11" height="11" viewBox="0 0 11 11"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.501 10.501L2.99848 10.501L2.99848 9.66931L9.07931 9.66931L0.498476 1.08897L1.08848 0.500977L9.66764 9.07965L9.66764 2.99515L10.501 2.99515L10.501 10.501Z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-25">
                            <div class="col-lg-5 col-md-6">
                                <div class="single-step">
                                    <span>Step-05</span>
                                    <h2>পেমেন্ট ও হস্তান্তর</h2>
                                    <p>
                                        নিলাম জয়ের পর নির্ধারিত সময়ের মধ্যে পেমেন্ট সম্পন্ন করুন।
                                        পেমেন্ট যাচাই শেষে প্রপার্টি বা আইটেম হস্তান্তরের প্রক্রিয়া শুরু হবে।
                                    </p>
                                    <div class="arrow">
                                        <svg width="11" height="11" viewBox="0 0 11 11"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.501 10.501L2.99848 10.501L2.99848 9.66931L9.07931 9.66931L0.498476 1.08897L1.08848 0.500977L9.66764 9.07965L9.66764 2.99515L10.501 2.99515L10.501 10.501Z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End How To Sell section -->
@endsection
