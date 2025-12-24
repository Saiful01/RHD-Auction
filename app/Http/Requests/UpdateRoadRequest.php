<?php

namespace App\Http\Requests;

use App\Models\Road;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRoadRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('road_edit');
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
                'unique:roads,name,' . request()->route('road')->id,
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
