@extends('layouts.admin')
@section('content')
    <div class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('global.show') }} Document
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="form-group text-right">
                                <a class="btn btn-default" href="{{ route('admin.documents.index') }}">
                                    {{ trans('global.back_to_list') }}
                                </a>
                            </div>
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $document->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>নাম</th>
                                        <td>{{ $document->name }}</td>
                                    </tr>
                                    
                                    {{-- <tr>
                                    <th>File</th>
                                    <td>
                                        @if ($document->file)
                                            <a href="{{ asset($document->file) }}" target="_blank">View File</a>
                                        @endif
                                    </td>
                                </tr> --}}
                                </tbody>
                            </table>
                            {{-- <div class="form-group">
                                <a class="btn btn-default" href="{{ route('admin.documents.index') }}">
                                    {{ trans('global.back_to_list') }}
                                </a>
                            </div> --}}
                        </div>
                    </div>
                </div>

                
                {{-- <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.relatedData') }}
                </div>
                <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                    <li role="presentation">
                        <a href="#document_someRelation" aria-controls="document_someRelation" role="tab" data-toggle="tab">
                            Related Items
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="document_someRelation">
                        @includeIf('admin.documents.relationships.someRelation', [
                            'items' => $document->someRelation,
                        ])
                    </div>
                </div>
            </div> --}}

            </div>
        </div>
    </div>
@endsection
