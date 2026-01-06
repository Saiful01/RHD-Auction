<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <title>Bidder Interest Submission</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @font-face {
            font-family: 'NotoSansBengali';
            src: url('{{ asset('fonts/NotoSansBengali-Regular.ttf') }}') format('truetype');
        }

        body {
            font-family: 'NotoSansBengali', sans-serif;
            font-size: 14px;
            line-height: 1.7;
            color: #000;
        }

        .page-wrapper {
            padding: 10px 60px 60px;
            /* 🔥 top space for logo */
        }

        h4.section-title {
            font-size: 16px;
            font-weight: bold;
            background: #f1f1f1;
            padding: 8px 12px;
            border-left: 5px solid #000;
            margin-top: 30px;
        }

        table th,
        table td {
            vertical-align: top;
            text-align: left;
        }

        .warning-box {
            border: 2px solid #000;
            background: #fff3cd;
            padding: 12px 15px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .signature-line {
            margin-top: 45px;
        }
    </style>
</head>

<body>

    <div class="page-wrapper">

        <!-- Header -->
        <div class="text-center">
            <img src="{{ asset('assets/pdf/logo1.jpg') }}" alt="Bangladesh Govt Logo" style="max-height:130px;">
        </div>

        <div class="text-center mb-4">
            <strong class="fs-6">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</strong><br>
            নির্বাহী বৃক্ষপালনবিদ (সওজ) এর কার্যালয়<br>
            অপারেশন ডিভিশন (পূর্বাঞ্চল)<br>
            পাইকপাড়া, মিরপুর, ঢাকা।<br>
            E-mail: ecodeast@rhd.gov.bd
        </div>

        <!-- Auction Info -->
        <h4 class="section-title">নিলামের তথ্য</h4>

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th width="35%">নিলামের নাম</th>
                    <td>{{ strip_tags($auction->name) }}</td>
                </tr>
                <tr>
                    <th>মেমো নং</th>
                    <td>{{ $auction->memo_no ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>ঘোষণা নং</th>
                    <td>{{ $auction->announcement_no ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>নিলামের বিস্তারিত</th>
                    <td>{{ strip_tags($auction->details) ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>নিলামের তারিখ ও সময়</th>
                    <td>
                        {{ $auction->auction_end_time
                            ? \Carbon\Carbon::parse($auction->auction_end_time)->translatedFormat('d F Y h:i A')
                            : 'N/A' }}
                    </td>
                </tr>
                <tr>
                    <th>জমাকৃত অর্থ</th>
                    <td>{{ number_format($interest->pay_amount, 2) }} টাকা</td>
                </tr>
                <tr>
                    <th>ভ্যাট</th>
                    <td>{{ $auction->vat ?? 0 }}%</td>
                </tr>
                <tr>
                    <th>আয়কর</th>
                    <td>{{ $auction->tax ?? 0 }}%</td>
                </tr>
            </tbody>
        </table>

        <!-- Lot Info -->
        <h4 class="section-title">Lot সংক্রান্ত তথ্য</h4>

        @forelse($auction->lots as $lot)
            <table class="table table-bordered">
                <tr>
                    <th width="35%">Lot এর নাম</th>
                    <td>{{ $lot->name }}</td>
                </tr>
                <tr>
                    <th>গাছের বিবরণ</th>
                    <td>{{ strip_tags($lot->tree_description) }}</td>
                </tr>
                <tr>
                    <th>মন্তব্য</th>
                    <td>{{ strip_tags($lot->comment ?? 'N/A') }}</td>
                </tr>
            </table>

            <h4 class="section-title">Lot আইটেমের বিবরণ</h4>

            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>ক্রমিক</th>
                        <th>আইটেমের নাম</th>
                        <th>বেড়</th>
                        <th>পরিমাণ</th>
                        <th>ইউনিট</th>
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
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">এই Lot-এ কোনো আইটেম নেই</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @empty
            <p>Lot তথ্য পাওয়া যায়নি।</p>
        @endforelse

        <!-- Documents -->
        <h4 class="section-title">প্রয়োজনীয় ডকুমেন্টসমূহ</h4>

        <div class="warning-box">
            অনুগ্রহ করে নিম্নোক্ত ক্রমানুসারে প্রয়োজনীয় ডকুমেন্টসমূহ সংগ্রহ করে সংশ্লিষ্ট অফিসে
            স্বশরীরে উপস্থিত হয়ে জমা প্রদান করার জন্য বিশেষভাবে অনুরোধ করা হলো।
        </div>

        <ol>
            @foreach ($documents as $doc)
                <li>{{ $doc->name }}</li>
            @endforeach
        </ol>

        <!-- Declaration -->
        <p class="mt-4">
            আমি এই মর্মে ঘোষণা করছি যে, উপরোক্ত সকল তথ্য আমার জ্ঞাতসারে সঠিক ও নির্ভুল এবং
            নিলামের সকল শর্তাবলী আমি যথাযথভাবে পড়ে, বুঝে ও মেনে গ্রহণ করেছি।
        </p>

        <!-- Signature -->
        <div class="row mt-5">
            <div class="col-6">
                তারিখ:<br>
                {{ now()->translatedFormat('d F Y') }}
            </div>
            <div class="col-6 text-end signature-line">
                ..................................................<br>
                নিলামকারীর স্বাক্ষর (বাংলায়)
            </div>
        </div>

    </div>

</body>

</html>
