<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('/app/settings')->group(function() {
    Route::get('/', 'SettingsController@index')->middleware('auth:admin');
    // Route::post('/list','SettingsController@ajax_list')->middleware('auth:admin');
    Route::post('/','SettingsController@store')->middleware('auth:admin');
    // Route::get('/create','SettingsController@create')->middleware('auth:admin');

    Route::get('/admin_nav', 'SettingsController@index_admin_nav')->middleware('auth:admin');
    Route::post('/admin_nav', 'SettingsController@store_admin_nav')->middleware('auth:admin');
    Route::post('/admin_nav/update_order', 'SettingsController@update_admin_nav_order')->middleware('auth:admin');
    Route::post('/admin_nav/{nav}', 'SettingsController@update_admin_nav')->middleware('auth:admin');
    Route::get('/admin_nav/{nav}', 'SettingsController@get_nav_by_id')->middleware('auth:admin');
    
});
Route::get('/app/array', 'SettingsController@edit');
Route::get('/app/themes', 'SettingsController@themes')->middleware('auth:admin');
