<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

session_start();

class index_controller extends Controller
{
    public function index(){
    	if(isset($_SESSION['login_type'])){
    		return redirect('/home');
    	}
    	else{
    		return view('index');
    	}
    }
}
