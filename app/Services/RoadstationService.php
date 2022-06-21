<?php

namespace App\Services;
use Illuminate\Support\Facades\Log;
use App\Models\Roadstation;
use App\Models\RoadstationAddress;
use App\Models\RoadstationBusinessHour;
use App\Models\RoadstationBusinessStampInformation;
use App\Models\RoadstationEval;
use App\Models\RoadstationParking;
use App\Models\RoadstationSightseeing;
use App\Models\RoadstationUrls;
use App\Models\LocationRoad;
use App\Models\FacilityDetail;
use App\Models\AncillaryEquipments;
use App\Models\IncidentalFacility;
use App\Models\SeasonalInformation;
use App\Models\SeasonalInformationFlag;
use Illuminate\Http\Request;

class RoadstationService
{
  // 道の駅を全取得
  public function all(){
    // Userのmodelクラスのインスタンスを生成
    return Roadstation::orderBy('CID','asc')->get();
  }
  // 道の駅取得（ページネーション付き）
  public function get(){
    // Userのmodelクラスのインスタンスを生成
    return Roadstation::orderBy('CID','asc')->paginate(15);
  }
  public function count(){
    // Userのmodelクラスのインスタンスを生成
    return Roadstation::count();
  }
  // 道の駅取得（ID指定）
  public function where($cid){
    return Roadstation::where('CID',$cid)->get();
  }
  public function detail($zpx_id){
    $ret['roadstation'] = Roadstation::where('ZPX_ID',$zpx_id)->get();
    $ret['address'] = RoadstationAddress::where('ZPX_ID',$zpx_id)->get();
    $ret['localroad'] = LocationRoad::where('ZPX_ID',$zpx_id)->get();
    $ret['event'] = SeasonalInformation::where('ZPX_ID',$zpx_id)->get();
    $ret['eventFlag'] = SeasonalInformationFlag::where('ZPX_ID',$zpx_id)->get();
    $ret['basic'] = RoadstationBusinessHour::where('ZPX_ID',$zpx_id)->get();
    $ret['parking'] = RoadstationParking::where('ZPX_ID',$zpx_id)->get();
    $ret['stamp'] = RoadstationBusinessStampInformation::where('ZPX_ID',$zpx_id)->get();
    $ret['urls'] = RoadstationUrls::where('ZPX_ID',$zpx_id)->get();
  }
  public function edit($cid){
    $ret = array();
    // 各情報を持ってくる
    $ret['roadstation'] = Roadstation::where('CID',$cid)->get();
    $ret['address'] = RoadstationAddress::where('CID',$cid)->get();
    $ret['localroad'] = LocationRoad::where('CID',$cid)->get();
    $ret['event'] = SeasonalInformation::where('CID',$cid)->get();
    $ret['eventFlag'] = SeasonalInformationFlag::where('CID',$cid)->get();
    $ret['basic'] = RoadstationBusinessHour::where('CID',$cid)->get();
    $ret['parking'] = RoadstationParking::where('CID',$cid)->get();
    $ret['stamp'] = RoadstationBusinessStampInformation::where('CID',$cid)->get();
    $ret['urls'] = RoadstationUrls::where('CID',$cid)->get();
    return $ret;
  }
  public function show($zpx_id){
    $ret = array();
    // 各情報を持ってくる
    $ret['roadstation'] = Roadstation::where('ZPX_ID',$zpx_id)->get();
    $cid = $ret['roadstation'][0]->CID;
    $ret['address'] = RoadstationAddress::where('cid',$cid)->get();
    $ret['localroad'] = LocationRoad::where('cid',$cid)->get();
    $ret['event'] = SeasonalInformation::where('cid',$cid)->get();
    $ret['eventFlag'] = SeasonalInformationFlag::where('cid',$cid)->get();
    $ret['business_hour'] = RoadstationBusinessHour::where('cid',$cid)->get();
    $ret['parking'] = RoadstationParking::where('cid',$cid)->get();
    $ret['stamp'] = RoadstationBusinessStampInformation::where('cid',$cid)->get();
    $ret['urls'] = RoadstationUrls::where('cid',$cid)->get();
    $ret['sightseeing'] = RoadstationSightseeing::where('cid',$cid)->get(['name']);
    $ret['equipments'] = AncillaryEquipments::where('cid',$cid)->get();
    $ret['facilities'] = FacilityDetail::where('ZPX_ID',$zpx_id)->get();
    return $ret;
  }
  // 道の駅登録
  // 各メソッドでupdateOrCreateが試せるかを再思考
  public function store($request) {
    // 各テーブルに使うデータの整形
    $data = $request->all();
    $roadstation  = isset($data['roadstation']) ? $data['roadstation'] : '';
    $address      = isset($data['address']) ? $data['address'] : '';
    $local_road   = isset($data['localroad']) ? $data['localroad'] : '';
    $event        = isset($data['event']) ? $data['event'] : '';
    $eventFlg     = isset($data['eventFlag']) ? $data['eventFlag'] : '';
    $facility     = isset($data['facility']) ? $data['facility'] : '';
    $equipment    = isset($data['service']) ? $data['service'] : '';
    $basic        = isset($data['basic']) ? $data['basic'] : '';
    $parking      = isset($data['parking']) ? $data['parking'] : '';
    $stamp        = isset($data['stamp']) ? $data['stamp'] : '';
    $urls         = isset($data['urls']) ? $data['urls'] : '';
    // Log::debug($facility);
    // 道の駅メインのテーブルにデータを取得し、返却されたデータからCIDを抜き出す。
    if($roadstation != '') $inserted_station = $this->createRoadStation($roadstation);
    $cid = $inserted_station['CID'];
    // // 抜き出したCIDを元に各リレーションレコードを作成する
    if($local_road != '') $this->createRelationRoadStation(new RoadstationAddress() ,$cid, $address);
    if($basic != '') $this->createRelationRoadStation(new RoadstationBusinessHour() ,$cid, $basic);
    if($stamp != '') $this->createRelationRoadStation(new RoadstationBusinessStampInformation() ,$cid, $stamp);
    // $this->createRelationRoadStation(new RoadstationEval() ,$cid, $local_road);
    if($parking != '') $this->createRelationRoadStation(new RoadstationParking() ,$cid, $parking);
    // $this->createRelationRoadStation(new RoadstationSightseeing() ,$cid, $local_road);
    if($urls != '') $this->createRelationRoadStation(new RoadstationUrls() ,$cid, $urls);
    if($local_road != '') $this->createRelationRoadStation(new LocationRoad() ,$cid, $local_road);
    // $this->createRelationRoadStation(new FacilitiesDetail() ,$cid, $local_road);
    if($event != '') $this->createSeasonalInformation(new SeasonalInformation() ,$cid, $event);
    if($eventFlg != '') $this->createRelationRoadStation(new SeasonalInformationFlag() ,$cid, $eventFlg);
    // // 特殊な処理を行うレコードは個別の処理
    if($equipment != '') $this->createAncillaryEquipments($cid, $equipment);
    if($facility != '') $this->createIncidentalFacility($cid, $facility);
  }
  // 道の駅更新
  public function update($request){
    // 各テーブルに使うデータの整形
    $data = $request->all();
    $roadstation  = $data['roadstation'];
    $this->updateRoadStation($roadstation);
  }
  // 道の駅基本情報の更新
  private function updateRoadStation($record){
    $model = new Roadstation();
    $inserted_station = $model->where('CID',$record['CID'])
                              ->update( $record ); 
    return $inserted_station;
  }
  // 道の駅基本情報の登録
  private function createRoadStation($record){
    $model = new Roadstation();
    $inserted_station = $model->create( $record );
    return $inserted_station;
  }
  // 道の駅関連情報の登録
  private function createRelationRoadStation($model,$cid,$record){
    $record = array_merge( $record,array('CID' => $cid) );
    $model->create( $record );
  }
  // 旬の情報登録
  // 配列[0]～[2]の3つあり、再帰処理で登録
  private function createSeasonalInformation($model,$cid,$record){
    for($cnt = 1;$cnt <= 3;$cnt++){
      $data = array('CID' => $cid);
      $data = array_merge($data,array("title" => $record['title' . $cnt]));
      $data = array_merge($data,array("content" => $record['content' . $cnt]));
      $data = array_merge($data,array("start_time" => $record['start_time' . $cnt]));
      $data = array_merge($data,array("end_time" => $record['end_time' . $cnt]));
      Log::debug($data);
      $model->create( $data );
    }
    return true;
  }
  // 道の駅設備情報の登録
  private function createAncillaryEquipments($cid,$record){
    $model = new AncillaryEquipments();
    $equipments = array('equipment_id' => implode($record));
    $equipments = array_merge($equipments,array('CID' => $cid));
    $model->create( $equipments );
    return true;
  }
  // 道の駅施設情報の登録
  private function createIncidentalFacility($cid,$record){
    $model = new FacilityDetail();
    foreach($record as $key => $value){
      $data = $value;
      $data = array_merge($data,array('CID' => $cid));
      $model->create( $data );
    }
    return true;
  }
  public function delete($cid){
    Roadstation::where('CID',$cid)->delete();
    RoadstationAddress::where('CID',$cid)->delete();
    RoadstationBusinessHour::where('CID',$cid)->delete();
    RoadstationBusinessStampInformation::where('CID',$cid)->delete();
    RoadstationEval::where('CID',$cid)->delete();
    RoadstationParking::where('CID',$cid)->delete();
    RoadstationSightseeing::where('CID',$cid)->delete();
    RoadstationUrls::where('CID',$cid)->delete();
    LocationRoad::where('CID',$cid)->delete();
    FacilityDetail::where('CID',$cid)->delete();
    AncillaryEquipments::where('CID',$cid)->delete();
    IncidentalFacility::where('CID',$cid)->delete();
    SeasonalInformation::where('CID',$cid)->delete();
    SeasonalInformationFlag::where('CID',$cid)->delete();
    return true;
  }
}