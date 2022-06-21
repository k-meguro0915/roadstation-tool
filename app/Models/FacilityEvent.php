<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityEvent extends Model
{
    use HasFactory;
    protected $table = 'facility_events';
    protected $fillable = [
        'ZPX_ID',
        'UID',
        'id',
        'information'
    ];
    protected $primaryKey = ['ZPX_ID','UID'];
}
