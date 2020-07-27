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

Route::prefix('admin')->group(function() {
    Route::get('/login','AdminAuthController@index')->middleware('guest:admin')->name('admin.login');
    Route::post('/login','AdminAuthController@postLogin');
    Route::get('/dashboard','AdminAuthController@getDashboard')->middleware('auth:admin')->name('admin.dashboard');
    Route::get('/logout','AdminAuthController@logout');
});

Route::get('/create','AdminAuthController@create');
