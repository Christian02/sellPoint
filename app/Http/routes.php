<?php


Route::get('/', function(){
	return view('welcome');
});



Route::group(['middleware'=> ['web'] ], function(){
	Route::get('/login',['as' => 'login','uses'=> 'AuthController@login']);
	Route::get('/handleLogin',['as'=>'handleLogin','AuthController@handleLogin']);

});


