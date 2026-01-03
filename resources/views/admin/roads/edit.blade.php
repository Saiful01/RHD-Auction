@extends('layouts.admin')
@section('content')
    <div class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('global.edit') }} {{ trans('cruds.road.title_singular') }}
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('admin.roads.update', [$road->id]) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group {{ $errors->has('division') ? 'has-error' : '' }}">
                                    <label class="required"
                                        for="division_id">{{ trans('cruds.road.fields.division') }}</label>
                                    <select class="form-control select2" name="division_id" id="division_id" required>
                                        @foreach ($divisions as $id => $entry)
                                            <option value="{{ $id }}"
                                                {{ (old('division_id') ? old('division_id') : $road->division->id ?? '') == $id ? 'selected' : '' }}>
                                                {{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('division'))
                                        <span class="help-block" role="alert">{{ $errors->first('division') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.road.fields.division_helper') }}</span>
                                </div>
                                <div class="col-md-6 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label class="required" for="name">{{ trans('cruds.road.fields.name') }}</label>
                                    <input class="form-control" type="text" name="name" id="name"
                                        value="{{ old('name', $road->name) }}" required>
                                    @if ($errors->has('name'))
                                        <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.road.fields.name_helper') }}</span>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('details') ? 'has-error' : '' }}">
                                <label for="details">{{ trans('cruds.road.fields.details') }}</label>
                                <textarea class="form-control" name="details" id="details">{{ old('details', $road->details) }}</textarea>
                                @if ($errors->has('details'))
                                    <span class="help-block" role="alert">{{ $errors->first('details') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.road.fields.details_helper') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                <label for="address">{{ trans('cruds.road.fields.address') }}</label>
                                <input class="form-control" type="text" name="address" id="address"
                                    value="{{ old('address', $road->address) }}">
                                @if ($errors->has('address'))
                                    <span class="help-block" role="alert">{{ $errors->first('address') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.road.fields.address_helper') }}</span>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label for="email">{{ trans('cruds.road.fields.email') }}</label>
                                    <input class="form-control" type="email" name="email" id="email"
                                        value="{{ old('email', $road->email) }}">
                                    @if ($errors->has('email'))
                                        <span class="help-block" role="alert">{{ $errors->first('email') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.road.fields.email_helper') }}</span>
                                </div>
                                <div class="col-md-6 form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                                    <label for="phone">{{ trans('cruds.road.fields.phone') }}</label>
                                    <input class="form-control" type="text" name="phone" id="phone"
                                        value="{{ old('phone', $road->phone) }}">
                                    @if ($errors->has('phone'))
                                        <span class="help-block" role="alert">{{ $errors->first('phone') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.road.fields.phone_helper') }}</span>
                                </div>
                                <div class="col-md-6 form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                                    <label for="image">{{ trans('cruds.road.fields.image') }}</label>
                                    <div class="needsclick dropzone" id="image-dropzone">
                                    </div>
                                    @if ($errors->has('image'))
                                        <span class="help-block" role="alert">{{ $errors->first('image') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.road.fields.image_helper') }}</span>
                                </div>
                                <div class="col-md-6 form-group {{ $errors->has('files') ? 'has-error' : '' }}">
                                    <label for="files">{{ trans('cruds.road.fields.files') }}</label>
                                    <div class="needsclick dropzone" id="files-dropzone">
                                    </div>
                                    @if ($errors->has('files'))
                                        <span class="help-block" role="alert">{{ $errors->first('files') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.road.fields.files_helper') }}</span>
                                </div>
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
        var uploadedImageMap = {}
        Dropzone.options.imageDropzone = {
            url: '{{ route('admin.roads.storeMedia') }}',
            maxFilesize: 5, // MB
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 5
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="image[]" value="' + response.name + '">')
                uploadedImageMap[file.name] = response.name
            },
            removedfile: function(file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedImageMap[file.name]
                }
                $('form').find('input[name="image[]"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($road) && $road->image)
                    var files =
                        {!! json_encode($road->image) !!}
                    for (var i in files) {
                        var file = files[i]
                        this.options.addedfile.call(this, file)
                        file.previewElement.classList.add('dz-complete')
                        $('form').append('<input type="hidden" name="image[]" value="' + file.file_name + '">')
                    }
                @endif
            },
            error: function(file, response) {
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
    <script>
        var uploadedFilesMap = {}
        Dropzone.options.filesDropzone = {
            url: '{{ route('admin.roads.storeMedia') }}',
            maxFilesize: 10, // MB
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 10
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="files[]" value="' + response.name + '">')
                uploadedFilesMap[file.name] = response.name
            },
            removedfile: function(file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedFilesMap[file.name]
                }
                $('form').find('input[name="files[]"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($road) && $road->files)
                    var files =
                        {!! json_encode($road->files) !!}
                    for (var i in files) {
                        var file = files[i]
                        this.options.addedfile.call(this, file)
                        file.previewElement.classList.add('dz-complete')
                        $('form').append('<input type="hidden" name="files[]" value="' + file.file_name + '">')
                    }
                @endif
            },
            error: function(file, response) {
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
