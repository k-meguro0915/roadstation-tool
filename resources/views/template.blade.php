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
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
      @yield('script')
		</footer>
	</body>
</html>