<?php
use Illuminate\Support\Facades\Route;

// Admin Route
Route::group([
    'prefix' => 'superadmin',
    'as' => 'superadmin.',
    'namespace' => 'SuperAdmin',
    'middleware' => ['auth', 'role:superadmin']
], function () {
    Route::get('', 'HomeController@index')->name('home');
    Route::get('module', 'ModuleController@index')->name('module.index');
    Route::get('module/action', 'ModuleController@action')->name('module.action');
});