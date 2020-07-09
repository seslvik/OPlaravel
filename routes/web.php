<?php

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');// +

Route::get('/naftan', 'Naftan\NaftanHomeController@index')->name('naftanhome'); //открывает карту Нафтана +

Route::get('/polymir', 'Polymir\PolymirHomeController@index')->name('polymirhome');//открывает карту Полимира +


Route::group(['namespace' => 'Naftan', 'prefix' => 'naftan'], function (){
    Route::resource('operplans', 'NaftanOperplanController')->names('operplan.naftan');// +
});

Route::group(['namespace' => 'Polymir', 'prefix' => 'polymir'], function (){
    Route::resource('operplans', 'PolimirOperplanController')->names('operplan.polymir');// +
});
