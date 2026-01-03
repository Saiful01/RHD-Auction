@extends('layouts.admin')
@section('content')
    <div class="content">
        @can('lot_create')
            <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-12 text-right">
                    <a class="btn btn-success" href="{{ route('admin.lots.create') }}">
                        Create {{ trans('cruds.lot.title_singular') }}
                    </a>
                </div>
            </div>
        @endcan
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('cruds.lot.title_singular') }} {{ trans('global.list') }}
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover datatable datatable-Lot">
                                <thead>
                                    <tr>
                                        <th width="10">

                                        </th>
                                        <th>
                                            SL
                                        </th>
                                        <th>Division</th>
                                        <th>
                                            {{ trans('cruds.lot.fields.road') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.lot.fields.package') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.lot.fields.name') }}
                                        </th>
                                        <th>Lot Items</th>
                                        <th>
                                            &nbsp;
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lots as $key => $lot)
                                        <tr data-entry-id="{{ $lot->id }}">
                                            <td>

                                            </td>
                                            <td>
                                                {{ $key + 1 }}
                                            </td>
                                            <td>{{ $lot->package->road->division->name }}</td>
                                            <td>
                                                {{ $lot->road->name ?? '' }}
                                            </td>
                                            <td>
                                                {{ $lot->package->name ?? '' }}
                                            </td>
                                            <td>
                                                {{ $lot->name ?? '' }}
                                            </td>
                                            <td>{{ $lot->lotLotItems->count() }}</td>
                                            <td>
                                                <div style="display: inline-flex; gap: 5px; align-items: center;">
                                                    {{-- all buttons inline --}}
                                                    @can('lot_show')
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ route('admin.lots.show', $lot->id) }}">
                                                            {{ trans('global.view') }}
                                                        </a>
                                                    @endcan

                                                    @can('lot_edit')
                                                        <a class="btn btn-xs btn-info"
                                                            href="{{ route('admin.lots.edit', $lot->id) }}">
                                                            {{ trans('global.edit') }}
                                                        </a>
                                                    @endcan

                                                    @can('lot_delete')
                                                        <form action="{{ route('admin.lots.destroy', $lot->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                                            style="display:inline-block; margin:0;">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <input type="submit" class="btn btn-xs btn-danger"
                                                                value="{{ trans('global.delete') }}">
                                                        </form>
                                                    @endcan

                                                    @can('lot_item_access')
                                                        <a class="btn btn-xs btn-success"
                                                            href="{{ route('admin.lots.lot-items.newCreate', ['lot_id' => $lot->id]) }}">
                                                            {{ trans('cruds.lot.fields.add_lot_item') }}
                                                        </a>
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
            @can('lot_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.lots.massDestroy') }}",
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
            let table = $('.datatable-Lot:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
