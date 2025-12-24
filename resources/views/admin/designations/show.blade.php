@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.designation.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.designations.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.designation.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $designation->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.designation.fields.designation') }}
                                    </th>
                                    <td>
                                        {{ $designation->designation }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.designation.fields.designation_en') }}
                                    </th>
                                    <td>
                                        {{ $designation->designation_en }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.designation.fields.designation_bn') }}
                                    </th>
                                    <td>
                                        {{ $designation->designation_bn }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.designations.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.relatedData') }}
                </div>
                <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                    <li role="presentation">
                        <a href="#designation_employees" aria-controls="designation_employees" role="tab" data-toggle="tab">
                            {{ trans('cruds.employee.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="designation_employees">
                        @includeIf('admin.designations.relationships.designationEmployees', ['employees' => $designation->designationEmployees])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection