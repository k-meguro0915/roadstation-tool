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
      'member_cd',
      'spot_cd',
      'name',
      'introductory_sentence',
      'prefecture',
      'address',
      'remarks',
      'tel',
      'url',
      'latitude',
      'longitude',
      'picture',
    ];
    protected $primaryKey = ['SID,legacy_id'];
}
