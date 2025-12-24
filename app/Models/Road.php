<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Road extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'roads';

    protected $appends = [
        'image',
        'files',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'division_id',
        'name',
        'details',
        'address',
        'email',
        'phone',
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

    public function roadPackages()
    {
        return $this->hasMany(Package::class, 'road_id', 'id');
    }

    public function roadLots()
    {
        return $this->hasMany(Lot::class, 'road_id', 'id');
    }

    public function roadAuctions()
    {
        return $this->hasMany(Auction::class, 'road_id', 'id');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function getImageAttribute()
    {
        return $this->getMedia('image');
    }

    public function getFilesAttribute()
    {
        return $this->getMedia('files');
    }
}
