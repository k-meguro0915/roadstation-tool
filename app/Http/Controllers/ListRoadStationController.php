<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Roadstasion;

// サービス呼び出し
use App\Services\RoadstationService;

class ListRoadStationController extends Controller
{
    private $service;
    public function __construct(RoadstationService $service)
    {
      $this->middleware('auth');
        $this->service = $service;
    }

    public function index(Request $request){
        if(!empty($request->roadstation_name)){
          $road_station = $this->service->search($request->roadstation_name);
        }else{
          $road_station = $this->service->get();
        }
        $count = $this->service->count();
        // dd($road_station[0]->getAttributes());
        return view('listRoadstation',[
            'road_station' => $road_station,
            'count' => $count
        ]);
    }
    public function showDeleted(){
      $road_station = $this->service->deletedList();
      // $count = $this->service->count();
      // dd($road_station[0]->getAttributes());
      return view('listRoadstationDelete',[
          'road_station' => $road_station,
      ]);
    }

}
