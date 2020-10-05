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

Route::prefix('admin/users')->group(function() {
    Route::get('/','AdminController@index')->middleware('auth:admin');
    Route::post('/list','AdminController@ajax_list');
    Route::post('/','AdminController@store');
    Route::get('/view/{user}','AdminController@show')->middleware('auth:admin');
    Route::get('/{user}','AdminController@edit')->middleware('auth:admin');
    Route::post('/{user}','AdminController@update');
});


Route::prefix('/admin/roles')->group(function() {
    Route::get('/','RoleController@index')->middleware('auth:admin');
    Route::post('/list','RoleController@ajax_list');
    Route::post('/','RoleController@store');
    Route::get('/view/{role}','RoleController@show')->middleware('auth:admin');
    Route::get('/{role}','RoleController@edit')->middleware('auth:admin');
    Route::post('/{role}','RoleController@update');
});


Route::prefix('/admin/permissions')->group(function() {
    Route::get('/','PermissionController@index')->middleware('auth:admin');
    Route::post('/list','PermissionController@ajax_list');
    Route::post('/','PermissionController@store');
    Route::get('/view/{permission}','PermissionController@show')->middleware('auth:admin');
    Route::get('/{permission}','PermissionController@edit')->middleware('auth:admin');
    Route::post('/{permission}','PermissionController@update');
});

