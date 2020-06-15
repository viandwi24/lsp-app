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
    Route::get('skema/{skema}/frai02', 'SkemaController@frai02')->name('skema.frai02');
    Route::put('skema/{skema}/frai02', 'SkemaController@frai02_update')->name('skema.frai02.update');
    Route::get('skema/{skema}/fraiae01', 'SkemaController@fraiae01')->name('skema.fraiae01');
    Route::put('skema/{skema}/fraiae01', 'SkemaController@fraiae01_update')->name('skema.fraiae01.update');
    Route::get('skema/{skema}/fraiae03', 'SkemaController@fraiae03')->name('skema.fraiae03');
    Route::put('skema/{skema}/fraiae03', 'SkemaController@fraiae03_update')->name('skema.fraiae03.update');
    Route::get('skema/{skema}/umpanbalik', 'SkemaController@umpanbalik')->name('skema.umpanbalik');
    Route::put('skema/{skema}/umpanbalik', 'SkemaController@umpanbalik_update')->name('skema.umpanbalik.update');
    // 
    Route::resource('permohonan', 'PermohonanController', ['parameters' => ['permohonan' => 'permohonan_asesi_asesor']])
        ->only(['index', 'edit', 'update']);

    // 
    Route::get('asesi', 'AsesiController@index')->name('asesi');
    Route::get('asesi/{asesmen}', 'AsesiController@show')->name('asesi.show');
    Route::put('asesi/{asesmen}', 'AsesiController@update')->name('asesi.update');
    Route::get('asesi/{asesmen}/frmak01', 'AsesiController@frmak01')->name('asesi.frmak01');
    Route::post('asesi/{asesmen}/frmak01', 'AsesiController@frmak01_post')->name('asesi.frmak01.post');
    Route::get('asesi/{asesmen}/frai01', 'AsesiController@frai01')->name('asesi.frai01');
    Route::post('asesi/{asesmen}/frai01', 'AsesiController@frai01_post')->name('asesi.frai01.post');
    Route::get('asesi/{asesmen}/frai02', 'AsesiController@frai02')->name('asesi.frai02');
    Route::post('asesi/{asesmen}/frai02', 'AsesiController@frai02_post')->name('asesi.frai02.post');
    Route::get('asesi/{asesmen}/fraiae01', 'AsesiController@fraiae01')->name('asesi.fraiae01');
    Route::post('asesi/{asesmen}/fraiae01', 'AsesiController@fraiae01_post')->name('asesi.fraiae01.post');
    Route::get('asesi/{asesmen}/fraiae03', 'AsesiController@fraiae03')->name('asesi.fraiae03');
    Route::post('asesi/{asesmen}/fraiae03', 'AsesiController@fraiae03_post')->name('asesi.fraiae03.post');
    Route::get('asesi/{asesmen}/frac01', 'AsesiController@frac01')->name('asesi.frac01');
    Route::post('asesi/{asesmen}/frac01', 'AsesiController@frac01_post')->name('asesi.frac01.post');
});