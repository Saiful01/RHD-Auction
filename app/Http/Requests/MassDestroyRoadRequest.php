<?php

namespace App\Http\Requests;

use App\Models\Road;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRoadRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('road_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:roads,id',
        ];
    }
}
