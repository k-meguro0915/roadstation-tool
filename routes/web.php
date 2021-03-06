<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoadStationController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\ListRoadStationController;
use App\Http\Controllers\ListFacilityController;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\HomeController;

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
Route::get('/',[HomeController::class,'index']);
Route::get('/roadstations',[ListRoadStationController::class,'index']);
Route::get('/facilities',[ListFacilityController::class,'index']);
Route::get('/facilities/show/{UID}',[FacilityController::class,'show']);
Route::get('/facilities/edit/{UID}',[FacilityController::class,'edit']);
Route::post('/facilities/edit/store',[FacilityController::class,'update']);
Route::get('/facilities/delete/{UID}',[FacilityController::class,'delete']);
Route::get('/facilities/restore/{UID}',[FacilityController::class,'restore']);
Route::get('/create_facility',[FacilityController::class,'create']);
Route::post('/create_facility/store',[FacilityController::class,'store']);
Route::get('/create_roadstation',[RoadStationController::class,'index']);
Route::post('/create_roadstation/confirm',[RoadStationController::class,'confirm']);
Route::post('/create_roadstation/store',[RoadStationController::class,'store']);
Route::get('/edit_roadstation/{CID}',[RoadStationController::class,'edit']);
Route::put('/edit_roadstation/update',[RoadStationController::class,'store']);
Route::get('/delete_roadstation/{CID}',[RoadStationController::class,'delete']);
Route::get('/show_roadstation/{CID}',[RoadStationController::class,'show']);
Route::get('/show_deleted_roadstation',[ListRoadStationController::class,'showDeleted']);
Route::get('/show_deleted_facilities',[ListFacilityController::class,'showDeleted']);
Route::get('/restore_roadstation/{ZPX_ID}',[RoadStationController::class,'restore']);

Route::get('/import_csv', [CsvController::class,'index']);
Route::post('/import_csv/confirm',[CsvController::class,'confirm']);
Auth::routes();