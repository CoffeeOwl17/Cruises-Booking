<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App;

class registration_controller extends Controller
{
    public function index(){
    	$oauth 		= $_POST['inputOAuth'];
    	$login	 	= $_POST['inputLogin'];
    	$name 		= $_POST['inputName'];
    	$gender 	= $_POST['optGender'];
    	$address 	= $_POST['inputAddress'];
    	$email 		= $_POST['inputEmail'];

    	$user 			= new App\user;
    	$user->name 	= $name;
    	$user->gender 	= $gender;
    	$user->address 	= $address;
    	$user->email 	= $email;
    	$user->oauthID 	= $oauth;
    	$user->loginType= $login;

    	$saved = $user->save();

    	if($saved){
    		return view('Registration.registration_done');
    	}
    	else{
    		// return redirect('/');
    		return ('fail');
    	}

    }
}
