<?php

namespace App\Http\Requests;

use App\Models\BidderAuctionRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBidderAuctionRequestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bidder_auction_request_create');
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

            // Individual document fields
            'auto_chalan' => [
                'array',
                'required',
            ],
            'auto_chalan.*' => [
                'required',
            ],

            'nid_copy' => [
                'array',
                'required',
            ],
            'nid_copy.*' => [
                'required',
            ],

            'passport_photo' => [
                'array',
                'required',
            ],
            'passport_photo.*' => [
                'required',
            ],

            'trade_license' => [
                'array',
                'required',
            ],
            'trade_license.*' => [
                'required',
            ],

            'tax_certificate' => [
                'array',
                'required',
            ],
            'tax_certificate.*' => [
                'required',
            ],

            'wood_license' => [
                'array',
                'required',
            ],
            'wood_license.*' => [
                'required',
            ],

            'bank_guarantee' => [
                'array',
                'required',
            ],
            'bank_guarantee.*' => [
                'required',
            ],

            'mobile_signature' => [
                'array',
                'required',
            ],
            'mobile_signature.*' => [
                'required',
            ],
            // End individual document fields

            'pay_amount' => [
                'numeric',
            ],
        ];
    }
}
