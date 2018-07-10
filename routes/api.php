<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register','RegisterController@register');
Route::group(['prefix' => 'topics'], function() {
	Route::get('/','TopicController@index');
	Route::get('/{topic}','TopicController@show');
	Route::post('/','TopicController@store')->middleware('auth:api');
	Route::patch('/{topic}','TopicController@update')->middleware('auth:api');
	Route::delete('/{topic}','TopicController@destroy')->middleware('auth:api');

	Route::group(['prefix' => '/{topic}/posts'], function() {
		Route::post('/', 'PostController@store')->middleware('auth:api');
		Route::patch('/{post}', 'PostController@update')->middleware('auth:api');
		Route::delete('/{post}', 'PostController@destroy')->middleware('auth:api');

		Route::group(['prefix' => '/{post}/likes'], function() {
			Route::post('/', 'PostLikeController@store')->middleware('auth:api');
		});
	});
});	
