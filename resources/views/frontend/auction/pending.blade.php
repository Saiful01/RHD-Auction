@extends('frontend_layouts.frontend')

@section('title', 'Pending Auction Interests')

@section('content')

    {{-- Breadcrumb --}}
    @include('frontend_layouts.partials.breadcrumb', [
        'title' => 'Pending Interests',
        'breadcrumb' => 'Pending Interests',
    ])

    <div class="pending-interest-section py-5">
        <div class="container">

            @forelse ($pendingRequests as $request)
                {{-- Outer Card --}}
                <div class="card shadow-sm mb-5 border-0 rounded-4">
                    <div class="card-body p-4">

                        {{-- Greeting / Notice --}}
                        <div class="text-center mb-4">
                            <h3 class="fw-bold text-dark mb-1">ধন্যবাদ!</h3>
                            <p class="text-muted mb-0">
                                আপনার interest গ্রহণ করা হয়েছে। যাচাই প্রক্রিয়াধীন। অনুগ্রহ করে ধৈর্য ধারণ করুন।
                            </p>
                        </div>

                        {{-- Auction / Lot Info --}}
                        <div class="card mb-4 border-1 shadow-sm rounded-3">
                            <div class="card-header bg-light text-dark fw-bold">
                                Lot / Auction তথ্য
                            </div>
                            <div class="card-body">
                                {{-- Auction Name / Memo --}}
                                <h5 class="fw-semibold mb-3">
                                    {{ strip_tags($request->auction->name) ?? $request->auction->memo_no }}
                                </h5>

                                {{-- Auction Details --}}
                                <ul class="list-unstyled ps-3 mb-3">
                                    <li><strong>Memo No:</strong> {{ $request->auction->memo_no ?? 'N/A' }}</li>
                                    <li><strong>Announcement No:</strong> {{ $request->auction->announcement_no ?? 'N/A' }}
                                    </li>
                                    <li><strong>Auction Details:</strong>
                                        {{ strip_tags($request->auction->details) ?? 'N/A' }}</li>
                                </ul>

                                {{-- Lot Info --}}
                                @forelse($request->auction->lots as $lot)
                                    <div class="mb-3">
                                        <h6 class="fw-semibold">Lot Name: {{ $lot->name }}</h6>
                                        <ul class="list-unstyled ps-3">
                                            <li><strong>Tree Description:</strong>
                                                {{ strip_tags($lot->tree_description) ?? 'N/A' }}</li>
                                        </ul>
                                    </div>
                                @empty
                                    <p class="text-muted">No lot information available.</p>
                                @endforelse
                            </div>
                        </div>

                        {{-- Required Documents --}}
                        <div class="card border-1 shadow-sm rounded-3 mb-4">
                            <div class="card-header bg-light text-dark fw-bold">
                                নিলামে জমা দেওয়ার জন্য প্রয়োজনীয় ডকুমেন্টসমূহ
                            </div>
                            <div class="card-body">
                                <ol class="mb-2 ps-3">
                                    @foreach ($request->auction->documents as $index => $document)
                                        <li>
                                            <span class="fw-semibold">{{ $document->name }}</span>
                                            <span class="badge bg-secondary text-white ms-2">প্রয়োজনীয়</span>
                                        </li>
                                    @endforeach
                                </ol>
                                <p class="small text-muted mb-0">
                                    উপরের ডকুমেন্টগুলো অনুসারে অফিসে যোগাযোগ করুন।
                                </p>
                            </div>
                        </div>

                        {{-- Contact Reminder --}}
                        <div class="alert alert-warning mt-3 mb-0 rounded-3 border-start border-4 border-warning">
                            অনুগ্রহ করে আপনার নিবন্ধিত ফোন বা ইমেল খোলা রাখুন। এটি সরকারি যোগাযোগের জন্য ব্যবহার হবে।
                        </div>

                    </div>
                </div>
            @empty
                <div class="alert alert-light text-center rounded-3 border shadow-sm">
                    কোন pending interest পাওয়া যায়নি।
                </div>
            @endforelse

        </div>
    </div>

@endsection
