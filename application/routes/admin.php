<?php

/**
 * Route untuk admin
 */

Route::group('super-admin',['namespace' => 'Admin'], function(){

    ROute::group('/pintu', function(){
        Route::get('masuk','Auth/AuthController@index')->name('admin.auth.index');
        Route::get('masuk/salam','Auth/AuthController@auth')->name('admin.auth.login');
        Route::get('keluar','Auth/AuthController@logout')->name('admin.auth.logout');    

    });

    Route::group('/', ['middleware' => ['AdminMiddleware']],function(){
        Route::get('/','AdminController@index')->name('admin.dashboard');
    });
});