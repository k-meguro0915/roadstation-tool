<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoadStationController;
use App\Http\Controllers\ListRoadStationController;
use App\Http\Controllers\ListFacilityController;
use App\Http\Controllers\CsvController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/',[ListRoadStationController::class,'index']);
Route::get('/facilities',[ListFacilityController::class,'index']);
Route::get('/facilities/show/{UID}',[ListFacilityController::class,'show']);
Route::get('/create_roadstation',[RoadStationController::class,'index']);
Route::post('/create_roadstation/confirm',[RoadStationController::class,'confirm']);
Route::post('/create_roadstation/store',[RoadStationController::class,'store']);
Route::get('/edit_roadstation/{CID}',[RoadStationController::class,'edit']);
Route::put('/edit_roadstation/update',[RoadStationController::class,'update']);
Route::get('/delete_roadstation/{CID}',[RoadStationController::class,'delete']);
Route::get('/show_roadstation/{CID}',[RoadStationController::class,'show']);
Route::get('/show_deleted_roadstation',[ListRoadStationController::class,'showDeleted']);
Route::get('/show_deleted_facilities',[ListFacilityController::class,'showDeleted']);
Route::get('/restore_roadstation/{ZPX_ID}',[RoadStationController::class,'restore']);

Route::get('/import_csv', [CsvController::class,'index']);
Route::post('/import_csv/confirm',[CsvController::class,'confirm']);