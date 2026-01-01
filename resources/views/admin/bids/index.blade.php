@extends('layouts.admin')
@section('content')
<div class="content">
    @can('bid_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.bids.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.bid.title_singular') }}
                </a>
            </div>
        </div>
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
                                        {{ trans('cruds.bid.fields.id') }}
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
                                @foreach($bids as $key => $bid)
                                    <tr data-entry-id="{{ $bid->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $bid->id ?? '' }}
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
                                            @can('bid_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.bids.show', $bid->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('bid_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.bids.edit', $bid->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('bid_delete')
                                                <form action="{{ route('admin.bids.destroy', $bid->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('bid_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.bids.massDestroy') }}",
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
  let table = $('.datatable-Bid:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection