<?php

namespace App\Services;
use Illuminate\Support\Facades\Log;
use App\Models\RvPark;
use App\Models\RvRoadstation;
use Illuminate\Http\Request;

class RvParkService
{
  public function get(){
    $ret = [];
    $rv = RvPark::orderBy('SID','asc')->get();
    foreach($rv as $key => $item){
      $arr = $this->initApiArray(); //道の駅単位の初期化
      $value = $item->getAttributes();
      $arr['SID']                   = $value['SID'];
      $arr['legacy_id']             = $value['legacy_id'];
      $arr['member_cd']             = $value['member_cd'];
      $arr['spot_cd']             = $value['spot_cd'];
      $arr['name']                  = $value['name'];
      $arr['introductory_sentence'] = $value['introductory_sentence'];
      $arr['prefecture']               = $value['prefecture'];
      $arr['address']               = $value['address'];
      $arr['tel']                   = $value['tel'];
      $arr['remarks']               = $value['remarks'];
      $arr['url']                   = $value['url'];
      $arr['latitude']              = $value['latitude'];
      $arr['longitude']             = $value['longitude'];
      $ret[] = $arr;
    }
    return  $ret;
  }
  public function getTargetRoadstation(){
    $ret = [];
    $rv = RvRoadstation::orderBy('ZPX_ID','asc')->get();
    foreach($rv as $key => $item){
      // $arr = $this->initApiArray(); //道の駅単位の初期化
      $value = $item->getAttributes();
      $arr = $value['ZPX_ID'];
      $ret[] = $arr;
    }
    return  $ret;
  }
  private function initApiArray(){
    $ret = [
      'SID' => '',
      'legacy_id' => '',
      'member_cd' => '',
      'spot_cd' => '',
      'name' => '',
      'introductory_sentence' => '',
      'prefecture' => '',
      'address' => '',
      'tel' => '',
      'remarks' => '',
      'url' => '',
      'latitude' => '',
      'longitude' => '',
    ];
    return $ret;
  }
}