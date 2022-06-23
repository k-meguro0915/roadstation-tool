<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// サービス呼び出し
use App\Services\FacilityService;
use App\Services\RoadstationService;
use App\Services\DataVersionService;
class APIController extends Controller
{
    //
    public function getRoadstations(){
      try{
        $service = new RoadstationService;
        $ret = $service->apiAll();
        $result = [
          'result' => $ret
        ];
      } catch(\Exception $e){
        $result = [
            'result' => false,
            'error' => [
                'messages' => [$e->getMessage()]
            ],
        ];
        return $this->resConversionJson($result, $e->getCode());
      }
      return $this->resConversionJson($result);
    }
    public function getRoadstationDetail($zpx_id){
      try{
        $service = new RoadstationService;
        $ret = $service->apidetail($zpx_id);
        $result = [
          'result' => $ret
        ];
      } catch(\Exception $e){
        $result = [
            'result' => false,
            'error' => [
                'messages' => [$e->getMessage()]
            ],
        ];
        return $this->resConversionJson($result, $e->getCode());
      }
      return $this->resConversionJson($result);
    }
    public function getFacilities(){
      try{
        $service = new FacilityService;
        $ret = $service->all();
        $result = [
          'result' => $ret
        ];
      } catch(\Exception $e){
        $result = [
            'result' => false,
            'error' => [
                'messages' => [$e->getMessage()]
            ],
        ];
        return $this->resConversionJson($result, $e->getCode());
      }
      return $this->resConversionJson($result);
    }
    public function getFacilityDetail(Request $uid){
      try{
        $service = new RoadstationService;
        $ret = $service->detail($uid);
        $result = [
          'result' => $ret
        ];
      } catch(\Exception $e){
        $result = [
            'result' => false,
            'error' => [
                'messages' => [$e->getMessage()]
            ],
        ];
        return $this->resConversionJson($result, $e->getCode());
      }
      return $this->resConversionJson($result);
    }
    public function getDatabaseVersion(){
      try{
        $service = new DataVersionService;
        $ret = $service->get();
        $result = [
          'result' => $ret
        ];
      } catch(\Exception $e){
        $result = [
            'result' => false,
            'error' => [
                'messages' => [$e->getMessage()]
            ],
        ];
        return $this->resConversionJson($result, $e->getCode());
      }
      return $this->resConversionJson($result);
    }
    // jsonにコンバートかつステータスコードを返却する
    private function resConversionJson($result, $statusCode=200){
      if(empty($statusCode) || $statusCode < 100 || $statusCode >= 600){
        $statusCode = 500;
      }
      return response()->json(
        $result,
        $statusCode,
        ['Content-Type' => 'application/json;charset=UTF-8','Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE
      );
    }
}
