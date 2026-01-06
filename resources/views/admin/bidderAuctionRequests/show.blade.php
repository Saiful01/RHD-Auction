@extends('layouts.admin')
@section('content')
    <div class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('global.show') }} {{ trans('cruds.bidderAuctionRequest.title') }}
                    </div>
                    <div class="panel-body">
                        <div class="form-group text-right">
                            <a class="btn btn-default" href="{{ route('admin.bidder-auction-requests.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>

                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>{{ trans('cruds.bidderAuctionRequest.fields.id') }}</th>
                                    <td>{{ $bidderAuctionRequest->id }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('cruds.bidderAuctionRequest.fields.bidder') }}</th>
                                    <td>{{ $bidderAuctionRequest->bidder->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('cruds.bidderAuctionRequest.fields.auction') }}</th>
                                    <td>{{ strip_tags($bidderAuctionRequest->auction->name) ?? '' }}</td>
                                </tr>

                                <tr>
                                    <th>{{ trans('cruds.bidderAuctionRequest.fields.pay_amount') }}</th>
                                    <td>{{ $bidderAuctionRequest->pay_amount }}</td>
                                </tr>



                                {{-- Media Fields --}}
                                @php
                                    $mediaFields = [
                                        'pay_order' => 'Pay Order',
                                        'auto_chalan' => 'Auto Chalan',
                                        'nid_copy' => 'NID Copy',
                                        'passport_photo' => 'Passport Photo',
                                        'trade_license' => 'Trade License',
                                        'tax_certificate' => 'Tax Certificate',
                                        'wood_license' => 'Wood License',
                                        'bank_guarantee' => 'Bank Guarantee',
                                        'mobile_signature' => 'Mobile Signature',
                                    ];
                                @endphp

                                @foreach ($mediaFields as $field => $label)
                                    <tr>
                                        <th>{{ $label }}</th>
                                        <td>
                                            @if ($bidderAuctionRequest->{$field})
                                                @foreach ($bidderAuctionRequest->{$field} as $media)
                                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                                        {{ trans('global.view_file') }}
                                                    </a><br>
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <th>{{ trans('cruds.bidderAuctionRequest.fields.is_condition_accept') }}</th>
                                    <td>{{ App\Models\BidderAuctionRequest::IS_CONDITION_ACCEPT_RADIO[$bidderAuctionRequest->is_condition_accept] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ trans('cruds.bidderAuctionRequest.fields.status') }}</th>
                                    <td>{{ App\Models\BidderAuctionRequest::STATUS_RADIO[$bidderAuctionRequest->status] ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.bidder-auction-requests.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
