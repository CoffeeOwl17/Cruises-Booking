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

.normal-label{
	font-weight: normal !important;
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
				<form class="form-horizontal" method="post" action="/book/confirm">
					<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
					<div class="form-group">
						<label class="col-sm-4 control-label">Cruise</label>
						<div class="col-sm-4">
							<label class="control-label normal-label"><i>{!! $cruise['cruise'] !!}</i></label>	
						</div>
						<div class="col-sm-4">
							<label class="control-label normal-label"><i>RM {!! $cruise['price'] !!}</i></label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label">Stateroom</label>
						<div class="col-sm-4">
							<label class="control-label normal-label"><i>{!! $stateroom['stateroom'] !!}</i></label>
						</div>
						<div class="col-sm-4">
							<label class="control-label normal-label"><i>RM {!! $stateroom['price'] !!} * {!! $num_stateroom !!}</i></label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label">Guest</label>
						<div class="col-sm-4">
							<label class="control-label normal-label"><i>{!! $num_guest !!} guest(s)</i></label>
						</div>
						<div class="col-sm-4">
							<label class="control-label normal-label"><i>RM 100 * {!! $num_guest !!}</i></label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-8 control-label">Total</label>
						<div class="col-sm-4">
							<label class="control-label"><i>RM {!! $total !!}</i></label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-8 control-label">GST</label>
						<div class="col-sm-4">
							<label class="control-label"><i>RM {!! $gst !!}</i></label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-8 control-label">Grand Total</label>
						<div class="col-sm-4">
							<label class="control-label"><i>RM {!! $grand_total !!}</i></label>
						</div>
					</div>
					<div class="form-group">
    					<div class="col-sm-offset-5 col-sm-6">
							<button type="submit" class="btn btn-default">Confirm</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection