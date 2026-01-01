<?php

namespace App\Http\Requests;

use App\Models\Bidder;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBidderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bidder_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'password' => [
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
