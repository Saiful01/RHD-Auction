@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.employee.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.employees.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employee.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $employee->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employee.fields.cadre_name') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Employee::CADRE_NAME_RADIO[$employee->cadre_name] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employee.fields.charge_type') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Employee::CHARGE_TYPE_RADIO[$employee->charge_type] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employee.fields.post_type') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Employee::POST_TYPE_RADIO[$employee->post_type] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employee.fields.job_status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Employee::JOB_STATUS_RADIO[$employee->job_status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employee.fields.office') }}
                                    </th>
                                    <td>
                                        {{ $employee->office->office_name_en ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employee.fields.designation') }}
                                    </th>
                                    <td>
                                        {{ $employee->designation->designation ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employee.fields.name_en') }}
                                    </th>
                                    <td>
                                        {{ $employee->name_en }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employee.fields.name_bn') }}
                                    </th>
                                    <td>
                                        {{ $employee->name_bn }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employee.fields.personnel') }}
                                    </th>
                                    <td>
                                        {{ $employee->personnel }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employee.fields.gradation') }}
                                    </th>
                                    <td>
                                        {{ $employee->gradation }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employee.fields.grade') }}
                                    </th>
                                    <td>
                                        {{ $employee->grade }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employee.fields.bcs_no') }}
                                    </th>
                                    <td>
                                        {{ $employee->bcs_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employee.fields.passing_year') }}
                                    </th>
                                    <td>
                                        {{ $employee->passing_year }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employee.fields.birth_date') }}
                                    </th>
                                    <td>
                                        {{ $employee->birth_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employee.fields.date_of_retirement') }}
                                    </th>
                                    <td>
                                        {{ $employee->date_of_retirement }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employee.fields.phone_office') }}
                                    </th>
                                    <td>
                                        {{ $employee->phone_office }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employee.fields.phone_personal') }}
                                    </th>
                                    <td>
                                        {{ $employee->phone_personal }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employee.fields.email_office') }}
                                    </th>
                                    <td>
                                        {{ $employee->email_office }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employee.fields.email_personal') }}
                                    </th>
                                    <td>
                                        {{ $employee->email_personal }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employee.fields.signature') }}
                                    </th>
                                    <td>
                                        @if($employee->signature)
                                            <a href="{{ $employee->signature->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $employee->signature->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.employees.index') }}">
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
                        <a href="#employees_auctions" aria-controls="employees_auctions" role="tab" data-toggle="tab">
                            {{ trans('cruds.auction.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="employees_auctions">
                        @includeIf('admin.employees.relationships.employeesAuctions', ['auctions' => $employee->employeesAuctions])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection