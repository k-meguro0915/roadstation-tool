<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RvPark extends Model
{
    use HasFactory;
    protected $table = 'rv_parks';
    protected $fillable = [
      'SID',
      'legacy_id',
      'name',
      'introductory_sentence',
      'address',
      'remarks',
      'url',
      'latitude',
      'longitude',
      'picture',
    ];
    protected $primaryKey = ['SID,legacy_id'];
}
