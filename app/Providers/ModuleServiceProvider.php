<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Module;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Module::load();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->booted(function () {
            Module::load('boot');
        });
    }
}
