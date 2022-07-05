@include('head')
@include('nav')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		@yield('head')
	</head>
	<body>
		@yield('navigation')
    @if (session('flash_message'))
      <div class="flash_message alert alert-primary text-center" role="alert">
        {{ session('flash_message') }}
      </div>
    @elseif(session('error_message'))
      <div class="error_message alert alert-danger text-center" role="alert">
        {{ session('error_message') }}
      </div>
    @endif
		<div class="container">
			@yield('content')
		</div>
		<footer>
			<script src="{{ mix('js/app.js') }}"></script>
			<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
      @yield('script')
		</footer>
	</body>
</html>