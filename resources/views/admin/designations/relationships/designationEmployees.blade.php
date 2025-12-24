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
                        <table class=" table table-bordered table-striped table-hover datatable datatable-designationEmployees">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.cadre_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.charge_type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.post_type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.job_status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.office') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.designation') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.name_en') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.name_bn') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.personnel') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.gradation') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.grade') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.bcs_no') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.passing_year') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.birth_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.date_of_retirement') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.phone_office') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.phone_personal') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.email_office') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.email_personal') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.signature') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $key => $employee)
                                    <tr data-entry-id="{{ $employee->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $employee->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Employee::CADRE_NAME_RADIO[$employee->cadre_name] ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Employee::CHARGE_TYPE_RADIO[$employee->charge_type] ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Employee::POST_TYPE_RADIO[$employee->post_type] ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Employee::JOB_STATUS_RADIO[$employee->job_status] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employee->office->office_name_en ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employee->designation->designation ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employee->name_en ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employee->name_bn ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employee->personnel ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employee->gradation ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employee->grade ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employee->bcs_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employee->passing_year ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employee->birth_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employee->date_of_retirement ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employee->phone_office ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employee->phone_personal ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employee->email_office ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employee->email_personal ?? '' }}
                                        </td>
                                        <td>
                                            @if($employee->signature)
                                                <a href="{{ $employee->signature->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $employee->signature->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @can('employee_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.employees.show', $employee->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('employee_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.employees.edit', $employee->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('employee_delete')
                                                <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

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
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
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
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-designationEmployees:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection