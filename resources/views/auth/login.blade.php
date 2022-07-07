@extends('template')
@section('title','道の駅CSV登録')
@section('description','ディスクリプション')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <h2 class="text-center my-3">ログイン</h2>
          <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="row mb-3">
                  <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('name') }}</label>
                  <div class="col-md-6">
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                      @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
              <div class="row mb-3">
                  <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                  <div class="col-md-6">
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
              <div class="row mb-0">
                  <div class="col-md-8 offset-md-4">
                      <button type="submit" class="btn btn-primary">
                          {{ __('Login') }}
                      </button>
                  </div>
              </div>
          </form>
        </div>
    </div>
</div>
@endsection
