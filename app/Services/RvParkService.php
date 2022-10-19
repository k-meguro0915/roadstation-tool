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
      $arr['SID']                   = !empty($value['SID']) ? $value['SID'] : '';
      $arr['legacy_id']             = !empty($value['legacy_id']) ? $value['legacy_id'] : '';
      $arr['member_cd']             = !empty($value['member_cd']) ? strval($value['member_cd']) : '';
      $arr['spot_cd']               = !empty($value['spot_cd']) ? $value['spot_cd'] : '';
      $arr['name']                  = !empty($value['name']) ? $value['name'] : '';
      $arr['introductory_sentence'] = !empty($value['introductory_sentence']) ? $value['introductory_sentence'] : '';
      $arr['prefecture']            = !empty($value['prefecture']) ? $value['prefecture'] : '';
      $arr['address']               = !empty($value['address']) ? $value['address'] : '';
      $arr['tel']                   = !empty($value['tel']) ? $value['tel'] : '';
      $arr['remarks']               = !empty($value['remarks']) ? $value['remarks'] : '';
      $arr['url']                   = !empty($value['url']) ? $value['url'] : '';
      $arr['latitude']              = !empty($value['latitude']) ? $value['latitude'] : '';
      $arr['longitude']             = !empty($value['longitude']) ? $value['longitude'] : '';
      $arr['picture']             = !empty($value['picture']) ? $value['picture'] : '';
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
      'picture' => '',
    ];
    return $ret;
  }
}