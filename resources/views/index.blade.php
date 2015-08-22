@extends('app')

@section('include')
<link href="{{ URL::asset('css/IndexStyle.css') }}" rel="stylesheet" type="text/css" >
@endsection

@section('script')
<script>
$(document).ready(function() {
 });
</script>
@endsection

@section('content')
<div class="container-fluid header">
	<div class="container">
    	<h1>Welcome aboard</h1>
    	<h2>Your dream is coming true at this moment</h2>
    	<a class='btn btn-outline-inverse btn-lg' data-toggle="modal" data-target="#loginModal">
            <font> Login To Book Your Ticket Now</font>
        </a>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="myModalLabel">Login as</h4>
      		</div>
      		<div class="modal-body">
      			<div class="container-fluid">
      				<div class="row">
      					<div class="col-sm-4" id="google">
      						<i class="fa fa-google-plus-square fa-4x" id="google-icon" ></i> <label>Google Plus</label>
      					</div>
      					<div class="col-sm-4" id="facebook">
      						<i class="fa fa-facebook-square fa-4x" id="facebook-icon" ></i> <label>Facebook</label>
      					</div>
      					<div class="col-sm-4" id="twitter">
      						<i class="fa fa-twitter-square fa-4x" id="twitter-icon" ></i> <label>Twitter</label>
      					</div>
      				</div>
      			</div>
    		</div>
    		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
      		</div>
    	</div>
  	</div>
</div>
@endsection