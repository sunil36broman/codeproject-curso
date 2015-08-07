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
	Route::resource('client', 'ClientController', ['except' => ['create', 'edit']]);		
	Route::resource('project', 'ProjectController', ['except' => ['create', 'edit']]);
	Route::resource('project.note', 'ProjectNoteController', ['except' => ['create', 'edit']]);	
	Route::resource('project.task', 'ProjectTaskController', ['except' => ['create', 'edit']]);

	Route::get('project/{projectId}/member', 'ProjectController@members');
	Route::get('project/{projectId}/member/{memberId}', 'ProjectController@member');
	Route::post('project/{projectId}/member', 'ProjectController@addMember');
	Route::delete('project/{projectId}/member/{memberId}', 'ProjectController@removeMember');		
//});
