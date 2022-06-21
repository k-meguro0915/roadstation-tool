@include('head')
@include('nav')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		@yield('head')
	</head>
	<body>
		@yield('navigation')
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