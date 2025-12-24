<?php

namespace App\Http\Requests;

use App\Models\Lot;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLotRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('lot_edit');
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
        ];
    }
}
