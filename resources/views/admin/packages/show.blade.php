@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.package.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.packages.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.package.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $package->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.package.fields.road') }}
                                    </th>
                                    <td>
                                        {{ $package->road->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.package.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $package->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.package.fields.unique_code') }}
                                    </th>
                                    <td>
                                        {{ $package->unique_code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.package.fields.details') }}
                                    </th>
                                    <td>
                                        {!! $package->details !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.package.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Package::STATUS_RADIO[$package->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.package.fields.images') }}
                                    </th>
                                    <td>
                                        @foreach($package->images as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $media->getUrl('thumb') }}">
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.package.fields.files') }}
                                    </th>
                                    <td>
                                        @foreach($package->files as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.packages.index') }}">
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
                        <a href="#package_lots" aria-controls="package_lots" role="tab" data-toggle="tab">
                            {{ trans('cruds.lot.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#package_auctions" aria-controls="package_auctions" role="tab" data-toggle="tab">
                            {{ trans('cruds.auction.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="package_lots">
                        @includeIf('admin.packages.relationships.packageLots', ['lots' => $package->packageLots])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="package_auctions">
                        @includeIf('admin.packages.relationships.packageAuctions', ['auctions' => $package->packageAuctions])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection