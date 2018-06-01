<?php

/**
 * Routing untuk mengamankan dashboard admin dengan menggunakan middleware
 * Middleware bisa ditemukan di folder middleware
 * ------------------------------------------------------------------------
 * Sedikit penjelasan tentang penulisan routing
 * ------------------------------------------------------------------------
 * 
 * Contoh:
 * 
 * Route::group('super-admin', ['namespace' => 'Admin'], function(){
 * 
 * Penjelasan
 * 1. routing dengan menggunakan prefix super-admin, di url jadi localhost/super-admin
 * 2. namespace menunjukkan nama folder yang ada di controller
 * 
 * Karena di dalam group tidak bisa menggunakan namespace lagi, maka pada saat
 * 
 * Route::group('gate', function(){
 *      Route::get('in','Auth/AuthController@index')->name('admin.auth.index');
 * });
 * 
 * Tidak menggunakan namespace, melainkan langsung menuju folder yang dimaksud
 * 
 * Auth/AuthController@index -> ini menunjukkan folder Auth dengan file AuthController.php
 * dengan methode index, yang diberikan nama admin.auth.index, dimana ini untuk pemanggilan route()    
 * 
 */

Route::group('super-admin',['namespace' => 'Admin'], function(){

    Route::group('gate',['namespace' => 'Auth'],function(){
        Route::get('in','AuthController@index')->name('admin.auth.index');
        Route::get('in/auth','AuthController@auth')->name('admin.auth.login');
        Route::get('out','AuthController@logout')->name('admin.auth.logout');    

    });

    Route::group('/', ['middleware' => ['AdminMiddleware']],function(){
        Route::get('dashboard','AdminController@index')->name('admin.dashboard');
        
        /**
         * Karena masih bug, maka penulisannya masih begini dulu :D
         */
        Route::group('/',['namespace' => 'Profil'],function(){
            Route::get('sejarah','ProfilController@sejarah',['prefix' => 'profil'])->name('admin.profil.sejarah');
            Route::get('visi-misi','ProfilController@visi_misi',['prefix' => 'profil'])->name('admin.profil.visi-misi');
            Route::get('fasilitas','ProfilController@fasilitas',['prefix' => 'profil'])->name('admin.profil.fasilitas');
        });

        Route::group('/', function(){
            Route::get('kurikulum','Akademik/AkademikController@kurikulum',['prefix' => 'akademik'])->name('admin.akademik.kurikulum');
        });

        Route::group('/', function(){
            Route::get('/','Berita/BeritaController@index',['prefix' => 'berita'])->name('admin.berita.index');
        });

        Route::group('/',function(){
            Route::get('/','Pengumuman/PengumumanController@index',['prefix' => 'pengumuman'])->name('admin.pengumuman.index');
        });

        Route::group('/', function(){
            Route::get('/','Hasil-karya/HasilkaryaController@index',['prefix' => 'hasil-karya'])->name('admin.hasil-karya.index');
        });

        Route::group('/', function(){
            Route::get('/','Kerja-sama/KerjasamaController@index',['prefix' => 'kerja-sama'])->name('admin.kerja-sama.index');
        });

        Route::group('/', function(){
            Route::get('/','Dosen/DosenController@index',['prefix' => 'dosen'])->name('admin.dosen.index');
        });

    });
});