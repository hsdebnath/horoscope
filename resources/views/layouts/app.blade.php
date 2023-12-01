<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

    
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>{{ config('app.name', 'H0R0SC0P3') }}</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('asset/favicon.ico') }}" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('asset/css/styles.css') }}" rel="stylesheet" />

        <script type="text/javascript">
            $(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });

            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
                })
          </script>

    </head>
    <body id="page-top">  

		<nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
		  <div class="container-fluid">
		    <a class="navbar-brand"><img src="https://static.thenounproject.com/png/1942107-200.png" width="50" style="filter: invert(100%)" />&nbsp;Horscope</a>
		    <form class="d-flex" role="search" method = "POST" action="{{route('year_filter')}}">
		    	@csrf
		      <input class="form-control me-2" type="search" name ="year" placeholder="Zodiac Year (YYYY)" aria-label="Zodiac Year" value="{{old('year')}}">
		      <button class="btn btn-primary" type="submit">Find!</button>
		    </form> 
		  </div>
		</nav>

		<!-- Content Section -->
		<div class="container">
		    @yield('content')
		</div>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('asset/js/scripts.js') }}"></script>

    </body>
</html>
