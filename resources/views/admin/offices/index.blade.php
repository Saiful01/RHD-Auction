@extends('layouts.admin')
@section('content')
    <div class="content">
        @can('office_create')
            <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-12 text-right">
                    <a class="btn btn-success" href="{{ route('admin.offices.create') }}">
                        Create {{ trans('cruds.office.title_singular') }}
                    </a>
                </div>
            </div>
        @endcan
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('cruds.office.title_singular') }} {{ trans('global.list') }}
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover datatable datatable-Office">
                                <thead>
                                    <tr>
                                        <th width="10">

                                        </th>
                                        <th>
                                            SL
                                        </th>
                                        <th>
                                            {{ trans('cruds.office.fields.office_name_en') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.office.fields.office_name_bn') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.office.fields.office_cat') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.office.fields.parent_office') }}
                                        </th>
                                        <th>
                                            &nbsp;
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($offices as $key => $office)
                                        <tr data-entry-id="{{ $office->id }}">
                                            <td>

                                            </td>
                                            <td>
                                                {{ $key + 1 }}
                                            </td>
                                            <td>
                                                {{ $office->office_name_en ?? '' }}
                                            </td>
                                            <td>
                                                {{ $office->office_name_bn ?? '' }}
                                            </td>
                                            <td>
                                                {{ App\Models\Office::OFFICE_CAT_RADIO[$office->office_cat] ?? '' }}
                                            </td>
                                            <td>
                                                {{ $office->parent_office ?? '' }}
                                            </td>
                                            <td>
                                                <div style="display: inline-flex; gap: 5px; align-items: center;">
                                                    @can('office_show')
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ route('admin.offices.show', $office->id) }}">
                                                            {{ trans('global.view') }}
                                                        </a>
                                                    @endcan

                                                    @can('office_edit')
                                                        <a class="btn btn-xs btn-info"
                                                            href="{{ route('admin.offices.edit', $office->id) }}">
                                                            {{ trans('global.edit') }}
                                                        </a>
                                                    @endcan

                                                    @can('office_delete')
                                                        <form action="{{ route('admin.offices.destroy', $office->id) }}"
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
            @can('office_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.offices.massDestroy') }}",
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
            let table = $('.datatable-Office:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
