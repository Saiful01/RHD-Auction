@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('global.edit') }} {{ trans('cruds.bidderAuctionRequest.title_singular') }}
                    </div>
                    <div class="panel-body">
                        <form method="POST"
                            action="{{ route('admin.bidder-auction-requests.update', [$bidderAuctionRequest->id]) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            {{-- Row 1: Bidder, Auction, Pay Amount --}}
                            <div class="row">
                                <div class="form-group col-md-4 {{ $errors->has('bidder') ? 'has-error' : '' }}">
                                    <label class="required"
                                        for="bidder_id">{{ trans('cruds.bidderAuctionRequest.fields.bidder') }}</label>
                                    <select class="form-control select2" name="bidder_id" id="bidder_id" required>
                                        @foreach ($bidders as $id => $entry)
                                            <option value="{{ $id }}"
                                                {{ (old('bidder_id') ? old('bidder_id') : $bidderAuctionRequest->bidder->id ?? '') == $id ? 'selected' : '' }}>
                                                {{ $entry }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('bidder'))
                                        <span class="help-block" role="alert">{{ $errors->first('bidder') }}</span>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('auction') ? 'has-error' : '' }}">
                                    <label class="required"
                                        for="auction_id">{{ trans('cruds.bidderAuctionRequest.fields.auction') }}</label>
                                    <select class="form-control select2" name="auction_id" id="auction_id" required>
                                        @foreach ($auctions as $id => $entry)
                                            <option value="{{ $id }}"
                                                {{ (old('auction_id') ? old('auction_id') : $bidderAuctionRequest->auction->id ?? '') == $id ? 'selected' : '' }}>
                                                {{ $entry }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('auction'))
                                        <span class="help-block" role="alert">{{ $errors->first('auction') }}</span>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('pay_amount') ? 'has-error' : '' }}">
                                    <label
                                        for="pay_amount">{{ trans('cruds.bidderAuctionRequest.fields.pay_amount') }}</label>
                                    <input class="form-control" type="number" name="pay_amount" id="pay_amount"
                                        value="{{ old('pay_amount', $bidderAuctionRequest->pay_amount) }}"
                                        step="0.0000001">
                                    @if ($errors->has('pay_amount'))
                                        <span class="help-block" role="alert">{{ $errors->first('pay_amount') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Row 3: Pay Order Dropzone --}}
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('pay_order') ? 'has-error' : '' }}">
                                    <label class="required"
                                        for="pay_order">{{ trans('cruds.bidderAuctionRequest.fields.pay_order') }}</label>
                                    <div class="needsclick dropzone" id="pay_order-dropzone"></div>
                                    @if ($errors->has('pay_order'))
                                        <span class="help-block" role="alert">{{ $errors->first('pay_order') }}</span>
                                    @endif
                                </div>

                                {{-- Auto Chalan --}}
                                <div class="form-group col-md-6 {{ $errors->has('auto_chalan') ? 'has-error' : '' }}">
                                    <label class="required" for="auto_chalan">Auto Chalan</label>
                                    <div class="needsclick dropzone" id="auto_chalan-dropzone"></div>
                                    @if ($errors->has('auto_chalan'))
                                        <span class="help-block" role="alert">{{ $errors->first('auto_chalan') }}</span>
                                    @endif
                                </div>

                                {{-- NID Copy --}}
                                <div class="form-group col-md-6 {{ $errors->has('nid_copy') ? 'has-error' : '' }}">
                                    <label class="required" for="nid_copy">NID Copy</label>
                                    <div class="needsclick dropzone" id="nid_copy-dropzone"></div>
                                    @if ($errors->has('nid_copy'))
                                        <span class="help-block" role="alert">{{ $errors->first('nid_copy') }}</span>
                                    @endif
                                </div>

                                {{-- Passport Photo --}}
                                <div class="form-group col-md-6 {{ $errors->has('passport_photo') ? 'has-error' : '' }}">
                                    <label class="required" for="passport_photo">Passport Photo</label>
                                    <div class="needsclick dropzone" id="passport_photo-dropzone"></div>
                                    @if ($errors->has('passport_photo'))
                                        <span class="help-block"
                                            role="alert">{{ $errors->first('passport_photo') }}</span>
                                    @endif
                                </div>

                                {{-- Trade License --}}
                                <div class="form-group col-md-6 {{ $errors->has('trade_license') ? 'has-error' : '' }}">
                                    <label class="required" for="trade_license">Trade License</label>
                                    <div class="needsclick dropzone" id="trade_license-dropzone"></div>
                                    @if ($errors->has('trade_license'))
                                        <span class="help-block"
                                            role="alert">{{ $errors->first('trade_license') }}</span>
                                    @endif
                                </div>

                                {{-- Tax Certificate --}}
                                <div class="form-group col-md-6 {{ $errors->has('tax_certificate') ? 'has-error' : '' }}">
                                    <label class="required" for="tax_certificate">Tax Certificate</label>
                                    <div class="needsclick dropzone" id="tax_certificate-dropzone"></div>
                                    @if ($errors->has('tax_certificate'))
                                        <span class="help-block"
                                            role="alert">{{ $errors->first('tax_certificate') }}</span>
                                    @endif
                                </div>

                                {{-- Wood License --}}
                                <div class="form-group col-md-6 {{ $errors->has('wood_license') ? 'has-error' : '' }}">
                                    <label class="required" for="wood_license">Wood License</label>
                                    <div class="needsclick dropzone" id="wood_license-dropzone"></div>
                                    @if ($errors->has('wood_license'))
                                        <span class="help-block" role="alert">{{ $errors->first('wood_license') }}</span>
                                    @endif
                                </div>

                                {{-- Bank Guarantee --}}
                                <div class="form-group col-md-6 {{ $errors->has('bank_guarantee') ? 'has-error' : '' }}">
                                    <label class="required" for="bank_guarantee">Bank Guarantee</label>
                                    <div class="needsclick dropzone" id="bank_guarantee-dropzone"></div>
                                    @if ($errors->has('bank_guarantee'))
                                        <span class="help-block"
                                            role="alert">{{ $errors->first('bank_guarantee') }}</span>
                                    @endif
                                </div>

                                {{-- Mobile Signature --}}
                                <div class="form-group col-md-6 {{ $errors->has('mobile_signature') ? 'has-error' : '' }}">
                                    <label class="required" for="mobile_signature">Mobile Signature</label>
                                    <div class="needsclick dropzone" id="mobile_signature-dropzone"></div>
                                    @if ($errors->has('mobile_signature'))
                                        <span class="help-block"
                                            role="alert">{{ $errors->first('mobile_signature') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Row 2: Is Condition Accept, Status --}}
                            <div class="row">
                                <div
                                    class="form-group col-md-6 {{ $errors->has('is_condition_accept') ? 'has-error' : '' }}">
                                    <label>{{ trans('cruds.bidderAuctionRequest.fields.is_condition_accept') }}</label>
                                    @foreach (App\Models\BidderAuctionRequest::IS_CONDITION_ACCEPT_RADIO as $key => $label)
                                        <div>
                                            <input type="radio" id="is_condition_accept_{{ $key }}"
                                                name="is_condition_accept" value="{{ $key }}"
                                                {{ old('is_condition_accept', $bidderAuctionRequest->is_condition_accept) === (string) $key ? 'checked' : '' }}>
                                            <label for="is_condition_accept_{{ $key }}"
                                                style="font-weight: 400">{{ $label }}</label>
                                        </div>
                                    @endforeach
                                    @if ($errors->has('is_condition_accept'))
                                        <span class="help-block"
                                            role="alert">{{ $errors->first('is_condition_accept') }}</span>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('status') ? 'has-error' : '' }}">
                                    <label>{{ trans('cruds.bidderAuctionRequest.fields.status') }}</label>
                                    @foreach (App\Models\BidderAuctionRequest::STATUS_RADIO as $key => $label)
                                        <div>
                                            <input type="radio" id="status_{{ $key }}" name="status"
                                                value="{{ $key }}"
                                                {{ old('status', $bidderAuctionRequest->status) === (string) $key ? 'checked' : '' }}>
                                            <label for="status_{{ $key }}"
                                                style="font-weight: 400">{{ $label }}</label>
                                        </div>
                                    @endforeach
                                    @if ($errors->has('status'))
                                        <span class="help-block" role="alert">{{ $errors->first('status') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Save button --}}
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
        var uploadedPayOrderMap = {}
        Dropzone.options.payOrderDropzone = {
            url: '{{ route('admin.bidder-auction-requests.storeMedia') }}',
            maxFilesize: 5,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 5
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="pay_order[]" value="' + response.name + '">')
                uploadedPayOrderMap[file.name] = response.name
            },
            removedfile: function(file) {
                file.previewElement.remove()
                var name = typeof file.file_name !== 'undefined' ? file.file_name : uploadedPayOrderMap[file.name]
                $('form').find('input[name="pay_order[]"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($bidderAuctionRequest) && $bidderAuctionRequest->pay_order)
                    var files = {!! json_encode($bidderAuctionRequest->pay_order) !!};
                    for (var i in files) {
                        var file = files[i];
                        this.options.addedfile.call(this, file);
                        file.previewElement.classList.add('dz-complete');
                        $('form').append('<input type="hidden" name="pay_order[]" value="' + file.file_name + '">');
                    }
                @endif
            },
            error: function(file, response) {
                var message = typeof response === 'string' ? response : response.errors.file;
                file.previewElement.classList.add('dz-error');
                var _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]'),
                    _results = [];
                for (var _i = 0; _i < _ref.length; _i++) {
                    node = _ref[_i];
                    _results.push(node.textContent = message);
                }
                return _results;
            }
        }
        // Auto Chalan Dropzone
        var uploadedAutoChalanMap = {}
        Dropzone.options.autoChalanDropzone = {
            url: '{{ route('admin.bidder-auction-requests.storeMedia') }}',
            maxFilesize: 5,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 5
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="auto_chalan[]" value="' + response.name + '">')
                uploadedAutoChalanMap[file.name] = response.name
            },
            removedfile: function(file) {
                file.previewElement.remove()
                var name = typeof file.file_name !== 'undefined' ? file.file_name : uploadedAutoChalanMap[file.name]
                $('form').find('input[name="auto_chalan[]"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($bidderAuctionRequest) && $bidderAuctionRequest->auto_chalan)
                    var files = {!! json_encode($bidderAuctionRequest->auto_chalan) !!};
                    for (var i in files) {
                        var file = files[i];
                        this.options.addedfile.call(this, file);
                        file.previewElement.classList.add('dz-complete');
                        $('form').append('<input type="hidden" name="auto_chalan[]" value="' + file.file_name +
                            '">');
                    }
                @endif
            },
            error: function(file, response) {
                var message = typeof response === 'string' ? response : response.errors.file;
                file.previewElement.classList.add('dz-error');
                var _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]'),
                    _results = [];
                for (var _i = 0; _i < _ref.length; _i++) {
                    node = _ref[_i];
                    _results.push(node.textContent = message);
                }
                return _results;
            }
        }
        // NID Copy Dropzone
        var uploadedNidCopyMap = {}
        Dropzone.options.nidCopyDropzone = {
            url: '{{ route('admin.bidder-auction-requests.storeMedia') }}',
            maxFilesize: 5,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 5
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="nid_copy[]" value="' + response.name + '">')
                uploadedNidCopyMap[file.name] = response.name
            },
            removedfile: function(file) {
                file.previewElement.remove()
                var name = typeof file.file_name !== 'undefined' ? file.file_name : uploadedNidCopyMap[file.name]
                $('form').find('input[name="nid_copy[]"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($bidderAuctionRequest) && $bidderAuctionRequest->nid_copy)
                    var files = {!! json_encode($bidderAuctionRequest->nid_copy) !!};
                    for (var i in files) {
                        var file = files[i];
                        this.options.addedfile.call(this, file);
                        file.previewElement.classList.add('dz-complete');
                        $('form').append('<input type="hidden" name="nid_copy[]" value="' + file.file_name + '">');
                    }
                @endif
            },
            error: function(file, response) {
                var message = typeof response === 'string' ? response : response.errors.file;
                file.previewElement.classList.add('dz-error');
                var _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]'),
                    _results = [];
                for (var _i = 0; _i < _ref.length; _i++) {
                    node = _ref[_i];
                    _results.push(node.textContent = message);
                }
                return _results;
            }
        }
        // Passport Photo Dropzone
        var uploadedPassportPhotoMap = {}
        Dropzone.options.passportPhotoDropzone = {
            url: '{{ route('admin.bidder-auction-requests.storeMedia') }}',
            maxFilesize: 5,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 5
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="passport_photo[]" value="' + response.name + '">')
                uploadedPassportPhotoMap[file.name] = response.name
            },
            removedfile: function(file) {
                file.previewElement.remove()
                var name = typeof file.file_name !== 'undefined' ? file.file_name : uploadedPassportPhotoMap[file
                    .name]
                $('form').find('input[name="passport_photo[]"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($bidderAuctionRequest) && $bidderAuctionRequest->passport_photo)
                    var files = {!! json_encode($bidderAuctionRequest->passport_photo) !!};
                    for (var i in files) {
                        var file = files[i];
                        this.options.addedfile.call(this, file);
                        file.previewElement.classList.add('dz-complete');
                        $('form').append('<input type="hidden" name="passport_photo[]" value="' + file.file_name +
                            '">');
                    }
                @endif
            },
            error: function(file, response) {
                var message = typeof response === 'string' ? response : response.errors.file;
                file.previewElement.classList.add('dz-error');
                var _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]'),
                    _results = [];
                for (var _i = 0; _i < _ref.length; _i++) {
                    node = _ref[_i];
                    _results.push(node.textContent = message);
                }
                return _results;
            }
        }
        // Trade License Dropzone
        var uploadedTradeLicenseMap = {}
        Dropzone.options.tradeLicenseDropzone = {
            url: '{{ route('admin.bidder-auction-requests.storeMedia') }}',
            maxFilesize: 5,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 5
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="trade_license[]" value="' + response.name + '">')
                uploadedTradeLicenseMap[file.name] = response.name
            },
            removedfile: function(file) {
                file.previewElement.remove()
                var name = typeof file.file_name !== 'undefined' ? file.file_name : uploadedTradeLicenseMap[file
                    .name]
                $('form').find('input[name="trade_license[]"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($bidderAuctionRequest) && $bidderAuctionRequest->trade_license)
                    var files = {!! json_encode($bidderAuctionRequest->trade_license) !!};
                    for (var i in files) {
                        var file = files[i];
                        this.options.addedfile.call(this, file);
                        file.previewElement.classList.add('dz-complete');
                        $('form').append('<input type="hidden" name="trade_license[]" value="' + file.file_name +
                            '">');
                    }
                @endif
            },
            error: function(file, response) {
                var message = typeof response === 'string' ? response : response.errors.file;
                file.previewElement.classList.add('dz-error');
                var _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]'),
                    _results = [];
                for (var _i = 0; _i < _ref.length; _i++) {
                    node = _ref[_i];
                    _results.push(node.textContent = message);
                }
                return _results;
            }
        }
        // Tax Certificate Dropzone
        var uploadedTaxCertificateMap = {}
        Dropzone.options.taxCertificateDropzone = {
            url: '{{ route('admin.bidder-auction-requests.storeMedia') }}',
            maxFilesize: 5,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 5
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="tax_certificate[]" value="' + response.name + '">')
                uploadedTaxCertificateMap[file.name] = response.name
            },
            removedfile: function(file) {
                file.previewElement.remove()
                var name = typeof file.file_name !== 'undefined' ? file.file_name : uploadedTaxCertificateMap[file
                    .name]
                $('form').find('input[name="tax_certificate[]"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($bidderAuctionRequest) && $bidderAuctionRequest->tax_certificate)
                    var files = {!! json_encode($bidderAuctionRequest->tax_certificate) !!};
                    for (var i in files) {
                        var file = files[i];
                        this.options.addedfile.call(this, file);
                        file.previewElement.classList.add('dz-complete');
                        $('form').append('<input type="hidden" name="tax_certificate[]" value="' + file.file_name +
                            '">');
                    }
                @endif
            },
            error: function(file, response) {
                var message = typeof response === 'string' ? response : response.errors.file;
                file.previewElement.classList.add('dz-error');
                var _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]'),
                    _results = [];
                for (var _i = 0; _i < _ref.length; _i++) {
                    node = _ref[_i];
                    _results.push(node.textContent = message);
                }
                return _results;
            }
        }
        // Wood License Dropzone
        var uploadedWoodLicenseMap = {}
        Dropzone.options.woodLicenseDropzone = {
            url: '{{ route('admin.bidder-auction-requests.storeMedia') }}',
            maxFilesize: 5,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 5
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="wood_license[]" value="' + response.name + '">')
                uploadedWoodLicenseMap[file.name] = response.name
            },
            removedfile: function(file) {
                file.previewElement.remove()
                var name = typeof file.file_name !== 'undefined' ? file.file_name : uploadedWoodLicenseMap[file
                    .name]
                $('form').find('input[name="wood_license[]"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($bidderAuctionRequest) && $bidderAuctionRequest->wood_license)
                    var files = {!! json_encode($bidderAuctionRequest->wood_license) !!};
                    for (var i in files) {
                        var file = files[i];
                        this.options.addedfile.call(this, file);
                        file.previewElement.classList.add('dz-complete');
                        $('form').append('<input type="hidden" name="wood_license[]" value="' + file.file_name +
                            '">');
                    }
                @endif
            },
            error: function(file, response) {
                var message = typeof response === 'string' ? response : response.errors.file;
                file.previewElement.classList.add('dz-error');
                var _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]'),
                    _results = [];
                for (var _i = 0; _i < _ref.length; _i++) {
                    node = _ref[_i];
                    _results.push(node.textContent = message);
                }
                return _results;
            }
        }
        // Bank Guarantee Dropzone
        var uploadedBankGuaranteeMap = {}
        Dropzone.options.bankGuaranteeDropzone = {
            url: '{{ route('admin.bidder-auction-requests.storeMedia') }}',
            maxFilesize: 5,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 5
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="bank_guarantee[]" value="' + response.name + '">')
                uploadedBankGuaranteeMap[file.name] = response.name
            },
            removedfile: function(file) {
                file.previewElement.remove()
                var name = typeof file.file_name !== 'undefined' ? file.file_name : uploadedBankGuaranteeMap[file
                    .name]
                $('form').find('input[name="bank_guarantee[]"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($bidderAuctionRequest) && $bidderAuctionRequest->bank_guarantee)
                    var files = {!! json_encode($bidderAuctionRequest->bank_guarantee) !!};
                    for (var i in files) {
                        var file = files[i];
                        this.options.addedfile.call(this, file);
                        file.previewElement.classList.add('dz-complete');
                        $('form').append('<input type="hidden" name="bank_guarantee[]" value="' + file.file_name +
                            '">');
                    }
                @endif
            },
            error: function(file, response) {
                var message = typeof response === 'string' ? response : response.errors.file;
                file.previewElement.classList.add('dz-error');
                var _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]'),
                    _results = [];
                for (var _i = 0; _i < _ref.length; _i++) {
                    node = _ref[_i];
                    _results.push(node.textContent = message);
                }
                return _results;
            }
        }
        // Mobile Signature Dropzone
        var uploadedMobileSignatureMap = {}
        Dropzone.options.mobileSignatureDropzone = {
            url: '{{ route('admin.bidder-auction-requests.storeMedia') }}',
            maxFilesize: 5,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 5
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="mobile_signature[]" value="' + response.name + '">')
                uploadedMobileSignatureMap[file.name] = response.name
            },
            removedfile: function(file) {
                file.previewElement.remove()
                var name = typeof file.file_name !== 'undefined' ? file.file_name : uploadedMobileSignatureMap[file
                    .name]
                $('form').find('input[name="mobile_signature[]"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($bidderAuctionRequest) && $bidderAuctionRequest->mobile_signature)
                    var files = {!! json_encode($bidderAuctionRequest->mobile_signature) !!};
                    for (var i in files) {
                        var file = files[i];
                        this.options.addedfile.call(this, file);
                        file.previewElement.classList.add('dz-complete');
                        $('form').append('<input type="hidden" name="mobile_signature[]" value="' + file.file_name +
                            '">');
                    }
                @endif
            },
            error: function(file, response) {
                var message = typeof response === 'string' ? response : response.errors.file;
                file.previewElement.classList.add('dz-error');
                var _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]'),
                    _results = [];
                for (var _i = 0; _i < _ref.length; _i++) {
                    node = _ref[_i];
                    _results.push(node.textContent = message);
                }
                return _results;
            }
        }
    </script>
@endsection
