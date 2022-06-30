<?php

namespace App\Services;
use Illuminate\Support\Facades\Log;
use App\Models\Roadstation;
use App\Models\FacilityDetail;
use App\Models\FacilityPayment;
use App\Models\BathingInformation;
use App\Models\FacilityEvent;
use App\Models\RestaurantInformation;
use App\Models\FacilitiesBusinessHours;
use Illuminate\Support\Facades\DB;
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
    $ret['event'] = FacilityEvent::where([['UID','=',$uid],['is_delete','=','0']])->get('contents');
    $ret['restaurant'] = RestaurantInformation::where([['UID','=',$uid],['is_delete','=','0']])->get();
    $ret['businesshours'] = FacilitiesBusinessHours::where([['UID','=',$uid],['is_delete','=','0']])->get();
    $tmp = [];
    foreach($ret['businesshours'] as $key => $item){
      $tmp[] = $item->getAttributes();
    }
    $ret['businesshours'] = $tmp;
    $tmp = [];
    foreach($ret['event'] as $key => $item){
      $tmp[] = $item->getAttributes()['contents'];
    }
    $ret['event'] = $tmp;
    return $ret;
  }
  // 道の駅登録
  // 各メソッドでupdateOrCreateが試せるかを再思考
  public function store($request) {
    DB::beginTransaction();
    try{
      $facility = $request->facility;
      $this->createRelationTable(new FacilityDetail,$facility);
      $zpx_id = $facility['ZPX_ID'];
      $uid = $facility['UID'];
      if(!empty($request->spring)){
        $spring = $request->spring;
        $spring['ZPX_ID'] = $zpx_id;
        $spring['UID'] = $uid;
        $this->createRelationTable(new BathingInformation,$spring);
      }
      if(!empty($request->restaurant)){
        $restaurant = $request->restaurant;
        $restaurant['ZPX_ID'] = $zpx_id;
        $restaurant['UID'] = $uid;
        $this->createRelationTable(new RestaurantInformation,$restaurant);
      }
      if(!empty($request->payment)){
        $payment = $request->payment;
        $payment['ZPX_ID'] = $zpx_id;
        $payment['UID'] = $uid;
        // dd($payment);
        $this->createRelationTable(new FacilityPayment,$payment);
      }
      if(!empty($request->business_info)){
        $business_info = $request->business_info;
        $cnt = 0;
        foreach($business_info as $key => $item){
          if(empty($item['start_time'])) continue;
          $item['id'] = $cnt;
          $item['ZPX_ID'] = $zpx_id;
          $item['UID'] = $uid;
          $this->createRelationTable(new FacilitiesBusinessHours,$item,['ZPX_ID','UID','id']);
          $cnt++;
        }
      }
      if(!empty($request->event)){
        $event = $request->event;
        $cnt = 0;
        $arr = [];
        foreach($event as $key => $item){
          if(empty($item)) continue;
          $arr['id'] = $cnt;
          $arr['ZPX_ID'] = $zpx_id;
          $arr['UID'] = $uid;
          $arr['contents'] = $item;
          $this->createRelationTable(new FacilityEvent,$arr,['ZPX_ID','UID','id']);
          $cnt++;
        }
      }
      DB::commit();
    } catch (\Exception $e) {
      DB::rollback();
      return false;
    }
    return true;
  }
  
  private function createRelationTable($model,$record,$collation=['ZPX_ID','UID']){
    $model->upsert( $record,$collation );
  }
  public function checkRoadStation($uid){
    $zpx_id = FacilityDetail::where([['UID','=',$uid]])->get('ZPX_ID')[0]->getAttributes()['ZPX_ID'];
    return Roadstation::where([['ZPX_ID','=',$zpx_id],['is_delete','=','1']])->count();
  }
  // 道の駅更新
  public function changeDeleteFlg($uid,$flg){
    DB::beginTransaction();
    try{
      FacilityDetail::where([['UID','=',$uid]])->update(['is_delete'=>$flg]);
      BathingInformation::where([['UID','=',$uid]])->update(['is_delete'=>$flg]);
      RestaurantInformation::where([['UID','=',$uid]])->update(['is_delete'=>$flg]);
      FacilityPayment::where([['UID','=',$uid]])->update(['is_delete'=>$flg]);
      FacilitiesBusinessHours::where([['UID','=',$uid]])->update(['is_delete'=>$flg]);
      DB::commit();
    } catch (\Exception $e) {
      DB::rollback();
      return false;
    }
    return true;
  }
}