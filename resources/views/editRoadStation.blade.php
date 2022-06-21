@extends('template')
@section('title','道の駅情報更新')
@section('description','ディスクリプション')

@section('content')
	<div class="my-5">
		<h2>道の駅情報更新</h2>
		<form action="/edit_roadstation/update" method="POST">
			@method('PUT')
			@csrf
			<!-- 共通フォーム呼び出し -->
			@include('components.form')
			<div class="form-group">
				<button type="button" onclick="submit()" class="btn btn-primary mb-2 mt-2">更新</button>
			</div>
		</form>
	</div>
@endsection