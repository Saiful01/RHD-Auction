<?php

namespace App\Http\Requests;

use App\Models\Package;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePackageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('package_edit');
    }

    public function rules()
    {
        return [
            'road_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
            'unique_code' => [
                'string',
                'required',
                'unique:packages,unique_code,' . request()->route('package')->id,
            ],
            'images' => [
                'array',
            ],
            'files' => [
                'array',
            ],
        ];
    }
}
