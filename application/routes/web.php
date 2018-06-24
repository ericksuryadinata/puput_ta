<?php

/**
 * Welcome to Luthier-CI!
 *
 * This is your main route file. Put all your HTTP-Based routes here using the static
 * Route class methods
 *
 * Examples:
 *
 *    Route::get('foo', 'bar@baz');
 *      -> $route['foo']['GET'] = 'bar/baz';
 *
 *    Route::post('bar', 'baz@fobie', [ 'namespace' => 'cats' ]);
 *      -> $route['bar']['POST'] = 'cats/baz/foobie';
 *
 *    Route::get('blog/{slug}', 'blog@post');
 *      -> $route['blog/(:any)'] = 'blog/post/$1'
 */

/**
 * Routing untuk website
 * ------------------------------------------------------------------------
 * Sedikit penjelasan tentang penulisan routing
 * ------------------------------------------------------------------------
 * 
 * Contoh:
 * 
 * Route::group('/', ['namespace' => 'Website'], function(){
 * 
 * Penjelasan
 * 1. routing dengan menggunakan prefix /, di url jadi localhost/
 * 2. namespace menunjukkan nama folder yang ada di controller
 * 
 * Route::get('/', 'HomeController@index')->name('home.index');
 * 
 * prefix / menuju ke HomeController.php dengan penamaan home.index
 * home.index ini digunakan untuk memanggil via route()
 * jadi nanti pemanggilan dengan route('home.index')
 * ini menunjukkan HomeController bagian index
 * 
 */
Route::group('/',['namespace' => 'Website', 'middleware' => ['WebsiteMiddleware']],function(){
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('sejarah','ProfilController@sejarah')->name('profil.sejarah');
    Route::get('visi-misi','ProfilController@visi_misi')->name('profil.visi-misi');
    Route::get('fasilitas','ProfilController@fasilitas')->name('profil.fasilitas');
    Route::get('kurikulum','AkademikController@kurikulum')->name('akademik.kurikulum');
    Route::get('hubungi-kami','HomeController@hubungi_kami')->name('home.hubungi-kami');
    
    Route::get('/','DosenController@index',['prefix' => 'dosen'])->name('dosen.index');
    Route::get('datatables','DosenController@datatables',['prefix' => 'dosen'])->name('dosen.datatables');
    Route::get('dosen/detail/{id}','DosenController@detail',['prefix' => 'dosen'])->name('dosen.detail');
    
    Route::get('publikasi','PublikasiController@index')->name('publikasi.index');
    Route::get('datatables','PublikasiController@datatables')->name('publikasi.datatables');
    
    /**
     * Route Berita
     */
    Route::get('berita','BeritaController@index')->name('berita.index');
    Route::get('berita/halaman/','BeritaController@index');
    Route::get('berita/halaman/{id}','BeritaController@index');
    Route::get('berita/{slug}','BeritaController@detail')->name('berita.detail');
    

    /**
     * Route Pengumuman
     */
    Route::get('pengumuman','PengumumanController@index')->name('pengumuman.index');
    Route::get('pengumuman/halaman/','PengumumanController@index');
    Route::get('pengumuman/halaman/{id}','PengumumanController@index');
    Route::get('pengumuman/{slug}','PengumumanController@detail')->name('pengumuman.detail');
    
    /**
     * Route Hasil Karya
     */
    Route::get('hasil-karya','HasilKaryaController@index')->name('hasil-karya.index');
    Route::get('hasil-karya/halaman/','HasilKaryaController@index');
    Route::get('hasil-karya/halaman/{id}','HasilKaryaController@index');
    Route::get('hasil-karya/{slug}','HasilKaryaController@detail')->name('hasil-karya.detail');

    /**
     * Route Kerja Sama
     */
    Route::get('kerja-sama','KerjaSamaController@index')->name('kerja-sama.index');
    Route::get('kerja-sama/halaman/','KerjaSamaController@index');
    Route::get('kerja-sama/halaman/{id}','KerjaSamaController@index');
    Route::get('kerja-sama/{slug}','KerjaSamaController@detail')->name('kerja-sama.detail');
    
});

/**
 * Kita masukkan juga admin.php, tapi filenya dibedakan biar enak pengaturannya
 */
require __DIR__ . '/admin.php';

Route::set('404_override', function(){
    show_404();
});

Route::set('translate_uri_dashes',FALSE);