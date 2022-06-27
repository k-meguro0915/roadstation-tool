@extends('template')
@section('title','道の駅一覧')
@section('description','ディスクリプション')

@section('content')
	<div class="my-5">
    <h2 class="mb-5">道の駅一覧</h2>
    <div class="mb-5">
      <p class="d-inline">総数{{$count}}件</p>
      <a class="d-inline float-right" href="/show_deleted_roadstation"><button class="btn btn-primary">削除された道の駅</button></a>
      <a class="d-inline float-right mx-5" href="/create_roadstation"><button class="btn btn-primary">新規登録</button></a>
    </div>
		<table class="table">
			<thead>
				<tr>
					<th scope="col">ZPX_ID</th>
					<th scope="col">道の駅 名称</th>
					<th scope="col">登録年</th>
					<th scope="col">編集/削除</th>
				</tr>
			</thead>
			<tbody>
				@foreach($road_station as $key => $value)
        @php
          $item = $value->getAttributes();
        @endphp
				<tr>
					<td>{{ $item['ZPX_ID'] }}</td>
					<td><a href="/show_roadstation/{{$item['ZPX_ID']}}">{{ $item['name'] }}</a></td>
					<td>{{ $item['registry_year'] }}</td>
					<td>
						<a href="/edit_roadstation/{{$item['ZPX_ID']}}" class="btn btn-primary disabled">編集</a>
						<a href="/delete_roadstation/{{$item['ZPX_ID']}}" class="btn btn-danger">削除</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
    <div id="pagenation" class="w-50 mx-auto">
      {{ $road_station->links() }}
    </div>
	</div>
@endsection