<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>@if(session()->get('lang') == 'eng') Smack Bazar @else স্মাক বাজার @endif</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="{{ asset('frontend') }}/css/bootstrap.min.css" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="{{ asset('frontend') }}/css/slick.css" />
	<link type="text/css" rel="stylesheet" href="{{ asset('frontend') }}/css/slick-theme.css" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="{{ asset('frontend') }}/css/nouislider.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="{{ asset('frontend') }}/css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="{{ asset('frontend') }}/css/style.css" />
</head>
<body>
    
    @include('frontend.components.header')

	@yield('content')

	<!-- FOOTER -->
	@include('frontend.components.footer')
	<!-- /FOOTER -->

    <!-- jQuery Plugins -->
	<script src="{{ asset('frontend') }}/js/jquery.min.js"></script>
	<script src="{{ asset('frontend') }}/js/bootstrap.min.js"></script>
	<script src="{{ asset('frontend') }}/js/slick.min.js"></script>
	<script src="{{ asset('frontend') }}/js/nouislider.min.js"></script>
	<script src="{{ asset('frontend') }}/js/jquery.zoom.min.js"></script>
	<script src="{{ asset('frontend') }}/js/main.js"></script>
    @include('sweetalert::alert')
</body>
</html>
