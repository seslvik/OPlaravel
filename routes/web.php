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
//namespace Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/naftan', 'NaftanController@index')->name('naftanHome');

Route::get('/polymir', 'PolymirController@index')->name('polymirHome');


Route::group(['prefix' => 'op'], function (){
    Route::resource('operplans', 'OperplanController')->names('operplan.all');
});
