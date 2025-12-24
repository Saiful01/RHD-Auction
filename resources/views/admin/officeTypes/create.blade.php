@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.officeType.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.office-types.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.officeType.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.officeType.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('name_bn') ? 'has-error' : '' }}">
                            <label for="name_bn">{{ trans('cruds.officeType.fields.name_bn') }}</label>
                            <input class="form-control" type="text" name="name_bn" id="name_bn" value="{{ old('name_bn', '') }}">
                            @if($errors->has('name_bn'))
                                <span class="help-block" role="alert">{{ $errors->first('name_bn') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.officeType.fields.name_bn_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection