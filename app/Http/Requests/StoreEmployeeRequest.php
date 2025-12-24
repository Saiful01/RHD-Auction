<?php

namespace App\Http\Requests;

use App\Models\Employee;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('employee_create');
    }

    public function rules()
    {
        return [
            'office_id' => [
                'required',
                'integer',
            ],
            'designation_id' => [
                'required',
                'integer',
            ],
            'name_en' => [
                'string',
                'required',
            ],
            'name_bn' => [
                'string',
                'nullable',
            ],
            'personnel' => [
                'string',
                'required',
                'unique:employees',
            ],
            'gradation' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'grade' => [
                'string',
                'nullable',
            ],
            'bcs_no' => [
                'string',
                'nullable',
            ],
            'passing_year' => [
                'string',
                'nullable',
            ],
            'birth_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'date_of_retirement' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'phone_office' => [
                'string',
                'nullable',
            ],
            'phone_personal' => [
                'string',
                'nullable',
            ],
        ];
    }
}
