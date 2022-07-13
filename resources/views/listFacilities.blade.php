@extends('template')
@section('title','付帯施設一覧')
@section('description','ディスクリプション')

@section('content')
	<div class="my-5">
    <h2 class="mb-5">付帯施設一覧</h2>
    <div id="search-form" class="mb-5">
      <form action="" method="GET">
        <label for="formControlInput" class="form-label">施設名</label>
        <input name="facility_name" type="text" class="form-control" id="formControlInput" placeholder="あいまい検索">
        <div class="text-right">
          <button type="submit" class="btn btn-success my-2 ">検索</button>
        </div>
      </form>
    </div>
    <div class="mb-5">
      <p class="d-inline">総数{{$count}}件</p>
      <a class="d-inline float-right" href="/show_deleted_facilities"><button class="btn btn-primary">削除された付帯施設</button></a>
      <a class="d-inline float-right mx-5" href="/create_facility"><button class="btn btn-primary">新規登録</button></a>
    </div>
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
						<a href="/facilities/edit/{{$item['UID']}}" class="btn btn-primary">編集</a>
						<a href="/facilities/delete/{{$item['UID']}}" class="btn btn-danger">削除</a>
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