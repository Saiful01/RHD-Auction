@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.road.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.roads.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.road.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $road->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.road.fields.division') }}
                                    </th>
                                    <td>
                                        {{ $road->division->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.road.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $road->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.road.fields.details') }}
                                    </th>
                                    <td>
                                        {{ $road->details }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.road.fields.address') }}
                                    </th>
                                    <td>
                                        {{ $road->address }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.road.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $road->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.road.fields.phone') }}
                                    </th>
                                    <td>
                                        {{ $road->phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.road.fields.image') }}
                                    </th>
                                    <td>
                                        @foreach($road->image as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.road.fields.files') }}
                                    </th>
                                    <td>
                                        @foreach($road->files as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.roads.index') }}">
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
                        <a href="#road_packages" aria-controls="road_packages" role="tab" data-toggle="tab">
                            {{ trans('cruds.package.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#road_lots" aria-controls="road_lots" role="tab" data-toggle="tab">
                            {{ trans('cruds.lot.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#road_auctions" aria-controls="road_auctions" role="tab" data-toggle="tab">
                            {{ trans('cruds.auction.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="road_packages">
                        @includeIf('admin.roads.relationships.roadPackages', ['packages' => $road->roadPackages])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="road_lots">
                        @includeIf('admin.roads.relationships.roadLots', ['lots' => $road->roadLots])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="road_auctions">
                        @includeIf('admin.roads.relationships.roadAuctions', ['auctions' => $road->roadAuctions])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection