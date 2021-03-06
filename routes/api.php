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

Route::get('trails', 'TrailsController@getAll'); 
Route::get('trail/name/{name}', 'TrailsController@getTrailByName');
Route::post('trail/create', 'TrailsController@create');
Route::put('trail/update', 'TrailsController@update');
Route::put('trail/update/status', 'TrailsController@updateTrailStatus');
Route::post('trail/signup/process', 'TrailsController@processSignupSqs');
Route::post('trail/signup/process/db', 'TrailsController@processSignupDb');

Route::get('past/weather/trail/{name}', 'TrailsController@getWeather');
