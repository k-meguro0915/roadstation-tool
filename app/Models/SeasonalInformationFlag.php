<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeasonalInformationFlag extends Model
{
    use HasFactory;
    protected $table = 'seasonal_information_flags';
    protected $fillable = [
        'CID',
        'is_closed',
        'is_shutdown'
    ];
    protected $primaryKey = 'id';
}
