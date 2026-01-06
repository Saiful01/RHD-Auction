@extends('layouts.admin')
@section('content')
    <div class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('global.show') }} {{ trans('cruds.bidder.title') }}
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="form-group text-right">
                                <a class="btn btn-default" href="{{ route('admin.bidders.index') }}">
                                    {{ trans('global.back_to_list') }}
                                </a>
                            </div>
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.bidder.fields.id') }}
                                        </th>
                                        <td>
                                            {{ $bidder->id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.bidder.fields.name') }}
                                        </th>
                                        <td>
                                            {{ $bidder->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.bidder.fields.email') }}
                                        </th>
                                        <td>
                                            {{ $bidder->email }}
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                    <th>
                                        {{ trans('cruds.bidder.fields.password') }}
                                    </th>
                                    <td>
                                        ********
                                    </td>
                                </tr> --}}
                                    <tr>
                                        <th>
                                            {{ trans('cruds.bidder.fields.phone') }}
                                        </th>
                                        <td>
                                            {{ $bidder->phone }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.bidder.fields.nid_no') }}
                                        </th>
                                        <td>
                                            {{ $bidder->nid_no }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.bidder.fields.tin_no') }}
                                        </th>
                                        <td>
                                            {{ $bidder->tin_no }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.bidder.fields.bin_no') }}
                                        </th>
                                        <td>
                                            {{ $bidder->bin_no }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.bidder.fields.details') }}
                                        </th>
                                        <td>
                                            {{ $bidder->details }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.bidder.fields.address') }}
                                        </th>
                                        <td>
                                            {{ $bidder->address }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.bidder.fields.profile_image') }}
                                        </th>
                                        <td>
                                            @if ($bidder->profile_image)
                                                <a href="{{ $bidder->profile_image->getUrl() }}" target="_blank"
                                                    style="display: inline-block">
                                                    <img src="{{ $bidder->profile_image->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.bidder.fields.nid_file') }}
                                        </th>
                                        <td>
                                            @if ($bidder->nid_file)
                                                <a href="{{ $bidder->nid_file->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.bidder.fields.tin_file') }}
                                        </th>
                                        <td>
                                            @if ($bidder->tin_file)
                                                <a href="{{ $bidder->tin_file->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.bidder.fields.bin_file') }}
                                        </th>
                                        <td>
                                            @if ($bidder->bin_file)
                                                <a href="{{ $bidder->bin_file->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.bidder.fields.status') }}
                                        </th>
                                        <td>
                                            {{ App\Models\Bidder::STATUS_RADIO[$bidder->status] ?? '' }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('admin.bidders.index') }}">
                                    {{ trans('global.back_to_list') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('global.relatedData') }}
                    </div>
                    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                        <li role="presentation">
                            <a href="#bidder_bidder_auction_requests" aria-controls="bidder_bidder_auction_requests"
                                role="tab" data-toggle="tab">
                                {{ trans('cruds.bidderAuctionRequest.title') }}
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#bidder_bids" aria-controls="bidder_bids" role="tab" data-toggle="tab">
                                {{ trans('cruds.bid.title') }}
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane" role="tabpanel" id="bidder_bidder_auction_requests">
                            @includeIf('admin.bidders.relationships.bidderBidderAuctionRequests', [
                                'bidderAuctionRequests' => $bidder->bidderBidderAuctionRequests,
                            ])
                        </div>
                        <div class="tab-pane" role="tabpanel" id="bidder_bids">
                            @includeIf('admin.bidders.relationships.bidderBids', [
                                'bids' => $bidder->bidderBids,
                            ])
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
