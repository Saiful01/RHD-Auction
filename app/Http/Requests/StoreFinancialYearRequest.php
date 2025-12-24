<?php

namespace App\Http\Requests;

use App\Models\FinancialYear;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFinancialYearRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('financial_year_create');
    }

    public function rules()
    {
        return [
            'year' => [
                'string',
                'required',
                'unique:financial_years',
            ],
            'start_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'end_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
