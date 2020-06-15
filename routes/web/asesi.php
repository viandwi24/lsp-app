<?php
use Illuminate\Support\Facades\Route;

// Asesi Route
Route::group([
    'prefix' => 'asesi',
    'as' => 'asesi.',
    'namespace' => 'Asesi',
    'middleware' => ['auth', 'role:asesi']
], function () {
    Route::get('', 'HomeController@index')->name('home');
    Route::get('profil', 'ProfilController@index')->name('profil');
    Route::post('profil', 'ProfilController@update')->name('profil.update');

    // pendaftaran
    Route::get('skema', 'DaftarSkemaController@index')->name('skema');
    Route::get('permohonan/create/{skema}', 'PermohonanController@create')->name('permohonan.create');
    Route::post('permohonan/create/{skema}', 'PermohonanController@store')->name('permohonan.store');
    Route::resource('permohonan', 'PermohonanController')->except(['create', 'store']);

    // asesmen
    Route::get('asesmen', 'AsesmenController@index')->name('asesmen');
    Route::get('asesmen/{asesmen}', 'AsesmenController@show')->name('asesmen.show');
    Route::get('asesmen/{asesmen}/frmak01', 'AsesmenController@frmak01')->name('asesmen.frmak01');
    Route::post('asesmen/{asesmen}/frmak01', 'AsesmenController@frmak01_post')->name('asesmen.frmak01');
    Route::get('asesmen/{asesmen}/frai02', 'AsesmenController@frai02')->name('asesmen.frai02');
    Route::post('asesmen/{asesmen}/frai02', 'AsesmenController@frai02_post')->name('asesmen.frai02');
    Route::get('asesmen/{asesmen}/fraiae01', 'AsesmenController@fraiae01')->name('asesmen.fraiae01');
    Route::post('asesmen/{asesmen}/fraiae01', 'AsesmenController@fraiae01_post')->name('asesmen.fraiae01');
    Route::get('asesmen/{asesmen}/fraiae03', 'AsesmenController@fraiae03')->name('asesmen.fraiae03');
    Route::post('asesmen/{asesmen}/fraiae03', 'AsesmenController@fraiae03_post')->name('asesmen.fraiae03');
    Route::get('asesmen/{asesmen}/frac01', 'AsesmenController@frac01')->name('asesmen.frac01');
    Route::post('asesmen/{asesmen}/frac01', 'AsesmenController@frac01_post')->name('asesmen.frac01');
    Route::get('asesmen/{asesmen}/frmak03', 'AsesmenController@frmak03')->name('asesmen.frmak03');
    Route::post('asesmen/{asesmen}/frmak03', 'AsesmenController@frmak03_post')->name('asesmen.frmak03');
    Route::get('asesmen/{asesmen}/umpanbalik', 'AsesmenController@umpanbalik')->name('asesmen.umpanbalik');
    Route::post('asesmen/{asesmen}/umpanbalik', 'AsesmenController@umpanbalik_post')->name('asesmen.umpanbalik');
    
    Route::resource('berkas', 'BerkasController');
});