<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoadstationUrls extends Model
{
    use HasFactory;
    protected $table = 'roadstation_urls';
    protected $fillable = [
        'CID',
        'web',
        'twitter',
        'facebook',
        'instagram',
        'line',
        'other'
    ];
    protected $primaryKey = 'CID';
}
