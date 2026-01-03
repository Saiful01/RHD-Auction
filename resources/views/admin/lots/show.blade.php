@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.lot.title') }}
                </div>
                <div class="panel-body">
                    
                    <div class="form-group">
                        <div class="form-group text-right">
                            <a class="btn btn-default" href="{{ route('admin.lots.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lot.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $lot->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lot.fields.road') }}
                                    </th>
                                    <td>
                                        {{ $lot->road->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lot.fields.package') }}
                                    </th>
                                    <td>
                                        {{ $lot->package->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lot.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $lot->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lot.fields.details') }}
                                    </th>
                                    <td>
                                        {!! $lot->details !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lot.fields.location') }}
                                    </th>
                                    <td>
                                        {!! $lot->location !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lot.fields.tree_description') }}
                                    </th>
                                    <td>
                                        {!! $lot->tree_description !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lot.fields.comment') }}
                                    </th>
                                    <td>
                                        {!! $lot->comment !!}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.lots.index') }}">
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
                        <a href="#lot_lot_items" aria-controls="lot_lot_items" role="tab" data-toggle="tab">
                            {{ trans('cruds.lotItem.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#lot_auctions" aria-controls="lot_auctions" role="tab" data-toggle="tab">
                            {{ trans('cruds.auction.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="lot_lot_items">
                        @includeIf('admin.lots.relationships.lotLotItems', ['lotItems' => $lot->lotLotItems])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="lot_auctions">
                        @includeIf('admin.lots.relationships.lotAuctions', ['auctions' => $lot->lotAuctions])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection