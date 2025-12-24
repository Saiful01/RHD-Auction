<?php

namespace App\Http\Requests;

use App\Models\OfficeType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOfficeTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('office_type_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:office_types',
            ],
            'name_bn' => [
                'string',
                'nullable',
            ],
        ];
    }
}
