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
        $roadstation_name = !empty($request->roadstation_name) ? $request->roadstation_name : "";
        $prefecture = !empty($request->prefecture) ? $request->prefecture : "";
        $road_station = $this->service->search($roadstation_name,$prefecture);
        // $count = $road_station->count();
        // dd($road_station[0]->getAttributes());
        return view('listRoadstation',[
            'road_station' => $road_station['result'],
            'count' => $road_station['count']
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
