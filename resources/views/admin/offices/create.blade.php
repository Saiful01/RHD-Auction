@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.office.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.offices.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('office_type') ? 'has-error' : '' }}">
                            <label class="required" for="office_type_id">{{ trans('cruds.office.fields.office_type') }}</label>
                            <select class="form-control select2" name="office_type_id" id="office_type_id" required>
                                @foreach($office_types as $id => $entry)
                                    <option value="{{ $id }}" {{ old('office_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('office_type'))
                                <span class="help-block" role="alert">{{ $errors->first('office_type') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.office.fields.office_type_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('office_name_en') ? 'has-error' : '' }}">
                            <label for="office_name_en">{{ trans('cruds.office.fields.office_name_en') }}</label>
                            <input class="form-control" type="text" name="office_name_en" id="office_name_en" value="{{ old('office_name_en', '') }}">
                            @if($errors->has('office_name_en'))
                                <span class="help-block" role="alert">{{ $errors->first('office_name_en') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.office.fields.office_name_en_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('office_name_bn') ? 'has-error' : '' }}">
                            <label for="office_name_bn">{{ trans('cruds.office.fields.office_name_bn') }}</label>
                            <input class="form-control" type="text" name="office_name_bn" id="office_name_bn" value="{{ old('office_name_bn', '') }}">
                            @if($errors->has('office_name_bn'))
                                <span class="help-block" role="alert">{{ $errors->first('office_name_bn') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.office.fields.office_name_bn_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('office_cat') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.office.fields.office_cat') }}</label>
                            @foreach(App\Models\Office::OFFICE_CAT_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="office_cat_{{ $key }}" name="office_cat" value="{{ $key }}" {{ old('office_cat', '') === (string) $key ? 'checked' : '' }}>
                                    <label for="office_cat_{{ $key }}" style="font-weight: 400">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('office_cat'))
                                <span class="help-block" role="alert">{{ $errors->first('office_cat') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.office.fields.office_cat_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('parent_office') ? 'has-error' : '' }}">
                            <label for="parent_office">{{ trans('cruds.office.fields.parent_office') }}</label>
                            <input class="form-control" type="number" name="parent_office" id="parent_office" value="{{ old('parent_office', '') }}" step="1">
                            @if($errors->has('parent_office'))
                                <span class="help-block" role="alert">{{ $errors->first('parent_office') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.office.fields.parent_office_helper') }}</span>
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