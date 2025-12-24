@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.financialYear.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.financial-years.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.financialYear.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $financialYear->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.financialYear.fields.year') }}
                                    </th>
                                    <td>
                                        {{ $financialYear->year }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.financialYear.fields.start_date') }}
                                    </th>
                                    <td>
                                        {{ $financialYear->start_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.financialYear.fields.end_date') }}
                                    </th>
                                    <td>
                                        {{ $financialYear->end_date }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.financial-years.index') }}">
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
                        <a href="#financial_year_auctions" aria-controls="financial_year_auctions" role="tab" data-toggle="tab">
                            {{ trans('cruds.auction.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="financial_year_auctions">
                        @includeIf('admin.financialYears.relationships.financialYearAuctions', ['auctions' => $financialYear->financialYearAuctions])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection