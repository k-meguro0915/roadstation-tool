<?php

namespace App\Http\Controllers;
use App\Models\Roadstation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\MstFacility;
use App\Models\MstEquipments;
use App\Services\DataVersionService;

// サービス定義
use App\Services\RoadstationService;

class RoadStationController extends Controller
{
  private $service;
  private $roadstation;
  public function __construct(RoadstationService $service)
  {
    $this->service = $service;
  }
  // 道の駅作成：入力画面
  public function index(){
    $roadstation = new Roadstation();
    $equipments = MstFacility::orderBy('id','asc')->get();
    $facilities = MstEquipments::orderBy('id','asc')->get();
    return view('createRoadStation',[
      'equipments' => $equipments,
      'facilities' => $facilities,
      'roadstation' => $roadstation[0]
    ]);
  }
  // 道の駅作成：確認
  public function confirm(Request $request){
    $roadstation = $this->roadstation;
    return view('confirmRoadStation',[
      'request' => $request->get,
      'roadstation' => $roadstation
    ]);
  }
  // 道の駅作成：登録
  public function store(Request $request){
    dd($request);
    $this->service->store($request);
    return redirect('/');
  }
  // 道の駅編集
  public function edit($cid){
    $equipments = MstFacility::orderBy('id','asc')->get();
    $facilities = MstEquipments::orderBy('id','asc')->get();
    $roadstation = $this->service->edit($cid);
    return view('editRoadStation',[
      'equipments' => $equipments,
      'facilities' => $facilities,
      'roadstation' => $roadstation
    ]);
  }
  // 道の駅編集：更新
  public function update(Request $request){
    $this->service->update($request);
    return redirect('/');
  }
  // 道の駅削除
  public function delete($zpx_id){
    Log::Debug($zpx_id);
    $this->service->changeDeleteFlg($zpx_id,1);
    $version = new DataVersionService();
    $version->update();
    return redirect('/');
  }
  public function restore($zpx_id){
    Log::Debug($zpx_id);
    $this->service->changeDeleteFlg($zpx_id,0);
    $version = new DataVersionService();
    $version->update();
    return redirect('/show_deleted_roadstation');
  }
  public function show($zpx_id){
    $equipments = MstEquipments::orderBy('id','asc')->get();
    // dd($equipments->where('id','01')[0]['name']);
    // $facilities = MstEquipments::orderBy('id','asc')->get();
    $roadstation = $this->service->show($zpx_id);
    // dd($equipments[0]);
    return view('showRoadStation',[
      'equipments' => $equipments,
      'roadstation' => $roadstation,
    ]);
  }
}
