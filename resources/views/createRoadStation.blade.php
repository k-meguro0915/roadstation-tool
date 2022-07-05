@extends('template')
@section('title','道の駅新規登録')
@section('description','ディスクリプション')

@section('content')
	<div class="my-5">
		<h2>道の駅新規登録</h2>
		<form action="/create_roadstation/store" method="POST">
			@csrf
			<!-- 共通フォーム呼び出し -->
			@include('components.form')
			<div class="form-group">
				<button type="submit" class="btn btn-primary mb-2 mt-2">確定</button>
			</div>
		</form>
	</div>
@endsection