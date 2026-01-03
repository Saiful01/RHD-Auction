@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('global.show') }} {{ trans('cruds.auction.title') }}
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
                                            {{ trans('cruds.auction.fields.financial_year') }}
                                        </th>
                                        <td>
                                            {{ $auction->financial_year->year ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.auction.fields.road') }}
                                        </th>
                                        <td>
                                            {{ $auction->road->name ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.auction.fields.package') }}
                                        </th>
                                        <td>
                                            {{ $auction->package->name ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.auction.fields.lot') }}
                                        </th>
                                        <td>
                                            @foreach ($auction->lots as $key => $lot)
                                                <span class="label label-info">{{ $lot->name }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.auction.fields.memo_no') }}
                                        </th>
                                        <td>
                                            {{ $auction->memo_no }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.auction.fields.announcement_no') }}
                                        </th>
                                        <td>
                                            {{ $auction->announcement_no }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.auction.fields.name') }}
                                        </th>
                                        <td>
                                            {!! $auction->name !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.auction.fields.details') }}
                                        </th>
                                        <td>
                                            {!! $auction->details !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.auction.fields.auction_start_time') }}
                                        </th>
                                        <td>
                                            {{ $auction->auction_start_time }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.auction.fields.auction_end_time') }}
                                        </th>
                                        <td>
                                            {{ $auction->auction_end_time }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.auction.fields.tender_visible_start_date') }}
                                        </th>
                                        <td>
                                            {{ $auction->tender_visible_start_date }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.auction.fields.tender_visible_end_date') }}
                                        </th>
                                        <td>
                                            {{ $auction->tender_visible_end_date }}
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
                                            {{ trans('cruds.auction.fields.deadline_for_tree_removal') }}
                                        </th>
                                        <td>
                                            {{ $auction->deadline_for_tree_removal }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.auction.fields.bidder_criteria') }}
                                        </th>
                                        <td>
                                            {!! $auction->bidder_criteria !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.auction.fields.required_document') }}
                                        </th>
                                        <td>
                                            {!! $auction->required_document !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.auction.fields.note') }}
                                        </th>
                                        <td>
                                            {!! $auction->note !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.auction.fields.estimate_value_percentage') }}
                                        </th>
                                        <td>
                                            {{ $auction->estimate_value_percentage }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.auction.fields.base_value_amount') }}
                                        </th>
                                        <td>
                                            {{ $auction->base_value_amount }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.auction.fields.min_bid_amount') }}
                                        </th>
                                        <td>
                                            {{ $auction->min_bid_amount }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.auction.fields.vat') }}
                                        </th>
                                        <td>
                                            {{ $auction->vat }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.auction.fields.tax') }}
                                        </th>
                                        <td>
                                            {{ $auction->tax }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Bid Entity</th>
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
                                        <th>Contract Person</th>
                                        <td>
                                            @if ($auction->contractPersonEmployee)
                                                <span
                                                    class="label label-info">{{ $auction->contractPersonEmployee->name_en }}</span>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('admin.auctions.index') }}">
                                    {{ trans('global.back_to_list') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
