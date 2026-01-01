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
                    <form method="POST" action="{{ route("admin.bidder-auction-requests.update", [$bidderAuctionRequest->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('bidder') ? 'has-error' : '' }}">
                            <label class="required" for="bidder_id">{{ trans('cruds.bidderAuctionRequest.fields.bidder') }}</label>
                            <select class="form-control select2" name="bidder_id" id="bidder_id" required>
                                @foreach($bidders as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('bidder_id') ? old('bidder_id') : $bidderAuctionRequest->bidder->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('bidder'))
                                <span class="help-block" role="alert">{{ $errors->first('bidder') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bidderAuctionRequest.fields.bidder_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('auction') ? 'has-error' : '' }}">
                            <label class="required" for="auction_id">{{ trans('cruds.bidderAuctionRequest.fields.auction') }}</label>
                            <select class="form-control select2" name="auction_id" id="auction_id" required>
                                @foreach($auctions as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('auction_id') ? old('auction_id') : $bidderAuctionRequest->auction->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('auction'))
                                <span class="help-block" role="alert">{{ $errors->first('auction') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bidderAuctionRequest.fields.auction_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('pay_order') ? 'has-error' : '' }}">
                            <label class="required" for="pay_order">{{ trans('cruds.bidderAuctionRequest.fields.pay_order') }}</label>
                            <div class="needsclick dropzone" id="pay_order-dropzone">
                            </div>
                            @if($errors->has('pay_order'))
                                <span class="help-block" role="alert">{{ $errors->first('pay_order') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bidderAuctionRequest.fields.pay_order_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('pay_amount') ? 'has-error' : '' }}">
                            <label for="pay_amount">{{ trans('cruds.bidderAuctionRequest.fields.pay_amount') }}</label>
                            <input class="form-control" type="number" name="pay_amount" id="pay_amount" value="{{ old('pay_amount', $bidderAuctionRequest->pay_amount) }}" step="0.0000001">
                            @if($errors->has('pay_amount'))
                                <span class="help-block" role="alert">{{ $errors->first('pay_amount') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bidderAuctionRequest.fields.pay_amount_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('is_condition_accept') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.bidderAuctionRequest.fields.is_condition_accept') }}</label>
                            @foreach(App\Models\BidderAuctionRequest::IS_CONDITION_ACCEPT_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="is_condition_accept_{{ $key }}" name="is_condition_accept" value="{{ $key }}" {{ old('is_condition_accept', $bidderAuctionRequest->is_condition_accept) === (string) $key ? 'checked' : '' }}>
                                    <label for="is_condition_accept_{{ $key }}" style="font-weight: 400">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('is_condition_accept'))
                                <span class="help-block" role="alert">{{ $errors->first('is_condition_accept') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bidderAuctionRequest.fields.is_condition_accept_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.bidderAuctionRequest.fields.status') }}</label>
                            @foreach(App\Models\BidderAuctionRequest::STATUS_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', $bidderAuctionRequest->status) === (string) $key ? 'checked' : '' }}>
                                    <label for="status_{{ $key }}" style="font-weight: 400">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('status'))
                                <span class="help-block" role="alert">{{ $errors->first('status') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bidderAuctionRequest.fields.status_helper') }}</span>
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
    var uploadedPayOrderMap = {}
Dropzone.options.payOrderDropzone = {
    url: '{{ route('admin.bidder-auction-requests.storeMedia') }}',
    maxFilesize: 5, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="pay_order[]" value="' + response.name + '">')
      uploadedPayOrderMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPayOrderMap[file.name]
      }
      $('form').find('input[name="pay_order[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($bidderAuctionRequest) && $bidderAuctionRequest->pay_order)
          var files =
            {!! json_encode($bidderAuctionRequest->pay_order) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="pay_order[]" value="' + file.file_name + '">')
            }
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