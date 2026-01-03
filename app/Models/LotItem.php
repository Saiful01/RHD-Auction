<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class LotItem extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'lot_items';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const UNIT_SELECT = [
        'KG'          => 'KG',
        'Piece'       => 'Piece',
        'CFT'         => 'CFT (Cubic Feet)',
        'cubic_meter' => 'Cubic Meter',
        'Maund'       => 'Maund',
        'Ton'         => 'Ton',
    ];

    protected $fillable = [
        'lot_id',
        'name',
        'tree_no',
        'dia',
        'quantity',
        'unit',
        'unit_price',
        'estimated_price',
        'item_image',
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

    public function lot()
    {
        return $this->belongsTo(Lot::class, 'lot_id');
    }
}
