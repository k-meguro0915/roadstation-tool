<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationRoad extends Model
{
    use HasFactory;
    protected $table = 'location_roads';
    protected $fillable = [
        'CID',
        'location_road_id',
        'location_road_type',
        'road_number',
        'road_name'
    ];
    protected $primaryKey = 'CID';
}
