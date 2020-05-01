<?php
use Illuminate\Support\Facades\Route;

// Admin Route
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin',
    'middleware' => ['auth', 'role:admin']
], function () {
    Route::get('', 'HomeController@index')->name('home');
    Route::get('profil', 'ProfilController@index')->name('profil');
    Route::post('profil', 'ProfilController@update')->name('profil.update');

    Route::resource('kategori', 'KategoriController');
    Route::resource('tuk', 'TukController');
    Route::resource('jadwal', 'JadwalController');
    Route::resource('user/asesi', 'UserAsesiController', ['as' => 'user', 'parameters' => ['asesi' => 'user']]);
    Route::resource('user/asesor', 'UserAsesorController', ['as' => 'user', 'parameters' => ['asesor' => 'user']]);
    Route::resource('skema', 'SkemaController');
});