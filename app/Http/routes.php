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

Route::get('/', function () {
    return view('welcome');
});

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

//Route::group(['middleware' => 'oauth'], function () {
	Route::resource('client', 'ClientController', ['except' => ['creat', 'edit']]);

	Route::resource('project', 'ProjectController', ['except' => ['creat', 'edit']]);

	Route::group(['prefix' => 'project'], function (){
		Route::get('{project}/note', 'ProjectNoteController@index');
		Route::post('{project}/note', 'ProjectNoteController@store');
		Route::get('{project}/note{note}', 'ProjectNoteController@show');
		Route::put('note/{note}', 'ProjectNoteController@update');
		Route::delete('note/{note}', 'ProjectNoteController@destroy');
	});
//});
