@extends('layouts.admin')
@section('content')

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
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Auction">
                            <thead>
                                <tr>
                                    <th width="10"></th>
                                    <th>ID</th>
                                    <th>Financial Year</th>
                                    <th>Road</th>
                                    <th>Package</th>
                                    <th>Lot</th>
                                    <th>Status</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($auctions as $auction)
                                    <tr data-entry-id="{{ $auction->id }}">
                                        <td></td>

                                        <td>{{ $auction->id }}</td>

                                        <td>{{ $auction->financial_year->year ?? '' }}</td>

                                        <td>{{ $auction->road->name ?? '' }}</td>

                                        <td>{{ $auction->package->name ?? '' }}</td>

                                        <td>
                                            @foreach($auction->lots as $item)
                                                <span class="label label-info label-many">
                                                    {{ $item->name }}
                                                </span>
                                            @endforeach
                                        </td>

                                        {{-- STATUS BADGE --}}
                                        <td>
                                            @if($auction->status === 'active')
                                                <span class="label label-success">Active</span>
                                            @elseif($auction->status === 'under_review')
                                                <span class="label label-warning">Under Review</span>
                                            @else
                                                <span class="label label-danger">Rejected</span>
                                            @endif
                                        </td>

                                        {{-- ACTIONS --}}
                                        <td>
                                            {{-- VIEW (admin + user) --}}
                                            @can('auction_show')
                                                <a class="btn btn-xs btn-primary"
                                                   href="{{ route('admin.auctions.show', $auction->id) }}">
                                                    View
                                                </a>
                                            @endcan

                                            {{-- EDIT --}}
                                            @if(auth()->user()->is_admin)
                                                @can('auction_edit')
                                                    <a class="btn btn-xs btn-info"
                                                       href="{{ route('admin.auctions.edit', $auction->id) }}">
                                                        Edit
                                                    </a>
                                                @endcan
                                            @else
                                                @if($auction->status === 'under_review')
                                                    @can('auction_edit')
                                                        <a class="btn btn-xs btn-info"
                                                           href="{{ route('admin.auctions.edit', $auction->id) }}">
                                                            Edit
                                                        </a>
                                                    @endcan
                                                @endif
                                            @endif

                                            {{-- DELETE (admin only) --}}
                                            @if(auth()->user()->is_admin)
                                                @can('auction_delete')
                                                    <form action="{{ route('admin.auctions.destroy', $auction->id) }}"
                                                          method="POST"
                                                          onsubmit="return confirm('Are you sure?');"
                                                          style="display:inline-block;">
                                                        @method('DELETE')
                                                        @csrf
                                                        <input type="submit"
                                                               class="btn btn-xs btn-danger"
                                                               value="Delete">
                                                    </form>
                                                @endcan
                                            @endif

                                            {{-- STATUS TOGGLE (admin only) --}}
                                            @if(auth()->user()->is_admin)
                                                <form action="{{ route('admin.auctions.toggleStatus', $auction->id) }}"
                                                      method="POST"
                                                      style="display:inline-block;">
                                                    @csrf
                                                    <button class="btn btn-xs btn-warning">
                                                        Change Status
                                                    </button>
                                                </form>
                                            @endif
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

    @can('auction_delete')
        let deleteButton = {
            text: '{{ trans('global.datatables.delete') }}',
            url: "{{ route('admin.auctions.massDestroy') }}",
            className: 'btn-danger',
            action: function (e, dt) {
                let ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                    return $(entry).data('entry-id')
                })

                if (ids.length === 0) {
                    alert('{{ trans('global.datatables.zero_selected') }}')
                    return
                }

                if (confirm('{{ trans('global.areYouSure') }}')) {
                    $.ajax({
                        headers: { 'x-csrf-token': _token },
                        method: 'POST',
                        url: "{{ route('admin.auctions.massDestroy') }}",
                        data: { ids: ids, _method: 'DELETE' }
                    }).done(function () {
                        location.reload()
                    })
                }
            }
        }
        dtButtons.push(deleteButton)
    @endcan

    $('.datatable-Auction').DataTable({
        buttons: dtButtons,
        order: [[1, 'desc']],
        pageLength: 100
    })
})
</script>
@endsection
