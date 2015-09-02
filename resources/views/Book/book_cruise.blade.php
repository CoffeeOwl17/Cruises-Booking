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
			<a id="logout" href="/logout" onclick="signOut();" class="btn btn-danger">logout</a>
		</div>
	</div>
</div>
<hr/>
<div class="container-fluid">
	<div class="jumbotron">
		<div class="container-fluid">
			<div class="container col-md-8 col-md-offset-2">
				<form method="post" action="/book/payment">
					<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
					<div class="form-group">
						<label for="selNumStateroom">How many Staterooms would you like to travel in: </label>
						<select class="form-control" name="numStateroomOption">
						    <option value="1">1 stateroom</option>
						    <option value="2">2 staterooms</option>
						    <option value="3">3 staterooms</option>
						    <option value="4">4 staterooms</option>
						    <option value="5">5 staterooms</option>
						</select>
					</div>
					<div class="form-group">
						<label for="selGuest">How many guets will be traveling in this stateroom: </label>
						<select class="form-control" name="guestOption">
						    <option value="1">1</option>
						    <option value="2">2</option>
						    <option value="3">3</option>
						    <option value="4">4</option>
						    <option value="5">5</option>
						</select>
					</div>
					<div class="form-group">
						<label for="selStateroom">What type of stateroomdo you want to travel in: </label>
						<select class="form-control" name="stateroomOption">
						    <option value="S001">Royal  - RM 600</option>
						    <option value="S002">Deluxe - RM 500</option>
						    <option value="S003">Grand  - RM 400</option>
						    <option value="S004">Junior - RM 300</option>
						</select>
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection