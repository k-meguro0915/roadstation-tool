<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roadstation extends Model
{
    use HasFactory;
    protected $table = 'roadstations';
    protected $fillable = [
        'ZPX_ID',
        'CID',
        'name',
        'name_furi',
        'thumbnail',
        'registry_year',
        'catch_copy',
        'introduction'
    ];
    protected $primaryKey = 'ZPX_ID';
}
