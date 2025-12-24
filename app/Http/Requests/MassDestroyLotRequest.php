<?php

namespace App\Http\Requests;

use App\Models\Lot;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyLotRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('lot_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:lots,id',
        ];
    }
}
