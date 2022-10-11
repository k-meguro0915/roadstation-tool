<?php

namespace App\Services;
use Illuminate\Support\Facades\Log;
use App\Models\RvPark;
use Illuminate\Http\Request;

class RvParkService
{
  public function get(){
    return RvPark::orderBy('SID','asc')->get();
    return  $ret;
  }
}