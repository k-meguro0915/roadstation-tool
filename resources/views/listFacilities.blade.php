@extends('template')
@section('title','付帯施設一覧')
@section('description','ディスクリプション')

@section('content')
	<div class="my-5">
    <h2 class="mb-5">付帯施設一覧</h2>
    <p>総数{{$count}}件</p>
		<table class="table">
			<thead>
				<tr>
					<th scope="col">紐づけZPX_ID</th>
					<th scope="col">UID</th>
					<th scope="col">カテゴリID</th>
					<th scope="col">施設名称</th>
					<th scope="col">編集/削除</th>
				</tr>
			</thead>
			<tbody>
				@foreach($facilities as $key => $value)
        @php
          $item = $value->getAttributes();
        @endphp
				<tr>
					<td>{{ $item['ZPX_ID'] }}</td>
					<td>{{ $item['UID'] }}</td>
					<td>{{ $item['category_code'] }}</td>
					<td><a href="/facilities/show/{{$item['UID']}}">{{ $item['name'] }}</a></td>
					<td>
						<a href="/edit_facility/{{$item['UID']}}" class="btn btn-primary disabled">編集</a>
						<a href="/delete_facility/{{$item['UID']}}" class="btn btn-danger">削除</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
    <div id="pagenation" class="w-50 mx-auto">
      {{ $facilities->links() }}
    </div>
	</div>
@endsection