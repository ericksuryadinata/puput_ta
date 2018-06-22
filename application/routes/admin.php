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

Route::group('super-admin',['namespace' => 'Admin'],function(){
    Route::get('/','RedirectController@index')->name('admin.redirect.index');
    Route::group('gate',['namespace' => 'Auth'],function(){
        Route::get('in','AuthController@index')->name('admin.auth.index');
        Route::post('in/auth','AuthController@auth')->name('admin.auth.login');
        Route::get('out','AuthController@logout')->name('admin.auth.logout');    

    });

    Route::group('/', ['middleware' => ['AdminMiddleware']],function(){
        Route::get('dashboard','AdminController@index')->name('admin.dashboard');
        Route::get('log','AdminController@log')->name('admin.dashboard.log');
        
        /**
         * Karena masih bug, maka penulisannya masih begini dulu :D
         * Sudah tak mention di luthiernya :D
         */
        Route::group('/',['namespace' => 'Profil'],function(){
            //sejarah
            Route::get('sejarah','ProfilController@sejarah',['prefix' => 'profil'])->name('admin.profil.sejarah');
            Route::post('sejarah/upload','ProfilController@uploadSejarah',['prefix' => 'profil'])->name('admin.profil.sejarah.upload');
            
            //visi misi
            Route::get('visi-misi','ProfilController@visi_misi',['prefix' => 'profil'])->name('admin.profil.visi-misi');
            Route::post('visi-misi/upload','ProfilController@uploadVisiMisi',['prefix' => 'profil'])->name('admin.profil.visi-misi.upload');
            
            //fasilitas
            Route::get('fasilitas','ProfilController@fasilitas',['prefix' => 'profil'])->name('admin.profil.fasilitas');
            Route::post('fasilitas/upload','ProfilController@uploadFasilitas',['prefix' => 'profil'])->name('admin.profil.fasilitas.upload');
        });

        Route::group('/', ['namespace' => 'Akademik'], function(){
            Route::get('kurikulum','AkademikController@kurikulum',['prefix' => 'akademik'])->name('admin.akademik.kurikulum');
            Route::post('kurikulum/upload','AkademikController@uploadKurikulum',['prefix' => 'akademik'])->name('admin.akademik.kurikulum.upload');
        });

        Route::group('/', ['namespace' => 'Berita'], function(){
            Route::get('/','BeritaController@index',['prefix' => 'berita/post'])->name('admin.berita.post.index');
            Route::get('tambah','BeritaController@create',['prefix' => 'berita/post'])->name('admin.berita.post.create');
            Route::get('datatable','BeritaController@datatable',['prefix' => 'berita/post'])->name('admin.berita.post.datatable');
            Route::post('save','BeritaController@save',['prefix' => 'berita/post'])->name('admin.berita.post.save');
            Route::get('edit/{id}','BeritaController@edit',['prefix' => 'berita/post'])->name('admin.berita.post.edit');
            Route::post('update','BeritaController@update',['prefix' => 'berita/post'])->name('admin.berita.post.update');
            Route::post('delete','BeritaController@delete',['prefix' => 'berita/post'])->name('admin.berita.post.delete');

            Route::get('/','KategoriBeritaController@index',['prefix' => 'berita/kategori'])->name('admin.berita.kategori.index');
            Route::get('tambah','KategoriBeritaController@create',['prefix' => 'berita/kategori'])->name('admin.berita.kategori.create');
            Route::get('datatable','KategoriBeritaController@datatable',['prefix' => 'berita/kategori'])->name('admin.berita.kategori.datatable');
            Route::post('save','KategoriBeritaController@save',['prefix' => 'berita/kategori'])->name('admin.berita.kategori.save');
            Route::get('edit/{id}','KategoriBeritaController@edit',['prefix' => 'berita/kategori'])->name('admin.berita.kategori.edit');
            Route::post('update','KategoriBeritaController@update',['prefix' => 'berita/kategori'])->name('admin.berita.kategori.update');
            Route::post('delete','KategoriBeritaController@delete',['prefix' => 'berita/kategori'])->name('admin.berita.kategori.delete');
        });

        Route::group('/', ['namespace' => 'Pengumuman'], function(){
            Route::get('/','PengumumanController@index',['prefix' => 'pengumuman'])->name('admin.pengumuman.index');
            Route::get('tambah','PengumumanController@create',['prefix' => 'pengumuman'])->name('admin.pengumuman.create');
            Route::get('datatable','PengumumanController@datatable',['prefix' => 'pengumuman'])->name('admin.pengumuman.datatable');
            Route::post('save','PengumumanController@save',['prefix' => 'pengumuman'])->name('admin.pengumuman.save');
            Route::get('edit/{id}','PengumumanController@edit',['prefix' => 'pengumuman'])->name('admin.pengumuman.edit');
            Route::post('update','PengumumanController@update',['prefix' => 'pengumuman'])->name('admin.pengumuman.update');
            Route::post('delete','PengumumanController@delete',['prefix' => 'pengumuman'])->name('admin.pengumuman.delete');
        });

        Route::group('/', ['namespace' => 'Hasil-karya'], function(){
            Route::get('/','HasilkaryaController@index',['prefix' => 'hasil-karya'])->name('admin.hasil-karya.index');
            Route::get('tambah','HasilkaryaController@create',['prefix' => 'hasil-karya'])->name('admin.hasil-karya.create');
            Route::get('datatable','HasilkaryaController@datatable',['prefix' => 'hasil-karya'])->name('admin.hasil-karya.datatable');
            Route::post('save','HasilkaryaController@save',['prefix' => 'hasil-karya'])->name('admin.hasil-karya.save');
            Route::get('edit/{id}','HasilkaryaController@edit',['prefix' => 'hasil-karya'])->name('admin.hasil-karya.edit');
            Route::post('update','HasilkaryaController@update',['prefix' => 'hasil-karya'])->name('admin.hasil-karya.update');
            Route::post('delete','HasilkaryaController@delete',['prefix' => 'hasil-karya'])->name('admin.hasil-karya.delete');
        });

        Route::group('/', ['namespace' => 'Kerja-sama'], function(){
            Route::get('/','KerjasamaController@index',['prefix' => 'kerja-sama'])->name('admin.kerja-sama.index');
            Route::get('tambah','KerjasamaController@create',['prefix' => 'kerja-sama'])->name('admin.kerja-sama.create');
            Route::get('datatable','KerjasamaController@datatable',['prefix' => 'kerja-sama'])->name('admin.kerja-sama.datatable');
            Route::post('save','KerjasamaController@save',['prefix' => 'kerja-sama'])->name('admin.kerja-sama.save');
            Route::get('edit/{id}','KerjasamaController@edit',['prefix' => 'kerja-sama'])->name('admin.kerja-sama.edit');
            Route::post('update','KerjasamaController@update',['prefix' => 'kerja-sama'])->name('admin.kerja-sama.update');
            Route::post('delete','KerjasamaController@delete',['prefix' => 'kerja-sama'])->name('admin.kerja-sama.delete');
        });

        Route::group('/',['namespace' => 'Publikasi'], function(){
            Route::get('/','PublikasiController@index',['prefix' => 'publikasi'])->name('admin.publikasi.index');
            Route::get('/','PublikasiController@create',['prefix' => 'publikasi'])->name('admin.publikasi.create');
            Route::get('/','PublikasiController@datatable',['prefix' => 'publikasi'])->name('admin.publikasi.datatable');
            Route::post('/','PublikasiController@save',['prefix' => 'publikasi'])->name('admin.publikasi.save');
            Route::get('/','PublikasiController@edit',['prefix' => 'publikasi'])->name('admin.publikasi.edit');
            Route::post('/','PublikasiController@update',['prefix' => 'publikasi'])->name('admin.publikasi.update');
            Route::post('/','PublikasiController@delete',['prefix' => 'publikasi'])->name('admin.publikasi.delete');
        });

        Route::group('/', ['namespace' => 'Dosen'], function(){
            Route::get('/','DosenController@index',['prefix' => 'dosen'])->name('admin.dosen.index');
            Route::get('tambah','DosenController@create',['prefix' => 'dosen'])->name('admin.dosen.create');
            Route::get('datatable','DosenController@datatable',['prefix' => 'dosen'])->name('admin.dosen.datatable');
            Route::get('detail','DosenController@detail',['prefix' => 'dosen'])->name('admin.dosen.detail');
            Route::post('save','DosenController@save',['prefix' => 'dosen'])->name('admin.dosen.save');
            Route::get('edit/{id}','DosenController@edit',['prefix' => 'dosen'])->name('admin.dosen.edit');
            Route::post('update','DosenController@update',['prefix' => 'dosen'])->name('admin.dosen.update');
            Route::post('delete','DosenController@delete',['prefix' => 'dosen'])->name('admin.dosen.delete');

        });

        Route::group('/', ['namespace' => 'Settings'], function(){

            Route::get('/','WebSettingsController@index',['prefix' => 'settings/web'])->name('admin.settings.web.index');
            Route::post('save','WebSettingsController@save',['prefix' => 'settings/web'])->name('admin.settings.web.save');

            Route::get('/','LinkPartnerController@index',['prefix' => 'settings/link'])->name('admin.settings.link.index');
            Route::get('tambah','LinkPartnerController@create',['prefix' => 'settings/link'])->name('admin.settings.link.create');
            Route::get('datatable','LinkPartnerController@datatable',['prefix' => 'settings/link'])->name('admin.settings.link.datatable');
            Route::post('save','LinkPartnerController@save',['prefix' => 'settings/link'])->name('admin.settings.link.save');
            Route::get('edit/{id}','LinkPartnerController@edit',['prefix' => 'settings/link'])->name('admin.settings.link.edit');
            Route::post('update','LinkPartnerController@update',['prefix' => 'settings/link'])->name('admin.settings.link.update');
            Route::post('delete','LinkPartnerController@delete',['prefix' => 'settings/link'])->name('admin.settings.link.delete');
            Route::post('aktifkan','LinkPartnerController@aktifkan',['prefix' => 'settings/link'])->name('admin.settings.link.aktifkan');

            Route::get('/','SliderController@index',['prefix' => 'settings/slider'])->name('admin.settings.slider.index');
            Route::get('tambah','SliderController@create',['prefix' => 'settings/slider'])->name('admin.settings.slider.create');
            Route::get('datatable','SliderController@datatable',['prefix' => 'settings/slider'])->name('admin.settings.slider.datatable');
            Route::post('save','SliderController@save',['prefix' => 'settings/slider'])->name('admin.settings.slider.save');
            Route::get('edit/{id}','SliderController@edit',['prefix' => 'settings/slider'])->name('admin.settings.slider.edit');
            Route::post('update','SliderController@update',['prefix' => 'settings/slider'])->name('admin.settings.slider.update');
            Route::post('delete','SliderController@delete',['prefix' => 'settings/slider'])->name('admin.settings.slider.delete');
            Route::post('aktifkan','SliderController@aktifkan',['prefix' => 'settings/slider'])->name('admin.settings.slider.aktifkan');

            Route::get('/','AdminUserController@index',['prefix' => 'settings/administrator'])->name('admin.settings.administrator.index');
            Route::get('tambah','AdminUserController@create',['prefix' => 'settings/administrator'])->name('admin.settings.administrator.create');
            Route::get('datatable','AdminUserController@datatable',['prefix' => 'settings/administrator'])->name('admin.settings.administrator.datatable');
            Route::post('save','AdminUserController@save',['prefix' => 'settings/administrator'])->name('admin.settings.administrator.save');
            Route::get('edit/{id}','AdminUserController@edit',['prefix' => 'settings/administrator'])->name('admin.settings.administrator.edit');
            Route::post('update','AdminUserController@update',['prefix' => 'settings/administrator'])->name('admin.settings.administrator.update');
            Route::post('delete','AdminUserController@delete',['prefix' => 'settings/administrator'])->name('admin.settings.administrator.delete');
            Route::post('aktifkan','AdminUserController@aktifkan',['prefix' => 'settings/administrator'])->name('admin.settings.administrator.aktifkan');
        });
    });
});
