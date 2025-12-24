@extends('layouts.admin')
@section('content')
<div class="content">
    @can('financial_year_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.financial-years.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.financialYear.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.financialYear.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-FinancialYear">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.financialYear.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.financialYear.fields.year') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.financialYear.fields.start_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.financialYear.fields.end_date') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($financialYears as $key => $financialYear)
                                    <tr data-entry-id="{{ $financialYear->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $financialYear->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $financialYear->year ?? '' }}
                                        </td>
                                        <td>
                                            {{ $financialYear->start_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $financialYear->end_date ?? '' }}
                                        </td>
                                        <td>
                                            @can('financial_year_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.financial-years.show', $financialYear->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('financial_year_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.financial-years.edit', $financialYear->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('financial_year_delete')
                                                <form action="{{ route('admin.financial-years.destroy', $financialYear->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('financial_year_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.financial-years.massDestroy') }}",
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
  let table = $('.datatable-FinancialYear:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection