@extends('frontend_layouts.frontend')

@section('title', 'Auction Interest Submission')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- CSRF Meta --}}

    {{-- Breadcrumb --}}
    @include('frontend_layouts.partials.breadcrumb', [
        'title' => 'Auction Interest',
        'breadcrumb' => 'Auction Interest',
    ])

    <div class="auction-interest-section py-5">
        <div class="container">

            {{-- Lot Information --}}
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h4 class="mb-3">Lot Information</h4>
                    @foreach ($auction->lots as $lot)
                        <div class="mb-3 p-3 border rounded">
                            <h5 class="card-title">{{ $lot->name }}</h5>
                            <p><strong>Road:</strong> {{ $lot->road->name ?? 'N/A' }}</p>
                            <p><strong>Package:</strong> {{ $lot->package->name ?? 'N/A' }}</p>
                            <p><strong>Tree Description:</strong>
                                {{ strip_tags($lot->tree_description) ?? $lot->tree_description }}</p>
                            <p><strong>Comment:</strong> {{ strip_tags($lot->comment) ?? ($lot->comment ?? 'N/A') }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Interest Form --}}
            <div class="card shadow-sm p-4 mb-5">
                <h4 class="mb-4">Interest Submission Form</h4>

                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="interestForm" action="{{ route('auction.interest.store', $auction->id) }}" method="POST"
                    enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf

                    <div class="row">
                        {{-- Pay Amount --}}
                        <div class="col-md-6 mb-3">
                            <label class="fw-semibold">Pay Amount (৳)</label>
                            <input type="number" step="0.01" name="pay_amount" class="form-control"
                                value="{{ old('pay_amount', $auction->base_value_amount) }}" readonly>
                            <div class="invalid-feedback">Please enter a valid pay amount.</div>
                        </div>

                        {{-- Payment Order --}}
                        <div class="col-md-6 mb-3">
                            <label class="fw-semibold">Pay Order / Receipt</label>
                            <input type="file" name="pay_order[]" class="form-control" multiple required>
                            <div class="invalid-feedback">Please upload at least one payment receipt.</div>
                        </div>

                        {{-- Other Documents --}}
                        @php
                            $docFields = [
                                'auto_chalan' => 'Auto Chalan',
                                'nid_copy' => 'NID Copy',
                                'passport_photo' => 'Passport Photo',
                                'trade_license' => 'Trade License',
                                'tax_certificate' => 'Tax Certificate',
                                'wood_license' => 'Wood License',
                                'bank_guarantee' => 'Bank Guarantee',
                                'mobile_signature' => 'Signature',
                            ];
                        @endphp

                        @foreach ($docFields as $field => $label)
                            <div class="col-md-6 mb-3">
                                <label class="fw-semibold">{{ $label }}</label>
                                <input type="file" name="{{ $field }}[]" class="form-control" multiple required>
                                <div class="invalid-feedback">This field is required.</div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Terms & Conditions --}}
                    <div class="card mb-4 p-3 border rounded">
                        <h5 class="mb-3">শর্তাবলী / Terms & Conditions</h5>
                        <div class="terms-box mb-3"
                            style="max-height:200px; overflow-y:auto; padding:10px; border:1px solid #ddd; border-radius:5px;">
                            <ul class="mb-0" style="list-style: none; padding-left: 0;">
                                <li>১. বেস এমাউন্ট জমা দেওয়া বাধ্যতামূলক।</li>
                                <li>২. সমস্ত প্রয়োজনীয় ডকুমেন্ট জমা দিতে হবে।</li>
                                <li>৩. নিলামের সময়সূচী অনুযায়ী অংশগ্রহণ করতে হবে।</li>
                                <li>৪. নকল বা ভুল তথ্য প্রদান করা যাবে না।</li>
                                <li>৫. অনুমোদিত না হলে অংশগ্রহণ অগ্রহণযোগ্য হবে।</li>
                                <li>৬. অন্যান্য নিয়মাবলী অফিসিয়াল নোটিশ অনুযায়ী পালন করতে হবে।</li>
                            </ul>
                        </div>

                        {{-- Accept Checkbox --}}
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_condition_accept"
                                id="is_condition_accept" required>
                            <label class="form-check-label fw-semibold" for="is_condition_accept">
                                আমি শর্তাবলী পড়েছি এবং মেনে চলব
                            </label>
                            <div class="invalid-feedback">You must accept the terms and conditions.</div>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <div class="text-center">
                        <button id="submitBtn" class="btn btn-primary px-5 py-2 fw-bold" type="submit">
                            Submit Interest
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Bootstrap validation
            (function() {
                'use strict'
                var forms = document.querySelectorAll('.needs-validation')
                Array.prototype.slice.call(forms)
                    .forEach(function(form) {
                        form.addEventListener('submit', function(event) {
                            if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                            }
                            form.classList.add('was-validated')
                        }, false)
                    })
            })()

            // AJAX Submit
            document.getElementById('interestForm').addEventListener('submit', function(e) {
                e.preventDefault();
                let form = this;

                if (!form.checkValidity()) {
                    form.classList.add('was-validated');
                    return;
                }

                let submitBtn = document.getElementById('submitBtn');
                submitBtn.disabled = true;
                submitBtn.innerText = 'Submitting...';

                let formData = new FormData(form);
                let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        // Open PDF
                        window.open(data.pdf_url, '_blank');
                        // Redirect
                        window.location.href = data.redirect_url;
                    })
                    .catch(err => {
                        submitBtn.disabled = false;
                        submitBtn.innerText = 'Submit Interest';
                        alert(err.message ?? 'Something went wrong');
                        console.error(err);
                    });
            });

        });
    </script>
@endpush
