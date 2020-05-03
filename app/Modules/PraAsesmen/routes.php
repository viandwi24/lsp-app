<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'App\Modules\PraAsesmen\Controllers\\',
], function () {

    // 
    Route::group([
        'middleware' => ['auth', 'role:admin'],
        'prefix' => 'admin/skema/{skema}',
        'as' => 'admin.skema.'
    ], function () {
        Route::get('permohonan', 'PermohonanController@index')->name('permohonan');
    });


    // 
    Route::group([
        'middleware' => ['auth', 'role:superadmin'],
        'prefix' => 'module/pra-asesmen',
        'as' => 'PraAsesmen.'
    ], function () {
        Route::get('setup', 'SetupController@index')->name('setup');
        Route::get('setup/install', 'SetupController@install')->name('setup.install');
    });
});