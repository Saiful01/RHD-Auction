@extends('layouts.admin')
@section('content')
    <div class="content">
        @can('package_create')
            <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-12 text-right">
                    <a class="btn btn-success" href="{{ route('admin.packages.create') }}">
                        Create {{ trans('cruds.package.title_singular') }}
                    </a>
                </div>
            </div>
        @endcan
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('cruds.package.title_singular') }} {{ trans('global.list') }}
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover datatable datatable-Package">
                                <thead>
                                    <tr>
                                        <th width="10">

                                        </th>
                                        <th>
                                            SL
                                        </th>
                                        <th>
                                            Division
                                        </th>
                                        <th>
                                            {{ trans('cruds.package.fields.road') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.package.fields.name') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.package.fields.unique_code') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.package.fields.status') }}
                                        </th>
                                        {{-- <th>
                                        {{ trans('cruds.package.fields.images') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.package.fields.files') }}
                                    </th> --}}
                                        <th>
                                            &nbsp;
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($packages as $key => $package)
                                        <tr data-entry-id="{{ $package->id }}">
                                            <td>

                                            </td>
                                            <td>
                                                {{ $key + 1 }}
                                            </td>
                                            <td>
                                                {{ $package->road->division->name }}
                                            </td>
                                            <td>
                                                {{ $package->road->name ?? '' }}
                                            </td>
                                            <td>
                                                {{ $package->name ?? '' }}
                                            </td>
                                            <td>
                                                {{ $package->unique_code ?? '' }}
                                            </td>
                                            <td>
                                                {{ App\Models\Package::STATUS_RADIO[$package->status] ?? '' }}
                                            </td>
                                            <td>
                                                @foreach ($package->images as $key => $media)
                                                    <a href="{{ $media->getUrl() }}" target="_blank"
                                                        style="display: inline-block">
                                                        <img src="{{ $media->getUrl('thumb') }}">
                                                    </a>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($package->files as $key => $media)
                                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                                        {{ trans('global.view_file') }}
                                                    </a>
                                                @endforeach
                                            </td>
                                            <td>
                                                <div style="display: inline-flex; gap: 5px; align-items: center;">
                                                    {{-- all buttons inline --}}
                                                    @can('package_show')
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ route('admin.packages.show', $package->id) }}">
                                                            {{ trans('global.view') }}
                                                        </a>
                                                    @endcan

                                                    @can('package_edit')
                                                        <a class="btn btn-xs btn-info"
                                                            href="{{ route('admin.packages.edit', $package->id) }}">
                                                            {{ trans('global.edit') }}
                                                        </a>
                                                    @endcan

                                                    @can('package_delete')
                                                        <form action="{{ route('admin.packages.destroy', $package->id) }}"
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
            @can('package_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.packages.massDestroy') }}",
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
            let table = $('.datatable-Package:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
