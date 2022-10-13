<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('get_roadstations',[APIController::class,'getRoadstations']);
Route::get('get_roadstation_light',[APIController::class,'getRoadstationsLight']);
Route::get('get_roadstation_detail/{ZPX_ID}',[APIController::class,'getRoadstationDetail']);
Route::get('get_roadstation_event/{ZPX_ID}',[APIController::class,'getRoadstationEvent']);
Route::get('get_facilities/{ZPX_ID}',[APIController::class,'getFacilities']);
Route::get('get_facility_detail',[APIController::class,'getFacilityDetail']);
Route::get('get_rv_parks',[APIController::class,'getRvParks']);
Route::get('get_rv_roadstation',[APIController::class,'getRvRoadstation']);
Route::get('get_database_version',[APIController::class,'getDatabaseVersion']);