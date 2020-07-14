<?php

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/register-ok', function () {
    return view('auth.register-ok');
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

Route::group(['namespace' => 'Naftan', 'prefix' => 'naftan'], function (){
    Route::resource('gidrants', 'NaftanGidrantController')->names('gidrant.naftan');// +
});

Route::group(['namespace' => 'Polymir', 'prefix' => 'polymir'], function (){
    Route::resource('gidrants', 'PolymirGidrantController')->names('gidrant.polymir');// +
});

Route::group(['namespace' => 'Naftan', 'prefix' => 'naftan'], function (){
    Route::resource('polygons', 'NaftanPolygonController')->names('polygon.naftan');// +
});

Route::group(['namespace' => 'Polymir', 'prefix' => 'polymir'], function (){
    Route::resource('polygons', 'PolymirPolygonController')->names('polygon.polymir');// +
});

Route::post('/marker', 'AjaxController@markerAjax')->name('marker');// +

