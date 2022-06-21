<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoadstationBusinessHour extends Model
{
    use HasFactory;
    protected $table = 'roadstation_business_hours';
    protected $fillable = [
        'id',
        'CID',
        'start_time',
        'end_time',
        'time_supplement1',
        'time_supplement2',
        'regular_holiday',
        'holiday_supplement1',
        'holiday_supplement2',
        'holiday_sightseeing_code',
        'time_sightseeing_code'
    ];
    protected $primaryKey = 'id';
}
