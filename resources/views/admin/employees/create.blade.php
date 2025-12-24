@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.employee.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.employees.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('cadre_name') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.employee.fields.cadre_name') }}</label>
                            @foreach(App\Models\Employee::CADRE_NAME_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="cadre_name_{{ $key }}" name="cadre_name" value="{{ $key }}" {{ old('cadre_name', '') === (string) $key ? 'checked' : '' }}>
                                    <label for="cadre_name_{{ $key }}" style="font-weight: 400">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('cadre_name'))
                                <span class="help-block" role="alert">{{ $errors->first('cadre_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.cadre_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('charge_type') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.employee.fields.charge_type') }}</label>
                            @foreach(App\Models\Employee::CHARGE_TYPE_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="charge_type_{{ $key }}" name="charge_type" value="{{ $key }}" {{ old('charge_type', '') === (string) $key ? 'checked' : '' }}>
                                    <label for="charge_type_{{ $key }}" style="font-weight: 400">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('charge_type'))
                                <span class="help-block" role="alert">{{ $errors->first('charge_type') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.charge_type_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('post_type') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.employee.fields.post_type') }}</label>
                            @foreach(App\Models\Employee::POST_TYPE_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="post_type_{{ $key }}" name="post_type" value="{{ $key }}" {{ old('post_type', '') === (string) $key ? 'checked' : '' }}>
                                    <label for="post_type_{{ $key }}" style="font-weight: 400">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('post_type'))
                                <span class="help-block" role="alert">{{ $errors->first('post_type') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.post_type_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('job_status') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.employee.fields.job_status') }}</label>
                            @foreach(App\Models\Employee::JOB_STATUS_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="job_status_{{ $key }}" name="job_status" value="{{ $key }}" {{ old('job_status', '') === (string) $key ? 'checked' : '' }}>
                                    <label for="job_status_{{ $key }}" style="font-weight: 400">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('job_status'))
                                <span class="help-block" role="alert">{{ $errors->first('job_status') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.job_status_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('office') ? 'has-error' : '' }}">
                            <label class="required" for="office_id">{{ trans('cruds.employee.fields.office') }}</label>
                            <select class="form-control select2" name="office_id" id="office_id" required>
                                @foreach($offices as $id => $entry)
                                    <option value="{{ $id }}" {{ old('office_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('office'))
                                <span class="help-block" role="alert">{{ $errors->first('office') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.office_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('designation') ? 'has-error' : '' }}">
                            <label class="required" for="designation_id">{{ trans('cruds.employee.fields.designation') }}</label>
                            <select class="form-control select2" name="designation_id" id="designation_id" required>
                                @foreach($designations as $id => $entry)
                                    <option value="{{ $id }}" {{ old('designation_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('designation'))
                                <span class="help-block" role="alert">{{ $errors->first('designation') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.designation_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('name_en') ? 'has-error' : '' }}">
                            <label class="required" for="name_en">{{ trans('cruds.employee.fields.name_en') }}</label>
                            <input class="form-control" type="text" name="name_en" id="name_en" value="{{ old('name_en', '') }}" required>
                            @if($errors->has('name_en'))
                                <span class="help-block" role="alert">{{ $errors->first('name_en') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.name_en_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('name_bn') ? 'has-error' : '' }}">
                            <label for="name_bn">{{ trans('cruds.employee.fields.name_bn') }}</label>
                            <input class="form-control" type="text" name="name_bn" id="name_bn" value="{{ old('name_bn', '') }}">
                            @if($errors->has('name_bn'))
                                <span class="help-block" role="alert">{{ $errors->first('name_bn') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.name_bn_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('personnel') ? 'has-error' : '' }}">
                            <label class="required" for="personnel">{{ trans('cruds.employee.fields.personnel') }}</label>
                            <input class="form-control" type="text" name="personnel" id="personnel" value="{{ old('personnel', '') }}" required>
                            @if($errors->has('personnel'))
                                <span class="help-block" role="alert">{{ $errors->first('personnel') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.personnel_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('gradation') ? 'has-error' : '' }}">
                            <label for="gradation">{{ trans('cruds.employee.fields.gradation') }}</label>
                            <input class="form-control" type="number" name="gradation" id="gradation" value="{{ old('gradation', '') }}" step="1">
                            @if($errors->has('gradation'))
                                <span class="help-block" role="alert">{{ $errors->first('gradation') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.gradation_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('grade') ? 'has-error' : '' }}">
                            <label for="grade">{{ trans('cruds.employee.fields.grade') }}</label>
                            <input class="form-control" type="text" name="grade" id="grade" value="{{ old('grade', '') }}">
                            @if($errors->has('grade'))
                                <span class="help-block" role="alert">{{ $errors->first('grade') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.grade_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('bcs_no') ? 'has-error' : '' }}">
                            <label for="bcs_no">{{ trans('cruds.employee.fields.bcs_no') }}</label>
                            <input class="form-control" type="text" name="bcs_no" id="bcs_no" value="{{ old('bcs_no', '') }}">
                            @if($errors->has('bcs_no'))
                                <span class="help-block" role="alert">{{ $errors->first('bcs_no') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.bcs_no_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('passing_year') ? 'has-error' : '' }}">
                            <label for="passing_year">{{ trans('cruds.employee.fields.passing_year') }}</label>
                            <input class="form-control" type="text" name="passing_year" id="passing_year" value="{{ old('passing_year', '') }}">
                            @if($errors->has('passing_year'))
                                <span class="help-block" role="alert">{{ $errors->first('passing_year') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.passing_year_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('birth_date') ? 'has-error' : '' }}">
                            <label for="birth_date">{{ trans('cruds.employee.fields.birth_date') }}</label>
                            <input class="form-control date" type="text" name="birth_date" id="birth_date" value="{{ old('birth_date') }}">
                            @if($errors->has('birth_date'))
                                <span class="help-block" role="alert">{{ $errors->first('birth_date') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.birth_date_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('date_of_retirement') ? 'has-error' : '' }}">
                            <label for="date_of_retirement">{{ trans('cruds.employee.fields.date_of_retirement') }}</label>
                            <input class="form-control date" type="text" name="date_of_retirement" id="date_of_retirement" value="{{ old('date_of_retirement') }}">
                            @if($errors->has('date_of_retirement'))
                                <span class="help-block" role="alert">{{ $errors->first('date_of_retirement') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.date_of_retirement_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('phone_office') ? 'has-error' : '' }}">
                            <label for="phone_office">{{ trans('cruds.employee.fields.phone_office') }}</label>
                            <input class="form-control" type="text" name="phone_office" id="phone_office" value="{{ old('phone_office', '') }}">
                            @if($errors->has('phone_office'))
                                <span class="help-block" role="alert">{{ $errors->first('phone_office') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.phone_office_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('phone_personal') ? 'has-error' : '' }}">
                            <label for="phone_personal">{{ trans('cruds.employee.fields.phone_personal') }}</label>
                            <input class="form-control" type="text" name="phone_personal" id="phone_personal" value="{{ old('phone_personal', '') }}">
                            @if($errors->has('phone_personal'))
                                <span class="help-block" role="alert">{{ $errors->first('phone_personal') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.phone_personal_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('email_office') ? 'has-error' : '' }}">
                            <label for="email_office">{{ trans('cruds.employee.fields.email_office') }}</label>
                            <input class="form-control" type="email" name="email_office" id="email_office" value="{{ old('email_office') }}">
                            @if($errors->has('email_office'))
                                <span class="help-block" role="alert">{{ $errors->first('email_office') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.email_office_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('email_personal') ? 'has-error' : '' }}">
                            <label for="email_personal">{{ trans('cruds.employee.fields.email_personal') }}</label>
                            <input class="form-control" type="email" name="email_personal" id="email_personal" value="{{ old('email_personal') }}">
                            @if($errors->has('email_personal'))
                                <span class="help-block" role="alert">{{ $errors->first('email_personal') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.email_personal_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('signature') ? 'has-error' : '' }}">
                            <label for="signature">{{ trans('cruds.employee.fields.signature') }}</label>
                            <div class="needsclick dropzone" id="signature-dropzone">
                            </div>
                            @if($errors->has('signature'))
                                <span class="help-block" role="alert">{{ $errors->first('signature') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.signature_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.signatureDropzone = {
    url: '{{ route('admin.employees.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="signature"]').remove()
      $('form').append('<input type="hidden" name="signature" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="signature"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($employee) && $employee->signature)
      var file = {!! json_encode($employee->signature) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="signature" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
@endsection