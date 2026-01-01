@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.bid.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.bids.update", [$bid->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('bidder') ? 'has-error' : '' }}">
                            <label class="required" for="bidder_id">{{ trans('cruds.bid.fields.bidder') }}</label>
                            <select class="form-control select2" name="bidder_id" id="bidder_id" required>
                                @foreach($bidders as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('bidder_id') ? old('bidder_id') : $bid->bidder->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('bidder'))
                                <span class="help-block" role="alert">{{ $errors->first('bidder') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bid.fields.bidder_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('auction') ? 'has-error' : '' }}">
                            <label class="required" for="auction_id">{{ trans('cruds.bid.fields.auction') }}</label>
                            <select class="form-control select2" name="auction_id" id="auction_id" required>
                                @foreach($auctions as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('auction_id') ? old('auction_id') : $bid->auction->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('auction'))
                                <span class="help-block" role="alert">{{ $errors->first('auction') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bid.fields.auction_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('vat') ? 'has-error' : '' }}">
                            <label for="vat">{{ trans('cruds.bid.fields.vat') }}</label>
                            <input class="form-control" type="number" name="vat" id="vat" value="{{ old('vat', $bid->vat) }}" step="0.0000001">
                            @if($errors->has('vat'))
                                <span class="help-block" role="alert">{{ $errors->first('vat') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bid.fields.vat_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('tax') ? 'has-error' : '' }}">
                            <label for="tax">{{ trans('cruds.bid.fields.tax') }}</label>
                            <input class="form-control" type="number" name="tax" id="tax" value="{{ old('tax', $bid->tax) }}" step="0.0000001">
                            @if($errors->has('tax'))
                                <span class="help-block" role="alert">{{ $errors->first('tax') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bid.fields.tax_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('bid_amount') ? 'has-error' : '' }}">
                            <label for="bid_amount">{{ trans('cruds.bid.fields.bid_amount') }}</label>
                            <input class="form-control" type="number" name="bid_amount" id="bid_amount" value="{{ old('bid_amount', $bid->bid_amount) }}" step="0.0000001">
                            @if($errors->has('bid_amount'))
                                <span class="help-block" role="alert">{{ $errors->first('bid_amount') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bid.fields.bid_amount_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('total_amount') ? 'has-error' : '' }}">
                            <label for="total_amount">{{ trans('cruds.bid.fields.total_amount') }}</label>
                            <input class="form-control" type="number" name="total_amount" id="total_amount" value="{{ old('total_amount', $bid->total_amount) }}" step="0.0000001">
                            @if($errors->has('total_amount'))
                                <span class="help-block" role="alert">{{ $errors->first('total_amount') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bid.fields.total_amount_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('is_condition_accept') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.bid.fields.is_condition_accept') }}</label>
                            @foreach(App\Models\Bid::IS_CONDITION_ACCEPT_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="is_condition_accept_{{ $key }}" name="is_condition_accept" value="{{ $key }}" {{ old('is_condition_accept', $bid->is_condition_accept) === (string) $key ? 'checked' : '' }}>
                                    <label for="is_condition_accept_{{ $key }}" style="font-weight: 400">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('is_condition_accept'))
                                <span class="help-block" role="alert">{{ $errors->first('is_condition_accept') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bid.fields.is_condition_accept_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('is_winner') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.bid.fields.is_winner') }}</label>
                            @foreach(App\Models\Bid::IS_WINNER_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="is_winner_{{ $key }}" name="is_winner" value="{{ $key }}" {{ old('is_winner', $bid->is_winner) === (string) $key ? 'checked' : '' }}>
                                    <label for="is_winner_{{ $key }}" style="font-weight: 400">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('is_winner'))
                                <span class="help-block" role="alert">{{ $errors->first('is_winner') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bid.fields.is_winner_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.bid.fields.status') }}</label>
                            @foreach(App\Models\Bid::STATUS_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', $bid->status) === (string) $key ? 'checked' : '' }}>
                                    <label for="status_{{ $key }}" style="font-weight: 400">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('status'))
                                <span class="help-block" role="alert">{{ $errors->first('status') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bid.fields.status_helper') }}</span>
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