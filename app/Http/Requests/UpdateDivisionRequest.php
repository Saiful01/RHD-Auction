<?php

namespace App\Http\Requests;

use App\Models\Division;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDivisionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('division_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:divisions,name,' . request()->route('division')->id,
            ],
        ];
    }
}
