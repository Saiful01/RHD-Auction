@extends('layouts.admin')
@section('content')
    <div class="content">
        @can('bid_create')
            {{-- <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-12 text-right">
                    <a class="btn btn-success" href="{{ route('admin.bids.create') }}">
                        Create {{ trans('cruds.bid.title_singular') }}
                    </a>
                </div>
            </div> --}}
        @endcan
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('cruds.bid.title_singular') }} {{ trans('global.list') }}
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover datatable datatable-Bid">
                                <thead>
                                    <tr>
                                        <th width="10">

                                        </th>
                                        <th>
                                            SL
                                        </th>
                                        <th>
                                            {{ trans('cruds.bid.fields.bidder') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.bid.fields.auction') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.bid.fields.vat') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.bid.fields.tax') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.bid.fields.bid_amount') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.bid.fields.total_amount') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.bid.fields.is_condition_accept') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.bid.fields.is_winner') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.bid.fields.status') }}
                                        </th>
                                        <th>
                                            &nbsp;
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bids as $key => $bid)
                                        <tr data-entry-id="{{ $bid->id }}">
                                            <td>

                                            </td>
                                            <td>
                                                {{ $key + 1 }}
                                            </td>
                                            <td>
                                                {{ $bid->bidder->name ?? '' }}
                                            </td>
                                            <td>
                                                {{ $bid->auction->memo_no ?? '' }}
                                            </td>
                                            <td>
                                                {{ $bid->vat ?? '' }}
                                            </td>
                                            <td>
                                                {{ $bid->tax ?? '' }}
                                            </td>
                                            <td>
                                                {{ $bid->bid_amount ?? '' }}
                                            </td>
                                            <td>
                                                {{ $bid->total_amount ?? '' }}
                                            </td>
                                            <td>
                                                {{ App\Models\Bid::IS_CONDITION_ACCEPT_RADIO[$bid->is_condition_accept] ?? '' }}
                                            </td>
                                            <td>
                                                {{ App\Models\Bid::IS_WINNER_RADIO[$bid->is_winner] ?? '' }}
                                            </td>
                                            <td>
                                                {{ App\Models\Bid::STATUS_RADIO[$bid->status] ?? '' }}
                                            </td>
                                            <td>
                                                <div
                                                    style="display:inline-flex; gap:5px; align-items:center;">

                                                    {{-- View --}}
                                                    @can('bid_show')
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ route('admin.bids.show', $bid->id) }}">
                                                            {{ trans('global.view') }}
                                                        </a>
                                                    @endcan

                                                    {{-- Edit --}}
                                                    @can('bid_edit')
                                                        <a class="btn btn-xs btn-info"
                                                            href="{{ route('admin.bids.edit', $bid->id) }}">
                                                            {{ trans('global.edit') }}
                                                        </a>

                                                        {{-- Status toggle --}}
                                                        <form action="{{ route('admin.bids.toggleStatus', $bid->id) }}"
                                                            method="POST" style="margin:0;">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-xs
                                                                    {{ $bid->status == '1' ? 'btn-warning' : ($bid->status == '2' ? 'btn-success' : 'btn-danger') }}">
                                                                {{ $bid->status == '1' ? 'Pending' : ($bid->status == '2' ? 'Accept' : 'Reject') }}
                                                            </button>
                                                        </form>

                                                        {{-- Winner toggle --}}
                                                        <form action="{{ route('admin.bids.toggleWinner', $bid->id) }}"
                                                            method="POST" style="margin:0;">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-xs {{ $bid->is_winner ? 'btn-success' : 'btn-secondary' }}">
                                                                {{ $bid->is_winner ? 'Winner' : 'Mark Winner' }}
                                                            </button>
                                                        </form>
                                                    @endcan

                                                    {{-- Delete --}}
                                                    @can('bid_delete')
                                                        <form action="{{ route('admin.bids.destroy', $bid->id) }}"
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
            @can('bid_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.bids.massDestroy') }}",
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
            let table = $('.datatable-Bid:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
