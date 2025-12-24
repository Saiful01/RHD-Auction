<?php

namespace App\Http\Requests;

use App\Models\Auction;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAuctionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('auction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:auctions,id',
        ];
    }
}
