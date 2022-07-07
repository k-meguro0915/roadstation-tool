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
    protected $error_msg_key = 'wrong or nothing API Key';
    //
    private function checkAPIKey($request){
      $key = $request->key;
      if($key == '3fpe8F9e_9KdJFHE88YL'){
        return true;
      }
      return false;
    }
    public function getRoadstations(Request $request){
      try{
        if($this->checkAPIKey($request)){
          $service = new RoadstationService;
          $ret = $service->apiAll();
          $result = [
            'result' => $ret
          ];
        } else {
          $result = [
            'result' => false,
            'error' => [
                'messages' => [$this->error_msg_key]
            ],
          ];
        }
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
    public function getRoadstationsLight(Request $request){
      try{
        if($this->checkAPIKey($request)){
          $service = new RoadstationService;
          $ret = $service->apiLight();
          $result = [
            'result' => $ret
          ];
        } else {
          $result = [
            'result' => false,
            'error' => [
                'messages' => [$this->error_msg_key]
            ],
          ];
        }
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
    public function getRoadstationDetail(Request $request){
      try{
        if($this->checkAPIKey($request)){
          $zpx_id = $request->ZPX_ID;
          $service = new RoadstationService;
          $ret = $service->apidetail($zpx_id);
          $result = [
            'result' => $ret
          ];
        } else {
          $result = [
            'result' => false,
            'error' => [
                'messages' => [$this->error_msg_key]
            ],
          ];
        }
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
    public function getRoadstationEvent(Request $request){
      try{
        if($this->checkAPIKey($request)){
          $zpx_id = $request->ZPX_ID;
          $service = new RoadstationService;
          $ret = $service->apiEvents($zpx_id);
          $result = [
            'result' => $ret
          ];
        } else {
          $result = [
            'result' => false,
            'error' => [
                'messages' => [$this->error_msg_key]
            ],
          ];
        }
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
    public function getFacilities(Request $request){
      try{
        if($this->checkAPIKey($request)){
          $zpx_id = $request->ZPX_ID;
          $service = new FacilityService;
          $ret = $service->where($zpx_id);
          $result = [
            'result' => $ret
          ];
        } else {
          $result = [
            'result' => false,
            'error' => [
                'messages' => [$this->error_msg_key]
            ],
          ];
        }
      } catch(\Exception $e){
        $result = [
            'result' => false,
            'error' => [
                'messages' => [$e->getMessage()]
            ],
        ];
        return $this->resConversionJson($result, $e->getCode());
      }
      // dd($result);
      return $this->resConversionJson($result);
    }
    public function getFacilityDetail(Request $request){
      try{
        if($this->checkAPIKey($request)){
          $service = new RoadstationService;
          $ret = $service->detail($uid);
          $result = [
            'result' => $ret
          ];
        } else {
          $result = [
            'result' => false,
            'error' => [
                'messages' => [$this->error_msg_key]
            ],
          ];
        }
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
    public function getDatabaseVersion(Request $request){
      try{
        if($this->checkAPIKey($request)){
          $service = new DataVersionService;
          $ret = $service->get();
          $result = [
            'result' => $ret
          ];
        } else {
          $result = [
            'result' => false,
            'error' => [
                'messages' => ['wrong or nothing API Key']
            ],
          ];
        }
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
