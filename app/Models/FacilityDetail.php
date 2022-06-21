<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityDetail extends Model
{
    use HasFactory;
    protected $table = 'facility_details';
    protected $fillable = [
        'ZPX_ID',
        'facility_category_code',
        'category_code',
        'facility_code',
        'UID',
        'name',
        'name_furi',
        'description',
        'recommendation_name',
        'recommendation_desc',
        'checkin_time',
        'checkout_time',
        'regular_holiday',
        'holiday_supplement1',
        'holiday_supplement2',
        'tel',
        'tel_supplement',
        'place',
        'price',
        'detail_link',
        'is_closed',
        'remarks'
    ];
    protected $primaryKey = ['ZPX_ID','UID'];
}
