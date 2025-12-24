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

class Employee extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'employees';

    protected $appends = [
        'signature',
    ];

    public const CADRE_NAME_RADIO = [
        '1' => 'BCS R&H (Civil)',
        '2' => 'BCS R&H (Mechanical)',
    ];

    public const CHARGE_TYPE_RADIO = [
        '1' => 'Current',
        '2' => 'Regular',
        '3' => 'Additional',
    ];

    protected $dates = [
        'birth_date',
        'date_of_retirement',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const POST_TYPE_RADIO = [
        '1' => 'Revenue',
        '2' => 'Development & Deputation',
        '3' => 'Converted Regular',
    ];

    public const JOB_STATUS_RADIO = [
        '1' => 'Regular',
        '2' => 'On Deputation',
        '3' => 'Retired',
        '4' => 'Suspended',
        '5' => 'Other',
    ];

    protected $fillable = [
        'cadre_name',
        'charge_type',
        'post_type',
        'job_status',
        'office_id',
        'designation_id',
        'name_en',
        'name_bn',
        'personnel',
        'gradation',
        'grade',
        'bcs_no',
        'passing_year',
        'birth_date',
        'date_of_retirement',
        'phone_office',
        'phone_personal',
        'email_office',
        'email_personal',
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

    public function employeesAuctions()
    {
        return $this->belongsToMany(Auction::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id','designation_id');
    }

    public function getBirthDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getDateOfRetirementAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateOfRetirementAttribute($value)
    {
        $this->attributes['date_of_retirement'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getSignatureAttribute()
    {
        $file = $this->getMedia('signature')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }
}
