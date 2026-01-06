@extends('layouts.admin')
@section('content')
    <div class="content">
        @can('bidder_auction_request_create')
            <div style="margin-bottom: 10px;" class="row">
                {{-- <div class="col-lg-12 text-right">
                    <a class="btn btn-success" href="{{ route('admin.bidder-auction-requests.create') }}">
                        Create {{ trans('cruds.bidderAuctionRequest.title_singular') }}
                    </a>
                </div> --}}
            </div>
        @endcan
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('cruds.bidderAuctionRequest.title_singular') }} {{ trans('global.list') }}
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table
                                class=" table table-bordered table-striped table-hover datatable datatable-BidderAuctionRequest">
                                <thead>
                                    <tr>
                                        <th width="10">

                                        </th>
                                        <th>
                                            SL
                                        </th>
                                        <th>
                                            {{ trans('cruds.bidderAuctionRequest.fields.bidder') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.bidderAuctionRequest.fields.auction') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.bidderAuctionRequest.fields.pay_order') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.bidderAuctionRequest.fields.pay_amount') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.bidderAuctionRequest.fields.is_condition_accept') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.bidderAuctionRequest.fields.status') }}
                                        </th>
                                        <th>
                                            &nbsp;
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bidderAuctionRequests as $key => $bidderAuctionRequest)
                                        <tr data-entry-id="{{ $bidderAuctionRequest->id }}">
                                            <td>

                                            </td>
                                            <td>
                                                {{ $key + 1 }}
                                            </td>
                                            <td>
                                                {{ $bidderAuctionRequest->bidder->name ?? '' }}
                                            </td>
                                            <td>
                                                {{ strip_tags($bidderAuctionRequest->auction->name ?? '') }}
                                            </td>
                                            <td>
                                                @foreach ($bidderAuctionRequest->pay_order as $key => $media)
                                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                                        {{ trans('global.view_file') }}
                                                    </a>
                                                @endforeach
                                            </td>
                                            <td>
                                                {{ $bidderAuctionRequest->pay_amount ?? '' }}
                                            </td>
                                            <td>
                                                {{ App\Models\BidderAuctionRequest::IS_CONDITION_ACCEPT_RADIO[$bidderAuctionRequest->is_condition_accept] ?? '' }}
                                            </td>
                                            <td>
                                                {{ App\Models\BidderAuctionRequest::STATUS_RADIO[$bidderAuctionRequest->status] ?? '' }}
                                            </td>
                                            <td>
                                                <div style="display:inline-flex; gap:5px; align-items:center;">
                                                    @can('bidder_auction_request_show')
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ route('admin.bidder-auction-requests.show', $bidderAuctionRequest->id) }}">
                                                            {{ trans('global.view') }}
                                                        </a>
                                                    @endcan

                                                    @can('bidder_auction_request_edit')
                                                        <a class="btn btn-xs btn-info"
                                                            href="{{ route('admin.bidder-auction-requests.edit', $bidderAuctionRequest->id) }}">
                                                            {{ trans('global.edit') }}
                                                        </a>

                                                        <form
                                                            action="{{ route('admin.bidder-auction-requests.toggleStatus', $bidderAuctionRequest->id) }}"
                                                            method="POST" style="margin:0;">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-xs
                        {{ $bidderAuctionRequest->status == '1' ? 'btn-warning' : ($bidderAuctionRequest->status == '2' ? 'btn-success' : 'btn-danger') }}">
                                                                {{ $bidderAuctionRequest->status == '1' ? 'Pending' : ($bidderAuctionRequest->status == '2' ? 'Accept' : 'Reject') }}
                                                            </button>
                                                        </form>
                                                    @endcan

                                                    @can('bidder_auction_request_delete')
                                                        <form
                                                            action="{{ route('admin.bidder-auction-requests.destroy', $bidderAuctionRequest->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                                            style="margin:0;">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <input type="submit" class="btn btn-xs btn-danger"
                                                                value="{{ trans('global.delete') }}">
                                                        </form>
                                                    @endcan
                                                </div>
                                            </td>


                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('bidder_auction_request_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.bidder-auction-requests.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            let table = $('.datatable-BidderAuctionRequest:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
