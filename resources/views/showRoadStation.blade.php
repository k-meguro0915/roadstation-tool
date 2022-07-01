@extends('template')
@section('title','道の駅情報更新')
@section('description','ディスクリプション')

@section('content')
	<div class="my-5">
      <div>
        <span>{{$roadstation["roadstation"][0]->name_furi}}</span>
        <h3>{{ $roadstation["roadstation"][0]->name }}</h3>
      </div>
      <h3>基本情報</h3>
      @if(!empty($roadstation["roadstation"][0]))
        <table class="table">
          <tr>
            <th class="col-md-3">ZPX-ID</th>
            <th class="col-md-7">{{$roadstation["roadstation"][0]->ZPX_ID}}</th>
          </tr>
          <tr>
            <th>CID</th>
            <th>{{$roadstation["roadstation"][0]->CID}}</th>
          </tr>
          <tr>
            <th>道の駅名称</th>
            <th>{{$roadstation["roadstation"][0]->name}}</th>
          </tr>
          <tr>
            <th>道の駅名称（カナ）</th>
            <th>{{$roadstation["roadstation"][0]->name_furi}}</th>
          </tr>
          <tr>
            <th>登録年</th>
            <th>{{$roadstation["roadstation"][0]->registry_year}}</th>
          </tr>
          <tr>
            <th>キャッチコピー</th>
            <th>{{$roadstation["roadstation"][0]->catch_copy}}</th>
          </tr>
          <tr>
            <th>説明</th>
            <th>{{$roadstation["roadstation"][0]->introduction}}</th>
          </tr>
        </table>
      @endif
      <h3>住所情報</h3>
      @if(!empty($roadstation["address"][0]))
        <table class="table">
          <tr>
            <th class="col-md-3">郵便番号</th>
            <th class="col-md-7">{{ $roadstation["address"][0]->postal_code }}</th>
          </tr>
          <tr>
            <th>住所（都道府県）</th>
            <th>{{ $roadstation["address"][0]->prefecture }}</th>
          </tr>
          <tr>
            <th>住所（市区町村以下）</th>
            <th>{{ $roadstation["address"][0]->local_address }}</th>
          </tr>
          <tr>
            <th>住所コード</th>
            <th>{{ $roadstation["address"][0]->prefecture_code }}</th>
          </tr>
          <tr>
            <th>経緯度(X)</th>
            <th>{{ $roadstation["address"][0]->latitude_x }}</th>
          </tr>
          <tr>
            <th>経緯度(Y)</th>
            <th>{{ $roadstation["address"][0]->latitude_y }}</th>
          </tr>
          <tr>
            <th>マップコード</th>
            <th>{{ $roadstation["address"][0]->map_code }}</th>
          </tr>
          <tr>
            <th>電話番号</th>
            <th>{{ $roadstation["address"][0]->tel }}</th>
          </tr>
          <tr>
            <th>標高</th>
            <th>{{ $roadstation["address"][0]->elebation }}</th>
          </tr>
        </table>
      @endif
      <h3>営業情報</h3>
      @if(!empty($roadstation["business_hour"][0]))
        <table class="table">
          <tr>
            <th class="col-md-3">営業時間</th>
            <th class="col-md-7">
              {{$roadstation["business_hour"][0]->start_time}}～{{$roadstation["business_hour"][0]->end_time}}
            </th>
          </tr>
          <tr>
            <th class="col-md-3">営業時間補足1</th>
            <th class="col-md-7">
              {{$roadstation["business_hour"][0]->time_supplement1}}
            </th>
          </tr>
          <tr>
            <th class="col-md-3">営業時間補足2</th>
            <th class="col-md-7">
              {{$roadstation["business_hour"][0]->time_supplement2}}
            </th>
          </tr>
          <tr>
            <th class="col-md-3">営業時間（観光コンテンツ用コード）</th>
            <th class="col-md-7">
              {{$roadstation["business_hour"][0]->holiday_sightseeing_code}}
            </th>
          </tr>
          <tr>
            <th class="col-md-3">定休日</th>
            <th class="col-md-7">
              {{$roadstation["business_hour"][0]->regular_holiday}}
            </th>
          </tr>
          <tr>
            <th class="col-md-3">定休日補足1</th>
            <th class="col-md-7">
              {{$roadstation["business_hour"][0]->holiday_supplement1}}
            </th>
          </tr>
          <tr>
            <th class="col-md-3">定休日補足2</th>
            <th class="col-md-7">
              {{$roadstation["business_hour"][0]->holiday_supplement2}}
            </th>
          </tr>
          <tr>
            <th class="col-md-3">定休日（観光コンテンツ用コード）</th>
            <th class="col-md-7">
              {{$roadstation["business_hour"][0]->time_sightseeing_code}}
            </th>
          </tr>
        </table>
      @endif
      <h3>道路情報</h3>
      @if(!empty($roadstation["localroad"][0]))
        <table class="table">
          <tr>
            <th class="col-md-3">立地道路種別</th>
            <th class="col-md-7">
              {{$roadstation["localroad"][0]->location_road_type}}
            </th>
          </tr>
          <tr>
            <th class="col-md-3">道路番号</th>
            <th class="col-md-7">
              {{$roadstation["localroad"][0]->road_number}}
            </th>
          </tr>
          <tr>
            <th class="col-md-3">道路名称（その他のみ）</th>
            <th class="col-md-7">
              {{$roadstation["localroad"][0]->road_name}}
            </th>
          </tr>
        </table>
      @endif
      <h3>駐車場情報</h3>
      @if(!empty($roadstation["parking"][0]))
        <table class="table">
          <tr>
            <th class="col-md-3">駐車場（大型）</th>
            <th class="col-md-7">
              {{$roadstation["parking"][0]->learge_parking_number}}台
            </th>
          </tr>
          <tr>
            <th class="col-md-3">駐車場（普通）</th>
            <th class="col-md-7">
              {{$roadstation["parking"][0]->middle_parking_number}}台
            </th>
          </tr>
          <tr>
            <th class="col-md-3">駐車場（障がい者用）</th>
            <th class="col-md-7">
              {{$roadstation["parking"][0]->disabilities_parking_number}}台
            </th>
          </tr>
        </table>
      @endif
      <h3>URL情報</h3>
      @if(!empty($roadstation["urls"][0]))
        <table class="table">
          <tr>
            <th class="col-md-3">web</th>
            <th class="col-md-7">
              {{$roadstation["urls"][0]->web}}
            </th>
          </tr>
          <tr>
            <th class="col-md-3">twitter</th>
            <th class="col-md-7">
              {{$roadstation["urls"][0]->twitter}}
            </th>
          </tr>
          <tr>
            <th class="col-md-3">facebook</th>
            <th class="col-md-7">
              {{$roadstation["urls"][0]->facebook}}
            </th>
          </tr>
          <tr>
            <th class="col-md-3">instagram</th>
            <th class="col-md-7">
              {{$roadstation["urls"][0]->instagram}}
            </th>
          </tr>
          <tr>
            <th class="col-md-3">line</th>
            <th class="col-md-7">
              {{$roadstation["urls"][0]->line}}
            </th>
          </tr>
          <tr>
            <th class="col-md-3">その他</th>
            <th class="col-md-7">
              {{$roadstation["urls"][0]->other}}
            </th>
          </tr>
        </table>
      @endif
      <h3>連絡先情報</h3>
      @if(!empty($roadstation["contact"][0]))
        <table class="table">
          <tr>
            <th class="col-md-3">調査連絡先</th>
            <th class="col-md-7">
              {{$roadstation["contact"][0]->contact_address}}
            </th>
          </tr>
          <tr>
            <th class="col-md-3">調査連絡先郵便番号</th>
            <th class="col-md-7">
              {{$roadstation["contact"][0]->postal_code}}
            </th>
          </tr>
          <tr>
            <th class="col-md-3">調査連絡先住所</th>
            <th class="col-md-7">
              {{$roadstation["contact"][0]->address}}
            </th>
          </tr>
          <tr>
            <th class="col-md-3">調査連絡先電話番号</th>
            <th class="col-md-7">
              {{$roadstation["contact"][0]->tel}}
            </th>
          </tr>
          <tr>
            <th class="col-md-3">調査連絡先FAX番号</th>
            <th class="col-md-7">
              {{$roadstation["contact"][0]->fax}}
            </th>
          </tr>
          <tr>
            <th class="col-md-3">調査連絡先担当者</th>
            <th class="col-md-7">
              {{$roadstation["contact"][0]->manager}}
            </th>
          </tr>
          <tr>
            <th class="col-md-3">調査連絡先メルアド</th>
            <th class="col-md-7">
              {{$roadstation["contact"][0]->mail}}
            </th>
          </tr>
          <tr>
            <th class="col-md-3">調査連絡先備考</th>
            <th class="col-md-7">
              {{$roadstation["contact"][0]->remarks}}
            </th>
          </tr>
        </table>
      @endif
      <h3>設備情報</h3>
      @if(!empty($roadstation["equipments"]))
        <table class="table">
          @foreach($roadstation["equipments"] as $key => $value)
            <tr>
              <th>
                {{ $equipments->where( 'id',$value['equipment_id'] )[ $value[ 'equipment_id' ] ]['name'] }}
              </th>
            </tr>
          @endforeach
        </table>
      @endif
      <h3>施設情報</h3>
      @if(!empty($roadstation["facilities"]))
        <table class="table">
          @foreach($roadstation["facilities"] as $key => $value)
            @php
              $item = $value->getAttributes();
            @endphp
            <tr>
              <th>
                <a href="/facilities/show/{{$item['UID']}}">{{$item['name']}}</a>
              </th>
            </tr>
          @endforeach
        </table>
      @endif
	</div>
@endsection