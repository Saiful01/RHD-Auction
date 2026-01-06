@extends('layouts.admin')
@section('content')
    <div class="content">
        @can('auction_create')
            <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-12 text-right">
                    <a class="btn btn-success" href="{{ route('admin.auctions.create') }}">
                        নিলাম তৈরি করুন
                    </a>
                </div>
            </div>
        @endcan

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        নিলামের তালিকা
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover datatable datatable-Auction">
                                <thead>
                                    <tr>
                                        <th width="10"></th>
                                        <th>ক্রমিক নং</th>
                                        <th>অর্থবছর</th>
                                        <th>বিভাগ</th>
                                        <th>সড়ক</th>
                                        <th>প্যাকেজ</th>
                                        <th>লট</th>
                                        <th>লট আইটেম</th>
                                        <th>ভিত্তি
                                            মূল্য({{ optional($auctions->first())->estimate_value_percentage ?? '0' }} %)
                                        </th>
                                        <th>অবস্থা</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($auctions as $auction)
                                        <tr data-entry-id="{{ $auction->id }}">
                                            <td></td>

                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ $auction->financial_year->year ?? '' }}</td>
                                            <td>{{ $auction->road->division->name }}</td>

                                            <td>{{ $auction->road->name ?? '' }}</td>

                                            <td>{{ $auction->package->name ?? '' }}</td>

                                            <td>
                                                <div style="display:flex; flex-wrap:wrap; width:100%;">
                                                    @foreach ($auction->lots as $item)
                                                        <span
                                                            style="
                                                                    background:#0dcaf0;
                                                                    color:#fff;
                                                                    padding:4px 8px;
                                                                    border-radius:4px;
                                                                    margin:2px;
                                                                    white-space:normal;
                                                                    max-width:100%;
                                                                    word-break:break-word;
                                                                ">
                                                            {{ $item->name }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)" class="text-primary"
                                                    onclick="$('#lotItemsModal{{ $auction->id }}').modal('show')">
                                                    {{ $auction->totalLotItemsCount() }}
                                                </a>
                                            </td>



                                            <td>{{ $auction->base_value_amount }}</td>

                                            {{-- STATUS BADGE --}}
                                            <td>
                                                @if ($auction->status === 'active')
                                                    <span class="label label-success">Active</span>
                                                @elseif($auction->status === 'under_review')
                                                    <span class="label label-warning">Under Review</span>
                                                @else
                                                    <span class="label label-danger">Rejected</span>
                                                @endif
                                            </td>

                                            {{-- ACTIONS --}}
                                            <td>
                                                <div style="display: inline-flex; gap: 5px; align-items: center;">
                                                    {{-- inline-flex ensures one line --}}
                                                    {{-- VIEW (admin + user) --}}
                                                    @can('auction_show')
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ route('admin.auctions.show', $auction->id) }}"
                                                            title="View">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    @endcan

                                                    {{-- EDIT --}}
                                                    @if (auth()->user()->is_admin)
                                                        @can('auction_edit')
                                                            <a class="btn btn-xs btn-info"
                                                                href="{{ route('admin.auctions.edit', $auction->id) }}"
                                                                title="Edit">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                        @endcan
                                                    @else
                                                        @if ($auction->status === 'under_review')
                                                            @can('auction_edit')
                                                                <a class="btn btn-xs btn-info"
                                                                    href="{{ route('admin.auctions.edit', $auction->id) }}"
                                                                    title="Edit">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                            @endcan
                                                        @endif
                                                    @endif

                                                    {{-- DELETE (admin only) --}}
                                                    @if (auth()->user()->is_admin)
                                                        @can('auction_delete')
                                                            <form action="{{ route('admin.auctions.destroy', $auction->id) }}"
                                                                method="POST" onsubmit="return confirm('Are you sure?');"
                                                                style="display:inline-block; margin:0;">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit" class="btn btn-xs btn-danger"
                                                                    title="Delete">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @endcan
                                                    @endif

                                                    {{-- STATUS TOGGLE (admin only) --}}
                                                    @if (auth()->user()->is_admin)
                                                        <form
                                                            action="{{ route('admin.auctions.toggleStatus', $auction->id) }}"
                                                            method="POST" style="display:inline-block; margin:0;">
                                                            @csrf
                                                            <button class="btn btn-xs btn-warning" title="Change Status">
                                                                <i class="fa fa-exchange"></i> {{-- FA4 compatible --}}
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @foreach ($auctions as $auction)
                            <div class="modal fade" id="lotItemsModal{{ $auction->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg" style="width:95%">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">
                                                Lot Items (Auction - {{ $auction->id }}
                                                ({{ strip_tags($auction->name) }})
                                                )
                                            </h4>
                                        </div>

                                        <div class="modal-body">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>ক্রমিক নং</th>
                                                        <th>নাম</th>
                                                        <th>কাঠের পরিমাণ</th>
                                                        <th>একক</th>
                                                        <th>ছবি</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @php
                                                        $items = $auction->lots->flatMap(fn($lot) => $lot->lotLotItems);
                                                    @endphp

                                                    @forelse($items as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $item->name }}</td>
                                                            <td>{{ $item->quantity }}</td>
                                                            <td>{{ \App\Models\LotItem::UNIT_SELECT[$item->unit] ?? '' }}
                                                            </td>

                                                            <td>
                                                                @if ($item->item_image)
                                                                    <img src="{{ asset('storage/' . $item->item_image) }}"
                                                                        width="60">
                                                                @else
                                                                    <span class="text-muted">No image</span>
                                                                @endif
                                                            </td>

                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="7" class="text-center text-muted">
                                                                No lot items found
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach

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

            @can('auction_delete')
                let deleteButton = {
                    text: '{{ trans('global.datatables.delete') }}',
                    url: "{{ route('admin.auctions.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt) {
                        let ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        })

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
                                url: "{{ route('admin.auctions.massDestroy') }}",
                                data: {
                                    ids: ids,
                                    _method: 'DELETE'
                                }
                            }).done(function() {
                                location.reload()
                            })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan

            $('.datatable-Auction').DataTable({
                buttons: dtButtons,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100
            })
        })
    </script>
@endsection
