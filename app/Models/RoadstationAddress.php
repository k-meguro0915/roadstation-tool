<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoadstationAddress extends Model
{
    use HasFactory;
    protected $table = 'roadstation_addresses';
    protected $fillable = [
        'CID',
        'postal_code',
        'prefecture',
        'local_address',
        'prefecture_code',
        'address_code',
        'latitude_x',
        'latitude_y',
        'map_code',
        'tel',
        'elebation'
    ];
    protected $primaryKey = 'CID';
}
