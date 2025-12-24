<div class="content">
    @can('auction_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.auctions.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.auction.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.auction.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-lotAuctions">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.auction.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.auction.fields.financial_year') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.auction.fields.road') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.auction.fields.package') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.auction.fields.lot') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.auction.fields.memo_no') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.auction.fields.announcement_no') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.auction.fields.auction_start_time') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.auction.fields.auction_end_time') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.auction.fields.tender_visible_start_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.auction.fields.tender_visible_end_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.auction.fields.tender_sale_start_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.auction.fields.tender_sale_end_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.auction.fields.deadline_for_tree_removal') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.auction.fields.estimate_value_percentage') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.auction.fields.base_value_amount') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.auction.fields.min_bid_amount') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.auction.fields.vat') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.auction.fields.tax') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.auction.fields.employees') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($auctions as $key => $auction)
                                    <tr data-entry-id="{{ $auction->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $auction->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $auction->financial_year->year ?? '' }}
                                        </td>
                                        <td>
                                            {{ $auction->road->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $auction->package->name ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($auction->lots as $key => $item)
                                                <span class="label label-info label-many">{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $auction->memo_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $auction->announcement_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $auction->auction_start_time ?? '' }}
                                        </td>
                                        <td>
                                            {{ $auction->auction_end_time ?? '' }}
                                        </td>
                                        <td>
                                            {{ $auction->tender_visible_start_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $auction->tender_visible_end_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $auction->tender_sale_start_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $auction->tender_sale_end_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $auction->deadline_for_tree_removal ?? '' }}
                                        </td>
                                        <td>
                                            {{ $auction->estimate_value_percentage ?? '' }}
                                        </td>
                                        <td>
                                            {{ $auction->base_value_amount ?? '' }}
                                        </td>
                                        <td>
                                            {{ $auction->min_bid_amount ?? '' }}
                                        </td>
                                        <td>
                                            {{ $auction->vat ?? '' }}
                                        </td>
                                        <td>
                                            {{ $auction->tax ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($auction->employees as $key => $item)
                                                <span class="label label-info label-many">{{ $item->personnel }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('auction_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.auctions.show', $auction->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('auction_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.auctions.edit', $auction->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('auction_delete')
                                                <form action="{{ route('admin.auctions.destroy', $auction->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('auction_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.auctions.massDestroy') }}",
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
  let table = $('.datatable-lotAuctions:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection