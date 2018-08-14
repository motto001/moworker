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

Route::get('/', function () {
    return view('welcome');
});
Route::any('test/viewM', 'ControllerM@ViewM');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin', 'Admin\AdminController@index');

//workadmin---------------------------------------------------------------
Route::group(['prefix' => '/workadmin', 'middleware' => ['auth', 'roles'], 'roles' => 'workadmin'], function () {

    Route::resource('/workertimes', 'Workadmin\\WorkertimesController');
    Route::resource('/workerdays', 'Workadmin\\WorkerdaysController');

    Route::any('/wroles/addtime/{wroleid}', 'Workadmin\\WrolesController@addtime');
    Route::any('/wroles/deltime/{timeid}/{wroleid}', 'Workadmin\\WrolesController@deltime');
});
//worker---------------------------------------------------------------
Route::group(['prefix' => '/worker', 'middleware' => ['auth', 'roles'], 'roles' => 'worker'], function () {
    Route::resource('/workertimes', 'Worker\\WorkertimesController');
    Route::resource('/workerdays', 'Worker\\WorkerdaysController');
    Route::resource('/naptar', 'Worker\\NaptarController');

});
