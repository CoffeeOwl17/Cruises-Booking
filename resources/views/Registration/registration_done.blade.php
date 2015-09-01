@extends('app')

@section('include')
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="https://apis.google.com/js/api:client.js"></script>
@endsection

@section('script')
<script>
	var auth2;
	gapi.load('auth2', function() {
	  auth2 = gapi.auth2.init({
	    client_id: '1058358629596-g4u9j540pt7vq8n4a2ogshrj80uis7ve.apps.googleusercontent.com',
	    fetch_basic_profile: false,
	    scope: 'profile'
	  });
	});

	function signOut() {
		auth2 = gapi.auth2.getAuthInstance();
		auth2.signOut().then(function () {
		  console.log('User signed out.');
		});
	}

	$(function(){
		$( ".form-horizontal" ).submit(function( e ) {
			var name = $.trim($("#inputName").val());
			var email = $.trim($("#inputEmail").val());
			var address = $.trim($("#inputAddress").val());
			if(name == '' || email == '' || address == ''){
				alert("All field are required to enter.");
				e.preventDefault();	
			}
		});
	});
</script>
@endsection


@section('content')
<div class="container-fluid">
	<div class="container col-md-8 col-md-offset-2">
		<ol class="breadcrumb">
			<li>Signup</li>
			<li class="active">Complete</li>
		</ol>
		<h2 align="center">Congratulation</h2>
		<h3 align="center">You has successfully registered as member</h3>
		<h4 align="center"><a href="/home">Click here to enter</a></h4>
	</div>
</div>
@endsection