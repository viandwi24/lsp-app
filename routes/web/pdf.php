<?php
use Illuminate\Support\Facades\Route;

// Asesi Route
Route::group([
    "prefix" => "pdf",
    "as" => "pdf."
], function () {
    Route::get('frmak01/{id}', "PdfController@frmak01")->name("frmak01");
    Route::get('frai01/{id}', "PdfController@frai01")->name("frai01");
    Route::get('frai02/{id}', "PdfController@frai02")->name("frai02");
    Route::get('frac01/{id}', "PdfController@frac01")->name("frac01");
    Route::get('frmak03/{id}', "PdfController@frmak03")->name("frmak03");
});