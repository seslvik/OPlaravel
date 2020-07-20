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

Route::get('/naftan/operplans/restore/{id}', 'Naftan\NaftanOperplanController@restore')->name('operplan.naftan.restore');

Route::group(['namespace' => 'Naftan', 'prefix' => 'naftan'], function (){
    Route::resource('operplans', 'NaftanOperplanController')->names('operplan.naftan');// +
});

Route::get('/polymir/operplans/restore/{id}', 'Polymir\PolimirOperplanController@restore')->name('operplan.polymir.restore');

Route::group(['namespace' => 'Polymir', 'prefix' => 'polymir'], function (){
    Route::resource('operplans', 'PolimirOperplanController')->names('operplan.polymir');// +
});

Route::get('/naftan/gidrants/restore/{id}', 'Naftan\NaftanGidrantController@restore')->name('gidrant.naftan.restore');

Route::group(['namespace' => 'Naftan', 'prefix' => 'naftan'], function (){
    Route::resource('gidrants', 'NaftanGidrantController')->names('gidrant.naftan');// +
});

Route::get('/polymir/gidrants/restore/{id}', 'Polymir\PolymirGidrantController@restore')->name('gidrant.polymir.restore');

Route::group(['namespace' => 'Polymir', 'prefix' => 'polymir'], function (){
    Route::resource('gidrants', 'PolymirGidrantController')->names('gidrant.polymir');// +
});

Route::get('/naftan/polygons/restore/{id}', 'Naftan\NaftanPolygonController@restore')->name('polygon.naftan.restore');

Route::group(['namespace' => 'Naftan', 'prefix' => 'naftan'], function (){
    Route::resource('polygons', 'NaftanPolygonController')->names('polygon.naftan');// +
});

Route::get('/polymir/polygons/restore/{id}', 'Polymir\PolymirPolygonController@restore')->name('polygon.polymir.restore');

Route::group(['namespace' => 'Polymir', 'prefix' => 'polymir'], function (){
    Route::resource('polygons', 'PolymirPolygonController')->names('polygon.polymir');// +
});

Route::group(['namespace' => 'User', 'prefix' => 'user'], function (){
    Route::resource('user', 'UserEditController')->names('user.admin')->only('index', 'destroy')->middleware('auth');// +
});

Route::group(['namespace' => 'Restore'], function (){
    Route::resource('restore', 'RestoreController')->names('restore')->only('index');// +
});

Route::post('/marker', 'AjaxController@markerAjax')->name('marker');

Route::post('/user-up-down', 'AjaxController@userUpDownAjax')->name('user-up-down');

Route::post('/user-admin-up-down', 'AjaxController@userAdminUpDownAjax')->name('user-admin-up-down');




