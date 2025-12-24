<?php

namespace App\Http\Requests;

use App\Models\Division;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDivisionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('division_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:divisions',
            ],
        ];
    }
}
