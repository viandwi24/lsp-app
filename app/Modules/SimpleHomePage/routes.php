<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('SimpleHomePage::home');
});


// Admin Route
Route::group([
    'namespace' => '\Modules\SimpleHomePage\\',
    'middleware' => ['auth', 'role:admin,superadmin']
], function () {
    Route::get('module/simplehomepage/edit', 'SimpleHomePageController@index')->name('simplehomepage.edit');
    Route::post('module/simplehomepage/edit', 'SimpleHomePageController@update')->name('simplehomepage.update');
});