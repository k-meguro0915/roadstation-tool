<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Goodby\CSV\Import\Standard\LexerConfig;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Illuminate\Support\Facades\Log;
use App\Services\ImportCsvService;
class CsvController extends Controller
{
  public function index(){
    return view('importCsv');
  }
  public function confirm(Request $request){
    $service = new ImportCsvService;
    $type = $request->input('type');
    $upload_file_name = Storage::disk('public')->putFileAs('files', $request->file('file'),'roadstation_basic_info.txt');// ファイル内容取得
    $csv = Storage::disk('local')->get('public/' . $upload_file_name);
    $csv = str_replace(array("\r\n","\r"), "\n", $csv);
    $data = collect(explode("\n", $csv));
    $fileHeader = collect(explode(",", $data->shift()));
    try {
      $users = $data->map(function ($item, $key) use ($fileHeader){
        return preg_split("/(?!\".*,.*$\"$),/", $item);
      });
    } catch (Exception $e) {
      throw new Exception("項目数エラー");
    }
    if($type == 0){
      if(count($fileHeader) != 99) return false;
      $service->bulkInsertRoadstation($users);
    } else {
      if(count($fileHeader) != 49) return false;
      $service->bulkInsertFacility($users);
    }
    Storage::delete($upload_file_name);
    return redirect('/');
  }
}