@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.office.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.offices.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.office.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $office->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.office.fields.office_type') }}
                                    </th>
                                    <td>
                                        {{ $office->office_type->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.office.fields.office_name_en') }}
                                    </th>
                                    <td>
                                        {{ $office->office_name_en }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.office.fields.office_name_bn') }}
                                    </th>
                                    <td>
                                        {{ $office->office_name_bn }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.office.fields.office_cat') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Office::OFFICE_CAT_RADIO[$office->office_cat] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.office.fields.parent_office') }}
                                    </th>
                                    <td>
                                        {{ $office->parent_office }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.offices.index') }}">
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
                        <a href="#office_employees" aria-controls="office_employees" role="tab" data-toggle="tab">
                            {{ trans('cruds.employee.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="office_employees">
                        @includeIf('admin.offices.relationships.officeEmployees', ['employees' => $office->officeEmployees])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection