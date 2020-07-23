<?php

use App\Models\Berkas;
use App\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

// Admin Route
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin',
    'middleware' => ['auth', 'role:admin']
], function () {
    Route::get('', 'HomeController@index')->name('home');
    Route::get('profil', 'ProfilController@index')->name('profil');
    Route::post('profil', 'ProfilController@update')->name('profil.update');
    Route::get('berkas', 'BerkasController@index')->name('berkas');
    Route::post('berkas', 'BerkasController@store')->name('berkas.store');
    Route::delete('berkas/{id}', 'BerkasController@destroy')->name('berkas.destroy');

    Route::resource('kategori', 'KategoriController');
    Route::resource('tuk', 'TukController');
    Route::resource('jadwal', 'JadwalController');
    Route::resource('user/asesi', 'UserAsesiController', ['as' => 'user', 'parameters' => ['asesi' => 'user']]);
    Route::resource('user/asesor', 'UserAsesorController', ['as' => 'user', 'parameters' => ['asesor' => 'user']]);
    Route::resource('skema', 'SkemaController');
    Route::group([ 'as' => 'skema.' ], function () {
        Route::resource('skema/{skema}/permohonan', 'SkemaPermohonanController');
    });
    Route::get('berkas/remove-duplicate', function () {
        $request = app('request');
        $users = User::with('berkas')
            ->offset($request->get('start', 0))
            ->limit($request->get('limit', 10))
            ->get();

        $result = [];
        foreach($users as $user)
        {
            $user_berkas = $user->berkas->pluck('nama')->toArray();

            $duplicates_ex = [];
            $count_values = array_count_values($user_berkas);
            $result[$user->nama]['duplicated'] = $count_values;
            foreach($user->berkas as $berkas)
            {
                if (($count_values[$berkas->nama]) > 1)
                {
                    if (isset($duplicates_ex[$berkas->nama])) {
                        $result[$user->nama]['try_delete'][] = $berkas->id;
                        $delete = Berkas::find($berkas->id)->delete();
                        if ($delete) {
                            $result[$user->nama]['deleted'][] = $berkas->id;
                            $result[$user->nama]['deleted_file'][] = $berkas->toArray();
                        }
                    } else {
                        $result[$user->nama]['keep'][] = $berkas->id;
                        $result[$user->nama]['keep_file'][] = $berkas->toArray();
                        $duplicates_ex[$berkas->nama] = $berkas;
                    }
                }
            }
        }

        dd($result);
    });
});