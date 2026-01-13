@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.bid.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group text-right">
                            <a class="btn btn-default" href="{{ route('admin.bids.auction', $bid->auction->id) }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bid.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $bid->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bid.fields.bidder') }}
                                    </th>
                                    <td>
                                        {{ $bid->bidder->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bid.fields.auction') }}
                                    </th>
                                    <td>
                                        {{ $bid->auction->memo_no ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bid.fields.vat') }}
                                    </th>
                                    <td>
                                        {{ $bid->vat }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bid.fields.tax') }}
                                    </th>
                                    <td>
                                        {{ $bid->tax }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bid.fields.bid_amount') }}
                                    </th>
                                    <td>
                                        {{ $bid->bid_amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bid.fields.total_amount') }}
                                    </th>
                                    <td>
                                        {{ $bid->total_amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bid.fields.is_condition_accept') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Bid::IS_CONDITION_ACCEPT_RADIO[$bid->is_condition_accept] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bid.fields.is_winner') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Bid::IS_WINNER_RADIO[$bid->is_winner] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bid.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Bid::STATUS_RADIO[$bid->status] ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        {{-- <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.bids.index') }}">
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