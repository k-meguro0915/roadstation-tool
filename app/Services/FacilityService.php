<?php

namespace App\Services;
use Illuminate\Support\Facades\Log;
use App\Models\FacilityDetail;
use App\Models\FacilityPayment;
use App\Models\BathingInformation;
use App\Models\FacilityEvent;
use App\Models\RestaurantInformation;
use App\Models\FacilitiesBusinessHours;
use Illuminate\Http\Request;

class FacilityService
{
  // 道の駅を全取得
  public function all(){
    // Userのmodelクラスのインスタンスを生成
    return FacilityDetail::where('is_delete','0')->orderBy('ZPX_ID','asc')->get();
  }
  // 道の駅を全取得（ページネーション）
  public function get(){
    // Userのmodelクラスのインスタンスを生成
    return FacilityDetail::where('is_delete','0')->orderBy('ZPX_ID','asc')->paginate(15);
  }
  public function deletedList(){
    return FacilityDetail::where('is_delete',1)->orderBy('ZPX_ID','asc')->paginate(15);
  }
  public function count(){
    // Userのmodelクラスのインスタンスを生成
    return FacilityDetail::where('is_delete','0')->count();
  }
  // 道の駅取得（ID指定）
  // リストの時点で削除フラグは非表示なので、こちらではフラグ検索はしない
  public function where($cid){
    return FacilityDetail::where('CID',$cid)->get();
  }
  public function edit($cid){
  }
  public function show($uid){
    $ret = array();
    // 各情報を持ってくる
    $ret['facility'] = FacilityDetail::where([['UID','=',$uid],['is_delete','=','0']])->get();
    $ret['payment'] = FacilityPayment::where([['UID','=',$uid],['is_delete','=','0']])->get();
    $ret['bathing'] = BathingInformation::where([['UID','=',$uid],['is_delete','=','0']])->get();
    // $ret['event'] = FacilityEvent::where([['UID','=',$uid],['is_delete','=','0']])->get();
    $ret['restaurant'] = RestaurantInformation::where([['UID','=',$uid],['is_delete','=','0']])->get();
    $ret['businesshours'] = FacilitiesBusinessHours::where([['UID','=',$uid],['is_delete','=','0']])->get();
    return $ret;
  }
  // 道の駅登録
  // 各メソッドでupdateOrCreateが試せるかを再思考
  public function store($request) {
    
  }
  // 道の駅更新
  public function update($request){
  }
  public function delete($cid){
    return true;
  }
}