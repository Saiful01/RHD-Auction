@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.lot.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.lots.update", [$lot->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('road') ? 'has-error' : '' }}">
                            <label class="required" for="road_id">{{ trans('cruds.lot.fields.road') }}</label>
                            <select class="form-control select2" name="road_id" id="road_id" required>
                                @foreach($roads as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('road_id') ? old('road_id') : $lot->road->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('road'))
                                <span class="help-block" role="alert">{{ $errors->first('road') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lot.fields.road_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('package') ? 'has-error' : '' }}">
                            <label for="package_id">{{ trans('cruds.lot.fields.package') }}</label>
                            <select class="form-control select2" name="package_id" id="package_id">
                                @foreach($packages as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('package_id') ? old('package_id') : $lot->package->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('package'))
                                <span class="help-block" role="alert">{{ $errors->first('package') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lot.fields.package_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.lot.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $lot->name) }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lot.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('details') ? 'has-error' : '' }}">
                            <label for="details">{{ trans('cruds.lot.fields.details') }}</label>
                            <textarea class="form-control ckeditor" name="details" id="details">{!! old('details', $lot->details) !!}</textarea>
                            @if($errors->has('details'))
                                <span class="help-block" role="alert">{{ $errors->first('details') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lot.fields.details_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                            <label for="location">{{ trans('cruds.lot.fields.location') }}</label>
                            <textarea class="form-control ckeditor" name="location" id="location">{!! old('location', $lot->location) !!}</textarea>
                            @if($errors->has('location'))
                                <span class="help-block" role="alert">{{ $errors->first('location') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lot.fields.location_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('tree_description') ? 'has-error' : '' }}">
                            <label for="tree_description">{{ trans('cruds.lot.fields.tree_description') }}</label>
                            <textarea class="form-control ckeditor" name="tree_description" id="tree_description">{!! old('tree_description', $lot->tree_description) !!}</textarea>
                            @if($errors->has('tree_description'))
                                <span class="help-block" role="alert">{{ $errors->first('tree_description') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lot.fields.tree_description_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
                            <label for="comment">{{ trans('cruds.lot.fields.comment') }}</label>
                            <textarea class="form-control ckeditor" name="comment" id="comment">{!! old('comment', $lot->comment) !!}</textarea>
                            @if($errors->has('comment'))
                                <span class="help-block" role="alert">{{ $errors->first('comment') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lot.fields.comment_helper') }}</span>
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
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.lots.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $lot->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection