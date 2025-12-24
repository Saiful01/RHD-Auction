@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">

        {{-- Left Column: Create Lot Item Form --}}
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.lotItem.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('admin.lots.lot-items.newStore') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="lot_id" value="{{ $lotId ?? old('lot_id') }}">

                        <div id="lotItemsContainer">

                            <div class="lot-item-row border p-3 mb-2 d-flex">
                                {{-- Left Column: Form Fields --}}
                                <div class="flex-grow-1">
                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                        <label class="required" for="name">{{ trans('cruds.lotItem.fields.name') }}</label>
                                        <input class="form-control" type="text" name="name[]" value="{{ old('name.0', '') }}" required>
                                    </div>

                                    <div class="form-group {{ $errors->has('tree_no') ? 'has-error' : '' }}">
                                        <label for="tree_no">{{ trans('cruds.lotItem.fields.tree_no') }}</label>
                                        <textarea class="form-control ckeditor" name="tree_no[]">{!! old('tree_no.0') !!}</textarea>
                                    </div>

                                    <div class="form-group {{ $errors->has('dia') ? 'has-error' : '' }}">
                                        <label for="dia">{{ trans('cruds.lotItem.fields.dia') }}</label>
                                        <input class="form-control" type="text" name="dia[]" value="{{ old('dia.0', '') }}">
                                    </div>

                                    <div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
                                        <label for="quantity">{{ trans('cruds.lotItem.fields.quantity') }}</label>
                                        <input class="form-control" type="number" step="0.000000001" name="quantity[]" value="{{ old('quantity.0', '') }}">
                                    </div>

                                    <div class="form-group {{ $errors->has('unit') ? 'has-error' : '' }}">
                                        <label class="required">{{ trans('cruds.lotItem.fields.unit') }}</label>
                                        <select class="form-control" name="unit[]" required>
                                            <option value disabled {{ old('unit.0', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                            @foreach(App\Models\LotItem::UNIT_SELECT as $key => $label)
                                                <option value="{{ $key }}" {{ old('unit.0', '') == (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group {{ $errors->has('unit_price') ? 'has-error' : '' }}">
                                        <label for="unit_price">{{ trans('cruds.lotItem.fields.unit_price') }}</label>
                                        <input class="form-control" type="number" step="0.01" name="unit_price[]" value="{{ old('unit_price.0', '') }}">
                                    </div>

                                    <div class="form-group {{ $errors->has('estimated_price') ? 'has-error' : '' }}">
                                        <label for="estimated_price">{{ trans('cruds.lotItem.fields.estimated_price') }}</label>
                                        <input class="form-control" type="number" step="0.000000001" name="estimated_price[]" value="{{ old('estimated_price.0', '') }}">
                                    </div>
                                </div>

                                {{-- Right Column: Buttons --}}
                                <div class="d-flex flex-column justify-content-start align-items-end ms-3">
                                    <button type="button" class="btn btn-primary mb-2" id="addLotItem" title="Add"><i class="fas fa-plus"></i></button>
                                    <button type="button" class="btn btn-danger mb-2 remove-lot-item" title="Remove"><i class="fas fa-trash"></i></button>
                                    <button type="submit" class="btn btn-success" title="Save"><i class="fas fa-save"></i></button>
                                </div>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>

        {{-- Right Column: List of Existing Lot Items --}}
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.lotItem.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Tree No</th>
                                <th>Dia</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Unit Price</th>
                                <th>Estimated Price</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lotId ? \App\Models\LotItem::where('lot_id', $lotId)->get() : [] as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{!! $item->tree_no !!}</td>
                                    <td>{{ $item->dia }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ \App\Models\LotItem::UNIT_SELECT[$item->unit] ?? '' }}</td>
                                    <td>{{ $item->unit_price }}</td>
                                    <td>{{ $item->estimated_price }}</td>
                                    <td>
                                        <a href="{{ route('lot-items.edit', $item->id) }}" class="btn btn-xs btn-info" title="Edit"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    function SimpleUploadAdapter(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
            return {
                upload: function() {
                    return loader.file.then(function(file) {
                        return new Promise(function(resolve, reject) {
                            var xhr = new XMLHttpRequest();
                            xhr.open('POST', '{{ route('admin.lot-items.storeCKEditorImages') }}', true);
                            xhr.setRequestHeader('x-csrf-token', window._token);
                            xhr.setRequestHeader('Accept', 'application/json');
                            xhr.responseType = 'json';

                            xhr.addEventListener('error', function() { reject("Upload failed"); });
                            xhr.addEventListener('abort', function() { reject(); });
                            xhr.addEventListener('load', function() {
                                var response = xhr.response;
                                if(!response || xhr.status !== 201) {
                                    return reject("Upload failed: "+xhr.status);
                                }
                                $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');
                                resolve({ default: response.url });
                            });

                            var data = new FormData();
                            data.append('upload', file);
                            data.append('crud_id', '{{ $lotId ?? 0 }}');
                            xhr.send(data);
                        });
                    });
                }
            };
        }
    }

    var allEditors = document.querySelectorAll('.ckeditor');
    for (var i = 0; i < allEditors.length; ++i) {
        ClassicEditor.create(allEditors[i], { extraPlugins: [SimpleUploadAdapter] });
    }

    // Add/Remove multiple lot item rows
    $('#addLotItem').click(function() {
        var newRow = $('.lot-item-row:first').clone();
        newRow.find('input, textarea, select').val('');
        $('#lotItemsContainer').append(newRow);

        // Re-init CKEditor for new row
        newRow.find('.ckeditor').each(function(){
            ClassicEditor.create(this, { extraPlugins: [SimpleUploadAdapter] });
        });
    });

    $(document).on('click', '.remove-lot-item', function() {
        if($('.lot-item-row').length > 1){
            $(this).closest('.lot-item-row').remove();
        }
    });
});
</script>
@endsection
