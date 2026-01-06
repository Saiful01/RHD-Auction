@extends('frontend_layouts.frontend')

@section('content')
    <!-- Start Banner section -->
    <div class="home1-banner-section mb-50">
        <div class="banner-wrapper"
            style="background-image: linear-gradient(180deg, rgba(11, 12, 12, 0.65) 0%, rgba(11, 12, 12, 0.65) 100%), url(assets/img/banner.jpg);">
            <div class="container">
                <div class="banner-content">
                    <span class="sub-title">
                        <svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6.6304 0.338424C6.67018 -0.112811 7.32982 -0.112807 7.3696 0.338428L7.72654 4.38625C7.75291 4.68505 8.10454 4.83069 8.33443 4.63804L11.4491 2.02821C11.7963 1.73728 12.2627 2.20368 11.9718 2.55089L9.36197 5.66556C9.1693 5.89546 9.31496 6.24709 9.61374 6.27346L13.6615 6.6304C14.1128 6.67018 14.1128 7.32982 13.6615 7.3696L9.61374 7.72654C9.31496 7.75291 9.1693 8.10454 9.36197 8.33443L11.9718 11.4491C12.2627 11.7963 11.7963 12.2627 11.4491 11.9718L8.33443 9.36197C8.10454 9.1693 7.75291 9.31496 7.72654 9.61374L7.3696 13.6615C7.32982 14.1128 6.67018 14.1128 6.6304 13.6615L6.27346 9.61374C6.24709 9.31496 5.89546 9.1693 5.66556 9.36197L2.55089 11.9718C2.20368 12.2627 1.73729 11.7963 2.02822 11.4491L4.63804 8.33443C4.83069 8.10454 4.68504 7.75291 4.38625 7.72654L0.338424 7.3696C-0.112811 7.32982 -0.112807 6.67018 0.338428 6.6304L4.38625 6.27346C4.68505 6.24709 4.83069 5.89546 4.63804 5.66556L2.02821 2.55089C1.73728 2.20368 2.20368 1.73729 2.55089 2.02822L5.66556 4.63804C5.89546 4.83069 6.24709 4.68504 6.27346 4.38625L6.6304 0.338424Z" />
                        </svg>
                        গাছ হবে সম্পদ, নিলাম আনবে সমৃদ্ধি।
                        <svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6.6304 0.338424C6.67018 -0.112811 7.32982 -0.112807 7.3696 0.338428L7.72654 4.38625C7.75291 4.68505 8.10454 4.83069 8.33443 4.63804L11.4491 2.02821C11.7963 1.73728 12.2627 2.20368 11.9718 2.55089L9.36197 5.66556C9.1693 5.89546 9.31496 6.24709 9.61374 6.27346L13.6615 6.6304C14.1128 6.67018 14.1128 7.32982 13.6615 7.3696L9.61374 7.72654C9.31496 7.75291 9.1693 8.10454 9.36197 8.33443L11.9718 11.4491C12.2627 11.7963 11.7963 12.2627 11.4491 11.9718L8.33443 9.36197C8.10454 9.1693 7.75291 9.31496 7.72654 9.61374L7.3696 13.6615C7.32982 14.1128 6.67018 14.1128 6.6304 13.6615L6.27346 9.61374C6.24709 9.31496 5.89546 9.1693 5.66556 9.36197L2.55089 11.9718C2.20368 12.2627 1.73729 11.7963 2.02822 11.4491L4.63804 8.33443C4.83069 8.10454 4.68504 7.75291 4.38625 7.72654L0.338424 7.3696C-0.112811 7.32982 -0.112807 6.67018 0.338428 6.6304L4.38625 6.27346C4.68505 6.24709 4.83069 5.89546 4.63804 5.66556L2.02821 2.55089C1.73728 2.20368 2.20368 1.73729 2.55089 2.02822L5.66556 4.63804C5.89546 4.83069 6.24709 4.68504 6.27346 4.38625L6.6304 0.338424Z" />
                        </svg>
                    </span>


                    <h1>সওজ <span>বৃক্ষপালনবিদ নিলামে </span> আপনাদের স্বাগতম </h1>
                    {{-- <ul>
                        <li>
                            <svg width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M18 9C18 9.768 17.0565 10.401 16.8675 11.109C16.6725 11.841 17.166 12.861 16.7955 13.5015C16.419 14.1525 15.2865 14.2305 14.7585 14.7585C14.2305 15.2865 14.1525 16.419 13.5015 16.7955C12.861 17.166 11.841 16.6725 11.109 16.8675C10.401 17.0565 9.768 18 9 18C8.232 18 7.599 17.0565 6.891 16.8675C6.159 16.6725 5.139 17.166 4.4985 16.7955C3.8475 16.419 3.7695 15.2865 3.2415 14.7585C2.7135 14.2305 1.581 14.1525 1.2045 13.5015C0.834 12.861 1.3275 11.841 1.1325 11.109C0.9435 10.401 0 9.768 0 9C0 8.232 0.9435 7.599 1.1325 6.891C1.3275 6.159 0.834 5.139 1.2045 4.4985C1.581 3.8475 2.7135 3.7695 3.2415 3.2415C3.7695 2.7135 3.8475 1.581 4.4985 1.2045C5.139 0.834 6.159 1.3275 6.891 1.1325C7.599 0.9435 8.232 0 9 0C9.768 0 10.401 0.9435 11.109 1.1325C11.841 1.3275 12.861 0.834 13.5015 1.2045C14.1525 1.581 14.2305 2.7135 14.7585 3.2415C15.2865 3.7695 16.419 3.8475 16.7955 4.4985C17.166 5.139 16.6725 6.159 16.8675 6.891C17.0565 7.599 18 8.232 18 9Z" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.3797 5.3254L8.02828 12.7353L3.64648 8.35356L4.35359 7.64645L7.9718 11.2647L13.6204 4.67461L14.3797 5.3254Z" />
                            </svg>
                            নিলাম শ্রেষ্ঠত্ব
                        </li>
                        <li>
                            <svg width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M18 9C18 9.768 17.0565 10.401 16.8675 11.109C16.6725 11.841 17.166 12.861 16.7955 13.5015C16.419 14.1525 15.2865 14.2305 14.7585 14.7585C14.2305 15.2865 14.1525 16.419 13.5015 16.7955C12.861 17.166 11.841 16.6725 11.109 16.8675C10.401 17.0565 9.768 18 9 18C8.232 18 7.599 17.0565 6.891 16.8675C6.159 16.6725 5.139 17.166 4.4985 16.7955C3.8475 16.419 3.7695 15.2865 3.2415 14.7585C2.7135 14.2305 1.581 14.1525 1.2045 13.5015C0.834 12.861 1.3275 11.841 1.1325 11.109C0.9435 10.401 0 9.768 0 9C0 8.232 0.9435 7.599 1.1325 6.891C1.3275 6.159 0.834 5.139 1.2045 4.4985C1.581 3.8475 2.7135 3.7695 3.2415 3.2415C3.7695 2.7135 3.8475 1.581 4.4985 1.2045C5.139 0.834 6.159 1.3275 6.891 1.1325C7.599 0.9435 8.232 0 9 0C9.768 0 10.401 0.9435 11.109 1.1325C11.841 1.3275 12.861 0.834 13.5015 1.2045C14.1525 1.581 14.2305 2.7135 14.7585 3.2415C15.2865 3.7695 16.419 3.8475 16.7955 4.4985C17.166 5.139 16.6725 6.159 16.8675 6.891C17.0565 7.599 18 8.232 18 9Z" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.3797 5.3254L8.02828 12.7353L3.64648 8.35356L4.35359 7.64645L7.9718 11.2647L13.6204 4.67461L14.3797 5.3254Z" />
                            </svg>
                            টাকা ফেরতের গ্যারান্টি
                        </li>
                        <li>
                            <svg width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M18 9C18 9.768 17.0565 10.401 16.8675 11.109C16.6725 11.841 17.166 12.861 16.7955 13.5015C16.419 14.1525 15.2865 14.2305 14.7585 14.7585C14.2305 15.2865 14.1525 16.419 13.5015 16.7955C12.861 17.166 11.841 16.6725 11.109 16.8675C10.401 17.0565 9.768 18 9 18C8.232 18 7.599 17.0565 6.891 16.8675C6.159 16.6725 5.139 17.166 4.4985 16.7955C3.8475 16.419 3.7695 15.2865 3.2415 14.7585C2.7135 14.2305 1.581 14.1525 1.2045 13.5015C0.834 12.861 1.3275 11.841 1.1325 11.109C0.9435 10.401 0 9.768 0 9C0 8.232 0.9435 7.599 1.1325 6.891C1.3275 6.159 0.834 5.139 1.2045 4.4985C1.581 3.8475 2.7135 3.7695 3.2415 3.2415C3.7695 2.7135 3.8475 1.581 4.4985 1.2045C5.139 0.834 6.159 1.3275 6.891 1.1325C7.599 0.9435 8.232 0 9 0C9.768 0 10.401 0.9435 11.109 1.1325C11.841 1.3275 12.861 0.834 13.5015 1.2045C14.1525 1.581 14.2305 2.7135 14.7585 3.2415C15.2865 3.7695 16.419 3.8475 16.7955 4.4985C17.166 5.139 16.6725 6.159 16.8675 6.891C17.0565 7.599 18 8.232 18 9Z" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.3797 5.3254L8.02828 12.7353L3.64648 8.35356L4.35359 7.64645L7.9718 11.2647L13.6204 4.67461L14.3797 5.3254Z" />
                            </svg>
                            ২৪/৭ সাপোর্ট
                        </li>
                    </ul> --}}
                    <div class="button-area">
                        <a class="primary-btn btn-hover" href="/">
                            বিড শুরু করুন
                            <svg width="11" height="11" viewBox="0 0 11 11" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M10.0266 9.33856L0.689022 0.000487831L-3.01181e-08 0.68951L9.33807 10.0271L2.88172 10.0271L2.88172 11.001L11.0005 11.001L11.0005 2.88221L10.0266 2.88221L10.0266 9.33856Z" />
                            </svg>
                            <span></span>
                        </a>
                        <a class="primary-btn btn-hover white-bg" href="/">
                            সবগুলো দেখুন নিলাম
                            <span></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Banner section -->

    <!-- Start Live Auction section -->
    <div class="live-aution-section mb-110" id="auctions">
        <div class="container">
            <div class="row mb-60 wow animate fadeInDown" data-wow-delay="200ms" data-wow-duration="1500ms">
                <div class="col-lg-12 d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div class="section-title">
                        <h2>লাইভ <span>নিলাম</span></h2>
                        <p>টেকসই বৃক্ষ, সঠিক মান—নিলামে সেরা কাষ্ঠের সন্ধান।</p>
                    </div>
                    <div class="slider-btn-grp">
                        <div class="slider-btn auction-slider-prev">
                            <svg width="9" height="15" viewBox="0 0 9 15" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 7.50009L9 0L3.27273 7.50009L9 15L0 7.50009Z" />
                            </svg>
                        </div>
                        <div class="slider-btn auction-slider-next">
                            <svg width="9" height="15" viewBox="0 0 9 15" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 7.50009L0 0L5.72727 7.50009L0 15L9 7.50009Z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="auction-slider-area mb-70 wow animate fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="swiper auction-slider">
                            <div class="swiper-wrapper">
                                @php
                                    use Carbon\Carbon;
                                    $now = Carbon::now();
                                @endphp
                                @foreach ($auctions as $auction)
                                    @php
                                        $startTime = $auction->auction_start_time
                                            ? Carbon::parse($auction->auction_start_time)
                                            : null;
                                        $badgeText = 'Upcoming';
                                        $badgeClass = 'upcoming';
                                        $isClickable = false;

                                        if ($auction->status === 'active' && $startTime->lte($now)) {
                                            $badgeText = 'Live';
                                            $badgeClass = 'live';
                                            $isClickable = true;
                                        } elseif ($auction->status === 'rejected') {
                                            $badgeText = 'Rejected';
                                            $badgeClass = 'rejected';
                                            $isClickable = false;
                                        } elseif ($auction->status === 'under_review') {
                                            $badgeText = 'Upcoming';
                                            $badgeClass = 'upcoming';
                                            $isClickable = false;
                                        }
                                    @endphp
                                    <div class="swiper-slide"
                                        style="{{ $isClickable ? '' : 'pointer-events:none; opacity:0.6;' }}">
                                        <div class="auction-card">
                                            <div class="auction-card-img-wrap">
                                                <a href="{{ $isClickable ? route('auction.details', $auction->id) : 'javascript:void(0)' }}"
                                                    class="card-img">
                                                    @php
                                                        // lot item image
                                                        $firstItemImage = null;
                                                        foreach ($auction->lots as $lot) {
                                                            foreach ($lot->lotLotItems as $item) {
                                                                if ($item->item_image) {
                                                                    $firstItemImage = $item->item_image;
                                                                    break 2;
                                                                }
                                                            }
                                                        }
                                                    @endphp

                                                    <img src="{{ asset($firstItemImage ?? 'assets/img/home1/auction-img1.jpg') }}"
                                                        alt="Auction Image">
                                                </a>

                                                <div class="batch">
                                                    <span class="{{ $badgeClass }}">
                                                        <svg width="11" height="11" viewBox="0 0 11 11"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M10.6777 11H4.83398C4.65599 11 4.51172 10.8557 4.51172 10.6777V10.334C4.51172 9.97798 4.80025 9.68944 5.15625 9.68944V9.30414C5.15625 8.79397 5.57133 8.37889 6.0815 8.37889H9.43022C9.94039 8.37889 10.3555 8.79397 10.3555 9.30414V9.68944C10.7115 9.68944 11 9.97798 11 10.334V10.6777C11 10.8556 10.8556 11 10.6777 11ZM6.96665 7.09722C6.75245 7.38146 6.34829 7.43829 6.06405 7.22402C5.77973 7.00985 5.72299 6.60568 5.93716 6.32134L7.8766 3.74766C8.09087 3.46333 8.49494 3.40659 8.7792 3.62077C9.06353 3.83503 9.12035 4.23911 8.90609 4.52346L6.96665 7.09722ZM2.334 3.60618C2.11973 3.89042 1.71563 3.94725 1.43131 3.73298C1.14707 3.51881 1.09025 3.11473 1.30451 2.83038L3.24397 0.256726C3.45815 -0.027598 3.86231 -0.0844241 4.14657 0.12984C4.43081 0.344103 4.48763 0.748181 4.27337 1.03253L2.334 3.60618ZM3.74767 5.4785C3.27134 5.11956 2.91373 4.67385 2.69008 4.20454L4.94678 1.20984C5.45955 1.29552 5.98651 1.51631 6.46293 1.87534C6.93928 2.23428 7.29689 2.67999 7.52054 3.14921L5.26382 6.14409C4.75108 6.05841 4.22411 5.83751 3.74767 5.4785ZM2.87749 5.56242C3.02753 5.71533 3.18557 5.86196 3.35979 5.99329C3.53409 6.12456 3.71864 6.23606 3.90689 6.33822L3.48668 6.89589L2.45719 6.12018L2.87749 5.56242ZM2.06929 6.63488L3.09878 7.41059L1.15932 9.98436C0.945055 10.2687 0.540977 10.3254 0.256717 10.1112C-0.027607 9.89698 -0.0843477 9.4929 0.12983 9.20856L2.06929 6.63488Z" />
                                                        </svg>
                                                        {{ $badgeText }}
                                                    </span>
                                                </div>
                                                <ul class="view-and-favorite-area">
                                                    <li>
                                                        <a href="#">
                                                            <svg width="16" height="15" viewBox="0 0 16 15"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8.00013 3.32629L7.32792 2.63535C5.75006 1.01348 2.85685 1.57317 1.81244 3.61222C1.32211 4.57128 1.21149 5.95597 2.10683 7.72315C2.96935 9.42471 4.76378 11.4628 8.00013 13.6828C11.2365 11.4628 13.03 9.42471 13.8934 7.72315C14.7888 5.95503 14.6791 4.57128 14.1878 3.61222C13.1434 1.57317 10.2502 1.01254 8.67234 2.63441L8.00013 3.32629ZM8.00013 14.8125C-6.375 5.31378 3.57406 -2.09995 7.83512 1.8216C7.89138 1.87317 7.94669 1.9266 8.00013 1.98192C8.05303 1.92665 8.10807 1.87349 8.16513 1.82254C12.4253 -2.10182 22.3753 5.31284 8.00013 14.8125Z" />
                                                            </svg>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <svg width="17" height="11" viewBox="0 0 17 11"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M15.4028 5.44118C14.0143 7.8425 11.3811 9.33421 8.53217 9.33421C5.68139 9.33421 3.04821 7.8425 1.65968 5.44118C1.55274 5.25472 1.55274 5.05762 1.65968 4.87132C3.04821 2.47003 5.68139 0.978484 8.53217 0.978484C11.3811 0.978484 14.0143 2.47003 15.4028 4.87132C15.5116 5.05762 15.5116 5.25472 15.4028 5.44118ZM16.2898 4.39522C14.7224 1.68403 11.7499 0 8.53217 0C5.31258 0 2.3401 1.68403 0.772715 4.39522C0.492428 4.87896 0.492428 5.43355 0.772715 5.91693C2.3401 8.62812 5.31258 10.3125 8.53217 10.3125C11.7499 10.3125 14.7224 8.62812 16.2898 5.91693C16.5701 5.43358 16.5701 4.87896 16.2898 4.39522ZM8.53217 7.1634C9.68098 7.1634 10.6159 6.26305 10.6159 5.15617C10.6159 4.04929 9.68098 3.14894 8.53217 3.14894C7.38152 3.14894 6.44663 4.04929 6.44663 5.15617C6.44663 6.26305 7.38156 7.1634 8.53217 7.1634ZM8.53217 2.17045C6.82095 2.17045 5.43061 3.50998 5.43061 5.1562C5.43061 6.80278 6.82098 8.14176 8.53217 8.14176C10.2416 8.14176 11.6319 6.80275 11.6319 5.1562C11.6319 3.50998 10.2416 2.17045 8.53217 2.17045Z" />
                                                            </svg>
                                                        </a>
                                                    </li>
                                                </ul>
                                                @if ($badgeText === 'Live')
                                                    <div class="countdown-timer">
                                                        <ul
                                                            data-countdown="{{ \Carbon\Carbon::parse($auction->auction_end_time)->format('Y-m-d H:i:s') }}">
                                                            <li class="times" data-days="00">00</li>
                                                            <li class="colon">
                                                                :
                                                            </li>
                                                            <li class="times" data-hours="00">00</li>
                                                            <li class="colon">
                                                                :
                                                            </li>
                                                            <li class="times" data-minutes="00">00</li>
                                                            <li class="colon">
                                                                :
                                                            </li>
                                                            <li class="times" data-seconds="00">00</li>
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="auction-card-content">
                                                <h6>
                                                    <a
                                                        href="{{ $isClickable ? route('auction.details', $auction->id) : 'javascript:void(0)' }}">
                                                        {{ strip_tags($auction->name) }}
                                                    </a>
                                                </h6>
                                                <div class="price-and-code-area">
                                                    @if ($badgeText === 'Live')
                                                        <div class="price">
                                                            <span>বর্তমান ভিত্তিমূল্য:</span>
                                                            <strong>{{ $auction->base_value_amount }} ৳</strong>
                                                        </div>
                                                    @endif
                                                    <div class="code">
                                                        <span>
                                                            @foreach ($auction->lots as $lot)
                                                                {{ strip_tags($lot->details) }}
                                                            @endforeach
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="author-and-btn-area">
                                                    {{-- <a class="author-area">
                                                        <div class="author-img">
                                                            <img src="assets/img/home1/auction-card-author-img1.png"
                                                                alt="">
                                                        </div>
                                                        <div class="author-content">
                                                            <h6>
                                                                @foreach ($auction->employees as $employee)
                                                                    {{ $employee->name_en }}
                                                                @endforeach
                                                            </h6>
                                                        </div>
                                                    </a> --}}
                                                    <a href="{{ $isClickable ? route('auction.details', $auction->id) : 'javascript:void(0)' }}"
                                                        class="bid-btn {{ $isClickable ? '' : 'disabled' }}">
                                                        View Details
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row wow animate fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
                <div class="col-lg-12 d-flex justify-content-center">
                    <a class="view-button" href="auction-grid.html">
                        View All Auction
                        <svg viewBox="0 0 13 20">
                            <polyline points="0.5 19.5 3 19.5 12.5 10 3 0.5"></polyline>
                        </svg>
                    </a>
                </div>
            </div> --}}
        </div>
    </div>
    <!-- End Live Auction section -->

    <!-- Start Faq section -->
    <div class="home1-faq-section mb-110" id="contact">
        <div class="container">
            <div class="row mb-60 wow animate fadeInDown" data-wow-delay="200ms" data-wow-duration="1500ms">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>প্রায়শই জিজ্ঞাস্য <span>প্রশ্নসমূহ</span></h2>
                        <p>আপনার নিলামের সাথে সম্পর্কিত সাধারণ প্রশ্নগুলোর উত্তর এখানে পাবেন।</p>
                    </div>
                </div>
            </div>
            <div class="row gy-5">
                <!-- Left Contact Info -->
                <div class="col-lg-4 wow animate fadeInLeft" data-wow-delay="200ms" data-wow-duration="1500ms">
                    <div class="faq-contact-wrap p-4"
                        style="background:#fdf6e7; border-radius:10px; box-shadow:0 0 15px rgba(0,0,0,0.05);">
                        <div class="contact-address-area text-start text-lg-center">
                            <h4 class="mb-3">যোগাযোগ করুন</h4>

                            <div class="contact-area mb-3">
                                <div class="d-flex align-items-center mb-1">
                                    <span class="me-2" style="font-size:20px;"><i class="bi bi-building"></i></span>
                                    <strong>অফিসের নাম:</strong>
                                </div>
                                <hr style="border-top: 1px solid #ccc; margin:0 0 5px 0;">
                                <div>সওজ বৃক্ষপালনবিদ, পাইকপাড়া, মিরপুর, ঢাকা।</div>
                            </div>

                            <div class="contact-area mb-3">
                                <div class="d-flex align-items-center mb-1">
                                    <span class="me-2" style="font-size:20px;"><i class="bi bi-envelope"></i></span>
                                    <strong>ইমেইল:</strong>
                                </div>
                                <hr style="border-top: 1px solid #ccc; margin:0 0 5px 0;">
                                <div><a href="mailto:info@auction.com">ecodeast@rhd.gov.bd</a></div>
                            </div>

                            <div class="contact-area mb-3">
                                <div class="d-flex align-items-center mb-1">
                                    <span class="me-2" style="font-size:20px;"><i class="bi bi-telephone"></i></span>
                                    <strong>ফোন:</strong>
                                </div>
                                <hr style="border-top: 1px solid #ccc; margin:0 0 5px 0;">
                                <div>+880 1234 567890</div>
                            </div>

                        </div>
                    </div>
                </div>



                <!-- Right FAQ Accordion -->
                <div class="col-lg-8 wow animate fadeInRight" data-wow-delay="200ms" data-wow-duration="1500ms">
                    <div class="faq-wrappper">
                        <div class="faq-content">
                            <div class="accordion" id="accordionGeneral">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="faqheadingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faqcollapseOne" aria-expanded="true"
                                            aria-controls="faqcollapseOne">
                                            নিলাম কী?
                                        </button>
                                    </h2>
                                    <div id="faqcollapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="faqheadingOne" data-bs-parent="#accordionGeneral">
                                        <div class="accordion-body">
                                            নিলাম হলো একটি সরকারি বা বেসরকারি অনুষ্ঠান যেখানে পণ্য বা সেবা সর্বোচ্চ
                                            বিডকারীকে বিক্রি করা হয়। বিডাররা উচ্চতম দাম দেওয়ার জন্য প্রতিযোগিতা করে এবং
                                            সর্বোচ্চ বিডকারী জিনিসটি পায়।
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="faqheadingTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#faqcollapseTwo"
                                            aria-expanded="false" aria-controls="faqcollapseTwo">
                                            কিভাবে নিলামে অংশগ্রহণ করবেন?
                                        </button>
                                    </h2>
                                    <div id="faqcollapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="faqheadingTwo" data-bs-parent="#accordionGeneral">
                                        <div class="accordion-body">
                                            নিলামে অংশগ্রহণ করতে প্রথমে নিবন্ধন করতে হবে। এরপর নির্দিষ্ট সময়সীমার মধ্যে বিড
                                            করতে হবে। সর্বোচ্চ বিডকারী জিনিসটি জিতবে এবং প্রদত্ত মূল্য পরিশোধ করতে হবে।
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="faqheadingThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#faqcollapseThree"
                                            aria-expanded="false" aria-controls="faqcollapseThree">
                                            নিলামে জয়ী হলে কী করবেন?
                                        </button>
                                    </h2>
                                    <div id="faqcollapseThree" class="accordion-collapse collapse"
                                        aria-labelledby="faqheadingThree" data-bs-parent="#accordionGeneral">
                                        <div class="accordion-body">
                                            যদি আপনি নিলামে জিতে যান, আপনাকে জেতা আইটেমের জন্য নির্ধারিত মূল্য পরিশোধ করতে
                                            হবে। প্রদত্ত পেমেন্ট নির্দেশনা অনুসরণ করুন। নিয়ম না মানলে শাস্তি বা একাউন্ট
                                            সাসপেনশন হতে পারে।
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Faq section -->
@endsection
