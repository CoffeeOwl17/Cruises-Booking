<?php

namespace App\Http\Controllers;

session_start();

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Facebook;
use Config;
use Session;
use App;
use Abraham\TwitterOAuth\TwitterOAuth;



class home_controller extends Controller
{
    public function index(){
    	$user_data = "";
    	// if(Session::has('login_type')){
    	// 	$_SESSION['login_type'] = Session::get('login_type');
    	// }
    	if(isset($_SESSION['login_type']))
    	{
    		if($_SESSION['login_type'] == "facebook"){

    			$fb = new Facebook\Facebook([
				  'app_id' => Config::get('facebook.appid'),
				  'app_secret' => Config::get('facebook.secret'),
				  'default_graph_version' => 'v2.2',
				  ]);

		    	$helper = $fb->getRedirectLoginHelper();

    			if(! isset($_SESSION['fb_access_token'] )){

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

					if (! isset($accessToken)) {
						if ($helper->getError()) {
							header('HTTP/1.0 401 Unauthorized');
							echo "Error: " . $helper->getError() . "\n";
							echo "Error Code: " . $helper->getErrorCode() . "\n";
							echo "Error Reason: " . $helper->getErrorReason() . "\n";
							echo "Error Description: " . $helper->getErrorDescription() . "\n";
						} else {
							header('HTTP/1.0 400 Bad Request');
							echo 'Bad request';
						}
						exit;
					}

					$oAuth2Client = $fb->getOAuth2Client();

					$tokenMetadata = $oAuth2Client->debugToken($accessToken);

					$tokenMetadata->validateAppId(Config::get('facebook.appid'));

					$tokenMetadata->validateExpiration();

					if (! $accessToken->isLongLived()) {
						// Exchanges a short-lived access token for a long-lived one
						try {
							$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
						} catch (Facebook\Exceptions\FacebookSDKException $e) {
							echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
							exit;
						}
					}

					$_SESSION['fb_access_token'] = (string) $accessToken;
				}

				try {
					  // Returns a `Facebook\FacebookResponse` object
					  $response = $fb->get('/me?fields=id,name,last_name', $_SESSION['fb_access_token']);
				} catch(Facebook\Exceptions\FacebookResponseException $e) {
					  echo 'Graph returned an error: ' . $e->getMessage();
					  exit;
				} catch(Facebook\Exceptions\FacebookSDKException $e) {
					  echo 'Facebook SDK returned an error: ' . $e->getMessage();
					  exit;
				}

				$user = $response->getGraphNode();

				$user_data = array(
					'type'		=> $_SESSION['login_type'],
					'Name' 		=> $user->getField('name'),
					'ID' 		=> $user->getField('id')
				);
			}
			else if($_SESSION['login_type'] == "google"){
				$user_data = array(
					'type'		=> $_SESSION['login_type'],
					'Name' 		=> $_SESSION['name'],
					'ID' 		=> $_SESSION['id']
				);
			}
			else{
				
				$request_token = [];
				$request_token['oauth_token'] = $_SESSION['oauth_token'];
				$request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];
				$connection = new TwitterOAuth(Config::get('twitter.appid'), Config::get('twitter.secret'), $request_token['oauth_token'], $request_token['oauth_token_secret']);
				$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));
				$_SESSION['access_token'] = $access_token;
				
				
				$access_token = $_SESSION['access_token'];
				$connection = new TwitterOAuth(Config::get('twitter.appid'), Config::get('twitter.secret'), $access_token['oauth_token'], $access_token['oauth_token_secret']);
				$user = $connection->get("account/verify_credentials");
				$user_data = array(
					'type'		=> $_SESSION['login_type'],
					'Name' 		=> $user->screen_name,
					'ID' 		=> $user->id
				);
			}
			$user = App\user::where('oauthID', $user_data['ID'])->first(); 
			if(is_null($user)){
				return view('Registration.registration', $user_data);
			}
			$_SESSION['user_id'] = $user_data['ID'];
			return view('home', $user_data);
		}
		else{
			return redirect("/");
		}
		
    }
}
