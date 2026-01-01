<?php

namespace App\Http\Requests;

use App\Models\Bidder;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBidderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bidder_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'phone' => [
                'string',
                'nullable',
            ],
            'nid_no' => [
                'string',
                'nullable',
            ],
            'tin_no' => [
                'string',
                'nullable',
            ],
            'bin_no' => [
                'string',
                'nullable',
            ],
            'address' => [
                'string',
                'nullable',
            ],
        ];
    }
}
