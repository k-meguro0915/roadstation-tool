<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantInformation extends Model
{
    use HasFactory;
    protected $table = 'restaurant_information';
    protected $fillable = [
        'ZPX_ID',
        'UID',
        'japanese_food',
        'western_food',
        'chinese_food',
        'sweets',
        'bar',
        'eat_in',
        'take_out',
        'buffet'
    ];
    protected $primaryKey = ['ZPX_ID','UID'];
}
