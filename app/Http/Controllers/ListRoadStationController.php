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
        $this->service = $service;
    }

    public function index(){
        $road_station = $this->service->get();
        // dd($road_station[0]->getAttributes());
        return view('welcome',[
            'road_station' => $road_station,
        ]);
    }

}
