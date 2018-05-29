<?php

/**
 * Route untuk admin
 */

Route::group('super-admin',['namespace' => 'admin'], function(){
    // Route::get()->name('auth.login');
    // Route::post();
    // Route::get();
    
    Route::group('dashboard',['middleware' => ['admin.auth']], function(){

    });
});