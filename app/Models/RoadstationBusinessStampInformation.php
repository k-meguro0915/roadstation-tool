<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoadstationBusinessStampInformation extends Model
{
    use HasFactory;
    protected $table = 'roadstation_business_stamp_information';
    protected $fillable = [
        'id',
        'CID',
        'installation_location',
        'start_time',
        'end_time'
    ];
    protected $primaryKey = ['CID','id'];
}
