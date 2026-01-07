<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bid extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'bids';

    public const IS_WINNER_RADIO = [
        '1' => 'Yes',
        '0' => 'NO',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const IS_CONDITION_ACCEPT_RADIO = [
        '1' => 'Yes',
        '0' => 'NO',
    ];

    public const STATUS_RADIO = [
        '1' => 'Pending',
        '2' => 'Accept',
        '3' => 'Reject',
    ];

    protected $fillable = [
        'bidder_id',
        'auction_id',
        'vat',
        'tax',
        'bid_amount',
        'total_amount',
        'is_condition_accept',
        'is_winner',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function bidder()
    {
        return $this->belongsTo(Bidder::class, 'bidder_id');
    }

    public function auction()
    {
        return $this->belongsTo(Auction::class, 'auction_id');
    }
}
