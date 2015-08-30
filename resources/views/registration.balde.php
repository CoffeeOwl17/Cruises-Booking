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
<div class="container-fluid">
	<div class="container col-md-8 col-md-offset-2">
		<ol class="breadcrumb">
			<li class="active">Signup</li>
		</ol>
		<h3 align="center">Please complete the form <span class="label label-default">New Member</span></h3>
		<form class="form-horizontal">
			<div class="form-group">
				<label for="inputName" class="col-sm-2 control-label">Name</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="inputName" value="{!! $Name !!}">
				</div>
			</div>
			<div class="form-group">
				<label for="inputGender" class="col-sm-2 control-label">Gender</label>
				<div class="col-sm-10">
				  <label class="radio-inline"><input type="radio" name="optGender" checked="true">Male</label>
				  <label class="radio-inline"><input type="radio" name="optGender">Female</label>
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail" class="col-sm-2 control-label">Email</label>
				<div class="col-sm-10">
				  <input type="email" class="form-control" id="inputEmail" placeholder="Email">
				</div>
			</div>
			<div class="form-group">
				<label for="inputAddress" class="col-sm-2 control-label">Address</label>
				<div class="col-sm-10">
					<textarea class="form-control" rows="3" placeholder="Address"></textarea>
				</div>
			</div>
			<div class="form-group">
				<div align="center">
				  <button type="submit" class="btn btn-default">Sign in</button>
				</div>
			</div>
		</form>
	</div>
</div>
{!! $Name !!}
{!! $ID !!}
<a href="/logout" onclick="signOut();">logout</a>
@endsection