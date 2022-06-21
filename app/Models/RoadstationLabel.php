<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoadstationLabel extends Model
{
    use HasFactory;
    protected $table = 'roadstation_labels';
    protected $fillable = [
      'CID',
      'label_id'
    ];
    protected $primaryKey = 'CID';
}
