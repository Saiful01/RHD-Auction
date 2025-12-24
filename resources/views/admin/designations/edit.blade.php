@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.designation.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.designations.update", [$designation->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('designation') ? 'has-error' : '' }}">
                            <label for="designation">{{ trans('cruds.designation.fields.designation') }}</label>
                            <input class="form-control" type="number" name="designation" id="designation" value="{{ old('designation', $designation->designation) }}" step="1">
                            @if($errors->has('designation'))
                                <span class="help-block" role="alert">{{ $errors->first('designation') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.designation.fields.designation_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('designation_en') ? 'has-error' : '' }}">
                            <label class="required" for="designation_en">{{ trans('cruds.designation.fields.designation_en') }}</label>
                            <input class="form-control" type="text" name="designation_en" id="designation_en" value="{{ old('designation_en', $designation->designation_en) }}" required>
                            @if($errors->has('designation_en'))
                                <span class="help-block" role="alert">{{ $errors->first('designation_en') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.designation.fields.designation_en_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('designation_bn') ? 'has-error' : '' }}">
                            <label for="designation_bn">{{ trans('cruds.designation.fields.designation_bn') }}</label>
                            <input class="form-control" type="text" name="designation_bn" id="designation_bn" value="{{ old('designation_bn', $designation->designation_bn) }}">
                            @if($errors->has('designation_bn'))
                                <span class="help-block" role="alert">{{ $errors->first('designation_bn') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.designation.fields.designation_bn_helper') }}</span>
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