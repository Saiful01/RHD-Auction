<?php

namespace App\Http\Requests;

use App\Models\BidderAuctionRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBidderAuctionRequestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bidder_auction_request_edit');
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
            'pay_order' => [
                'array',
                'required',
            ],
            'pay_order.*' => [
                'required',
            ],
            'pay_amount' => [
                'numeric',
            ],
        ];
    }
}
