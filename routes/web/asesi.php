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
    Route::get('skema', 'SkemaController@index')->name('skema');
    Route::get('permohonan/create/{skema}', 'PermohonanController@create')->name('permohonan.create');
    Route::resource('permohonan', 'PermohonanController')->except(['create']);
    
    Route::resource('berkas', 'BerkasController');
});