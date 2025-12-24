<?php

namespace App\Http\Requests;

use App\Models\Auction;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAuctionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('auction_create');
    }

    public function rules()
    {
        return [
            'financial_year_id' => [
                'required',
                'integer',
            ],
            'road_id' => [
                'required',
                'integer',
            ],
            'lots.*' => [
                'integer',
            ],
            'lots' => [
                'required',
                'array',
            ],
            'memo_no' => [
                'string',
                'required',
                'unique:auctions',
            ],
            'announcement_no' => [
                'string',
                'required',
            ],
            'name' => [
                'required',
            ],
            'auction_start_time' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'auction_end_time' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'tender_visible_start_date' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'tender_visible_end_date' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'tender_sale_start_date' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'tender_sale_end_date' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'deadline_for_tree_removal' => [
                'string',
                'nullable',
            ],
            'estimate_value_percentage' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'base_value_amount' => [
                'numeric',
                'required',
            ],
            'vat' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'tax' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'employees.*' => [
                'integer',
            ],
            'employees' => [
                'array',
            ],
        ];
    }
}
