@extends('template')
@section('title','道の駅一覧')
@section('description','ディスクリプション')

@section('content')
	<div class="my-5">
    <h2 class="mb-5">削除した道の駅一覧</h2>
    <a class="d-inline float-right mb-5" href="/"><button class="btn btn-primary">道の駅一覧</button></a>
		<table class="table">
			<thead>
				<tr>
					<th scope="col">ZPX_ID</th>
					<th scope="col">道の駅 名称</th>
					<th scope="col">登録年</th>
					<th scope="col">復元</th>
				</tr>
			</thead>
			<tbody>
				@foreach($road_station as $key => $value)
        @php
          $item = $value->getAttributes();
        @endphp
				<tr>
					<td>{{ $item['ZPX_ID'] }}</td>
					<td>{{ $item['name'] }}</td>
					<td>{{ $item['registry_year'] }}</td>
					<td>
						<a href="/restore_roadstation/{{$item['ZPX_ID']}}" class="btn btn-primary">復元</a>
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