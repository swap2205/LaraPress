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

use Nwidart\Modules\Facades\Module;

Route::get('/', 'HomeController@home');

Route::prefix('admin/cms')->group(function() {
    Route::get('/list/{type?}', 'CMSController@list')->middleware('auth:admin');
    Route::post('/list','CMSController@ajax_list')->middleware('auth:admin');
    Route::post('/','CMSController@store')->middleware('auth:admin');
    Route::get('/{page}','CMSController@edit')->middleware('auth:admin');
    Route::get('/view/{page}','CMSController@show')->middleware('auth:admin');
    Route::post('/{page}','CMSController@update')->middleware('auth:admin');
});

Route::prefix('admin/page_type')->group(function() {
    Route::get('/', 'PageTypeController@index')->middleware('auth:admin');
    Route::post('/list','PageTypeController@ajax_list')->middleware('auth:admin');
    Route::post('/','PageTypeController@store')->middleware('auth:admin');
    Route::get('/{pageType}','PageTypeController@edit')->middleware('auth:admin');
    Route::get('/view/{pageType}','PageTypeController@show')->middleware('auth:admin');
    Route::post('/{pageType}','PageTypeController@update')->middleware('auth:admin');
});

Route::get('/swap','CMSController@create');

if(empty(request()->segment(2))){
    //condition to check if the route does not belong to any module
    if(!in_array(request()->segment(1),Module::all())){
        // Route::get('/{course:slug}', 'PageController@course');
        Route::get('/{slug}', 'HomeController@index');
    }
}
