<?php
use Illuminate\Support\Facades\Route;

// Asesor Route
Route::group([
    'prefix' => 'asesor',
    'as' => 'asesor.',
    'namespace' => 'Asesor',
    'middleware' => ['auth', 'role:asesor']
], function () {
    Route::get('', 'HomeController@index')->name('home');
    Route::get('profil', 'ProfilController@index')->name('profil');
    Route::post('profil', 'ProfilController@update')->name('profil.update');

    // skema saya
    Route::get('skema', 'SkemaController@index')->name('skema');
    Route::get('skema/{skema}/frpaap01', 'SkemaController@frpaap01')->name('skema.frpaap01');
    Route::put('skema/{skema}/frpaap01', 'SkemaController@frpaap01_update')->name('skema.frpaap01.update');
    Route::get('skema/{skema}/frmak01', 'SkemaController@frmak01')->name('skema.frmak01');
    Route::put('skema/{skema}/frmak01', 'SkemaController@frmak01_update')->name('skema.frmak01.update');
    // 
    Route::resource('permohonan', 'PermohonanController', ['parameters' => ['permohonan' => 'permohonan_asesi_asesor']])
        ->only(['index', 'edit', 'update']);

    // 
    Route::get('asesi', 'AsesiController@index')->name('asesi');
    Route::get('asesi/{asesmen}', 'AsesiController@show')->name('asesi.show');
    Route::get('asesi/{asesmen}/frmak01', 'AsesiController@frmak01')->name('asesi.frmak01');
    Route::post('asesi/{asesmen}/frmak01', 'AsesiController@frmak01_post')->name('asesi.frmak01.post');
    Route::get('asesi/{asesmen}/frai01', 'AsesiController@frai01')->name('asesi.frai01');
    Route::post('asesi/{asesmen}/frai01', 'AsesiController@frai01_post')->name('asesi.frai01.post');
});