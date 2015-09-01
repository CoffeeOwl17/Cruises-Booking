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
</script>
@endsection


@section('content')
<style>
#logout{
	margin-top: 30px;
	/*margin-bottom: -50px;	*/
}
</style>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6">
			<h1>Crunard Line <small>Largest Cruise Operator In The Word</small></h1> 
		</div>
		<div class="col-md-6" align="right">
			<button id="logout" class="btn btn-default">Logout</button> 
		</div>
	</div>
</div>
<hr/>
<div class="container-fluid">
	<div class="jumbotron">
		<div class="container-fluid">
			<h3>Choose a package</h3>
		</div>
	</div>
</div>
{!! $Name !!}
{!! $ID !!}
<a href="/logout" onclick="signOut();">logout</a>
@endsection