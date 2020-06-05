<?php
use Illuminate\Support\Facades\Route;

// Asesi Route
Route::group([
    "prefix" => "pdf",
    "as" => "pdf."
], function () {
    Route::get('frapl01/{id}', "PdfController@frapl01")->name("frapl01");
});