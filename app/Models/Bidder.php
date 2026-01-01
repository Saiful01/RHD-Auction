<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Bidder extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'bidders';

    protected $hidden = [
        'password',
    ];

    public const STATUS_RADIO = [
        '1' => 'Active',
        '0' => 'InActive',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'profile_image',
        'nid_file',
        'tin_file',
        'bin_file',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'nid_no',
        'tin_no',
        'bin_no',
        'details',
        'address',
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

    public function bidderBidderAuctionRequests()
    {
        return $this->hasMany(BidderAuctionRequest::class, 'bidder_id', 'id');
    }

    public function bidderBids()
    {
        return $this->hasMany(Bid::class, 'bidder_id', 'id');
    }

    public function getProfileImageAttribute()
    {
        $file = $this->getMedia('profile_image')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getNidFileAttribute()
    {
        return $this->getMedia('nid_file')->last();
    }

    public function getTinFileAttribute()
    {
        return $this->getMedia('tin_file')->last();
    }

    public function getBinFileAttribute()
    {
        return $this->getMedia('bin_file')->last();
    }
}
