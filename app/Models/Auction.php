<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Auction extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'auctions';

    protected $dates = [
        'auction_start_time',
        'auction_end_time',
        'tender_visible_start_date',
        'tender_visible_end_date',
        'tender_sale_start_date',
        'tender_sale_end_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'financial_year_id',
        'road_id',
        'package_id',
        'memo_no',
        'announcement_no',
        'name',
        'details',
        'auction_start_time',
        'auction_end_time',
        'tender_visible_start_date',
        'tender_visible_end_date',
        'tender_sale_start_date',
        'tender_sale_end_date',
        'deadline_for_tree_removal',
        'bidder_criteria',
        'required_document',
        'note',
        'estimate_value_percentage',
        'base_value_amount',
        'min_bid_amount',
        'vat',
        'tax',
        'bid_entity',
        'contract_person',
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

    public function financial_year()
    {
        return $this->belongsTo(FinancialYear::class, 'financial_year_id');
    }

    public function road()
    {
        return $this->belongsTo(Road::class, 'road_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function lots()
    {
        return $this->belongsToMany(Lot::class);
    }

    public function totalLotItemsCount()
    {
        return $this->lots->sum(fn($lot) => $lot->lotLotItems->count());
    }

    public function getAuctionStartTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setAuctionStartTimeAttribute($value)
    {
        $this->attributes['auction_start_time'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getAuctionEndTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setAuctionEndTimeAttribute($value)
    {
        $this->attributes['auction_end_time'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getTenderVisibleStartDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setTenderVisibleStartDateAttribute($value)
    {
        $this->attributes['tender_visible_start_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getTenderVisibleEndDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setTenderVisibleEndDateAttribute($value)
    {
        $this->attributes['tender_visible_end_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getTenderSaleStartDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setTenderSaleStartDateAttribute($value)
    {
        $this->attributes['tender_sale_start_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getTenderSaleEndDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setTenderSaleEndDateAttribute($value)
    {
        $this->attributes['tender_sale_end_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }

    public function bidEntityEmployee()
    {
        return $this->belongsTo(Employee::class, 'bid_entity');
    }
    public function contractPersonEmployee()
    {
        return $this->belongsTo(Employee::class, 'contract_person');
    }
}
