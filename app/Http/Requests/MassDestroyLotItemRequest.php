<?php

namespace App\Http\Requests;

use App\Models\LotItem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyLotItemRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('lot_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:lot_items,id',
        ];
    }
}
