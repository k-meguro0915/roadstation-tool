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
use App\Models\MstEquipments;
use App\Models\MstFacility;
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
  public function apiGet(){
    $ret = [];
    $roadstation = Roadstation::orderBy('ZPX_ID','asc')->get();
    foreach($roadstation as $key => $item){
      $arr = $this->initApiArray();
      $value = $item->getAttributes();
      $arr["ID"] = $value['ZPX_ID'];
      $arr["RoadStationName"] = $value['name'];
      $arr["RoadStationNumber"] = intval(substr($value['ZPX_ID'],strpos($value['ZPX_ID'],'-')+1));
      $arr["RoadStationNameKana"] = $value['name_furi'];
      $arr["RoadStationGuide"] = $value['introduction'];
      $arr["CatchCopy"] = $value['catch_copy'];
      $arr["PhotoUrl"] = $value['thumbnail'];
      $arr["RegistryYear"] = $value['registry_year'];
      $prefecture_id = intval(substr($value['ZPX_ID'],0,strpos($value['ZPX_ID'],'-')));
      $arr["PrefectureCD"] = $prefecture_id;
      $arr["PrefectureID"] = $prefecture_id;
      $address = RoadstationAddress::where('CID',$value['CID'])->get();
      $address = $address[0];
      $arr["Area"] = $address['prefecture'];
      $arr["Latitude"] = $address['latitude_x'];
      $arr["Longitude"] = $address['latitude_y'];
      $arr["MapCode"] = $address['map_code'];
      $arr["PrefectureNameCD"] = $address['prefecture'];
      $arr["PhoneNumber"] = $address['tel'];
      $arr["Elebation"] = $address['elebation'];
      $arr['RoadStationAddress'] = $address['prefecture'] . $address['local_address'];
      $urls = RoadstationUrls::where('CID',$value['CID'])->get();
      $urls = $urls[0];
      $arr["Twitter"] = $urls['twitter'];
      $arr["Facebook"] = $urls['facebook'];
      $arr["Instagram"] = $urls['instagram'];
      $arr["HomePage"] = $urls['web'];
      $parking = RoadstationUrls::where('CID',$value['CID'])->get();
      $parking = $parking[0];
      $arr["LargeParkingLot"] = $urls['learge_parking_number'];
      $arr["ParkingLotHandicap"] = $urls['disabilities_parking_number'];
      $arr["ParkingLotNormalNumber"] = $urls['middle_parking_number'];
      $business_hour = RoadstationBusinessHour::where('CID',$value['CID'])->get();
      if(!empty($business_hour[0])){
        $business_hour = $business_hour[0];
        $arr["BusinessHours"] = $business_hour['start_time'] . '～' . $business_hour['end_time'];
        $arr["BusinessHoursInformation"] = $business_hour['time_sightseeing_code'];
        $arr["Holiday"] = $business_hour['regular_holiday'];
      }
      $stamp = RoadstationBusinessStampInformation::where('CID',$value['CID'])->get();
      if(!empty($stamp[0])){
        $stamp = $stamp[0]->getAttributes();
        $arr['StampContent'] = $stamp['installation_location'];
      }
      $local_road = LocationRoad::where('CID',$value['CID'])->get();
      $cnt_highway = 1;
      $cnt_majorway = 1;
      foreach($local_road as $key => $item){
        if($item['location_road_type'] == '1'){
          $arr["NationalHighWay".$cnt_highway] = $item['road_number'];
          $cnt_highway++;
        } else if($item['location_road_type'] == '2'){
          $arr["MajorPrefecturalRoad".$cnt_majorway] = $item['road_number'];
          $cnt_majorway++;
        }
      }
      $equipment = AncillaryEquipments::where('CID',$value['CID'])->get();
      $arr_equipment = [];
      foreach($equipment as $key => $item){
        $arr['RegularParkingLotWithOrWithoutWirelessLAN'] = $item['equipment_id'] == '3' ? true : false;
        $arr['Laundry'] = $item['equipment_id'] == '2' ? true : false;
        $arr_equipment[] = MstEquipments::where('id',$item['equipment_id'])->get('name')[0]->getAttributes()['name'];
      }
      $mst_facility = MstFacility::all();
      $facility = FacilityDetail::where('ZPX_ID',$item['ZPX_ID'])->get();
      $arr_facility = [];
      if(0 < $facility->count()){
        foreach($facility as $key => $item){
          $item = $item->getAttributes();
          $arr_facility[] = MstFacility::where('id',$tmp['facility_code'])->get('name')[0]->getAttributes()['name'];
          // dd($arr_facility);
        }
      }
      $arr['Facility'] = [
        '施設種別' => implode('、',$arr_facility),
        'サービス種別' => implode('、',$arr_equipment)
      ];
      $sightseeing = RoadstationSightseeing::where('CID',$value['CID'])->get();
      $arr_sight = [];
      foreach($sightseeing as $key => $item){
        $arr_sight[] = $item['name'];
      }
      $arr['TouristFacility'] = implode('、',$arr_sight);
      $ret[] = $arr;
    }
    return $ret;
  }
  private function initApiArray(){
    $ret = [
      'Area' => 'N/A',
      'ID' => 'N/A',
      'Latitude' => 'N/A',
      'Longitude' => 'N/A',
      'MapCode' => 'N/A',
      'PrefectureNameCD' => 'N/A',
      'PrefectureCD' => 'N/A',
      'PrefectureID' => 'N/A',
      'RoadStationAddress' => 'N/A',
      'RoadStationName' => 'N/A',
      'RoadStationNumber' => 'N/A',
      'RoadStationGuide' => 'N/A',
      'Twitter' => 'N/A',
      'Facebook' => 'N/A',
      'Instagram' => 'N/A',
      'HomePage' => 'N/A',
      'BusinessHours' => 'N/A',
      'LargeParkingLot' => 'N/A',
      'ParkingLotHandicap' => 'N/A',
      'ParkingLotNormalNumber' => 'N/A',
      'RegularParkingLotWithOrWithoutWirelessLAN' => 'N/A',
      'TouristFacility' => 'N/A',
      'CatchCopy' => 'N/A',
      'Laundry' => 'N/A',
      'PhoneNumber' => 'N/A',
      'PhotoUrl' => 'N/A',
      'BusinessHoursInformation' => 'N/A',
      'Holiday' => 'N/A',
      'RoadStationNameKana' => 'N/A',
      'StampContent' => 'N/A',
      'NationalHighWay1' => 'N/A',
      'NationalHighWay2' => 'N/A',
      'MajorPrefecturalRoad1' => 'N/A',
      'MajorPrefecturalRoad2' => 'N/A',
      'RegistryYear' => 'N/A',
      'Facilities' => 'N/A',
    ];
    return $ret;
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