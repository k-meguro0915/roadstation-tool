<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoadstationContact extends Model
{
    use HasFactory;
    protected $table = 'roadstation_contacts';
    protected $fillable = [
      'CID',
      'contact_address',
      'postal_code',
      'address',
      'tel',
      'fax',
      'manager',
      'mail',
      'remarks'
    ];
    protected $primaryKey = 'CID';
}
