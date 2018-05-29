<?php

/**
 * Route untuk admin
 */

Route::group('super-admin',['namespace' => 'Admin'], function(){
    Route::get('/pintu','Auth/AuthController@index')->name('admin.auth.index');
    Route::get('/pintu/masuk','Auth/AuthController@auth')->name('admin.auth.login');
    Route::get('/pintu/keluar','Auth/AuthController@logout')->name('admin.auth.logout');
    
    // Route::post();
    // Route::get();
    
    Route::group('/', ['middleware' => 'AdminMiddleware'],function(){
        Route::get('/','AdminController@index')->name('admin.dashboard');
    });
});