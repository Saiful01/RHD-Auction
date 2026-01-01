<?php

namespace App\Http\Requests;

use App\Models\Bid;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBidRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bid_edit');
    }

    public function rules()
    {
        return [
            'bidder_id' => [
                'required',
                'integer',
            ],
            'auction_id' => [
                'required',
                'integer',
            ],
            'vat' => [
                'numeric',
            ],
            'tax' => [
                'numeric',
            ],
            'bid_amount' => [
                'numeric',
            ],
            'total_amount' => [
                'numeric',
            ],
        ];
    }
}
