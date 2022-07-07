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
    $this->middleware('auth');
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
  public function showDeleted(){
    $facilities = $this->service->deletedList();
    // $count = $this->service->count();
    // dd($facilities[0]->getAttributes());
    return view('listFacilitiesDelete',[
        'facilities' => $facilities,
    ]);
  }
}
