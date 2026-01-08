@extends('frontend_layouts.frontend')

@section('title', 'নিলামে অংশগ্রহণ করুন')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="auction-bid-section py-5">
        <div class="container">

            {{-- Countdown --}}
            <div class="text-center mb-4">
                <h4>নিলাম শেষ হতে বাকি সময়</h4>
                <div id="auction-countdown" class="d-flex justify-content-center gap-2">
                    @foreach (['days', 'hours', 'minutes', 'seconds'] as $t)
                        <div class="text-center p-2 bg-light border rounded">
                            <h5 class="mb-0" id="{{ $t }}">0</h5>
                            <small>{{ ucfirst($t) }}</small>
                        </div>
                    @endforeach
                </div>
            </div>
            <form id="bidForm" action="{{ route('bid.submit', $auction->id) }}" method="POST">
                @csrf
                {{-- Terms / Ongikarnama --}}
                <div class="card mb-4 shadow-sm p-3">
                    <h5>শর্তাবলী / Ongikarnama</h5>
                    <ul>
                        <li>১. সমস্ত লটের জন্য bid দিতে হবে।</li>
                        <li>২. আপনার মোট bid বেস মানের চেয়ে কম হতে পারবে না।</li>
                        <li>৩. VAT এবং TAX স্বয়ংক্রিয়ভাবে যোগ হবে।</li>
                        <li>৪. একবার bid submit করলে পরিবর্তন সম্ভব নয়।</li>
                    </ul>
                    <div class="form-check mt-3">
                        <input type="checkbox" class="form-check-input" id="is_condition_accept" name="is_condition_accept"
                            value="1" required>
                        <label class="form-check-label fw-bold" for="is_condition_accept">
                            আমি শর্তাবলী পড়েছি এবং মেনে চলব
                        </label>
                    </div>
                </div>

                {{-- Bid Form --}}



                @foreach ($auction->lots as $lot)
                    <div class="card mb-4 shadow-sm p-3">
                        <h5>(Lot) {{ $lot->name }}</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ক্রমিক নং</th>
                                    <th>নাম</th>
                                    <th>পরিমাণ</th>
                                    <th>একক</th>
                                    <th>আপনার একক মূল্য (৳)</th>
                                    <th>আনুমানিক মোট (৳)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lot->lotLotItems as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td class="quantity">{{ $item->quantity }}</td>
                                        <td>{{ $item->unit }}</td>
                                        <td>
                                            <input type="number" min="0" step="0.01"
                                                name="bids[{{ $item->id }}]" class="form-control unit-price-input"
                                                required>
                                        </td>
                                        <td class="estimated_total">0.00</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach

                {{-- Hidden inputs for totals --}}
                <input type="hidden" name="bid_amount" id="bid_amount" value="0">
                <input type="hidden" name="vat" id="vat" value="0">
                <input type="hidden" name="tax" id="tax" value="0">
                <input type="hidden" name="total_amount" id="total_amount" value="0">

                {{-- Display totals --}}
                <div class="card mb-4 shadow-sm p-3">
                    <h5>Total Calculation</h5>
                    <p><strong>Total Bid Amount:</strong> <span id="total_bid_amount">0.00</span> ৳</p>
                    <p><strong>VAT ({{ $auction->vat ?? 0 }}%):</strong> <span id="vat_amount">0.00</span> ৳</p>
                    <p><strong>TAX ({{ $auction->tax ?? 0 }}%):</strong> <span id="tax_amount">0.00</span> ৳</p>
                    <p><strong>Total Amount Payable:</strong> <span id="total_amount_display">0.00</span> ৳</p>
                </div>

                {{-- Submit Button --}}
                <div class="text-center mb-5">
                    <button type="submit" id="submitBtn" class="btn btn-primary px-5 py-2 fw-bold">Submit Bid</button>
                </div>

            </form>

        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Countdown
            const endTime = new Date("{{ $auction->bid_end_time }}").getTime();
            const daysEl = document.getElementById('days');
            const hoursEl = document.getElementById('hours');
            const minutesEl = document.getElementById('minutes');
            const secondsEl = document.getElementById('seconds');

            function updateCountdown() {
                const now = new Date().getTime();
                let distance = endTime - now;

                if (distance < 0) {
                    distance = 0;
                    document.querySelectorAll('#bidForm input, #bidForm button').forEach(el => el.disabled = true);
                }

                daysEl.innerText = Math.floor(distance / (1000 * 60 * 60 * 24));
                hoursEl.innerText = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                minutesEl.innerText = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                secondsEl.innerText = Math.floor((distance % (1000 * 60)) / 1000);
            }
            setInterval(updateCountdown, 1000);
            updateCountdown();

            // Calculation
            const unitInputs = document.querySelectorAll('.unit-price-input');
            const totalBidEl = document.getElementById('total_bid_amount');
            const vatEl = document.getElementById('vat_amount');
            const taxEl = document.getElementById('tax_amount');
            const totalAmountEl = document.getElementById('total_amount_display');

            const hiddenBid = document.getElementById('bid_amount');
            const hiddenVat = document.getElementById('vat');
            const hiddenTax = document.getElementById('tax');
            const hiddenTotal = document.getElementById('total_amount');

            const vatPercent = {{ $auction->vat ?? 0 }};
            const taxPercent = {{ $auction->tax ?? 0 }};
            const baseAmount = {{ $auction->base_value_amount }};

            function calculateTotals() {
                let totalBid = 0;
                unitInputs.forEach(input => {
                    const tr = input.closest('tr');
                    const quantity = parseFloat(tr.querySelector('.quantity').innerText) || 0;
                    const unitPrice = parseFloat(input.value) || 0;
                    const estimated = quantity * unitPrice;
                    tr.querySelector('.estimated_total').innerText = estimated.toFixed(2);
                    totalBid += estimated;
                });

                const vat = totalBid * vatPercent / 100;
                const tax = totalBid * taxPercent / 100;
                const totalAmount = totalBid + vat + tax;

                totalBidEl.innerText = totalBid.toFixed(2);
                vatEl.innerText = vat.toFixed(2);
                taxEl.innerText = tax.toFixed(2);
                totalAmountEl.innerText = totalAmount.toFixed(2);

                hiddenBid.value = totalBid.toFixed(2);
                hiddenVat.value = vat.toFixed(2);
                hiddenTax.value = tax.toFixed(2);
                hiddenTotal.value = totalAmount.toFixed(2);

                totalBidEl.style.color = totalBid < baseAmount ? 'red' : 'green';
            }

            unitInputs.forEach(input => input.addEventListener('input', calculateTotals));
            calculateTotals();

            // Final validation
            document.getElementById('bidForm').addEventListener('submit', function(e) {
                if (!document.getElementById('is_condition_accept').checked) {
                    e.preventDefault();
                    alert('আপনাকে শর্তাবলী মেনে চলতে হবে।');
                    return;
                }

                if (parseFloat(hiddenBid.value) < baseAmount) {
                    e.preventDefault();
                    alert('Total Bid Amount অবশ্যই বেস মানের সমান বা বেশি হতে হবে।');
                }
            });

        });
    </script>
@endpush
