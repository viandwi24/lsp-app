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
});