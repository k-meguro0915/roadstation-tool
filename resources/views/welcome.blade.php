@extends('template')
@section('title','道の駅DBツール|ログイン')
@section('description','ディスクリプション')

@section('content')
	<div class="my-5">
    <form >
      <h1 class="text-center">ログイン</h1>
      <label for="formControlInput" class="form-label">login user</label>
      <input type="text" class="form-control" id="formControlInput" placeholder="">
      <label for="formControlInput" class="form-label">password</label>
      <input type="password" class="form-control" id="formControlInput" placeholder="">
      <button type="submit" class="btn btn-primary mt-3">ログイン</button>
    </form>
	</div>
@endsection