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
    Route::resource('profil', 'ProfilController')->only('index', 'update');

    Route::resource('kategori', 'KategoriController');
    Route::resource('tuk', 'TukController');
    Route::resource('jadwal', 'JadwalController');
    Route::resource('user/asesi', 'UserAsesiController', ['as' => 'user', 'parameters' => ['asesi' => 'user']]);
});