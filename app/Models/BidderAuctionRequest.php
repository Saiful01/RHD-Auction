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
        // my changes
        'auto_chalan',
        'nid_copy',
        'passport_photo',
        'trade_license',
        'tax_certificate',
        'wood_license',
        'bank_guarantee',
        'mobile_signature',
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

    // my changes
    public function getAutoChalanAttribute()
    {
        return $this->getMedia('auto_chalan');
    }

    public function getNidCopyAttribute()
    {
        return $this->getMedia('nid_copy');
    }

    public function getPassportPhotoAttribute()
    {
        return $this->getMedia('passport_photo');
    }

    public function getTradeLicenseAttribute()
    {
        return $this->getMedia('trade_license');
    }

    public function getTaxCertificateAttribute()
    {
        return $this->getMedia('tax_certificate');
    }

    public function getWoodLicenseAttribute()
    {
        return $this->getMedia('wood_license');
    }

    public function getBankGuaranteeAttribute()
    {
        return $this->getMedia('bank_guarantee');
    }

    public function getMobileSignatureAttribute()
    {
        return $this->getMedia('mobile_signature');
    }
}
