@extends('app')

@section('include')
<link href="{{ URL::asset('css/IndexStyle.css') }}" rel="stylesheet" type="text/css" >
@endsection

@section('content')
<div class="container-fluid header">
	<div class="container">
    	<h1>Welcome aboard</h1>
    	<h2>Your dream is coming true at this moment</h2>
    	<a href='/login' class='btn btn-outline-inverse btn-lg'>
            <font> Login To Book Your Ticket Now</font>
        </a>
	</div>
</div>
@endsection