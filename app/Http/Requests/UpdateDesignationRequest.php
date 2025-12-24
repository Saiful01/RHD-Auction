<?php

namespace App\Http\Requests;

use App\Models\Designation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDesignationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('designation_edit');
    }

    public function rules()
    {
        return [
            'designation' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'designation_en' => [
                'string',
                'required',
                'unique:designations,designation_en,' . request()->route('designation')->id,
            ],
            'designation_bn' => [
                'string',
                'nullable',
            ],
        ];
    }
}
