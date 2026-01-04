@extends('layouts.admin')
@section('content')
    <div class="content">
        @can('bidder_create')
            <div style="margin-bottom: 10px;" class="row">
                {{-- <div class="col-lg-12 text-right">
                    <a class="btn btn-success" href="{{ route('admin.bidders.create') }}">
                        Create {{ trans('cruds.bidder.title_singular') }}
                    </a>
                </div> --}}
            </div>
        @endcan
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('cruds.bidder.title_singular') }} {{ trans('global.list') }}
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover datatable datatable-Bidder">
                                <thead>
                                    <tr>
                                        <th width="10">

                                        </th>
                                        <th>
                                            SL
                                        </th>
                                        <th>
                                            {{ trans('cruds.bidder.fields.name') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.bidder.fields.email') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.bidder.fields.phone') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.bidder.fields.nid_no') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.bidder.fields.tin_no') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.bidder.fields.bin_no') }}
                                        </th>
                                        <th>Status</th>
                                        <th>
                                            &nbsp;
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bidders as $key => $bidder)
                                        <tr data-entry-id="{{ $bidder->id }}">
                                            <td>

                                            </td>
                                            <td>
                                                {{ $key + 1 }}
                                            </td>
                                            <td>
                                                {{ $bidder->name ?? '' }}
                                            </td>
                                            <td>
                                                {{ $bidder->email ?? '' }}
                                            </td>
                                            <td>
                                                {{ $bidder->phone ?? '' }}
                                            </td>
                                            <td>
                                                {{ $bidder->nid_no ?? '' }}
                                            </td>
                                            <td>
                                                {{ $bidder->tin_no ?? '' }}
                                            </td>
                                            <td>
                                                {{ $bidder->bin_no ?? '' }}
                                            </td>
                                            <td>
                                                @if ($bidder->status == 1)
                                                    <span class="label label-success">Active</span>
                                                @else
                                                    <span class="label label-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div style="display:inline-flex; gap:5px; align-items:center;">
                                                    @can('bidder_show')
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ route('admin.bidders.show', $bidder->id) }}">
                                                            {{ trans('global.view') }}
                                                        </a>
                                                    @endcan

                                                    @can('bidder_edit')
                                                        <a class="btn btn-xs btn-info"
                                                            href="{{ route('admin.bidders.edit', $bidder->id) }}">
                                                            {{ trans('global.edit') }}
                                                        </a>

                                                        <form action="{{ route('admin.bidders.toggleStatus', $bidder->id) }}"
                                                            method="POST" style="margin:0;">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-xs {{ $bidder->status == 1 ? 'btn-warning' : 'btn-success' }}">
                                                                {{ $bidder->status == 1 ? 'Deactivate' : 'Activate' }}
                                                            </button>
                                                        </form>
                                                    @endcan

                                                    @can('bidder_delete')
                                                        <form action="{{ route('admin.bidders.destroy', $bidder->id) }}"
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
            @can('bidder_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.bidders.massDestroy') }}",
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
            let table = $('.datatable-Bidder:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
