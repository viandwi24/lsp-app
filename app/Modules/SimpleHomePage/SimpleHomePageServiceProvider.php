<?php
namespace Modules\SimpleHomePage;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\ModuleServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Services\Dashboard;
use App\Services\Module;

class SimpleHomePageServiceProvider extends ServiceProvider implements ModuleServiceProvider
{
    public function register()
    {
        // load route
        Route::middleware('web')->group(__DIR__ . '/routes.php');

        // load view
        $this->loadViewsFrom(__DIR__.'/views', 'SimpleHomePage');
    }

    public function boot()
    {
        // add menu
        // dd(route('simplehomepage.edit.inde'));
        // dd(Route::getRoutes());
        Dashboard::addMenu(['admin', 'superadmin'], [
            'type' => 'header',
            'text' => 'Simple Home Page',
        ]);
        Dashboard::addMenu(['admin', 'superadmin'], [
            'type' => 'item',
            'text' => 'Edit Home',
            'icon' => 'la la-edit',
            'link' => route('simplehomepage.edit')
        ]);
    }

    public function checkInstalled()
    {
        $error = null;

        // check text editor module must loaded
        if (!in_array('TextEditor', Module::getLoadedModules())) $error = 'Membutukan Module Text Editor Untuk Bisa Berjalan.';

        // if error, return status error
        if ($error != null ) return [ 'status' => 'error', 'error' => $error ];

        // if not error, return ready
        return [ 'status' => 'ready' ];
    }
}