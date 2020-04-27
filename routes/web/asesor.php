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
});