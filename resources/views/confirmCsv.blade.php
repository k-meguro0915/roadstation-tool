@extends('template')
@section('title','道の駅新規登録')
@section('description','ディスクリプション')

@section('content')
	<div class="my-5">
    <table class="table">
      @foreach ($data as $key => $item)
        @foreach ( $item as $key => $element )
        <tr>
          <th>{{$element[0]}}</th><td>{{$element[1]}}</td>
        </tr>
        @endforeach
        <tr><th></th><td></td></tr>
      @endforeach
    </table>
	</div>
@endsection