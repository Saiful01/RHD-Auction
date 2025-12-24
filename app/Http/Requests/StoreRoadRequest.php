<?php

namespace App\Http\Requests;

use App\Models\Road;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRoadRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('road_create');
    }

    public function rules()
    {
        return [
            'division_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
                'unique:roads',
            ],
            'address' => [
                'string',
                'nullable',
            ],
            'phone' => [
                'string',
                'nullable',
            ],
            'image' => [
                'array',
            ],
            'files' => [
                'array',
            ],
        ];
    }
}
