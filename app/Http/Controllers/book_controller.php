<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App;

session_start();

class book_controller extends Controller
{
    public function index(){
    	$_SESSION['cruise_select'] = $_POST['cruiseOption'];
    	return view('Book.book_cruise');
    }

    public function setInfo(){
    	$cruise = App\cruise::where('cruise_id', $_SESSION['cruise_select'])->first();
    	$stateroom = App\stateroom::where('stateroom_id', $_POST['stateroomOption'])->first();
    	$num_stateroom = $_POST['numStateroomOption'];
    	$num_guest = $_POST['guestOption'];
    	$total = $cruise->price + ($stateroom->price * $num_stateroom) + ($num_guest * 100);
    	$gst = round($total*0.06,2);
    	$grand_total = $total + $gst;
    	$data = array(
    		"cruise" 		=> $cruise,
    		"stateroom"		=> $stateroom,
    		"num_stateroom" => $num_stateroom,
    		"num_guest"		=> $num_guest,
    		"total"			=> $total,
    		"gst"			=> $gst,
    		"grand_total"	=> $grand_total
    		);

    	$_SESSION['stateroom'] 		= $stateroom->stateroom_id;
    	$_SESSION['num_stateroom'] 	=$num_stateroom;
    	$_SESSION['num_guest'] 		=$num_guest;
    	return view('Book.payment', $data);
    }

    public function makePayment(){
    	$record = new App\user_cruise;
    	$record->oauthID = $_SESSION['user_id'];
    	$record->cruise_id = $_SESSION['cruise_select'];
    	$record->stateroom_id = $_SESSION['stateroom'];
    	$record->num_guest = $_SESSION['num_guest'];
    	$record->num_stateroom = $_SESSION['num_stateroom'];

    	$saved = $record->save();
    	if($saved){
    		return redirect('/');
    	}
    	else{
    		return ('booking fail');
    	}
    }
}
