@extends('layouts.admin')
@section('content')
    <div class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('global.edit') }} {{ trans('cruds.bidder.title_singular') }}
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('admin.bidders.update', [$bidder->id]) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-4 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label class="required" for="name">{{ trans('cruds.bidder.fields.name') }}</label>
                                    <input class="form-control" type="text" name="name" id="name"
                                        value="{{ old('name', $bidder->name) }}" required>
                                    @if ($errors->has('name'))
                                        <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.bidder.fields.name_helper') }}</span>
                                </div>
                                <div class="col-md-4 form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label for="email">{{ trans('cruds.bidder.fields.email') }}</label>
                                    <input class="form-control" type="email" name="email" id="email"
                                        value="{{ old('email', $bidder->email) }}">
                                    @if ($errors->has('email'))
                                        <span class="help-block" role="alert">{{ $errors->first('email') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.bidder.fields.email_helper') }}</span>
                                </div>
                                {{-- <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label class="required" for="password">{{ trans('cruds.bidder.fields.password') }}</label>
                            <input class="form-control" type="password" name="password" id="password">
                            @if ($errors->has('password'))
                                <span class="help-block" role="alert">{{ $errors->first('password') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bidder.fields.password_helper') }}</span>
                        </div> --}}
                                <div class="col-md-4 form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                                    <label for="phone">{{ trans('cruds.bidder.fields.phone') }}</label>
                                    <input class="form-control" type="text" name="phone" id="phone"
                                        value="{{ old('phone', $bidder->phone) }}">
                                    @if ($errors->has('phone'))
                                        <span class="help-block" role="alert">{{ $errors->first('phone') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.bidder.fields.phone_helper') }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group {{ $errors->has('nid_no') ? 'has-error' : '' }}">
                                    <label for="nid_no">{{ trans('cruds.bidder.fields.nid_no') }}</label>
                                    <input class="form-control" type="text" name="nid_no" id="nid_no"
                                        value="{{ old('nid_no', $bidder->nid_no) }}">
                                    @if ($errors->has('nid_no'))
                                        <span class="help-block" role="alert">{{ $errors->first('nid_no') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.bidder.fields.nid_no_helper') }}</span>
                                </div>
                                <div class="col-md-4 form-group {{ $errors->has('tin_no') ? 'has-error' : '' }}">
                                    <label for="tin_no">{{ trans('cruds.bidder.fields.tin_no') }}</label>
                                    <input class="form-control" type="text" name="tin_no" id="tin_no"
                                        value="{{ old('tin_no', $bidder->tin_no) }}">
                                    @if ($errors->has('tin_no'))
                                        <span class="help-block" role="alert">{{ $errors->first('tin_no') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.bidder.fields.tin_no_helper') }}</span>
                                </div>
                                <div class="col-md-4 form-group {{ $errors->has('bin_no') ? 'has-error' : '' }}">
                                    <label for="bin_no">{{ trans('cruds.bidder.fields.bin_no') }}</label>
                                    <input class="form-control" type="text" name="bin_no" id="bin_no"
                                        value="{{ old('bin_no', $bidder->bin_no) }}">
                                    @if ($errors->has('bin_no'))
                                        <span class="help-block" role="alert">{{ $errors->first('bin_no') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.bidder.fields.bin_no_helper') }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 form-group {{ $errors->has('details') ? 'has-error' : '' }}">
                                    <label for="details">{{ trans('cruds.bidder.fields.details') }}</label>
                                    <textarea class="form-control" name="details" id="details">{{ old('details', $bidder->details) }}</textarea>
                                    @if ($errors->has('details'))
                                        <span class="help-block" role="alert">{{ $errors->first('details') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.bidder.fields.details_helper') }}</span>
                                </div>
                                <div class="col-md-5 form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                    <label for="address">{{ trans('cruds.bidder.fields.address') }}</label>
                                    <textarea class="form-control" name="address" id="address">{{ old('address', $bidder->address) }}</textarea>
                                    @if ($errors->has('address'))
                                        <span class="help-block" role="alert">{{ $errors->first('address') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.bidder.fields.address_helper') }}</span>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group {{ $errors->has('profile_image') ? 'has-error' : '' }}">
                                    <label for="profile_image">{{ trans('cruds.bidder.fields.profile_image') }}</label>
                                    <div class="needsclick dropzone" id="profile_image-dropzone">
                                    </div>
                                    @if ($errors->has('profile_image'))
                                        <span class="help-block"
                                            role="alert">{{ $errors->first('profile_image') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.bidder.fields.profile_image_helper') }}</span>
                                </div>
                                <div class="col-md-6 form-group {{ $errors->has('nid_file') ? 'has-error' : '' }}">
                                    <label for="nid_file">{{ trans('cruds.bidder.fields.nid_file') }}</label>
                                    <div class="needsclick dropzone" id="nid_file-dropzone">
                                    </div>
                                    @if ($errors->has('nid_file'))
                                        <span class="help-block" role="alert">{{ $errors->first('nid_file') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.bidder.fields.nid_file_helper') }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group {{ $errors->has('tin_file') ? 'has-error' : '' }}">
                                    <label for="tin_file">{{ trans('cruds.bidder.fields.tin_file') }}</label>
                                    <div class="needsclick dropzone" id="tin_file-dropzone">
                                    </div>
                                    @if ($errors->has('tin_file'))
                                        <span class="help-block" role="alert">{{ $errors->first('tin_file') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.bidder.fields.tin_file_helper') }}</span>
                                </div>
                                <div class="col-md-6 form-group {{ $errors->has('bin_file') ? 'has-error' : '' }}">
                                    <label for="bin_file">{{ trans('cruds.bidder.fields.bin_file') }}</label>
                                    <div class="needsclick dropzone" id="bin_file-dropzone">
                                    </div>
                                    @if ($errors->has('bin_file'))
                                        <span class="help-block" role="alert">{{ $errors->first('bin_file') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.bidder.fields.bin_file_helper') }}</span>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                <label>{{ trans('cruds.bidder.fields.status') }}</label>
                                @foreach (App\Models\Bidder::STATUS_RADIO as $key => $label)
                                    <div>
                                        <input type="radio" id="status_{{ $key }}" name="status"
                                            value="{{ $key }}"
                                            {{ (string) old('status', $bidder->status) === (string) $key ? 'checked' : '' }}>
                                        <label for="status_{{ $key }}"
                                            style="font-weight: 400">{{ $label }}</label>
                                    </div>
                                @endforeach
                                @if ($errors->has('status'))
                                    <span class="help-block" role="alert">{{ $errors->first('status') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.bidder.fields.status_helper') }}</span>
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
        Dropzone.options.profileImageDropzone = {
            url: '{{ route('admin.bidders.storeMedia') }}',
            maxFilesize: 5, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 5,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="profile_image"]').remove()
                $('form').append('<input type="hidden" name="profile_image" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="profile_image"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($bidder) && $bidder->profile_image)
                    var file = {!! json_encode($bidder->profile_image) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="profile_image" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
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
        Dropzone.options.nidFileDropzone = {
            url: '{{ route('admin.bidders.storeMedia') }}',
            maxFilesize: 5, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 5
            },
            success: function(file, response) {
                $('form').find('input[name="nid_file"]').remove()
                $('form').append('<input type="hidden" name="nid_file" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="nid_file"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($bidder) && $bidder->nid_file)
                    var file = {!! json_encode($bidder->nid_file) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="nid_file" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
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
        Dropzone.options.tinFileDropzone = {
            url: '{{ route('admin.bidders.storeMedia') }}',
            maxFilesize: 5, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 5
            },
            success: function(file, response) {
                $('form').find('input[name="tin_file"]').remove()
                $('form').append('<input type="hidden" name="tin_file" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="tin_file"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($bidder) && $bidder->tin_file)
                    var file = {!! json_encode($bidder->tin_file) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="tin_file" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
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
        Dropzone.options.binFileDropzone = {
            url: '{{ route('admin.bidders.storeMedia') }}',
            maxFilesize: 5, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 5
            },
            success: function(file, response) {
                $('form').find('input[name="bin_file"]').remove()
                $('form').append('<input type="hidden" name="bin_file" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="bin_file"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($bidder) && $bidder->bin_file)
                    var file = {!! json_encode($bidder->bin_file) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="bin_file" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
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
