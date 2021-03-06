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
			<div class="col-md-6">
				<form method="post" action="/book">
					<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
					<div class="form-group">
						<label for="selPackage">Select your journey: </label>
						<select class="form-control" name="cruiseOption">
						    <option value="C001">6 Night Japan Cruise</option>
						    <option value="C002">7 Night Southeast Asia Cruise</option>
						    <option value="C003">6 Night Malaysia Cruise</option>
						    <option value="C004">7 Night Australia Cruise</option>
						    <option value="C005">3 Night Brazil Cruise</option>
						</select>
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection