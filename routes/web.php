<?php

use App\Models\Berkas;
use App\Models\Permohonan;
use App\Models\Skema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Services\User;

Route::get('/', function () { return view("pages.home"); });

Route::get('berkas/{path?}', function ($path) {
    // role
    $role = 'guest';
    if (auth()->check()) $role = auth()->user()->role;

    $berkas = Berkas::where('path', $path)->first();

    $path = 'berkas/' . $berkas->path;
    $check_exist = Storage::exists($path);    
    if (!$check_exist) abort(404);
 
    $file = Storage::get($path);
    $type = $berkas->tipe;

    // 
    $ext_blocked = ['application/x-httpd-php', 'application/x-php', 'application/javascript'];
    if (in_array($type, $ext_blocked) && in_array($role, ['asesi'])) return abort(403);

    // check role berkas
    if ($berkas->role == 'private')
    {
        if ( (in_array($role, ['admin', 'superadmin']))  ) { } else if (
            ( $role == 'guest' || (auth()->check() && auth()->user()->id != $berkas->user_id) )
        ) {
            return abort(403);
        }
    }
 
    $response = Response::make($file, 200);
    $response->header('Content-disposition','attachment; filename="'.$berkas->nama.'"');
    $response->header("Content-Type", $type);
 
    return $response;
})->name('berkas.download');


Route::get('/migrasi/user', 'MigrationController@index');
Route::post('migrasi/user/prepare', 'MigrationController@prepare');
Route::post('migrasi/user/submit', 'MigrationController@migrate');
Route::post('migrasi/user/rollback', 'MigrationController@rollback');