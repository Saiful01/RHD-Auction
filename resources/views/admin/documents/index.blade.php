@extends('layouts.admin')
@section('content')
    <div class="content">
        @can('document_create')
            <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-12 text-right">
                    <a class="btn btn-success" href="{{ route('admin.documents.create') }}">
                        ডকুমেন্ট তৈরি করুন
                    </a>
                </div>
            </div>
        @endcan
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                       ডকুমেন্টের তালিকা
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover datatable datatable-Document">
                                <thead>
                                    <tr>
                                        <th width="10"></th>
                                        <th>ক্রমিক নং</th>
                                        <th>নাম</th>
                                        <th>তৈরি করার তারিখ</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($documents as $key => $document)
                                        <tr data-entry-id="{{ $document->id }}">
                                            <td></td>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $document->name ?? '' }}</td>
                                            <td>{{ $document->created_at ?? '' }}</td>
                                            <td>
                                                @can('document_show')
                                                    <a class="btn btn-xs btn-primary"
                                                        href="{{ route('admin.documents.show', $document->id) }}">
                                                        View
                                                    </a>
                                                @endcan

                                                @can('document_edit')
                                                    <a class="btn btn-xs btn-info"
                                                        href="{{ route('admin.documents.edit', $document->id) }}">
                                                        Edit
                                                    </a>
                                                @endcan

                                                @can('document_delete')
                                                    <form action="{{ route('admin.documents.destroy', $document->id) }}"
                                                        method="POST" onsubmit="return confirm('Are you sure?');"
                                                        style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
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
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            @can('document_delete')
                let deleteButtonTrans = 'Delete selected'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.documents.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('No documents selected')

                            return
                        }

                        if (confirm('Are you sure?')) {
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
            let table = $('.datatable-Document:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            });
        })
    </script>
@endsection
