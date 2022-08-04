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
use App\Models\RoadstationLabel;
use App\Models\LocationRoad;
use App\Models\AncillaryEquipments;
use App\Models\IncidentalFacility;
use App\Models\SeasonalInformation;
use App\Models\SeasonalInformationFlag;
use App\Models\FacilityDetail;
use App\Models\FacilityPayment;
use App\Models\BathingInformation;
use App\Models\FacilityEvent;
use App\Models\RestaurantInformation;
use App\Models\FacilitiesBusinessHours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImportCsvService
{
  public function bulkInsertRoadstation($csv_data){
    try{
      DB::beginTransaction();
      $this->createRoadstation($csv_data);
      $this->createRoadstationAddress($csv_data);
      $this->createLocationRoad($csv_data);
      $this->createRoadstationBusinessHour($csv_data);
      $this->createRoadstationBusinessStampInformation($csv_data);
      $this->createRoadstationSightseeing($csv_data);
      $this->createRoadstationParking($csv_data);
      $this->createRoadstationContact($csv_data);
      $this->createRoadstationUrls($csv_data);
      $this->createRoadstationLabel($csv_data);
      $this->createAncillaryEquipments($csv_data);
      $this->createRoadstationEval($csv_data);
      $this->createSeasonalInformation($csv_data);
      $this->createSeasonalInformationFlag($csv_data);
      DB::commit();
    } catch (\Exception $e) {
      DB::rollback();
      dd($e);
      return false;
    }
    return true;
  }
  public function bulkInsertFacility($csv_data){
    DB::beginTransaction();
    try{
      // dd($csv_data);
      $this->createFacilityDetail($csv_data);
      $this->createFacilityPayment($csv_data);
      $this->createFacilityEvent($csv_data);
      $this->createRestaurantInformation($csv_data);
      $this->createBathingInformation($csv_data);
      $this->createFacilitiesBusinessHours($csv_data);
      DB::commit();
    } catch (\Exception $e) {
      DB::rollback();
      dd($e);
      return false;
    }
    return true;
  }
  private function createRoadstation($data){
    try{
      $arr_roadstation = [];
      foreach($data as $key => $value){
        if(empty($value[0])) continue;
        $tmp = [];
        $tmp['ZPX_ID']        = isset($value[0]) ? $value[0] : "";
        $tmp['CID']           = isset($value[1]) ? strval($value[1]) : "";
        $tmp['name']          = isset($value[2]) ? strval($value[2]) : "";
        $tmp['name_furi']     = isset($value[3]) ? strval($value[3]) : "";
        $tmp['thumbnail']     = isset($value[4]) ? strval($value[4]) : "";
        $tmp['registry_year'] = isset($value[21]) ? strval($value[21]) : "";
        $tmp['catch_copy']    = isset($value[22]) ? strval($value[22]) : "";
        $tmp['introduction']  = isset($value[23]) ? strval($value[23]) : "";
        // $arr_roadstation[] = $tmp;
        Roadstation::upsert($tmp,['ZPX_ID']);
      }
      // $arr_roadstation = array_chunk($arr_roadstation,1000);
      // foreach($arr_roadstation as $key => $value){
      //   Roadstation::upsert($value,['ZPX_ID']);
      // }
    } catch (Exception $e) {
      throw new Exception("項目数エラー");
    }
  }
  private function createRoadstationAddress($data){
    try{
      $arr = [];
      foreach($data as $key => $value){
        if(empty($value[1])) continue;
        $tmp = [];
        $tmp['CID']             = isset($value[1]) ? strval($value[1]) : "";
        $tmp['postal_code']     = isset($value[5]) ? strval($value[5]) : "";
        $tmp['prefecture']      = isset($value[6]) ? strval($value[6]) : "";
        $tmp['local_address']   = isset($value[7]) ? strval($value[7]) : "";
        $tmp['prefecture_code'] = isset($value[8]) ? strval($value[8]) : "";
        $tmp['area']            = isset($value[9]) ? strval($value[9]) : "";
        $tmp['latitude_x']      = isset($value[10]) ? strval($value[10]) : "";
        $tmp['latitude_y']      = isset($value[11]) ? strval($value[11]) : "";
        $tmp['map_code']        = isset($value[12]) ? strval($value[12]) : "";
        $tmp['tel']             = isset($value[13]) ? strval($value[13]) : "";
        $tmp['elebation']       = isset($value[14]) ? strval($value[14]) : "";
        $arr[] = $tmp;
      }
      $arr = array_chunk($arr,1000);
      foreach($arr as $key => $value){
        RoadstationAddress::upsert($value,['CID']);
      }
    } catch (Exception $e) {
      throw new Exception("項目数エラー");
    }
  }
  private function createLocationRoad($data){
    try{
      $arr = [];
      foreach($data as $key => $value){
        if(empty($value[15])) continue;
        $tmp = [];
        $tmp['CID']                = isset($value[1]) ? strval($value[1]) : "";
        $tmp['location_road_id']   = 1;
        $tmp['location_road_type'] = isset($value[15]) ? strval($value[15]) : "";
        $tmp['road_number']        = isset($value[16]) ? strval($value[16]) : "";
        $tmp['road_name']          = isset($value[17]) ? strval($value[17]) : "";
        $arr[] = $tmp;
      }
      foreach($data as $key => $value){
        if(empty($value[18])) continue;
        $tmp = [];
        $tmp['CID']                = isset($value[1]) ? strval($value[1]) : "";
        $tmp['location_road_id']   = 2;
        $tmp['location_road_type'] = isset($value[18]) ? strval($value[18]) : "";
        $tmp['road_number']        = isset($value[19]) ? strval($value[19]) : "";
        $tmp['road_name']          = isset($value[20]) ? strval($value[20]) : "";
        $arr[] = $tmp;
      }
      $arr = array_chunk($arr,1000);
      foreach($arr as $key => $value){
        LocationRoad::upsert($value,['CID','location_road_id']);
      }
    } catch (Exception $e) {
      throw new Exception("項目数エラー");
    }
  }
  private function createRoadstationBusinessHour($data){
    try{
      $arr = [];
      foreach($data as $key => $value){
        if(empty($value[24])) continue;
        $tmp = [];
        $tmp['CID']                   = isset($value[1]) ? strval($value[1]) : "";
        $tmp['start_time']            = isset($value[24]) ? strval($value[24]) : "";
        $tmp['end_time']              = isset($value[25]) ? strval($value[25]) : "";
        $tmp['time_supplement1']      = isset($value[26]) ? strval($value[26]) : "";
        $tmp['time_supplement2']      = isset($value[27]) ? strval($value[27]) : "";
        $tmp['regular_holiday']       = isset($value[29]) ? strval($value[29]) : "";
        $tmp['holiday_supplement1']   = isset($value[30]) ? strval($value[30]) : "";
        $tmp['holiday_supplement2']   = isset($value[31]) ? strval($value[31]) : "";
        $tmp['holiday_sightseeing_code']   = isset($value[32]) ? strval($value[32]) : "";
        $tmp['time_sightseeing_code']   = isset($value[28]) ? strval($value[28]) : "";
        $arr[] = $tmp;
      }
      // dd($arr);
      $arr = array_chunk($arr,1000);
      foreach($arr as $key => $value){
        RoadstationBusinessHour::upsert($value,['CID','location_road_id']);
      }
    } catch (Exception $e) {
      throw new Exception("項目数エラー");
    }
  }
  private function createRoadstationSightseeing($data){
    try{
      $arr = [];
      foreach($data as $key => $value){
        if(
          empty($value[33]) &&
          empty($value[34]) &&
          empty($value[35]) &&
          empty($value[36]) &&
          empty($value[37])
        ) continue;
        if(!empty($value[33])) $arr[] = ['id' => 0,'CID' => strval($value[1]),'name' => strval($value[33])];
        if(!empty($value[34])) $arr[] = ['id' => 1,'CID' => strval($value[1]),'name' => strval($value[34])];
        if(!empty($value[35])) $arr[] = ['id' => 2,'CID' => strval($value[1]),'name' => strval($value[35])];
        if(!empty($value[36])) $arr[] = ['id' => 3,'CID' => strval($value[1]),'name' => strval($value[36])];
        if(!empty($value[37])) $arr[] = ['id' => 4,'CID' => strval($value[1]),'name' => strval($value[37])];
      }
      $arr = array_chunk($arr,1000);
      foreach($arr as $key => $value){
        RoadstationSightseeing::upsert($value,['id','CID']);
      }
    } catch (Exception $e) {
      throw new Exception("項目数エラー");
    }
  }
  private function createRoadstationParking($data){
    try{
      $arr = [];
      foreach($data as $key => $value){
        if(empty($value[47])) continue;
        $tmp = [];
        $tmp['CID']                         = isset($value[1]) ? strval($value[1]) : "";
        $tmp['learge_parking_number']       = isset($value[46]) ? strval($value[46]) : "";
        $tmp['middle_parking_number']       = isset($value[47]) ? strval($value[47]) : "";
        $tmp['disabilities_parking_number'] = isset($value[48]) ? strval($value[48]) : "";
        $arr[] = $tmp;
      }
      $arr = array_chunk($arr,1000);
      foreach($arr as $key => $value){
        RoadstationParking::upsert($value,['CID']);
      }
    } catch (Exception $e) {
      throw new Exception("項目数エラー");
    }
  }
  private function createRoadstationUrls($data){
    try{
      $arr = [];
      foreach($data as $key => $value){
        if(empty($value[1])){continue;}
        $tmp = [];
        $tmp['CID']       = isset($value[1]) ? strval($value[1]) : "";
        $tmp['web']       = isset($value[38]) ? strval($value[38]) : "";
        $tmp['twitter']   = isset($value[39]) ? strval($value[39]) : "";
        $tmp['facebook']  = isset($value[40]) ? strval($value[40]) : "";
        $tmp['instagram'] = isset($value[41]) ? strval($value[41]) : "";
        $tmp['line']      = isset($value[42]) ? strval($value[42]) : "";
        $tmp['other']     = isset($value[43]) ? strval($value[43]) : "";
        $arr[] = $tmp;
      }
      // dd($arr_roadstation);
      $arr = array_chunk($arr,1000);
      foreach($arr as $key => $value){
        RoadstationUrls::upsert($value,['CID']);
      }
    } catch (Exception $e) {
      throw new Exception("項目数エラー");
    }
  }
  private function createRoadstationLabel($data){
    try{
      $arr = [];
      foreach($data as $key => $value){
        if(empty($value[0])) continue;
        if(isset($value[84]) && $value[84] == 1)$arr[] = ['CID' => strval($value[1]),'label_id' => 0];
        if(isset($value[85]) && $value[85] == 1)$arr[] = ['CID' => strval($value[1]),'label_id' => 1];
        if(isset($value[86]) && $value[86] == 1)$arr[] = ['CID' => strval($value[1]),'label_id' => 2];
        if(isset($value[87]) && $value[87] == 1)$arr[] = ['CID' => strval($value[1]),'label_id' => 3];
        if(isset($value[88]) && $value[88] == 1)$arr[] = ['CID' => strval($value[1]),'label_id' => 4];
        if(isset($value[89]) && $value[89] == 1)$arr[] = ['CID' => strval($value[1]),'label_id' => 5];
        if(isset($value[90]) && $value[90] == 1)$arr[] = ['CID' => strval($value[1]),'label_id' => 6];
      }
      $arr = array_chunk($arr,1000);
      foreach($arr as $key => $value){
        RoadstationLabel::upsert($value,['CID','label_id']);
      }
    } catch (Exception $e) {
      throw new Exception("項目数エラー");
    }
  }
  private function createIncidentalFacility($data){
    try{
      $arr = [];
      foreach($data as $key => $value){
        if(empty($value[0])) continue;
        if(isset($value[49]) && $value[49] == 1)$arr[] = ['CID' => strval($value[1]),'facility_id' => 0];
        if(isset($value[50]) && $value[50] == 1)$arr[] = ['CID' => strval($value[1]),'facility_id' => 1];
        if(isset($value[51]) && $value[51] == 1)$arr[] = ['CID' => strval($value[1]),'facility_id' => 2];
        if(isset($value[52]) && $value[52] == 1)$arr[] = ['CID' => strval($value[1]),'facility_id' => 3];
        if(isset($value[53]) && $value[53] == 1)$arr[] = ['CID' => strval($value[1]),'facility_id' => 4];
        if(isset($value[54]) && $value[54] == 1)$arr[] = ['CID' => strval($value[1]),'facility_id' => 5];
        if(isset($value[55]) && $value[55] == 1)$arr[] = ['CID' => strval($value[1]),'facility_id' => 6];
        if(isset($value[56]) && $value[56] == 1)$arr[] = ['CID' => strval($value[1]),'facility_id' => 7];
      }
      // dd($arr);
      $arr = array_chunk($arr,1000);
      foreach($arr as $key => $value){
        IncidentalFacility::upsert($value,['CID','facility_id']);
      }
    } catch (Exception $e) {
      throw new Exception("項目数エラー");
    }
  }
  private function createAncillaryEquipments($data){
    try{
      $arr = [];
      $cid = "";
      foreach($data as $key => $value){
        if(empty($value[0])) continue;
        $cid = strval($value[1]);
        if(isset($value[58]) && $value[58] == 1)$arr[] = ['CID' => strval($value[1]),'equipment_id' => 0];
        if(isset($value[59]) && $value[59] == 1)$arr[] = ['CID' => strval($value[1]),'equipment_id' => 1];
        if(isset($value[60]) && $value[60] == 1)$arr[] = ['CID' => strval($value[1]),'equipment_id' => 2];
        if(isset($value[61]) && $value[61] == 1)$arr[] = ['CID' => strval($value[1]),'equipment_id' => 3];
        if(isset($value[62]) && $value[62] == 1)$arr[] = ['CID' => strval($value[1]),'equipment_id' => 4];
        if(isset($value[63]) && $value[63] == 1)$arr[] = ['CID' => strval($value[1]),'equipment_id' => 5];
        if(isset($value[64]) && $value[64] == 1)$arr[] = ['CID' => strval($value[1]),'equipment_id' => 6];
        if(isset($value[65]) && $value[65] == 1)$arr[] = ['CID' => strval($value[1]),'equipment_id' => 7];
        if(isset($value[57]) && $value[57] == 1)$arr[] = ['CID' => strval($value[1]),'equipment_id' => 8];
      }
      // dd($arr);
      AncillaryEquipments::query()->delete();
      $arr = array_chunk($arr,1000);
      foreach($arr as $key => $value){
        AncillaryEquipments::upsert($value,['CID','equipment_id']);
      }
    } catch (Exception $e) {
      throw new Exception("項目数エラー");
    }
  }
  private function createRoadstationBusinessStampInformation($data){
    try{
      $arr = [];
      foreach($data as $key => $value){
        if(empty($value[66])) continue;
        $tmp = [];
        $tmp['CID']                     = isset($value[1]) ? strval($value[1]) : "";
        $tmp['id']                      = isset($value[66]) ? 1 : "";
        $tmp['installation_location']   = isset($value[66]) ? strval($value[66]) : "";
        $tmp['start_time']              = isset($value[67]) ? strval($value[67]) : "";
        $arr[] = $tmp;
      }
      foreach($data as $key => $value){
        if(empty($value[66])) continue;
        $tmp = [];
        $tmp['CID']                     = isset($value[1]) ? strval($value[1]) : "";
        $tmp['id']                      = isset($value[66]) ? 2 : "";
        $tmp['installation_location']   = isset($value[68]) ? strval($value[68]) : "";
        $tmp['start_time']              = isset($value[69]) ? strval($value[69]) : "";
        $arr[] = $tmp;
      }
      $arr = array_chunk($arr,1000);
      foreach($arr as $key => $value){
        RoadstationBusinessStampInformation::upsert($value,['CID','id']);
      }
    } catch (Exception $e) {
      throw new Exception("項目数エラー");
    }
  }
  private function createRoadstationContact($data){
    try{
      $arr = [];
      foreach($data as $key => $value){
        if(empty($value[92])) continue;
        $tmp = [];
        $tmp['CID']               = isset($value[1]) ? strval($value[1]) : "";
        $tmp['contact_address']   = isset($value[92]) ? strval($value[92]) : "";
        $tmp['postal_code']       = isset($value[93]) ? strval($value[93]) : "";
        $tmp['address']           = isset($value[94]) ? strval($value[94]) : "";
        $tmp['tel']               = isset($value[95]) ? strval($value[95]) : "";
        $tmp['fax']               = isset($value[96]) ? strval($value[96]) : "";
        $tmp['manager']           = isset($value[97]) ? strval($value[97]) : "";
        $tmp['mail']              = isset($value[98]) ? strval($value[98]) : "";
        $tmp['remarks']           = isset($value[99]) ? strval($value[99]) : "";
        $arr[] = $tmp;
      }
      $arr = array_chunk($arr,1000);
      foreach($arr as $key => $value){
        RoadstationContact::upsert($value,['CID']);
      }
    } catch (Exception $e) {
      throw new Exception("項目数エラー");
    }
  }
  private function createRoadstationEval($data){
    try{
      $arr = [];
      foreach($data as $key => $value){
        if(empty($value[1])) continue;
        $tmp = [];
        $tmp['CID']           = isset($value[1]) ? strval($value[1]) : "";
        $tmp['eval_index']    = isset($value[44]) ? strval($value[44]) : "";
        $tmp['eval_comment']  = isset($value[45]) ? strval($value[45]) : "";
        $arr[] = $tmp;
      }
      $arr = array_chunk($arr,1000);
      foreach($arr as $key => $value){
        RoadstationEval::upsert($value,['CID']);
      }
    } catch (Exception $e) {
      throw new Exception("項目数エラー");
    }
  }
  private function createSeasonalInformation($data){
    try{
      $arr = [];
      foreach($data as $key => $value){
        if(empty($value[1])) continue;
        if(!empty($value[70])){
          $tmp = [];
          $tmp['CID']         = isset($value[1]) ? strval($value[1]) : "";
          $tmp['title']       = isset($value[70]) ? strval($value[69]) : "";
          $tmp['content']     = isset($value[71]) ? strval($value[71]) : "";
          $tmp['start_time']  = isset($value[72]) ? strval($value[72]) : "";
          $tmp['end_time']    = isset($value[73]) ? strval($value[73]) : "";
          $arr[] = $tmp;
        }
        if(!empty($value[74])){
          $tmp = [];
          $tmp['CID']         = isset($value[1]) ? strval($value[1]) : "";
          $tmp['title']       = isset($value[74]) ? strval($value[74]) : "";
          $tmp['content']     = isset($value[75]) ? strval($value[75]) : "";
          $tmp['start_time']  = isset($value[76]) ? strval($value[76]) : "";
          $tmp['end_time']    = isset($value[77]) ? strval($value[77]) : "";
          $arr[] = $tmp;
        }
        if(!empty($value[78])){
          $tmp = [];
          $tmp['CID']         = isset($value[1]) ? strval($value[1]) : "";
          $tmp['title']       = isset($value[78]) ? strval($value[78]) : "";
          $tmp['content']     = isset($value[79]) ? strval($value[79]) : "";
          $tmp['start_time']  = isset($value[80]) ? strval($value[80]) : "";
          $tmp['end_time']    = isset($value[81]) ? strval($value[81]) : "";
          $arr[] = $tmp;
        }
      }
      $arr = array_chunk($arr,1000);
      foreach($arr as $key => $value){
        SeasonalInformation::upsert($value,['CID']);
      }
    } catch (Exception $e) {
      throw new Exception("項目数エラー");
    }
  }
  private function createSeasonalInformationFlag($data){
    try{
      $arr = [];
      foreach($data as $key => $value){
        if(empty($value[1])) continue;
          $tmp = [];
          $tmp['CID']           = isset($value[1]) ? strval($value[1]) : "";
          $tmp['is_closed']     = isset($value[82]) ? strval($value[82]) : "";
          $tmp['is_shutdown']   = isset($value[83]) ? strval($value[83]) : "";
          $arr[] = $tmp;
      }
      $arr = array_chunk($arr,1000);
      foreach($arr as $key => $value){
        SeasonalInformationFlag::upsert($value,['CID']);
      }
    } catch (Exception $e) {
      throw new Exception("項目数エラー");
    }
  }
  private function createFacilityDetail($data){
    try{
      $arr = [];
      foreach($data as $key => $value){
        if(empty($value[0])) continue;
        $tmp = [];
        $tmp['ZPX_ID']                  = isset($value[0]) ? strval($value[0]) : "";
        $tmp['facility_category_code']  = isset($value[1]) ? sprintf('%04d', $value[1]) : "";
        $tmp['facility_code']           = isset($value[2]) ? sprintf('%02d', $value[2]) : "";
        $tmp['category_code']           = isset($value[3]) ? sprintf('%02d', $value[3]) : "";
        $tmp['UID']                     = isset($value[4]) ? strval($value[4]) : "";
        $tmp['name']                    = isset($value[5]) ? strval($value[5]) : "";
        $tmp['name_furi']               = isset($value[6]) ? strval($value[6]) : "";
        $tmp['description']             = isset($value[7]) ? strval($value[7]) : "";
        $tmp['recommendation_name']     = isset($value[8]) ? strval($value[8]) : "";
        $tmp['recommendation_desc']     = isset($value[9]) ? strval($value[9]) : "";
        $tmp['checkin_time']            = isset($value[19]) ? strval($value[19]) : "";
        $tmp['checkout_time']           = isset($value[20]) ? strval($value[20]) : "";
        $tmp['regular_holiday']         = isset($value[21]) ? strval($value[21]) : "";
        $tmp['holiday_supplement1']     = isset($value[22]) ? strval($value[22]) : "";
        $tmp['holiday_supplement2']     = isset($value[23]) ? strval($value[23]) : "";
        $tmp['tel']                     = isset($value[24]) ? strval($value[24]) : "";
        $tmp['tel_supplement']          = isset($value[25]) ? strval($value[25]) : "";
        $tmp['place']                   = isset($value[26]) ? strval($value[26]) : "";
        $tmp['price']                   = isset($value[27]) ? strval($value[27]) : "";
        $tmp['detail_link']             = isset($value[31]) ? strval($value[31]) : "";
        $tmp['is_closed']               = isset($value[39]) ? strval($value[39]) : "";
        $tmp['remarks']                 = isset($value[40]) ? strval($value[40]) : "";
        $arr[] = $tmp;
      }
      $arr = array_chunk($arr,1000);
      foreach($arr as $key => $value){
        FacilityDetail::upsert($value,['ZPX_ID','UID']);
      }
    } catch (Exception $e) {
      throw new Exception("項目数エラー");
    }
  }
  private function createFacilityPayment($data){
    try{
      $arr = [];
      foreach($data as $key => $value){
        if(empty($value[0])) continue;
        $tmp = [];
        $tmp['ZPX_ID']              = isset($value[0]) ? strval($value[0]) : 0;
        $tmp['UID']                 = isset($value[4]) ? strval($value[4]) : 0;
        $tmp['is_pay_to_credit']    = isset($value[32]) ? strval($value[32]) : 0;
        $tmp['is_pay_to_e_money']   = isset($value[33]) ? strval($value[33]) : 0;
        $tmp['is_pay_to_barcode']   = isset($value[34]) ? strval($value[34]) : 0;
        $tmp['is_pay_to_other']     = isset($value[35]) ? strval($value[35]) : 0;
        $arr[] = $tmp;
      }
      $arr = array_chunk($arr,1000);
      foreach($arr as $key => $value){
        FacilityPayment::upsert($value,['ZPX_ID','UID']);
      }
    } catch (Exception $e) {
      throw new Exception("項目数エラー");
    }
  }
  private function createBathingInformation($data){
    try{
      $arr = [];
      foreach($data as $key => $value){
        if(
          empty($value[0]) &&
          empty($value[28]) &&
          empty($value[29]) &&
          empty($value[30])
          ) continue;
        $tmp = [];
        $tmp['ZPX_ID']           = isset($value[0]) ? strval($value[0]) : "";
        $tmp['UID']              = isset($value[4]) ? strval($value[4]) : "";
        $tmp['open_air_bath']    = isset($value[28]) ? strval($value[28]) : "";
        $tmp['sauna']            = isset($value[29]) ? strval($value[29]) : "";
        $tmp['spring_quality']   = isset($value[30]) ? strval($value[30]) : "";
        $arr[] = $tmp;
      }
      $arr = array_chunk($arr,1000);
      foreach($arr as $key => $value){
        BathingInformation::upsert($value,['ZPX_ID','UID']);
      }
    } catch (Exception $e) {
      throw new Exception("項目数エラー");
    }
  }
  private function createFacilityEvent($data){
    try{
      $arr = [];
      foreach($data as $key => $value){
        if(
          empty($value[0]) &&
          empty($value[36]) &&
          empty($value[37]) &&
          empty($value[38])
          ) continue;
        if(!empty($value[36])){
          $tmp = [];
          $tmp['ZPX_ID']           = isset($value[0]) ? strval($value[0]) : "";
          $tmp['UID']              = isset($value[4]) ? strval($value[4]) : "";
          $tmp['id']               = isset($value[36]) ? 0 : "";
          $tmp['contents']      = isset($value[36]) ? strval($value[36]) : "";
          $arr[] = $tmp;
        }
        if(!empty($value[37])){
          $tmp = [];
          $tmp['ZPX_ID']           = isset($value[0]) ? strval($value[0]) : "";
          $tmp['UID']              = isset($value[4]) ? strval($value[4]) : "";
          $tmp['id']               = isset($value[37]) ? 1 : "";
          $tmp['contents']      = isset($value[37]) ? strval($value[37]) : "";
          $arr[] = $tmp;
        }
        if(!empty($value[38])){
          $tmp = [];
          $tmp['ZPX_ID']           = isset($value[0]) ? strval($value[0]) : "";
          $tmp['UID']              = isset($value[4]) ? strval($value[4]) : "";
          $tmp['id']               = isset($value[38]) ? 2 : "";
          $tmp['contents']      = isset($value[38]) ? strval($value[38]) : "";
          $arr[] = $tmp;
        }
      }
      $arr = array_chunk($arr,1000);
      foreach($arr as $key => $value){
        FacilityEvent::upsert($value,['ZPX_ID','UID']);
      }
    } catch (Exception $e) {
      throw new Exception("項目数エラー");
    }
  }
  private function createRestaurantInformation($data){
    try{
      $arr = [];
      foreach($data as $key => $value){
        if(
          empty($value[0]) &&
          empty($value[41]) &&
          empty($value[42]) &&
          empty($value[43]) &&
          empty($value[44]) &&
          empty($value[45]) &&
          empty($value[46]) &&
          empty($value[47]) &&
          empty($value[48])
        ) continue;
        $tmp = [];
        $tmp['ZPX_ID']         = isset($value[0]) ? strval($value[0]) : "";
        $tmp['UID']            = isset($value[4]) ? strval($value[4]) : "";
        $tmp['japanese_food']  = isset($value[41]) ? strval($value[41]) : "";
        $tmp['western_food']   = isset($value[42]) ? strval($value[33]) : "";
        $tmp['chinese_food']   = isset($value[43]) ? strval($value[43]) : "";
        $tmp['sweets']         = isset($value[44]) ? strval($value[44]) : "";
        $tmp['bar']            = isset($value[45]) ? strval($value[45]) : "";
        $tmp['eat_in']         = isset($value[46]) ? strval($value[46]) : "";
        $tmp['take_out']       = isset($value[47]) ? strval($value[47]) : "";
        $tmp['buffet']         = isset($value[48]) ? strval($value[48]) : "";
        $arr[] = $tmp;
      }
      $arr = array_chunk($arr,1000);
      foreach($arr as $key => $value){
        RestaurantInformation::upsert($value,['ZPX_ID','UID']);
      }
    } catch (Exception $e) {
      throw new Exception("項目数エラー");
    }
  }
  private function createFacilitiesBusinessHours($data){
    try{
      $arr = [];
      foreach($data as $key => $value){
        if(
          empty($value[0]) &&
          empty($value[10]) &&
          empty($value[13]) &&
          empty($value[16])
          ) continue;
          if(!empty($value[10])){
            $tmp = [];
            $tmp['ZPX_ID']           = isset($value[0]) ? strval($value[0]) : "";
            $tmp['UID']              = isset($value[4]) ? strval($value[4]) : "";
            $tmp['id']               = isset($value[10]) ? 0 : "";
            $tmp['start_time']       = isset($value[10]) ? strval($value[10]) : "";
            $tmp['end_time']         = isset($value[11]) ? strval($value[11]) : "";
            $tmp['time_supplement']  = isset($value[12]) ? strval($value[12]) : "";
            $arr[] = $tmp;
          }
          if(!empty($value[13])){
            $tmp = [];
            $tmp['ZPX_ID']           = isset($value[0]) ? strval($value[0]) : "";
            $tmp['UID']              = isset($value[4]) ? strval($value[4]) : "";
            $tmp['id']               = isset($value[13]) ? 1 : "";
            $tmp['start_time']       = isset($value[13]) ? strval($value[13]) : "";
            $tmp['end_time']         = isset($value[14]) ? strval($value[14]) : "";
            $tmp['time_supplement']  = isset($value[15]) ? strval($value[15]) : "";
            $arr[] = $tmp;
          }
          if(!empty($value[16])){
            $tmp = [];
            $tmp['ZPX_ID']           = isset($value[0]) ? strval($value[0]) : "";
            $tmp['UID']              = isset($value[4]) ? strval($value[4]) : "";
            $tmp['id']               = isset($value[16]) ? 2 : "";
            $tmp['start_time']       = isset($value[16]) ? strval($value[16]) : "";
            $tmp['end_time']         = isset($value[17]) ? strval($value[17]) : "";
            $tmp['time_supplement']  = isset($value[18]) ? strval($value[18]) : "";
            $arr[] = $tmp;
          }
      }
      $arr = array_chunk($arr,1000);
      foreach($arr as $key => $value){
        FacilitiesBusinessHours::upsert($value,['ZPX_ID','UID']);
      }
    } catch (Exception $e) {
      throw new Exception("項目数エラー");
    }
  }
}