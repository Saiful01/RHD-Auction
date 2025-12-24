@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.division.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.divisions.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.division.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.division.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('details') ? 'has-error' : '' }}">
                            <label for="details">{{ trans('cruds.division.fields.details') }}</label>
                            <textarea class="form-control" name="details" id="details">{{ old('details') }}</textarea>
                            @if($errors->has('details'))
                                <span class="help-block" role="alert">{{ $errors->first('details') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.division.fields.details_helper') }}</span>
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