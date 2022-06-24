@extends('template')
@section('title','付帯施設一覧')
@section('description','ディスクリプション')

@section('content')
	<div class="my-5">
    <h2 class="mb-5">削除した付帯施設一覧</h2>
    <div class="mb-5">
      <a class="d-inline float-right" href="/facilities"><button class="btn btn-primary">付帯施設一覧</button></a>
    </div>
		<table class="table">
			<thead>
				<tr>
					<th scope="col">紐づけZPX_ID</th>
					<th scope="col">UID</th>
					<th scope="col">カテゴリID</th>
					<th scope="col">施設名称</th>
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
					<td>{{ $item['name'] }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
    <div id="pagenation" class="w-50 mx-auto">
      {{ $facilities->links() }}
    </div>
	</div>
@endsection