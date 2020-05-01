<?php

use Illuminate\Support\Facades\Route;

// Admin Route
Route::group([
    'namespace' => '\Modules\PraAsesmen\Controllers\\',
    'middleware' => ['auth', 'role:admin'],
    'prefix' => 'admin/skema/{skema}',
    'as' => 'admin.skema.'
], function () {
        Route::get('permohonan', 'PermohonanController@index')->name('permohonan');
});