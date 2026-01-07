@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        নিলাম প্রদর্শন করুন
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="form-group text-right">
                                <a class="btn btn-default" href="{{ route('admin.auctions.index') }}">
                                    {{ trans('global.back_to_list') }}
                                </a>
                            </div>
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    {{-- <tr>
                                    <th>
                                        {{ trans('cruds.auction.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $auction->id }}
                                    </td>
                                </tr> --}}
                                    <tr>
                                        <th>
                                            অর্থবছর
                                        </th>
                                        <td>
                                            {{ $auction->financial_year->year ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            সড়ক
                                        </th>
                                        <td>
                                            {{ $auction->road->name ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            প্যাকেজ
                                        </th>
                                        <td>
                                            {{ $auction->package->name ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            লট
                                        </th>
                                        <td>
                                            @foreach ($auction->lots as $key => $lot)
                                                <span class="label label-info">{{ $lot->name }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            স্মারক নং
                                        </th>
                                        <td>
                                            {{ $auction->memo_no }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            বিজ্ঞপ্তি নং
                                        </th>
                                        <td>
                                            {{ $auction->announcement_no }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            নাম
                                        </th>
                                        <td>
                                            {!! $auction->name !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            বিবরণ
                                        </th>
                                        <td>
                                            {!! $auction->details !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            নিলামের শুরু সময়
                                        </th>
                                        <td>
                                            {{ $auction->auction_start_time }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            নিলামের শেষ সময়
                                        </th>
                                        <td>
                                            {{ $auction->auction_end_time }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            নিলাম প্রদর্শনের শুরু তারিখ
                                        </th>
                                        <td>
                                            {{ $auction->tender_visible_start_date }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            নিলাম প্রদর্শনের শেষ তারিখ
                                        </th>
                                        <td>
                                            {{ $auction->tender_visible_end_date }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            বিড শুরু হওয়ার সময়
                                        </th>
                                        <td>
                                            {{ $auction->bid_start_time }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            বিড শেষ হওয়ার সময়
                                        </th>
                                        <td>
                                            {{ $auction->bid_end_time }}
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                    <th>
                                        {{ trans('cruds.auction.fields.tender_sale_start_date') }}
                                    </th>
                                    <td>
                                        {{ $auction->tender_sale_start_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.auction.fields.tender_sale_end_date') }}
                                    </th>
                                    <td>
                                        {{ $auction->tender_sale_end_date }}
                                    </td>
                                </tr> --}}
                                    <tr>
                                        <th>
                                            গাছ অপসারণের শেষ সময়সীমা
                                        </th>
                                        <td>
                                            {{ $auction->deadline_for_tree_removal }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            বিডারের যোগ্যতার শর্তাবলি
                                        </th>
                                        <td>
                                            {!! $auction->bidder_criteria !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            লট অনুযায়ী জমার শর্তাবলি
                                        </th>
                                        <td>
                                            {!! $auction->required_document !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            নোট
                                        </th>
                                        <td>
                                            {!! $auction->note !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            অনুমানমূল্য শতাংশ (%)
                                        </th>
                                        <td>
                                            {{ $auction->estimate_value_percentage }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            মূল্য ভিত্তির পরিমাণ
                                        </th>
                                        <td>
                                            {{ $auction->base_value_amount }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>
                                            ভ্যাট (%)
                                        </th>
                                        <td>
                                            {{ $auction->vat }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            কর (%)
                                        </th>
                                        <td>
                                            {{ $auction->tax }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>ব্যক্তি</th>
                                        <td>
                                            @if ($auction->bidEntityEmployee)
                                                <span
                                                    class="label label-info">{{ $auction->bidEntityEmployee->name_en }}</span>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>সংযুক্ত ব্যক্তি</th>
                                        <td>
                                            @if ($auction->contractPersonEmployee)
                                                <span
                                                    class="label label-info">{{ $auction->contractPersonEmployee->name_en }}</span>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>
                                            নথি
                                        </th>
                                        <td>
                                            @if ($auction->documents && $auction->documents->count())
                                                <ul class="list-unstyled mb-0">
                                                    @foreach ($auction->documents as $document)
                                                        <li>
                                                            <i class="fas fa-file-alt text-info"></i>
                                                            {{ $document->name }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <span class="text-muted">No documents attached</span>
                                            @endif
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            {{-- <div class="form-group">
                                <a class="btn btn-default" href="{{ route('admin.auctions.index') }}">
                                    {{ trans('global.back_to_list') }}
                                </a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
