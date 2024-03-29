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
use App\Models\RoadstationContact;
use App\Models\RoadstationUrls;
use App\Models\LocationRoad;
use App\Models\IncidentalFacility;
use App\Models\SeasonalInformation;
use App\Models\SeasonalInformationFlag;
use App\Models\MstEquipments;
use App\Models\MstFacility;
use App\Models\FacilityDetail;
use App\Models\FacilityPayment;
use App\Models\BathingInformation;
use App\Models\FacilityEvent;
use App\Models\RestaurantInformation;
use App\Models\FacilitiesBusinessHours;
use App\Models\AncillaryEquipments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    return Roadstation::where('roadstations.is_delete',0)
                        ->join('roadstation_addresses', 'roadstations.CID', '=', 'roadstation_addresses.CID')
                        ->orderBy('roadstations.CID','asc')->paginate(15);
  }
  public function search($name,$prefecture = ""){
    $query = Roadstation::query();
    if(!empty($name)) {
      $query->where('name','like',"%$name%");
    }
    if(!empty($prefecture) && $prefecture != '未選択') {
      $query->where('roadstation_addresses.prefecture','=',$prefecture);
    }
    $query->where('roadstations.is_delete',0);
    $query->join('roadstation_addresses', 'roadstations.CID', '=', 'roadstation_addresses.CID');
    $query->orderBy('roadstations.CID','asc');

    $ret['result'] = $query->paginate(15);
    $ret['count'] = $query->count();

    return $ret;
    // return Roadstation::where([['name','like',"%$name%"],['roadstation_addresses.prefecture','=',$prefecture],['roadstations.is_delete',0]])
    //                     ->join('roadstation_addresses', 'roadstations.CID', '=', 'roadstation_addresses.CID')
    //                     ->orderBy('roadstations.CID','asc')->paginate(15);
  }
  public function deletedList(){
    return Roadstation::where('roadstations.is_delete',1)
                      ->join('roadstation_addresses', 'roadstations.CID', '=', 'roadstation_addresses.CID')
                      ->orderBy('roadstations.CID','asc')->paginate(15);
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
    $ret['roadstation'] = Roadstation::where([['ZPX_ID','=',$zpx_id],['is_delete','=','0']])->get();
    $ret['address']     = RoadstationAddress::where([['ZPX_ID','=',$zpx_id],['is_delete','=','0']])->get();
    $ret['localroad']   = LocationRoad::where([['ZPX_ID','=',$zpx_id],['is_delete','=','0']])->get();
    $ret['event']       = SeasonalInformation::where([['ZPX_ID','=',$zpx_id],['is_delete','=','0']])->get();
    $ret['eventFlag']   = SeasonalInformationFlag::where([['ZPX_ID','=',$zpx_id],['is_delete','=','0']])->get();
    $ret['basic']       = RoadstationBusinessHour::where([['ZPX_ID','=',$zpx_id],['is_delete','=','0']])->get();
    $ret['parking']     = RoadstationParking::where([['ZPX_ID','=',$zpx_id],['is_delete','=','0']])->get();
    $ret['stamp']       = RoadstationBusinessStampInformation::where([['ZPX_ID','=',$zpx_id],['is_delete','=','0']])->get();
    $ret['urls']        = RoadstationUrls::where([['ZPX_ID','=',$zpx_id],['is_delete','=','0']])->get();
  }
  public function edit($zpx_id){
    $ret = array();
    // 各情報を持ってくる
    $ret['roadstation'] = Roadstation::where('ZPX_ID',$zpx_id)->get();
    $cid = $ret['roadstation']->CID;
    $ret['address']     = RoadstationAddress::where('ZPX_ID',$zpx_id)->get();
    $ret['localroad']   = LocationRoad::where('ZPX_ID',$zpx_id)->get();
    $ret['event']       = SeasonalInformation::where('ZPX_ID',$zpx_id)->get();
    $ret['eventFlag']   = SeasonalInformationFlag::where('ZPX_ID',$zpx_id)->get();
    $ret['basic']       = RoadstationBusinessHour::where('ZPX_ID',$zpx_id)->get();
    $ret['parking']     = RoadstationParking::where('ZPX_ID',$zpx_id)->get();
    $ret['stamp']       = RoadstationBusinessStampInformation::where('ZPX_ID',$zpx_id)->get();
    $ret['urls']        = RoadstationUrls::where('ZPX_ID',$zpx_id)->get();
    return $ret;
  }
  public function show($zpx_id){
    $ret = array();
    // 各情報を持ってくる
    $ret['roadstation']   = Roadstation::where('ZPX_ID',$zpx_id)->get();
    $cid = $ret['roadstation'][0]->CID;
    $ret['address']       = RoadstationAddress::where('CID',$cid)->get();
    $ret['localroad']     = LocationRoad::where('CID',$cid)->get();
    $ret['event']         = SeasonalInformation::where('CID',$cid)->get();
    $ret['eventFlag']     = SeasonalInformationFlag::where('CID',$cid)->get();
    $ret['business_hour'] = RoadstationBusinessHour::where('CID',$cid)->get();
    $ret['parking']       = RoadstationParking::where('CID',$cid)->get();
    $ret['stamp']         = RoadstationBusinessStampInformation::where('CID',$cid)->get();
    $ret['urls']          = RoadstationUrls::where('CID',$cid)->get();
    $ret['sightseeing']   = RoadstationSightseeing::where('CID',$cid)->get(['name']);
    $ret['equipments']    = AncillaryEquipments::where('CID',$cid)->get(['equipment_id']);
    $ret['facilities']    = FacilityDetail::where([['ZPX_ID','=',$zpx_id],['is_delete','=','0']])->get();
    $ret['contact']       = RoadstationContact::where('CID',$cid)->get();
    return $ret;
  }
  // 道の駅登録
  // 各メソッドでupdateOrCreateが試せるかを再思考
  public function store($request) {
    DB::beginTransaction();
    try{
      // 各テーブルに使うデータの整形
      $data         = $request->all();
      $roadstation  = isset($data['roadstation']) ? $data['roadstation'] : '';
      $address      = isset($data['address'])     ? $data['address'] : '';
      $local_road   = isset($data['localroad'])   ? $data['localroad'] : '';
      $event        = isset($data['event'])       ? $data['event'] : '';
      $eventFlg     = isset($data['eventFlag'])   ? $data['eventFlag'] : '';
      $facility     = isset($data['facility'])    ? $data['facility'] : '';
      $equipment    = isset($data['service'])     ? $data['service'] : '';
      $basic        = isset($data['basic'])       ? $data['basic'] : '';
      $parking      = isset($data['parking'])     ? $data['parking'] : '';
      $stamp        = isset($data['stamp'])       ? $data['stamp'] : '';
      $urls         = isset($data['urls'])        ? $data['urls'] : '';
      $sightseeing  = isset($data['sightseeing']) ? $data['sightseeing'] : '';
      $contact      = isset($data['contacts'])    ? $data['contacts'] : '';
      // dd($event);
      // 道の駅メインのテーブルにデータを取得し、返却されたデータからCIDを抜き出す。
      if(!empty($roadstation))$this->createRelationTable(new Roadstation,$roadstation,['ZPX_ID','CID']);
      $zpx_id = $roadstation['ZPX_ID'];
      $cid = $roadstation['CID'];
      // 抜き出したCIDを元に各リレーションレコードを作成する
      if(!empty($address)){
        $address['CID'] = $cid;
        $this->createRelationTable(new RoadstationAddress(),$address);
      }
      if(!empty($basic)){
        $basic['CID'] = $cid;
        $this->createRelationTable(new RoadstationBusinessHour(),$basic);
      }
      if(!empty($basic)){
        $basic['CID'] = $cid;
        $this->createRelationTable(new RoadstationBusinessHour(),$basic);
      }
      if(!empty($stamp)){
        $tmp = [];
        foreach($stamp as $key => $item){
          $tmp[] = [
            'CID'=>$cid,
            'id'=>$key,
            'installation_location'=>$item['installation_location'],
            'start_time'=>$item['start_time']
          ];
        }
        $this->createRelationTable(new RoadstationBusinessStampInformation(), $tmp,['CID','id']);
      }
      if(!empty($sightseeing)){
        $tmp =[];
        foreach($sightseeing as $key => $item){
          $tmp[] = ['CID'=>$cid,'id'=>$key,'name'=>$item];
        }
        $this->createRelationTable(new RoadstationSightseeing(),$tmp,['CID','id']);
      }
      if(!empty($urls)){
        $urls['CID'] = $cid;
        $this->createRelationTable(new RoadstationUrls(), $urls);
      }
      if(!empty($contact)){
        $contact['CID'] = $cid;
        $this->createRelationTable(new RoadstationContact(), $contact);
      }
      if(!empty($parking)){
        $parking['CID'] = $cid;
        $this->createRelationTable(new RoadstationParking(), $parking);
      }
      if(!empty($local_road)){
        $tmp = [];
        foreach($local_road as $key => $item){
          if($item['location_road_type'] == "")continue;
          $tmp[] = [
            'CID'=>$cid,
            'location_road_id'=>$key,
            'location_road_type'=>$item['location_road_type'],
            'road_number'=>$item['road_number'],
            'road_name'=>$item['road_name'],
          ];
        }
        LocationRoad::where('CID',$cid)->delete();
        $this->createRelationTable(new LocationRoad() , $tmp);
      }
      if(!empty($event)){
        $tmp = [];
        foreach($event as $key => $item){
          if(empty($item['title']))continue;
          $tmp[] = [
            'CID'=>$cid,
            'id'=>$key,
            'title'=>$item['title'],
            'content'=>$item['content'],
            'start_time'=>$item['start_time'],
            'end_time'=>$item['end_time'],
          ];
        }
        $this->createRelationTable(new SeasonalInformation(),$tmp);
      }
      if(!empty($eventFlg)){
        $eventFlg['CID'] = $cid;
        $this->createRelationTable(new SeasonalInformationFlag(),$eventFlg);
      }
      if(!empty($equipment)){
        $tmp =[];
        foreach($equipment as $key => $item){
          $tmp[] = ['CID'=>$cid,'equipment_id'=>$item];
        }
        AncillaryEquipments::where([['CID','=',$cid]])->delete();
        $this->createRelationTable(new AncillaryEquipments,$tmp,['CID','equipment_id']);
      }
      DB::commit();
    } catch (\Exception $e) {
      DB::rollback();
      dd($e);
      return false;
    }
    return true;
  }
  private function createRelationTable($model,$record,$collation=['CID']){
    // dd($record);
    $model->upsert( $record,$collation );
  }
  // APIによる取得処理
  public function apiAll(){
    $ret = [];
    $roadstation = Roadstation::where([['is_delete','=','0']])->orderBy('ZPX_ID','asc')->get();
    foreach($roadstation as $key => $item){
      $arr = $this->initApiArray(); //道の駅単位の初期化
      $value = $item->getAttributes();
      $arr["ID"]                  = $value['ZPX_ID'];
      $arr["RoadStationName"]     = $value['name'];
      $arr["RoadStationNumber"]   = intval(substr($value['ZPX_ID'],strpos($value['ZPX_ID'],'-')+1)); //to_integer
      $arr["RoadStationNameKana"] = $value['name_furi'];
      $arr["RoadStationGuide"]    = $value['introduction'];
      $arr["CatchCopy"]           = $value['catch_copy'];
      $arr["PhotoUrl"]            = $value['thumbnail'];
      $arr["RegistryYear"]        = $value['registry_year'];
      $prefecture_id              = intval(substr($value['ZPX_ID'],0,strpos($value['ZPX_ID'],'-'))); //to_integer
      $prefecture_id              = $prefecture_id == 0 ? 999 : $prefecture_id;
      $arr["PrefectureCD"]        = $prefecture_id;
      $arr["PrefectureID"]        = $prefecture_id;
      $address = RoadstationAddress::where('CID',$value['CID'])->get();
      $address = $address[0];
      $arr["Area"]              = $address['area'];
      if($prefecture_id == 999){
        $arr["Latitude"]          = "0";
        $arr["Longitude"]         = "0";
      } else {
        $arr["Latitude"]          = $address['latitude_y'];
        $arr["Longitude"]         = $address['latitude_x'];
      }
      $arr["MapCode"]           = $address['map_code'];
      $arr["PrefectureNameCD"]  = $address['prefecture'];
      $arr["PhoneNumber"]       = $address['tel'];
      $arr["Elebation"]         = $address['elebation'];
      $arr['RoadStationAddress'] = $address['prefecture'] . $address['local_address']; //都道府県＋市区町村以下
      $urls = RoadstationUrls::where('CID',$value['CID'])->get();
      $urls = $urls[0];
      $arr["Twitter"]   = $urls['twitter'];
      $arr["Facebook"]  = $urls['facebook'];
      $arr["Instagram"] = $urls['instagram'];
      $arr["HomePage"]  = $urls['web'];
      $parking = RoadstationParking::where('CID',$value['CID'])->get();
      if(!empty($parking[0])){
        $parking = $parking[0];
        $arr["LargeParkingLot"]         = $parking['learge_parking_number'];
        $arr["ParkingLotHandicap"]      = $parking['disabilities_parking_number'];
        $arr["ParkingLotNormalNumber"]  = $parking['middle_parking_number'];
      }
      $business_hour = RoadstationBusinessHour::where('CID',$value['CID'])->get();
      if(!empty($business_hour[0]) && !empty($business_hour[0]['start_time']) && !empty($business_hour[0]['end_time'])){
        $business_hour = $business_hour[0];
        $arr["BusinessHours"]             = $business_hour['start_time'] . '～' . $business_hour['end_time'];
        if(!empty($business_hour['time_sightseeing_code']))$arr["BusinessHoursInformation"]  = $business_hour['time_sightseeing_code'];
        if(!empty($business_hour['regular_holiday']))$arr["Holiday"]                   = $business_hour['regular_holiday'];
      }
      $stamp = RoadstationBusinessStampInformation::where('CID',$value['CID'])->get();
      if(!empty($stamp[0])){
        $stamp = $stamp[0]->getAttributes();
        $arr['StampContent'] = $stamp['installation_location'];
      }
      $local_road   = LocationRoad::where('CID',$value['CID'])->get();
      // 道路情報はDB側が不特定多数に対し、API先は数が固定されているため、道路タイプによって挿入先を変更させる
      $cnt_highway  = 1;
      $cnt_majorway = 1;
      foreach($local_road as $key => $item){
        $load_head = "";
        $road = "";
        if($item['location_road_type'] == '1'){
          $load_head = "国道";
          // $arr["NationalHighWay".$cnt_highway] = $load_head + $item['road_number'] + "号";
          $road = $load_head . $item['road_number'] . "号";
        } else if($item['location_road_type'] == '2'){
          switch($arr["PrefectureNameCD"]){
            case "東京都" : $load_head = "都道"; break;
            case "北海道" : $load_head = "道道"; break;
            case "京都府" : $load_head = "府道"; break;
            case "大阪府" : $load_head = "府道"; break;
            default: $load_head = "県道";
          }
          $road = $load_head . $item['road_number'] . "号";
        } else if($item['location_road_type'] == '3'){
          $road = $item['road_name'];
        }
        $arr["NationalHighWay".$cnt_highway] = $road;
        $arr["MajorPrefecturalRoad".$cnt_highway] = "";
        $cnt_highway++;
      }
      $equipment      = AncillaryEquipments::where('CID',$value['CID'])->get();
      $arr_equipment  = [];
      foreach($equipment as $key => $item){
        // insert_bool
        $arr['RegularParkingLotWithOrWithoutWirelessLAN'] = $item['equipment_id'] == '3' ? true : false;
        $arr['Laundry']   = $item['equipment_id'] == '2' ? true : false;
        $arr_equipment[]  = $item['equipment_id'];
      }
      $mst_facility = MstFacility::all();
      $facility     = FacilityDetail::where('ZPX_ID',$value['ZPX_ID'])->get();
      $arr_facility = [];
      if(0 < $facility->count()){
        foreach($facility as $key => $item){
          // $tmp           = $item->getAttributes();
          $arr_facility[] = $item->getAttributes()['facility_code'];
        }
      }
      $arr['Facility']  = $arr_facility;
      $arr['Service']   = $arr_equipment;
      $sightseeing  = RoadstationSightseeing::where('CID',$value['CID'])->get();
      $arr_sight    = [];
      foreach($sightseeing as $key => $item){
        $arr_sight[] = $item['name'];
      }
      $arr['TouristFacility'] = implode('、',$arr_sight);
      $ret[] = $arr;
    }
    return $ret;
  }
  public function apiLight(){
    $ret = [];
    $roadstation = Roadstation::where([['is_delete','=','0']])->orderBy('ZPX_ID','asc')->get();
    foreach($roadstation as $key => $item){
      $arr = []; //道の駅単位の初期化
      $value = $item->getAttributes();
      $arr["ID"]                  = $value['ZPX_ID'];
      $arr["RoadStationName"]     = $value['name'];
      $prefecture_id              = intval(substr($value['ZPX_ID'],0,strpos($value['ZPX_ID'],'-'))); //to_integer
      $prefecture_id              = $prefecture_id == 0 ? 999 : $prefecture_id;
      $arr["PrefectureCD"]        = $prefecture_id;
      $arr["PrefectureID"]        = $prefecture_id;
      $address = RoadstationAddress::where('CID',$value['CID'])->get();
      $address = $address[0];
      $arr["Area"]              = $address['area'];
      if($prefecture_id == 999){
        $arr["Latitude"]          = "0";
        $arr["Longitude"]         = "0";
      } else {
        $arr["Latitude"]          = $address['latitude_y'];
        $arr["Longitude"]         = $address['latitude_x'];
      }
      $arr["MapCode"]           = $address['map_code'];
      $business_hour = RoadstationBusinessHour::where('CID',$value['CID'])->get();
      if(!empty($business_hour[0])){
        $business_hour = $business_hour[0];
        $arr["BusinessHours"]             = $business_hour['start_time'] . '～' . $business_hour['end_time'];
      }
      $ret[] = $arr;
    }
    return $ret;
  }
  public function apidetail($zpx_id){
    $ret = [];
    $item = Roadstation::where('ZPX_ID',$zpx_id)->get();
    // dd($item);
    $arr = $this->initApiArray(); //道の駅単位の初期化
    $value = $item[0]->getAttributes();
    $arr["ID"]                  = $value['ZPX_ID'];
    $arr["RoadStationName"]     = $value['name'];
    $arr["RoadStationNumber"]   = intval(substr($value['ZPX_ID'],strpos($value['ZPX_ID'],'-')+1)); //to_integer
    $arr["RoadStationNameKana"] = $value['name_furi'];
    $arr["RoadStationGuide"]    = $value['introduction'];
    $arr["CatchCopy"]           = $value['catch_copy'];
    $arr["PhotoUrl"]            = $value['thumbnail'];
    $arr["RegistryYear"]        = $value['registry_year'];
    $prefecture_id              = intval(substr($value['ZPX_ID'],0,strpos($value['ZPX_ID'],'-'))); //to_integer
    $prefecture_id              = $prefecture_id == 0 ? 999 : $prefecture_id;
    $arr["PrefectureCD"]        = $prefecture_id;
    $arr["PrefectureID"]        = $prefecture_id;
    $address = RoadstationAddress::where('CID',$value['CID'])->get();
    $address = $address[0];
    $arr["Area"]                = $address['area'];
    if($prefecture_id == 999){
      $arr["Latitude"]          = "0";
      $arr["Longitude"]         = "0";
    } else {
      $arr["Latitude"]          = $address['latitude_y'];
      $arr["Longitude"]         = $address['latitude_x'];
    }
    $arr["MapCode"]             = $address['map_code'];
    $arr["PrefectureNameCD"]    = $address['prefecture'];
    $arr["PhoneNumber"]         = $address['tel'];
    $arr["Elebation"]           = $address['elebation'];
    $arr['RoadStationAddress']  = $address['prefecture'] . $address['local_address']; //都道府県＋市区町村以下
    $urls = RoadstationUrls::where('CID',$value['CID'])->get();
    $urls = $urls[0];
    $arr["Twitter"]   = $urls['twitter'];
    $arr["Facebook"]  = $urls['facebook'];
    $arr["Instagram"] = $urls['instagram'];
    $arr["HomePage"]  = $urls['web'];
    $parking = RoadstationParking::where('CID',$value['CID'])->get();
    $parking = $parking[0];
    $arr["LargeParkingLot"]         = $parking['learge_parking_number'];
    $arr["ParkingLotHandicap"]      = $parking['disabilities_parking_number'];
    $arr["ParkingLotNormalNumber"]  = $parking['middle_parking_number'];
    $business_hour = RoadstationBusinessHour::where('CID',$value['CID'])->get();
    if(!empty($business_hour[0])){
      $business_hour = $business_hour[0];
      $arr["BusinessHours"]             = $business_hour['start_time'] . '～' . $business_hour['end_time'];
      if(!empty($business_hour['time_sightseeing_code']))$arr["BusinessHoursInformation"]  = $business_hour['time_sightseeing_code'];
      if(!empty($business_hour['regular_holiday']))$arr["Holiday"]                   = $business_hour['regular_holiday'];
    }
    $stamp = RoadstationBusinessStampInformation::where('CID',$value['CID'])->get();
    if(!empty($stamp[0])){
      $stamp = $stamp[0]->getAttributes();
      $arr['StampContent'] = $stamp['installation_location'];
    }
    $local_road   = LocationRoad::where('CID',$value['CID'])->get();
    // 道路情報はDB側が不特定多数に対し、API先は数が固定されているため、道路タイプによって挿入先を変更させる
    $cnt_highway  = 1;
    $cnt_majorway = 1;
    foreach($local_road as $key => $item){
      $load_head = "";
      $road = "";
      if($item['location_road_type'] == '1'){
        $load_head = "国道";
        // $arr["NationalHighWay".$cnt_highway] = $load_head + $item['road_number'] + "号";
        $road = $load_head . $item['road_number'] . "号";
      } else if($item['location_road_type'] == '2'){
        switch($arr["PrefectureNameCD"]){
          case "東京都" : $load_head = "都道"; break;
          case "北海道" : $load_head = "道道"; break;
          case "京都府" : $load_head = "府道"; break;
          case "大阪府" : $load_head = "府道"; break;
          default: $load_head = "県道";
        }
        $road = $load_head . $item['road_number'] . "号";
      } else if($item['location_road_type'] == '3'){
        $road = $item['road_name'];
      }
      $arr["NationalHighWay".$cnt_highway] = $road;
      $arr["MajorPrefecturalRoad".$cnt_highway] = "";
      $cnt_highway++;
    }
    $equipment      = AncillaryEquipments::where('CID',$value['CID'])->get();
    $arr_equipment  = [];
    foreach($equipment as $key => $item){
      // insert_bool
      $arr['RegularParkingLotWithOrWithoutWirelessLAN'] = $item['equipment_id'] == '3' ? true : false;
      $arr['Laundry']   = $item['equipment_id'] == '2' ? true : false;
      $arr_equipment[]  = $item['equipment_id'];
    }
    $mst_facility = MstFacility::all();
    $facility     = FacilityDetail::where('ZPX_ID',$value['ZPX_ID'])->get();
    $arr_facility = [];
    if(0 < $facility->count()){
      foreach($facility as $key => $item){
        // $tmp           = $item->getAttributes();
        $arr_facility[] = $item->getAttributes()['facility_code'];
      }
    }
    $arr['Facility']  = $arr_facility;
    $arr['Service']   = $arr_equipment;
    $sightseeing  = RoadstationSightseeing::where('CID',$value['CID'])->get();
    $arr_sight    = [];
    foreach($sightseeing as $key => $item){
      $arr_sight[] = $item['name'];
    }
    $arr['TouristFacility'] = implode('、',$arr_sight);
    $ret[] = $arr;
    return $ret;
  }
  public function apiEvents($zpx_id){
    $cid = Roadstation::where('ZPX_ID',$zpx_id)->get('CID');
    $arr_events = SeasonalInformation::where('CID',$cid[0]->CID)->get();
    return $arr_events;
  }
  // API用の鋳型
  private function initApiArray(){
    $ret = [
      'Area' => '',
      'ID' => '',
      'Latitude' => '',
      'Longitude' => '',
      'MapCode' => '',
      'PrefectureNameCD' => '',
      'PrefectureCD' => '',
      'PrefectureID' => '',
      'RoadStationAddress' => '',
      'RoadStationName' => '',
      'RoadStationNumber' => '',
      'RoadStationGuide' => '',
      'Twitter' => '',
      'Facebook' => '',
      'Instagram' => '',
      'HomePage' => '',
      'BusinessHours' => '',
      'LargeParkingLot' => '',
      'ParkingLotHandicap' => '',
      'ParkingLotNormalNumber' => '',
      'RegularParkingLotWithOrWithoutWirelessLAN' => '',
      'TouristFacility' => '',
      'CatchCopy' => '',
      'Laundry' => '',
      'PhoneNumber' => '',
      'PhotoUrl' => '',
      'BusinessHoursInformation' => '',
      'Holiday' => '',
      'RoadStationNameKana' => '',
      'StampContent' => '',
      'NationalHighWay1' => '',
      'NationalHighWay2' => '',
      'MajorPrefecturalRoad1' => '',
      'MajorPrefecturalRoad2' => '',
      'RegistryYear' => '',
      'Facilities' => '',
    ];
    return $ret;
  }
  public function changeDeleteFlg($zpx_id,$flg){
    $cid = Roadstation::where('ZPX_ID',$zpx_id)->get()[0]['CID'];
    Roadstation::where('CID',$cid)->update(['is_delete'=>$flg]);
    RoadstationAddress::where('CID',$cid)->update(['is_delete'=>$flg]);
    RoadstationBusinessHour::where('CID',$cid)->update(['is_delete'=>$flg]);
    RoadstationBusinessStampInformation::where('CID',$cid)->update(['is_delete'=>$flg]);
    RoadstationEval::where('CID',$cid)->update(['is_delete'=>$flg]);
    RoadstationParking::where('CID',$cid)->update(['is_delete'=>$flg]);
    RoadstationSightseeing::where('CID',$cid)->update(['is_delete'=>$flg]);
    RoadstationUrls::where('CID',$cid)->update(['is_delete'=>$flg]);
    LocationRoad::where('CID',$cid)->update(['is_delete'=>$flg]);
    AncillaryEquipments::where('CID',$cid)->update(['is_delete'=>$flg]);
    // IncidentalFacility::where('CID',$cid)->update(['is_delete'=>$flg]);
    SeasonalInformation::where('CID',$cid)->update(['is_delete'=>$flg]);
    SeasonalInformationFlag::where('CID',$cid)->update(['is_delete'=>$flg]);
    FacilityDetail::where('ZPX_ID',$zpx_id)->update(['is_delete'=>$flg]);
    FacilityPayment::where('ZPX_ID',$zpx_id)->update(['is_delete'=>$flg]);
    BathingInformation::where('ZPX_ID',$zpx_id)->update(['is_delete'=>$flg]);
    RestaurantInformation::where('ZPX_ID',$zpx_id)->update(['is_delete'=>$flg]);
    FacilitiesBusinessHours::where('ZPX_ID',$zpx_id)->update(['is_delete'=>$flg]);
    return true;
  }
}