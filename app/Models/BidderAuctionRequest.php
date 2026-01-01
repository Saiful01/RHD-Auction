<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BidderAuctionRequest extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    protected $appends = [
        'pay_order',
    ];

    public $table = 'bidder_auction_requests';

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
        'pay_amount',
        'is_condition_accept',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function bidder()
    {
        return $this->belongsTo(Bidder::class, 'bidder_id');
    }

    public function auction()
    {
        return $this->belongsTo(Auction::class, 'auction_id');
    }

    public function getPayOrderAttribute()
    {
        return $this->getMedia('pay_order');
    }
}
