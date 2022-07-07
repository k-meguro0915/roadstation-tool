<?php

namespace App\Http\Controllers;

use App\Services\FacilityService;
use App\Services\RoadstationService;
use App\Services\DataVersionService;
// モデル連携
use App\Models\MstFacility;
use App\Models\MstEquipments;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
  private $service;
  private $roadstation;
  public function __construct(FacilityService $service)
  {
    $this->middleware('auth');
    $this->service = $service;
  }
  public function show($uid){
    $facility = $this->service->show($uid);
    $restaurant = !empty($facility['restaurant'][0]) ? $facility['restaurant'][0]->getAttributes() : NULL;
    $payment = !empty($facility['payment'][0]) ? $facility['payment'][0]->getAttributes() : NULL;
    $businesshours = !empty($facility['businesshours']) ? $facility['businesshours'] : NULL;
    $events = !empty($facility['events'][0]) ? $facility['events'][0] : NULL;
    return view('showFacility',[
      'facility' => $facility['facility'][0]->getAttributes(),
      'payment' => $payment,
      'restaurant' => $restaurant,
      'businesshours' => $businesshours,
      'events' => $events,
    ]);
  }
  public function create(){
    return view('createFacility');
  }
  public function store(Request $request){
    // dd($request);
    $ret = $this->service->store($request);
    // データバージョンアップ
    if($ret == true){
      $version = new DataVersionService();
      $version->update();
    }
    return redirect('/facilities')->with('flash_message','登録が完了しました。');;
  }
  public function edit($uid){
    $facility = $this->service->show($uid);
    $restaurant = !empty($facility['restaurant'][0]) ? $facility['restaurant'][0]->getAttributes() : NULL;
    $payment = !empty($facility['payment'][0]) ? $facility['payment'][0]->getAttributes() : NULL;
    $businesshours = !empty($facility['businesshours'][0]) ? $facility['businesshours'] : NULL;
    $events = !empty($facility['events'][0]) ? $facility['events'][0] : NULL;
    return view('editFacility',[
      'facility' => $facility['facility'][0]->getAttributes(),
      'payment' => $payment,
      'restaurant' => $restaurant,
      'businesshours' => $businesshours,
      'events' => $events,
    ]);
  }
  public function update(Request $request){
    // dd($request);
    $ret = $this->service->store($request);
    // データバージョンアップ
    if($ret == true){
      $version = new DataVersionService();
      $version->update();
    }
    return redirect('/facilities')->with('flash_message','更新が完了しました。');
  }
  public function delete($uid){
    $ret = $this->service->changeDeleteFlg($uid,'1');
    // データバージョンアップ
    if($ret == true){
      $version = new DataVersionService();
      $version->update();
    }
    return redirect('/facilities')->with('flash_message','削除が完了しました。');
  }
  public function restore($uid){
    $is_deleted_roadstation = $this->service->checkRoadStation($uid);
    if($is_deleted_roadstation >= 1){
      return redirect('/facilities');
    }
    $ret = $this->service->changeDeleteFlg($uid,'0');
    // データバージョンアップ
    if($ret == true){
      $version = new DataVersionService();
      $version->update();
    }
    return redirect('/facilities')->with('flash_message','削除済みの付帯施設を復元しました。');;
  }
}
