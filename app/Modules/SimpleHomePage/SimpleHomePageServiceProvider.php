<?php
namespace App\Modules\SimpleHomePage;

use App\Facades\Menu;
use Viandwi24\ModuleSystem\Base\Service;
use Viandwi24\ModuleSystem\Interfaces\ModuleInterface;
use Illuminate\Support\Facades\Route;

use App\Services\Dashboard;
use Viandwi24\ModuleSystem\Facades\Module;

class SimpleHomePageServiceProvider extends Service implements ModuleInterface
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
        Menu::get('dashboard.sidebar')
            ->add(['admin', 'superadmin'], [ 'type' => 'header', 'text' => 'Simple Home Page', ])
            ->add(['admin', 'superadmin'], [ 'type' => 'item', 'text' => 'Edit Home', 'icon' => 'la la-edit', 'link' => route('simplehomepage.edit') ]);
    }

    public function check()
    {
        $error = null;

        // check text editor module must loaded
        if (!Module::has('TextEditor')) $error = 'Membutukan Module Text Editor Untuk Bisa Berjalan.';

        // if error, return status error
        if ($error != null ) return [ 'state' => 'error', 'error' => $error ];

        // if not error, return ready
        return [ 'state' => 'ready' ];
    }
}