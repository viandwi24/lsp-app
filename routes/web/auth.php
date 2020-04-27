<?php
use Illuminate\Support\Facades\Route;

// Auth
Route::group([
    'prefix' => 'auth',
    'namespace' => 'Auth',
], function () {
    Route::get('/login', 'LoginController@index')->name('login')->middleware('guest');
    Route::post('/login', 'LoginController@login')->name('login.post')->middleware('guest');
    Route::get('/logout', 'LoginController@logout')->name('logout')->middleware('auth');
});