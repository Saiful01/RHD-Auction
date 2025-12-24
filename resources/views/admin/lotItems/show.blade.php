@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.lotItem.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.lot-items.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lotItem.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $lotItem->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lotItem.fields.lot') }}
                                    </th>
                                    <td>
                                        {{ $lotItem->lot->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lotItem.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $lotItem->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lotItem.fields.tree_no') }}
                                    </th>
                                    <td>
                                        {!! $lotItem->tree_no !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lotItem.fields.dia') }}
                                    </th>
                                    <td>
                                        {{ $lotItem->dia }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lotItem.fields.quantity') }}
                                    </th>
                                    <td>
                                        {{ $lotItem->quantity }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lotItem.fields.unit') }}
                                    </th>
                                    <td>
                                        {{ App\Models\LotItem::UNIT_SELECT[$lotItem->unit] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lotItem.fields.unit_price') }}
                                    </th>
                                    <td>
                                        {{ $lotItem->unit_price }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lotItem.fields.estimated_price') }}
                                    </th>
                                    <td>
                                        {{ $lotItem->estimated_price }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.lot-items.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection