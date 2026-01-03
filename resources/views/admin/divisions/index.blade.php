@extends('layouts.admin')
@section('content')
<div class="content">
    @can('division_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12 text-right">
                <a class="btn btn-success" href="{{ route('admin.divisions.create') }}">
                    Create {{ trans('cruds.division.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.division.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Division">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        SL
                                    </th>
                                    <th>
                                        {{ trans('cruds.division.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.division.fields.details') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($divisions as $key => $division)
                                    <tr data-entry-id="{{ $division->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $key+1 }}
                                        </td>
                                        <td>
                                            {{ $division->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $division->details ?? '' }}
                                        </td>
                                        <td>
                                            @can('division_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.divisions.show', $division->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('division_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.divisions.edit', $division->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('division_delete')
                                                <form action="{{ route('admin.divisions.destroy', $division->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('division_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.divisions.massDestroy') }}",
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
  let table = $('.datatable-Division:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection