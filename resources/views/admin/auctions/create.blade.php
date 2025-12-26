@extends('layouts.admin')
@section('content')
    <div class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('global.create') }} {{ trans('cruds.auction.title_singular') }}
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('admin.auctions.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group {{ $errors->has('financial_year') ? 'has-error' : '' }}">
                                <label class="required"
                                    for="financial_year_id">{{ trans('cruds.auction.fields.financial_year') }}</label>
                                <select class="form-control select2" name="financial_year_id" id="financial_year_id"
                                    required>
                                    @foreach ($financial_years as $id => $entry)
                                        <option value="{{ $id }}"
                                            {{ old('financial_year_id') == $id ? 'selected' : '' }}>{{ $entry }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('financial_year'))
                                    <span class="help-block" role="alert">{{ $errors->first('financial_year') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.auction.fields.financial_year_helper') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('road') ? 'has-error' : '' }}">
                                <label class="required" for="road_id">{{ trans('cruds.auction.fields.road') }}</label>
                                <select class="form-control select2" name="road_id" id="road_id" required>
                                    @foreach ($roads as $id => $entry)
                                        <option value="{{ $id }}" {{ old('road_id') == $id ? 'selected' : '' }}>
                                            {{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('road'))
                                    <span class="help-block" role="alert">{{ $errors->first('road') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.auction.fields.road_helper') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('package') ? 'has-error' : '' }}">
                                <label for="package_id">{{ trans('cruds.auction.fields.package') }}</label>
                                <select class="form-control select2" name="package_id" id="package_id">
                                    @foreach ($packages as $id => $entry)
                                        <option value="{{ $id }}"
                                            {{ old('package_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('package'))
                                    <span class="help-block" role="alert">{{ $errors->first('package') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.auction.fields.package_helper') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('lots') ? 'has-error' : '' }}">
                                <label class="required" for="lots">{{ trans('cruds.auction.fields.lot') }}</label>
                                <div style="padding-bottom: 4px">
                                    <span class="btn btn-info btn-xs select-all"
                                        style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                    <span class="btn btn-info btn-xs deselect-all"
                                        style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                </div>
                                <select class="form-control select2" name="lots[]" id="lots" multiple required>
                                    @foreach ($lots as $lot)
                                        <option value="{{ $lot->id }}"
                                            data-total="{{ $lot->lotLotItems->sum('estimated_price') }}"
                                            {{ in_array($lot->id, old('lots', [])) ? 'selected' : '' }}>
                                            {{ $lot->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('lots'))
                                    <span class="help-block" role="alert">{{ $errors->first('lots') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.auction.fields.lot_helper') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('memo_no') ? 'has-error' : '' }}">
                                <label class="required" for="memo_no">{{ trans('cruds.auction.fields.memo_no') }}</label>
                                <input class="form-control" type="text" name="memo_no" id="memo_no"
                                    value="{{ old('memo_no', '') }}" required>
                                @if ($errors->has('memo_no'))
                                    <span class="help-block" role="alert">{{ $errors->first('memo_no') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.auction.fields.memo_no_helper') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('announcement_no') ? 'has-error' : '' }}">
                                <label class="required"
                                    for="announcement_no">{{ trans('cruds.auction.fields.announcement_no') }}</label>
                                <input class="form-control" type="text" name="announcement_no" id="announcement_no"
                                    value="{{ old('announcement_no', '') }}" required>
                                @if ($errors->has('announcement_no'))
                                    <span class="help-block" role="alert">{{ $errors->first('announcement_no') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.auction.fields.announcement_no_helper') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">{{ trans('cruds.auction.fields.name') }}</label>
                                <textarea class="form-control ckeditor" name="name" id="name">{!! old('name') !!}</textarea>
                                @if ($errors->has('name'))
                                    <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.auction.fields.name_helper') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('details') ? 'has-error' : '' }}">
                                <label for="details">{{ trans('cruds.auction.fields.details') }}</label>
                                <textarea class="form-control ckeditor" name="details" id="details">{!! old('details') !!}</textarea>
                                @if ($errors->has('details'))
                                    <span class="help-block" role="alert">{{ $errors->first('details') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.auction.fields.details_helper') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('auction_start_time') ? 'has-error' : '' }}">
                                <label class="required"
                                    for="auction_start_time">{{ trans('cruds.auction.fields.auction_start_time') }}</label>
                                <input class="form-control datetime" type="text" name="auction_start_time"
                                    id="auction_start_time" value="{{ old('auction_start_time') }}" required>
                                @if ($errors->has('auction_start_time'))
                                    <span class="help-block"
                                        role="alert">{{ $errors->first('auction_start_time') }}</span>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.auction.fields.auction_start_time_helper') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('auction_end_time') ? 'has-error' : '' }}">
                                <label class="required"
                                    for="auction_end_time">{{ trans('cruds.auction.fields.auction_end_time') }}</label>
                                <input class="form-control datetime" type="text" name="auction_end_time"
                                    id="auction_end_time" value="{{ old('auction_end_time') }}" required>
                                @if ($errors->has('auction_end_time'))
                                    <span class="help-block"
                                        role="alert">{{ $errors->first('auction_end_time') }}</span>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.auction.fields.auction_end_time_helper') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('tender_visible_start_date') ? 'has-error' : '' }}">
                                <label
                                    for="tender_visible_start_date">{{ trans('cruds.auction.fields.tender_visible_start_date') }}</label>
                                <input class="form-control datetime" type="text" name="tender_visible_start_date"
                                    id="tender_visible_start_date" value="{{ old('tender_visible_start_date') }}">
                                @if ($errors->has('tender_visible_start_date'))
                                    <span class="help-block"
                                        role="alert">{{ $errors->first('tender_visible_start_date') }}</span>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.auction.fields.tender_visible_start_date_helper') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('tender_visible_end_date') ? 'has-error' : '' }}">
                                <label
                                    for="tender_visible_end_date">{{ trans('cruds.auction.fields.tender_visible_end_date') }}</label>
                                <input class="form-control datetime" type="text" name="tender_visible_end_date"
                                    id="tender_visible_end_date" value="{{ old('tender_visible_end_date') }}">
                                @if ($errors->has('tender_visible_end_date'))
                                    <span class="help-block"
                                        role="alert">{{ $errors->first('tender_visible_end_date') }}</span>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.auction.fields.tender_visible_end_date_helper') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('tender_sale_start_date') ? 'has-error' : '' }}">
                                <label
                                    for="tender_sale_start_date">{{ trans('cruds.auction.fields.tender_sale_start_date') }}</label>
                                <input class="form-control datetime" type="text" name="tender_sale_start_date"
                                    id="tender_sale_start_date" value="{{ old('tender_sale_start_date') }}">
                                @if ($errors->has('tender_sale_start_date'))
                                    <span class="help-block"
                                        role="alert">{{ $errors->first('tender_sale_start_date') }}</span>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.auction.fields.tender_sale_start_date_helper') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('tender_sale_end_date') ? 'has-error' : '' }}">
                                <label
                                    for="tender_sale_end_date">{{ trans('cruds.auction.fields.tender_sale_end_date') }}</label>
                                <input class="form-control datetime" type="text" name="tender_sale_end_date"
                                    id="tender_sale_end_date" value="{{ old('tender_sale_end_date') }}">
                                @if ($errors->has('tender_sale_end_date'))
                                    <span class="help-block"
                                        role="alert">{{ $errors->first('tender_sale_end_date') }}</span>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.auction.fields.tender_sale_end_date_helper') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('deadline_for_tree_removal') ? 'has-error' : '' }}">
                                <label
                                    for="deadline_for_tree_removal">{{ trans('cruds.auction.fields.deadline_for_tree_removal') }}</label>
                                <input class="form-control" type="text" name="deadline_for_tree_removal"
                                    id="deadline_for_tree_removal" value="{{ old('deadline_for_tree_removal', '') }}">
                                @if ($errors->has('deadline_for_tree_removal'))
                                    <span class="help-block"
                                        role="alert">{{ $errors->first('deadline_for_tree_removal') }}</span>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.auction.fields.deadline_for_tree_removal_helper') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('bidder_criteria') ? 'has-error' : '' }}">
                                <label for="bidder_criteria">{{ trans('cruds.auction.fields.bidder_criteria') }}</label>
                                <textarea class="form-control ckeditor" name="bidder_criteria" id="bidder_criteria">{!! old('bidder_criteria') !!}</textarea>
                                @if ($errors->has('bidder_criteria'))
                                    <span class="help-block"
                                        role="alert">{{ $errors->first('bidder_criteria') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.auction.fields.bidder_criteria_helper') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('required_document') ? 'has-error' : '' }}">
                                <label
                                    for="required_document">{{ trans('cruds.auction.fields.required_document') }}</label>
                                <textarea class="form-control ckeditor" name="required_document" id="required_document">{!! old('required_document') !!}</textarea>
                                @if ($errors->has('required_document'))
                                    <span class="help-block"
                                        role="alert">{{ $errors->first('required_document') }}</span>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.auction.fields.required_document_helper') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('note') ? 'has-error' : '' }}">
                                <label for="note">{{ trans('cruds.auction.fields.note') }}</label>
                                <textarea class="form-control ckeditor" name="note" id="note">{!! old('note') !!}</textarea>
                                @if ($errors->has('note'))
                                    <span class="help-block" role="alert">{{ $errors->first('note') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.auction.fields.note_helper') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('estimate_value_percentage') ? 'has-error' : '' }}">
                                <label
                                    for="estimate_value_percentage">{{ trans('cruds.auction.fields.estimate_value_percentage') }}</label>
                                <input class="form-control" type="number" name="estimate_value_percentage"
                                    id="estimate_value_percentage" value="{{ old('estimate_value_percentage', '') }}"
                                    step="1">
                                @if ($errors->has('estimate_value_percentage'))
                                    <span class="help-block"
                                        role="alert">{{ $errors->first('estimate_value_percentage') }}</span>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.auction.fields.estimate_value_percentage_helper') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('base_value_amount') ? 'has-error' : '' }}">
                                <label class="required"
                                    for="base_value_amount">{{ trans('cruds.auction.fields.base_value_amount') }}</label>
                                <input class="form-control" type="number" name="base_value_amount"
                                    id="base_value_amount" value="{{ old('base_value_amount', '') }}" step="0.0000001"
                                    required>
                                @if ($errors->has('base_value_amount'))
                                    <span class="help-block"
                                        role="alert">{{ $errors->first('base_value_amount') }}</span>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.auction.fields.base_value_amount_helper') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('min_bid_amount') ? 'has-error' : '' }}">
                                <label for="min_bid_amount">{{ trans('cruds.auction.fields.min_bid_amount') }}</label>
                                <input class="form-control" type="number" name="min_bid_amount" id="min_bid_amount"
                                    value="{{ old('min_bid_amount', '') }}" step="0.0000001">
                                @if ($errors->has('min_bid_amount'))
                                    <span class="help-block"
                                        role="alert">{{ $errors->first('min_bid_amount') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.auction.fields.min_bid_amount_helper') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('vat') ? 'has-error' : '' }}">
                                <label for="vat">{{ trans('cruds.auction.fields.vat') }}</label>
                                <input class="form-control" type="number" name="vat" id="vat"
                                    value="{{ old('vat', '') }}" step="1">
                                @if ($errors->has('vat'))
                                    <span class="help-block" role="alert">{{ $errors->first('vat') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.auction.fields.vat_helper') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('tax') ? 'has-error' : '' }}">
                                <label for="tax">{{ trans('cruds.auction.fields.tax') }}</label>
                                <input class="form-control" type="number" name="tax" id="tax"
                                    value="{{ old('tax', '') }}" step="1">
                                @if ($errors->has('tax'))
                                    <span class="help-block" role="alert">{{ $errors->first('tax') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.auction.fields.tax_helper') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('employees') ? 'has-error' : '' }}">
                                <label for="employees">{{ trans('cruds.auction.fields.employees') }}</label>
                                <div style="padding-bottom: 4px">
                                    <span class="btn btn-info btn-xs select-all"
                                        style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                    <span class="btn btn-info btn-xs deselect-all"
                                        style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                </div>
                                <select class="form-control select2" name="employees[]" id="employees" multiple>
                                    @foreach ($employees as $id => $employee)
                                        <option value="{{ $id }}"
                                            {{ in_array($id, old('employees', [])) ? 'selected' : '' }}>
                                            {{ $employee }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('employees'))
                                    <span class="help-block" role="alert">{{ $errors->first('employees') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.auction.fields.employees_helper') }}</span>
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
        $(document).ready(function() {
            function SimpleUploadAdapter(editor) {
                editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
                    return {
                        upload: function() {
                            return loader.file
                                .then(function(file) {
                                    return new Promise(function(resolve, reject) {
                                        // Init request
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST',
                                            '{{ route('admin.auctions.storeCKEditorImages') }}',
                                            true);
                                        xhr.setRequestHeader('x-csrf-token', window._token);
                                        xhr.setRequestHeader('Accept', 'application/json');
                                        xhr.responseType = 'json';

                                        // Init listeners
                                        var genericErrorText =
                                            `Couldn't upload file: ${ file.name }.`;
                                        xhr.addEventListener('error', function() {
                                            reject(genericErrorText)
                                        });
                                        xhr.addEventListener('abort', function() {
                                            reject()
                                        });
                                        xhr.addEventListener('load', function() {
                                            var response = xhr.response;

                                            if (!response || xhr.status !== 201) {
                                                return reject(response && response
                                                    .message ?
                                                    `${genericErrorText}\n${xhr.status} ${response.message}` :
                                                    `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`
                                                );
                                            }

                                            $('form').append(
                                                '<input type="hidden" name="ck-media[]" value="' +
                                                response.id + '">');

                                            resolve({
                                                default: response.url
                                            });
                                        });

                                        if (xhr.upload) {
                                            xhr.upload.addEventListener('progress', function(
                                                e) {
                                                if (e.lengthComputable) {
                                                    loader.uploadTotal = e.total;
                                                    loader.uploaded = e.loaded;
                                                }
                                            });
                                        }

                                        // Send request
                                        var data = new FormData();
                                        data.append('upload', file);
                                        data.append('crud_id', '{{ $auction->id ?? 0 }}');
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
    <script>
        $(document).ready(function() {

            function recalculate() {
                let total = 0;

                $('#lots option:selected').each(function() {
                    total += parseFloat($(this).data('total')) || 0;
                });

                let percentage = parseFloat($('#estimate_value_percentage').val()) || 0;

                if (percentage > 0) {
                    let calculated = (total * percentage) / 100;
                    $('#base_value_amount').val(calculated.toFixed(7));
                    $('#min_bid_amount').val(calculated.toFixed(7));
                } else {
                    $('#base_value_amount').val(total.toFixed(7));
                    $('#min_bid_amount').val(total.toFixed(7));
                }
            }

            // Lot change
            $('#lots').on('change', function() {
                recalculate();
            });

            // Percentage change
            $('#estimate_value_percentage').on('input', function() {
                recalculate();
            });

        });
    </script>
@endsection
