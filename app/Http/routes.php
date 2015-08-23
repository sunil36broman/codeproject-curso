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
    return view('app');
});

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});	

Route::group(['middleware' => 'oauth'], function () {		
	Route::resource('client', 'ClientController', ['except' => ['create', 'edit']]);
	Route::resource('project', 'ProjectController', ['except' => ['create', 'edit']]);
	Route::resource('project.note', 'ProjectNoteController', ['except' => ['create', 'edit']]);	
	Route::resource('project.task', 'ProjectTaskController', ['except' => ['create', 'edit']]);
	Route::resource('project.member', 'ProjectMemberController', ['except' => ['create', 'edit', 'update']]);
	Route::resource('project.file', 'ProjectFileController', ['except' => ['create', 'edit']]);

	/**
	 *  Na video-aula não está assim, mas na hora de avaliar o projeto fase-4 estão usando
	 *  desta forma =P
	 *
	 * @see  http://prntscr.com/8649ze
	 *  
	 */
	Route::resource('project/file', 'FileController', ['except' => ['create', 'edit']]);		
});
