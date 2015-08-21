<!doctype html>
<html lang="en">
	<head>
		<title>Cruises Booking System</title>
		<meta name="_token" content="{{ csrf_token() }}"/>
		<script type="text/javascript" src="{{ URL::asset('js/jquery-2.1.4.min.js') }}"></script>
		<link href="{{ URL::asset('css/bootstrap-3.3.5-dist/css/bootstrap.min.css') }}" rel="stylesheet" />	
		<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
		@yield('include')
	</head>
	<body>
		@yield('content')
	</body>
</html>