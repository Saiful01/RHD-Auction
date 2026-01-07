<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BidderBidItem extends Model
{
    // bidder bid item
    protected $fillable = [
        'bid_id',
        'bidder_id',
        'lot_item_id',
        'unit_price'
    ];

    public function bid()
    {
        return $this->belongsTo(Bid::class);
    }

    public function bidder()
    {
        return $this->belongsTo(Bidder::class);
    }

    public function lotItem()
    {
        return $this->belongsTo(LotItem::class, 'lot_item_id');
    }
}
