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

// Route::middleware('auth:api')->get('/cms', function (Request $request) {
//     return ['status'=>true];
// });

Route::get('/cms', function (Request $request) {
    return ['status'=>true];
});
Route::post('/login', 'Api\PageController@login');

Route::middleware('auth:api')->get('/user', 'Api\PageController@create');

Route::post('/user', 'Api\PageController@store');

// Route::middleware('auth:api')->get('/{slug}', 'Api\PageController@index');

Route::get('/{slug}', 'Api\PageController@index');