<?php

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');// +

Route::get('/naftan', 'Naftan\NaftanHomeController@index')->name('naftanhome'); //открывает карту Нафтана +

Route::get('/polymir', 'Polymir\PolymirHomeController@index')->name('polymirhome');//открывает карту Полимира +


//переделать
Route::group(['prefix' => 'op'], function (){
    Route::resource('operplans', 'OperplanController')->names('operplan.all');
});
