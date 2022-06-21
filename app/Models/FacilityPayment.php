<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityPayment extends Model
{
    use HasFactory;
    protected $table = 'facility_payments';
    protected $fillable = [
        'ZPX_ID',
        'UID',
        'is_pay_to_credit',
        'is_pay_to_e_money',
        'is_pay_to_barcode',
        'is_pay_to_other'
    ];
    protected $primaryKey = ['ZPX_ID','UID'];
}
