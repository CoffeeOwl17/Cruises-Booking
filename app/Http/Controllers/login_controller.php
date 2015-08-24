<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Facebook;
use Config;

session_start();

class login_controller extends Controller
{
    public function facebook(){
    	$fb = new Facebook\Facebook([
		  'app_id' => Config::get('facebook.appid'),
		  'app_secret' => Config::get('facebook.secret'),
		  'default_graph_version' => 'v2.2',
		  ]);

    	$helper = $fb->getRedirectLoginHelper();

    	try {
			$accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			// When Graph returns an error
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			// When validation fails or other local issues
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}

		$loginUrl = $helper->getLoginUrl('http://localhost:8000/home');

		return redirect($loginUrl);
    }
}
