<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeasonalInformation extends Model
{
    use HasFactory;
    protected $table = 'seasonal_information';
    protected $fillable = [
        'CID',
        'title',
        'content',
        'start_time',
        'end_time'
    ];
    protected $primaryKey = 'id';
}
