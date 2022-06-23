<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataVersion extends Model
{
    use HasFactory;
    protected $table = 'data_version';
    protected $fillable = [
      'version'
    ];
    protected $primaryKey = ['version'];
}
