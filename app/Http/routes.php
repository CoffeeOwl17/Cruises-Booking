<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'index_controller@index');
Route::get('/fb_login', 'login_controller@facebook');
Route::get('/twitter_login', 'login_controller@twitter');
Route::post('/glogin_session', 'login_controller@google_session');
Route::get('/home', 'home_controller@index');
Route::post('/home', 'registration_controller@index');
Route::post('/book', 'book_controller@index');
Route::post('/book/payment', 'book_controller@setInfo');
Route::post('/book/confirm', 'book_controller@makePayment');
Route::get('/logout', 'logout_controller@index');


