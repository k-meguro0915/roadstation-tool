@extends('template')
@section('title','付帯施設詳細')
@section('description','ディスクリプション')

@section('content')
	<div class="my-5">
      <div>
        <span>{{ $facility['name_furi'] }}</span>
        <h3>{{ $facility['name'] }}</h3>
      </div>
    <h3>基本情報</h3>
    <table class="table">
      <thead>
        <tr>
          <th>施設カテゴリーコード</th>
          <th>{{ $facility['facility_category_code'] }}</th>
        </tr>
        <tr>
          <th>施設コード</th><th>{{ $facility['category_code'] }}</th>
        </tr>
        <tr>
          <th>カテゴリーコード</th><th>{{ $facility['facility_code'] }}</th>
        </tr>
        <tr>
          <th>名称</th><th>{{ $facility['name'] }}</th>
        </tr>
        <tr>
          <th>名称（カナ）</th><th>{{ $facility['name_furi'] }}</th>
        </tr>
        <tr>
          <th>概要</th><th>{{ $facility['description'] }}</th>
        </tr>
        <tr>
          <th>イチオシ名称</th><th>{{ $facility['recommendation_name'] }}</th>
        </tr>
        <tr>
          <th>イチオシ説明</th><th>{{ $facility['recommendation_desc'] }}</th>
        </tr>
        <tr>
          <th>定休日</th><th>{{ $facility['regular_holiday'] }}</th>
        </tr>
        <tr>
          <th>定休日補足1</th><th>{{ $facility['holiday_supplement1'] }}</th>
        </tr>
        <tr>
          <th>定休日補足2</th><th>{{ $facility['holiday_supplement2'] }}</th>
        </tr>
        <tr>
          <th>電話番号・問い合わせ先</th><th>{{ $facility['tel'] }}</th>
        </tr>
        <tr>
          <th>電話番号補足</th><th>{{ $facility['tel_supplement'] }}</th>
        </tr>
        <tr>
          <th>場所</th><th>{{ $facility['place'] }}</th>
        </tr>
        <tr>
          <th>料金</th><th>{{ $facility['price'] }}</th>
        </tr>
        <tr>
          <th>詳細（外部リンク）</th><th>{{ $facility['detail_link'] }}</th>
        </tr>
        <tr>
          <th>施設備考</th><th>{{ $facility['remarks'] }}</th>
        </tr>
      </thead>
    </table>
    <h3>営業情報</h3>
    @if(empty($businesshours))
    <p>営業情報はありません。</p>
    @else
      <table class="table">
        <thead>
          @foreach($businesshours as $key => $item)
          <tr>
            <th>営業時間{{$key + 1}}</th>
            <th>
            {{ $businesshours[$key]['start_time'] }}～{{ $businesshours[$key]['end_time'] }}
            </th>
          </tr>
          <tr>
            <th>営業時間補足{{$key + 1}}</th>
            <th>
              {{ $businesshours[$key]['time_supplement'] }}
            </th>
          </tr>
          @endforeach
        </thead>
      </table>
    @endif
    <h3>決済手段</h3>
    <table class="table">
      <thead>
        <tr>
          <th>クレジットカード</th>
          <th>
            @if(!empty($payment['is_pay_to_credit']))
            〇
            @else
            ×
            @endif
          </th>
        </tr>
        <tr>
          <th>電子マネー</th>
          <th>
            @if(!empty($payment['is_pay_to_e_money']))
            〇
            @else
            ×
            @endif
          </th>
        </tr>
        <tr>
          <th>バーコード決済</th>
          <th>
            @if(!empty($payment['is_pay_to_barcode']))
            〇
            @else
            ×
            @endif
          </th>
        </tr>
        <tr>
          <th>その他</th>
          <th>
            @if(!empty($payment['is_pay_to_other']))
              {{ $payment['is_pay_to_other'] }}
            @endif
          </th>
        </tr>
      </thead>
    </table>
    <h3>イベント情報</h3>
    @if(empty($events))
      <p>イベント情報はありません。</p>
    @else
      <table class="table">
        <thead>
          @foreach($events as $key => $item)
          <tr>
            <th>イベント情報{{$key + 1}}</th>
            <th>
            {{ $item }}
            </th>
          </tr>
          @endforeach
        </thead>
      </table>
    @endif
    @if(!empty($restaurant) && array_search('1',$restaurant) != false)
      <h3>飲食店情報</h3>
      <table class="table">
        <thead>
          <tr>
            <th>和食</th>
            <th>@if($restaurant['japanese_food'])〇@else × @endif</th>
          </tr>
          <tr>
            <th>洋食</th>
            <th>@if($restaurant['western_food'])〇@else × @endif</th>
          </tr>
          <tr>
            <th>中華</th>
            <th>@if($restaurant['chinese_food'])〇@else × @endif</th>
          </tr>
          <tr>
            <th>スイーツ</th>
            <th>@if($restaurant['sweets'])〇@else × @endif</th>
          </tr>
          <tr>
            <th>バー・居酒屋</th>
            <th>@if($restaurant['bar'])〇@else × @endif</th>
          </tr>
          <tr>
            <th>イートイン</th>
            <th>@if($restaurant['eat_in'])〇@else × @endif</th>
          </tr>
          <tr>
            <th>テイクアウト</th>
            <th>@if($restaurant['take_out'])〇@else × @endif</th>
          </tr>
          <tr>
            <th>ビュッフェ</th>
            <th>@if($restaurant['buffet'])〇@else × @endif</th>
          </tr>
        </thead>
      </table>
    @endif
	</div>
@endsection