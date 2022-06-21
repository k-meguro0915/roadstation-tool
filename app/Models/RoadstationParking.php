<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoadstationParking extends Model
{
    use HasFactory;
    protected $table = 'roadstation_parkings';
    protected $fillable = [
        'id',
        'CID',
        'learge_parking_number',
        'middle_parking_number',
        'disabilities_parking_number'
    ];
    protected $primaryKey = 'id';
}
