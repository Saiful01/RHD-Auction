@extends('layouts.admin')
@section('content')
    <div class="content">
        @can('employee_create')
            <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-12">
                    <a class="btn btn-success" href="{{ route('admin.employees.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.employee.title_singular') }}
                    </a>
                </div>
            </div>
        @endcan
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('cruds.employee.title_singular') }} {{ trans('global.list') }}
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                     <td>SL</td>
                                    <th>{{ trans('cruds.employee.fields.name_en') }}</th>
                                    <th>{{ trans('cruds.employee.fields.personnel') }}</th>
                                    <th>{{ trans('cruds.employee.fields.designation') }}</th>
                                    <th>{{ trans('cruds.employee.fields.office') }}</th>
                                    <th>{{ trans('cruds.employee.fields.phone_office') }}</th>
                                    <th>{{ trans('cruds.employee.fields.email_office') }}</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($employees as $employee)
                                    <tr data-entry-id="{{ $employee->id }}">
                                        <td>{{$i}}</td>

                                        <td>{{ $employee->name_en ?? '' }}</td>
                                        <td>{{ $employee->personnel_id ?? '' }}</td>
                                        <td>{{ $employee->designation->designation_en ?? '' }}</td>
                                        <td>{{ $employee->office->office_name_en ?? '' }}</td>
                                        <td>{{ $employee->phone_office ?? '' }}</td>
                                        <td>{{ $employee->email_office ?? '' }}</td>
                                        <td>
                                            @can('employee_show')
                                                <a class="btn btn-xs btn-primary"
                                                   href="{{ route('admin.employees.show', $employee->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan
                                            @can('employee_edit')
                                                <a class="btn btn-xs btn-info"
                                                   href="{{ route('admin.employees.edit', $employee->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan
                                            @can('employee_delete')
                                                <form action="{{ route('admin.employees.destroy', $employee->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                                      style="display:inline-block;">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="submit" class="btn btn-xs btn-danger"
                                                           value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                    @php($i++)
                                @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-2">
                                {{ $employees->onEachSide(1)->links('pagination::bootstrap-4') }}
                            </div>
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
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('employee_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.employees.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({selected: true}).nodes(), function (entry) {
                        return $(entry).data('entry-id')
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')

                        return
                    }

                    if (confirm('{{ trans('global.areYouSure') }}')) {
                        $.ajax({
                            headers: {'x-csrf-token': _token},
                            method: 'POST',
                            url: config.url,
                            data: {ids: ids, _method: 'DELETE'}
                        })
                            .done(function () {
                                location.reload()
                            })
                    }
                }
            }
            dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [[1, 'desc']],
                pageLength: 100,
            });
            let table = $('.datatable-Employee:not(.ajaxTable)').DataTable({buttons: dtButtons})
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection
