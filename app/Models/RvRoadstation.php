<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RvRoadstation extends Model
{
    use HasFactory;
    protected $table = 'rv_roadstations';
    protected $fillable = [
      'ZPX_ID',
    ];
    protected $primaryKey = ['ZPX_ID'];
}
