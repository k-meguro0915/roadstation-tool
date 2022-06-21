<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilitiesBusinessHours extends Model
{
    use HasFactory;
    protected $table = 'facilities_business_hours';
    protected $fillable = [
        'ZPX_ID',
        'UID',
        'id',
        'start_time',
        'end_time',
        'time_supplement'
    ];
    protected $primaryKey = ['ZPX_ID','UID'];
}
