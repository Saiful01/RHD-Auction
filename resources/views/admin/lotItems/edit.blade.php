@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.lotItem.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.lot-items.update", [$lotItem->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('lot') ? 'has-error' : '' }}">
                            <label class="required" for="lot_id">{{ trans('cruds.lotItem.fields.lot') }}</label>
                            <select class="form-control select2" name="lot_id" id="lot_id" required>
                                @foreach($lots as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('lot_id') ? old('lot_id') : $lotItem->lot->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('lot'))
                                <span class="help-block" role="alert">{{ $errors->first('lot') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lotItem.fields.lot_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.lotItem.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $lotItem->name) }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lotItem.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('tree_no') ? 'has-error' : '' }}">
                            <label for="tree_no">{{ trans('cruds.lotItem.fields.tree_no') }}</label>
                            <textarea class="form-control ckeditor" name="tree_no" id="tree_no">{!! old('tree_no', $lotItem->tree_no) !!}</textarea>
                            @if($errors->has('tree_no'))
                                <span class="help-block" role="alert">{{ $errors->first('tree_no') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lotItem.fields.tree_no_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('dia') ? 'has-error' : '' }}">
                            <label for="dia">{{ trans('cruds.lotItem.fields.dia') }}</label>
                            <input class="form-control" type="text" name="dia" id="dia" value="{{ old('dia', $lotItem->dia) }}">
                            @if($errors->has('dia'))
                                <span class="help-block" role="alert">{{ $errors->first('dia') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lotItem.fields.dia_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
                            <label for="quantity">{{ trans('cruds.lotItem.fields.quantity') }}</label>
                            <input class="form-control" type="number" name="quantity" id="quantity" value="{{ old('quantity', $lotItem->quantity) }}" step="0.000000001">
                            @if($errors->has('quantity'))
                                <span class="help-block" role="alert">{{ $errors->first('quantity') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lotItem.fields.quantity_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('unit') ? 'has-error' : '' }}">
                            <label class="required">{{ trans('cruds.lotItem.fields.unit') }}</label>
                            <select class="form-control" name="unit" id="unit" required>
                                <option value disabled {{ old('unit', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\LotItem::UNIT_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('unit', $lotItem->unit) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('unit'))
                                <span class="help-block" role="alert">{{ $errors->first('unit') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lotItem.fields.unit_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('unit_price') ? 'has-error' : '' }}">
                            <label for="unit_price">{{ trans('cruds.lotItem.fields.unit_price') }}</label>
                            <input class="form-control" type="number" name="unit_price" id="unit_price" value="{{ old('unit_price', $lotItem->unit_price) }}" step="0.01">
                            @if($errors->has('unit_price'))
                                <span class="help-block" role="alert">{{ $errors->first('unit_price') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lotItem.fields.unit_price_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('estimated_price') ? 'has-error' : '' }}">
                            <label for="estimated_price">{{ trans('cruds.lotItem.fields.estimated_price') }}</label>
                            <input class="form-control" type="number" name="estimated_price" id="estimated_price" value="{{ old('estimated_price', $lotItem->estimated_price) }}" step="0.000000001">
                            @if($errors->has('estimated_price'))
                                <span class="help-block" role="alert">{{ $errors->first('estimated_price') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lotItem.fields.estimated_price_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.lot-items.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $lotItem->id ?? 0 }}');
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