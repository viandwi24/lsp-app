<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('SimpleHomePage::home');
});


// Admin Route
Route::group([
    'namespace' => '\Modules\SimpleHomePage\\',
    'middleware' => ['auth', 'role:admin']
], function () {
    Route::get('admin/simplehomepage/edit', 'SimpleHomePageController@index')->name('simplehomepage.edit');
    Route::post('admin/simplehomepage/edit', 'SimpleHomePageController@update')->name('simplehomepage.update');
});