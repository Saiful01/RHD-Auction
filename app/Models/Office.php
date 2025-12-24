<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Office extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'offices';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const OFFICE_CAT_RADIO = [
        '1' => 'HQ',
        '2' => 'Field',
        '3' => 'Project',
    ];

    protected $fillable = [
        'office_type_id',
        'office_name_en',
        'office_name_bn',
        'office_cat',
        'parent_office',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function officeEmployees()
    {
        return $this->hasMany(Employee::class, 'office_id', 'id');
    }

    public function office_type()
    {
        return $this->belongsTo(OfficeType::class, 'office_type_id');
    }
}
