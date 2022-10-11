<?php

namespace App\Services;
use Illuminate\Support\Facades\Log;
use App\Models\RvPark;
use Illuminate\Http\Request;

class RvParkService
{
  public function get(){
    $ret = RvPark::all()[0]->getAttributes();
    return  $ret;
  }
}