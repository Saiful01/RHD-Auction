@extends('frontend_layouts.frontend')

@section('title', 'Dashboard')

@section('content')
    <!-- Start Breadcrumb section -->
    @include('frontend_layouts.partials.breadcrumb', [
        'title' => 'Profile',
        'breadcrumb' => 'Profile',
    ])
    <!-- End Breadcrumb section -->

    <!-- Start Dashboard section -->
    <div class="dashboard-section pt-50 mb-110">
        <div class="container">
            <div class="dashboard-wrapper">
                @include('frontend.bidder.partials.sidebar')
                <div class="dashboard-content-wrap">
                    <div class="profile-info-wrap">
                        <div class="profile-img">
                            <img src="{{ $bidder->getFirstMediaUrl('profile_image') }}" alt="Bidder Photo">
                        </div>
                        <div class="profile-content">
                            <h4>Hi, {{ $bidder->name }}</h4>
                            {{-- <p>You Have Complete 10 Auction In Last Month. Start Your auction Today.</p> --}}
                        </div>
                    </div>
                    <div class="row g-lg-3 gy-4">
                        <div class="col-lg-4">
                            <div class="single-counter-card">
                                <span>Auction Attend</span>
                                <h2>{{ $auctionAttend }}</h2>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="single-counter-card two">
                                <span>Auction Win</span>
                                <h2>{{ $auctionWin }}</h2>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="single-counter-card three">
                                <span>Cancel Auction</span>
                                <h2>{{ $auctionCanceled }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="bidding-summary-wrap">
                        <h6>Bidding Summary</h6>
                        <table class="bidding-summary-table">
                            <thead>
                                <tr>
                                    <th>Auction Name</th>
                                    <th>Lot Name</th>
                                    <th>Bid Amount</th>
                                    <th>Total Amount (Vat & Tax)</th>
                                    <th>Status</th>
                                    <th>Auction Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentBids as $bid)
                                    <tr>
                                        <td data-label="Auction Name">{{ strip_tags($bid->auction->name) }}</td>
                                        <td data-label="Lot Name">
                                            @if ($bid->auction && $bid->auction->lots->count())
                                                @foreach ($bid->auction->lots as $lot)
                                                    {{ $lot->name }}
                                                    @if (!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td data-label="Bid Amount">{{ bangla_number_format($bid->bid_amount, 2) }} ৳</td>
                                        <td data-label="Total Amount (with Vat & Tax)">
                                            {{ bangla_number_format($bid->total_amount, 2) }} ৳</td>
                                        <td data-label="Status">
                                            @if ($bid->status == 3)
                                                <span class="bg-danger text-white">Cancle</span>
                                            @elseif($bid->is_winner)
                                                <span class="bg-success text-white">Winning</span>
                                            @else
                                                <span class="bg-warning text-dark">Pending</span>
                                            @endif
                                        </td>
                                        <td data-label="Auction Date">{{ $bid->created_at->format('F d, Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No Data Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="row pt-40">
                        <div class="col-lg-12">
                            <div class="inner-pagination-area two">
                                <ul class="paginations">
                                    <li class="page-item active">
                                        <a href="#">01</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#">02</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#">03</a>
                                    </li>
                                    <li class="page-item paginations-button">
                                        <a href="#">
                                            <svg width="16" height="13" viewBox="0 0 16 13"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M15.557 10.1026L1.34284 1.89603M15.557 10.1026C12.9386 8.59083 10.8853 3.68154 12.7282 0.489511M15.557 10.1026C12.9386 8.59083 7.66029 9.2674 5.81744 12.4593"
                                                    stroke-width="0.96" stroke-linecap="round"></path>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Dashboard section -->
@endsection
