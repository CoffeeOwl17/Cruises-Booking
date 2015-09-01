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
			<li class="active">Signup</li>
		</ol>
		<h3 align="center">Please complete the form <span class="label label-default">New Member</span></h3>
		<form class="form-horizontal" method="post">
			<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
			<div class="form-group">
				<label for="inputLogin" class="col-sm-2 control-label">Login as</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="inputLogin" name="inputLogin" readonly="readonly" value="{!! $type !!}">
				</div>
			</div>
			<div class="form-group">
				<label for="inputOAuth" class="col-sm-2 control-label">OAuth ID</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="inputOAuth" name="inputOAuth" readonly="readonly" value="{!! $ID !!}">
				</div>
			</div>
			<div class="form-group">
				<label for="inputName" class="col-sm-2 control-label">Name</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="inputName" name="inputName" value="{!! $Name !!}">
				</div>
			</div>
			<div class="form-group">
				<label for="inputGender" class="col-sm-2 control-label">Gender</label>
				<div class="col-sm-10">
				  <label class="radio-inline"><input type="radio" name="optGender" value="male" checked="true">Male</label>
				  <label class="radio-inline"><input type="radio" name="optGender" value="female" >Female</label>
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail" class="col-sm-2 control-label">Email</label>
				<div class="col-sm-10">
				  <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email">
				</div>
			</div>
			<div class="form-group">
				<label for="inputAddress" class="col-sm-2 control-label">Address</label>
				<div class="col-sm-10">
					<textarea class="form-control" id="inputAddress" name="inputAddress" rows="3" placeholder="Address"></textarea>
				</div>
			</div>
			<div class="form-group">
				<div align="center">
				  <a href='/logout' class='btn btn-default' onclick="signOut();">
		            <font>Back</font>
		          </a>
				  <input type="submit" value="Sign in" class="btn btn-danger"/>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection