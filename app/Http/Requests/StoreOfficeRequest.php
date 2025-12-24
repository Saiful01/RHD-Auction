<?php

namespace App\Http\Requests;

use App\Models\Office;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOfficeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('office_create');
    }

    public function rules()
    {
        return [
            'office_type_id' => [
                'required',
                'integer',
            ],
            'office_name_en' => [
                'string',
                'nullable',
            ],
            'office_name_bn' => [
                'string',
                'nullable',
            ],
            'parent_office' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
