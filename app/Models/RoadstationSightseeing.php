<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoadstationSightseeing extends Model
{
    use HasFactory;
    protected $table = 'roadstation_sightseeings';
    protected $fillable = [
        'id',
        'CID',
        'name'
    ];
    protected $primaryKey = 'id';
}
