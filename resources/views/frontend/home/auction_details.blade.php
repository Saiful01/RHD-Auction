@extends('frontend_layouts.frontend')

@section('content')
    <!-- Start Breadcrumb section -->
    <div class="breadcrumb-section"
        style="background-image: url(../assets/img/inner-pages/breadcrumb-bg1.png), linear-gradient(87.29deg, #FDF8E7 0%, #E4FFF0 99.71%);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center">
                    <div class="banner-content">
                        <h1>Auction Details</h1>
                        <ul class="breadcrumb-list">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li>Auction Details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb section -->

    <!-- Start Auction Details section -->
    <div class="auction-details-section pt-110 mb-110">
        <div class="container-fluid">
            <div class="row gy-5">
                <div class="col-xl-6">
                    <div class="auction-details-img">
                        <div class="tab-content" id="v-pills-tabContent">
                            @foreach ($auction->lots as $lot)
                                @foreach ($lot->lotLotItems as $index => $item)
                                    <div class="tab-pane fade @if ($loop->first && $index == 0) show active @endif"
                                        id="v-pills-img{{ $lot->id }}-{{ $item->id }}" role="tabpanel">
                                        <div class="auction-details-tab-img">
                                            @if ($item->item_image)
                                                <img src="{{ asset('storage/' . $item->item_image) }}"
                                                    alt="{{ $item->name }}">
                                            @else
                                                <img src="{{ asset('assets/img/inner-pages/default-item.jpg') }}"
                                                    alt="No Image">
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>

                        <div class="nav nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <div class="swiper auction-details-nav-slider">
                                <div class="swiper-wrapper">
                                    @foreach ($auction->lots as $lot)
                                        @foreach ($lot->lotLotItems as $index => $item)
                                            <div class="swiper-slide">
                                                <div class="nav-item" role="presentation">
                                                    <button class="nav-link @if ($loop->first && $index == 0) active @endif"
                                                        id="v-pills-img{{ $lot->id }}-{{ $item->id }}-tab"
                                                        data-bs-toggle="pill"
                                                        data-bs-target="#v-pills-img{{ $lot->id }}-{{ $item->id }}"
                                                        type="button" role="tab"
                                                        aria-controls="v-pills-img{{ $lot->id }}-{{ $item->id }}"
                                                        aria-selected="@if ($loop->first && $index == 0) true @else false @endif">
                                                        @if ($item->item_image)
                                                            <img src="{{ asset('storage/' . $item->item_image) }}"
                                                                alt="{{ $item->name }}">
                                                        @else
                                                            <img src="{{ asset('assets/img/inner-pages/default-item.jpg') }}"
                                                                alt="No Image">
                                                        @endif
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="auction-details-content">
                        <div class="batch">
                            <span>
                                @foreach ($auction->lots as $lot)
                                    {{ $lot->details }}
                                @endforeach
                            </span>
                        </div>
                        <h1>
                            @foreach ($auction->lots as $lot)
                                {{ $lot->name }}
                            @endforeach
                        </h1>
                        <p>
                            @foreach ($auction->lots as $lot)
                                {{ strip_tags($lot->location) }}
                            @endforeach
                        </p>
                        <div class="price-area">
                            <span>Current Base Value at:</span>
                            <strong>{{ $auction->base_value_amount }} ৳</strong>
                        </div>
                        <div class="coundown-area">
                            <h6>Auction Will Be End:</h6>
                            <div class="countdown-timer">
                                <ul
                                    data-countdown="{{ \Carbon\Carbon::parse($auction->auction_end_time)->format('Y-m-d H:i:s') }}">
                                    <li data-days="00">80 <span>Days</span> <span>Days</span></li>
                                    <li class="clone">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="4" height="13"
                                            viewBox="0 0 4 13">
                                            <path
                                                d="M0 11.0633C0 11.5798 0.186992 12.0317 0.560976 12.419C0.95122 12.8063 1.43089 13 2 13C2.58537 13 3.06504 12.8063 3.43903 12.419C3.81301 12.0317 4 11.5798 4 11.0633C4 10.5146 3.81301 10.0546 3.43903 9.68343C3.06504 9.29609 2.58537 9.10242 2 9.10242C1.43089 9.10242 0.95122 9.29609 0.560976 9.68343C0.186992 10.0546 0 10.5146 0 11.0633ZM0 1.96089C0 2.49348 0.186992 2.95345 0.560976 3.34078C0.95122 3.72812 1.43089 3.92179 2 3.92179C2.58537 3.92179 3.06504 3.72812 3.43903 3.34078C3.81301 2.95345 4 2.49348 4 1.96089C4 1.42831 3.81301 0.968343 3.43903 0.581006C3.06504 0.193669 2.58537 0 2 0C1.43089 0 0.95122 0.193669 0.560976 0.581006C0.186992 0.968343 0 1.42831 0 1.96089Z">
                                            </path>
                                        </svg>
                                    </li>
                                    <li data-hours="00">19 <span>Hours</span> <span>Hours</span></li>
                                    <li class="clone">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="4" height="13"
                                            viewBox="0 0 4 13">
                                            <path
                                                d="M0 11.0633C0 11.5798 0.186992 12.0317 0.560976 12.419C0.95122 12.8063 1.43089 13 2 13C2.58537 13 3.06504 12.8063 3.43903 12.419C3.81301 12.0317 4 11.5798 4 11.0633C4 10.5146 3.81301 10.0546 3.43903 9.68343C3.06504 9.29609 2.58537 9.10242 2 9.10242C1.43089 9.10242 0.95122 9.29609 0.560976 9.68343C0.186992 10.0546 0 10.5146 0 11.0633ZM0 1.96089C0 2.49348 0.186992 2.95345 0.560976 3.34078C0.95122 3.72812 1.43089 3.92179 2 3.92179C2.58537 3.92179 3.06504 3.72812 3.43903 3.34078C3.81301 2.95345 4 2.49348 4 1.96089C4 1.42831 3.81301 0.968343 3.43903 0.581006C3.06504 0.193669 2.58537 0 2 0C1.43089 0 0.95122 0.193669 0.560976 0.581006C0.186992 0.968343 0 1.42831 0 1.96089Z">
                                            </path>
                                        </svg>
                                    </li>
                                    <li data-minutes="00">26 <span>Mint</span> <span>Minutes</span></li>
                                    <li class="clone">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="4" height="13"
                                            viewBox="0 0 4 13">
                                            <path
                                                d="M0 11.0633C0 11.5798 0.186992 12.0317 0.560976 12.419C0.95122 12.8063 1.43089 13 2 13C2.58537 13 3.06504 12.8063 3.43903 12.419C3.81301 12.0317 4 11.5798 4 11.0633C4 10.5146 3.81301 10.0546 3.43903 9.68343C3.06504 9.29609 2.58537 9.10242 2 9.10242C1.43089 9.10242 0.95122 9.29609 0.560976 9.68343C0.186992 10.0546 0 10.5146 0 11.0633ZM0 1.96089C0 2.49348 0.186992 2.95345 0.560976 3.34078C0.95122 3.72812 1.43089 3.92179 2 3.92179C2.58537 3.92179 3.06504 3.72812 3.43903 3.34078C3.81301 2.95345 4 2.49348 4 1.96089C4 1.42831 3.81301 0.968343 3.43903 0.581006C3.06504 0.193669 2.58537 0 2 0C1.43089 0 0.95122 0.193669 0.560976 0.581006C0.186992 0.968343 0 1.42831 0 1.96089Z">
                                            </path>
                                        </svg>
                                    </li>
                                    <li data-seconds="00">17 <span>Sec</span> <span>Seconds</span></li>
                                </ul>
                            </div>
                            <span><strong>Ending On:</strong>
                                {{ \Carbon\Carbon::parse($auction->auction_end_time)->format('F d, Y h:i a') }}</span>
                        </div>
                    </div>
                    <div class="auction-details-description-area">
                        <div class="auction-details-description-nav mb-50">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-description-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-description" type="button" role="tab"
                                        aria-controls="nav-description" aria-selected="true">Auction Info</button>
                                    <button class="nav-link" id="nav-add-info-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-add-info" type="button" role="tab"
                                        aria-controls="nav-add-info" aria-selected="false">Lot & Item Information</button>
                                    <button class="nav-link" id="nav-reviews-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-reviews" type="button" role="tab"
                                        aria-controls="nav-reviews" aria-selected="false">Bidder Interest?</button>
                                </div>
                            </nav>
                        </div>
                        <div class="auction-details-description-tab">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-description" role="tabpanel"
                                    aria-labelledby="nav-description-tab">

                                    <div class="description-content">

                                        <h3>Auction Information</h3>

                                        <div class="table-responsive">
                                            <table class="table table-bordered align-middle">
                                                <tbody>

                                                    <tr>
                                                        <th width="35%">Auction Name</th>
                                                        <td>{{ strip_tags($auction->name) }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th>Memo No</th>
                                                        <td>{{ $auction->memo_no }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th>Announcement No</th>
                                                        <td>{{ $auction->announcement_no }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th>Auction Details</th>
                                                        <td>{{ strip_tags($auction->details) }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th>Auction Start Time</th>
                                                        <td>
                                                            {{ \Carbon\Carbon::parse($auction->auction_start_time)->format('d M Y h:i A') }}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th>Auction End Time</th>
                                                        <td>
                                                            {{ \Carbon\Carbon::parse($auction->auction_end_time)->format('d M Y h:i A') }}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th>Tender Visible Period</th>
                                                        <td>
                                                            {{ \Carbon\Carbon::parse($auction->tender_visible_start_date)->format('d M Y') }}
                                                            —
                                                            {{ \Carbon\Carbon::parse($auction->tender_visible_end_date)->format('d M Y') }}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th>Tender Sale Period</th>
                                                        <td>
                                                            {{ \Carbon\Carbon::parse($auction->tender_sale_start_date)->format('d M Y') }}
                                                            —
                                                            {{ \Carbon\Carbon::parse($auction->tender_sale_end_date)->format('d M Y') }}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th>Deadline for Tree Removal</th>
                                                        <td>
                                                            {{ $auction->deadline_for_tree_removal }}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th>Bidder Criteria</th>
                                                        <td>{{ strip_tags($auction->bidder_criteria) }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th>Required Documents</th>
                                                        <td>{{ strip_tags($auction->required_document) }}</td>
                                                    </tr>

                                                    {{-- <tr>
                                                        <th>Estimated Value (%)</th>
                                                        <td>{{ $auction->estimate_value_percentage }}%</td>
                                                    </tr> --}}

                                                    <tr>
                                                        <th>Base Value Amount</th>
                                                        <td>{{ number_format($auction->base_value_amount, 2) }}</td>
                                                    </tr>

                                                    {{-- <tr>
                                                        <th>Minimum Bid Amount</th>
                                                        <td>{{ number_format($auction->min_bid_amount, 2) }}</td>
                                                    </tr> --}}

                                                    <tr>
                                                        <th>VAT</th>
                                                        <td>{{ $auction->vat }}%</td>
                                                    </tr>

                                                    <tr>
                                                        <th>Tax</th>
                                                        <td>{{ $auction->tax }}%</td>
                                                    </tr>

                                                    @if ($auction->note)
                                                        <tr>
                                                            <th>Note</th>
                                                            <td>{{ strip_tags($auction->note) }}</td>
                                                        </tr>
                                                    @endif

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-add-info" role="tabpanel"
                                    aria-labelledby="nav-add-info-tab">

                                    <div class="addithonal-information">

                                        {{-- ================= LOT TABLE ================= --}}
                                        <h4 class="mb-3">Lot Information</h4>

                                        @forelse($auction->lots as $lot)
                                            <table class="table total-table2 mb-4">
                                                <tbody>
                                                    <tr>
                                                        <td><span>Lot Name</span></td>
                                                        <td>{{ $lot->name }}</td>
                                                    </tr>

                                                    <tr>
                                                        <td><span>Tree Description</span></td>
                                                        <td>{{ strip_tags($lot->tree_description) }}</td>
                                                    </tr>

                                                    <tr>
                                                        <td><span>Comment</span></td>
                                                        <td>{{ strip_tags($lot->comment ?? 'N/A') }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            {{-- ================= LOT ITEM TABLE ================= --}}
                                            <h5 class="mb-2">Lot Items</h5>

                                            <div class="table-responsive">
                                                <table class="table table-bordered align-middle">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Item Name</th>
                                                            <th>Dia</th>
                                                            <th>Quantity</th>
                                                            <th>Unit</th>
                                                            {{-- <th>Unit Price</th> --}}
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @forelse($lot->lotLotItems as $item)
                                                            <tr>
                                                                <td>{{ $item->id }}</td>
                                                                <td>{{ $item->name }}</td>
                                                                <td>{{ $item->dia }}</td>
                                                                <td>{{ $item->quantity }}</td>
                                                                <td>{{ $item->unit }}</td>
                                                                {{-- <td>{{ number_format($item->unit_price, 2) }}</td> --}}
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="6" class="text-center">
                                                                    No items found for this lot
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>

                                            <hr class="my-4">

                                        @empty
                                            <p>No lot information available.</p>
                                        @endforelse

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-reviews" role="tabpanel"
                                    aria-labelledby="nav-reviews-tab">

                                    <div class="reviews-area">

                                        {{-- Warning / info for bidders --}}
                                        <div class="alert alert-warning d-flex align-items-center mb-4" role="alert">
                                            <svg class="bi flex-shrink-0 me-2" width="24" height="24"
                                                role="img" aria-label="Info:">
                                                <use xlink:href="#info-circle-fill" />
                                            </svg>
                                            <div>
                                                এই নিলামে অংশগ্রহণ করতে, আপনাকে <strong>৳
                                                    {{ number_format($auction->base_value_amount, 2) }}</strong> মূল্যের
                                                বেস এমাউন্ট জমা দিতে হবে।
                                                <span style="font-weight:700; color:#d63384;">
                                                    নিলাম প্রকাশ হওয়ার তারিখের আগে -
                                                    {{ \Carbon\Carbon::parse($auction->tender_visible_start_date)->format('F d, Y h:i a') }}
                                                </span>
                                                জমা দেওয়া বাধ্যতামূলক, যাতে আপনি এই নিলামের জন্য যোগ্য হন।
                                            </div>
                                        </div>

                                        <p class="mb-4">
                                            বেস এমাউন্ট জমা দেওয়ার পরে, আপনি নিলামে অংশগ্রহণের জন্য যোগ্য হবেন।
                                            দয়া করে নিশ্চিত করুন যে আপনার পেমেন্ট নিলামের শেষ সময়ের আগে সম্পন্ন হয়েছে।
                                        </p>
                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- End Auction Details section -->
@endsection
