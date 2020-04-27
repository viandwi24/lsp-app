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
        // 
    }

    public function boot()
    {
        // load view
        $this->loadViewsFrom(__DIR__.'/views', 'SimpleHomePage');
        
        // load route
        Route::middleware('web')->group(__DIR__ . '/routes.php');

        // add menu
        Dashboard::addMenu('admin', [
            'type' => 'header',
            'text' => 'Simple Home Page',
        ]);
        Dashboard::addMenu('admin', [
            'type' => 'item',
            'text' => 'Edit Home',
            'icon' => 'la la-edit',
            'link' => url('admin/simplehomepage/edit')
        ]);
    }

    public function checkInstalled()
    {
        $error = null;

        // check text editor module must loaded
        if (!in_array('TextEditor', Module::getLoadedModules())) $error = 'Membutukan Module Text Editor Untuk Bisa Berjalan.';

        if ($error != null ) return [ 'status' => 'error', 'error' => $error ];
        return [ 'status' => 'ready' ];
    }
}