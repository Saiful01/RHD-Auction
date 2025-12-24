<?php

namespace App\Http\Requests;

use App\Models\LotItem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLotItemRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('lot_item_create');
    }

    public function rules()
    {
        return [
            'lot_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
            'dia' => [
                'string',
                'nullable',
            ],
            'quantity' => [
                'numeric',
            ],
            'unit' => [
                'required',
            ],
            'estimated_price' => [
                'numeric',
            ],
        ];
    }
}
