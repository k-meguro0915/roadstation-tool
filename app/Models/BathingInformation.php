<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BathingInformation extends Model
{
    use HasFactory;
    protected $table = 'bathing_information';
    protected $fillable = [
        'ZPX_ID',
        'UID',
        'open_air_bath',
        'sauna',
        'spring_quality'
    ];
    protected $primaryKey = ['ZPX_ID','UID'];
}
