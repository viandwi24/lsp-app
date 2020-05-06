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
    
    Route::resource('berkas', 'BerkasController');
});