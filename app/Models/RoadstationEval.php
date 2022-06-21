<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoadstationEval extends Model
{
    use HasFactory;
    protected $table = 'roadstation_evals';
    protected $fillable = [
        'CID',
        'eval_index',
        'eval_comment'
    ];
    protected $primaryKey = 'CID';
}
