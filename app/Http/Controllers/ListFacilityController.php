<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// サービス呼び出し
use App\Services\FacilityService;
use App\Services\DataVersionService;
// モデル連携
use App\Models\MstFacility;
use App\Models\MstEquipments;

class ListFacilityController extends Controller
{
  private $service;
  private $roadstation;
  public function __construct(FacilityService $service)
  {
    $this->service = $service;
  }
  public function index(){
    $facilities = $this->service->get();
    $count = $this->service->count();
    // dd($facilities);
    return view('listFacilities',[
      'facilities' => $facilities,
      'count' => $count
    ]);
  }
  public function show($uid){
    $facility = $this->service->show($uid);
    $restaurant = !empty($facility['restaurant'][0]) ? $facility['restaurant'][0]->getAttributes() : NULL;
    return view('showFacility',[
      'facility' => $facility['facility'][0]->getAttributes(),
      'payment' => $facility['payment'][0]->getAttributes(),
      'restaurant' => $restaurant,
      'businesshours' => $facility['businesshours'],
    ]);
  }
  public function showDeleted(){
    $facilities = $this->service->deletedList();
    // $count = $this->service->count();
    // dd($facilities[0]->getAttributes());
    return view('listFacilitiesDelete',[
        'facilities' => $facilities,
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
    return redirect('/facilities');
  }
  public function edit($uid){
    $facility = $this->service->show($uid);
    $restaurant = !empty($facility['restaurant'][0]) ? $facility['restaurant'][0]->getAttributes() : NULL;
    return view('editFacility',[
      'facility' => $facility['facility'][0]->getAttributes(),
      'payment' => $facility['payment'][0]->getAttributes(),
      'restaurant' => $restaurant,
      'businesshours' => $facility['businesshours'],
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
    return redirect('/facilities');
  }
  public function delete($uid){
    $ret = $this->service->changeDeleteFlg($uid,'1');
    // データバージョンアップ
    if($ret == true){
      $version = new DataVersionService();
      $version->update();
    }
    return redirect('/facilities');
  }
}
