@extends('layouts.admin')
@section('content')
    <div class="content">
        @can('road_create')
            <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-12 text-right">
                    <a class="btn btn-success" href="{{ route('admin.roads.create') }}">
                        সড়ক তৈরি করুন
                    </a>
                </div>
            </div>
        @endcan
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        সড়কসমূহের তালিকা
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover datatable datatable-Road">
                                <thead>
                                    <tr>
                                        <th width="10">

                                        </th>
                                        <th>
                                            ক্রমিক নং
                                        </th>
                                        <th>
                                            বিভাগ
                                        </th>
                                        <th>
                                            সড়কের নাম
                                        </th>
                                        {{-- <th>
                                        {{ trans('cruds.road.fields.details') }}
                                    </th> --}}
                                        <th>
                                            ঠিকানা
                                        </th>
                                        <th>
                                            ই-মেইল
                                        </th>
                                        <th>
                                            ফোন নম্বর
                                        </th>
                                        {{-- <th>
                                        {{ trans('cruds.road.fields.image') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.road.fields.files') }}
                                    </th> --}}
                                        <th>
                                            &nbsp;
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roads as $key => $road)
                                        <tr data-entry-id="{{ $road->id }}">
                                            <td>

                                            </td>
                                            <td>
                                                {{ $key + 1 }}
                                            </td>
                                            <td>
                                                {{ $road->division->name ?? '' }}
                                            </td>
                                            <td>
                                                {{ $road->name ?? '' }}
                                            </td>
                                            {{-- <td>
                                            {{ $road->details ?? '' }}
                                        </td> --}}
                                            <td>
                                                {{ $road->address ?? '' }}
                                            </td>
                                            <td>
                                                {{ $road->email ?? '' }}
                                            </td>
                                            <td>
                                                {{ $road->phone ?? '' }}
                                            </td>
                                            <td>
                                                @foreach ($road->image as $key => $media)
                                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                                        {{ trans('global.view_file') }}
                                                    </a>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($road->files as $key => $media)
                                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                                        {{ trans('global.view_file') }}
                                                    </a>
                                                @endforeach
                                            </td>
                                            <td>
                                                <div style="display: inline-flex; gap: 5px; align-items: center;">
                                                    {{-- all buttons inline --}}
                                                    @can('road_show')
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ route('admin.roads.show', $road->id) }}">
                                                            {{ trans('global.view') }}
                                                        </a>
                                                    @endcan

                                                    @can('road_edit')
                                                        <a class="btn btn-xs btn-info"
                                                            href="{{ route('admin.roads.edit', $road->id) }}">
                                                            {{ trans('global.edit') }}
                                                        </a>
                                                    @endcan

                                                    @can('road_delete')
                                                        <form action="{{ route('admin.roads.destroy', $road->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                                            style="display:inline-block; margin:0;">
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
            @can('road_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.roads.massDestroy') }}",
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
            let table = $('.datatable-Road:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
