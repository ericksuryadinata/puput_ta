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
 * Route untuk website utama
 */
Route::group('/',['namespace' => 'landing-page'],function(){
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('sejarah','ProfilController@sejarah')->name('profil.sejarah');
    Route::get('visi-misi','ProfilController@visi_misi')->name('profil.visi-misi');
    Route::get('fasilitas','ProfilController@fasilitas')->name('profil.fasilitas');
    Route::get('kurikulum','AkademikController@kurikulum')->name('akademik.kurikulum');
    Route::get('hubungi-kami','HomeController@hubungi_kami')->name('home.hubungi-kami');
    Route::get('dosen','DosenController@index')->name('dosen.index');
    
    
    Route::get('publikasi','PublikasiController@index')->name('publikasi.index');
    
    Route::get('berita','BeritaController@index')->name('berita.index');
    
    Route::get('pengumuan','PengumumanController@index')->name('pengumuman.index');
    
    Route::get('hasil-karya','HasilKaryaController@index')->name('hasil-karya.index');

    Route::get('kerja-sama','KerjaSamaController@index')->name('kerja-sama.index');
    
});

require __DIR__ . '/admin.php';

Route::set('404_override', function(){
    show_404();
});

Route::set('translate_uri_dashes',FALSE);