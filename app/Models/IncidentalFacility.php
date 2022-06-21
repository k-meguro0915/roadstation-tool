<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentalFacility extends Model
{
    use HasFactory;
    protected $table = 'incidental_facilities';
    protected $fillable = [
        'CID',
        'facility_id',
    ];
    protected $primaryKey = ['CID','facility_id'];
}
