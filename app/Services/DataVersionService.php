<?php

namespace App\Services;
use Illuminate\Support\Facades\Log;
use App\Models\DataVersion;
use Illuminate\Http\Request;

class DataVersionService
{
  public function update(){
    $data_version = DataVersion::get('version');
    $current_version = $data_version[0]->getAttributes()['version'];
    $update_version = $current_version + 1;
    DataVersion::where('version',$current_version)->update([
      'version' => $update_version
    ]);
  }
  public function get(){
    // $ret;
    $ret = DataVersion::get('version')[0]->getAttributes()['version'];
    return  $ret;
  }
}