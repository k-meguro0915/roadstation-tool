<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AncillaryEquipments extends Model
{
    use HasFactory;
    protected $table = 'ancillary_equipments';
    protected $fillable = [
        'id','CID','equipment_id'
    ];
    protected $primaryKey = 'id';
}
