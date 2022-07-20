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
use App\Services\DataVersionService;
class CsvController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index(){
    return view('importCsv');
  }
  public function confirm(Request $request){
    $service = new ImportCsvService;
    $ret = false;
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
      if(count($fileHeader) != 100) return false;
      $ret = $service->bulkInsertRoadstation($users);
    } else {
      if(count($fileHeader) != 49) return false;
      $ret = $service->bulkInsertFacility($users);
    }
    if($ret){
      $version = new DataVersionService();
      $version->update();
    }
    Storage::delete($upload_file_name);
    return redirect('/')->with('flash_message','CSVのインポートが完了しました。');;
  }
}