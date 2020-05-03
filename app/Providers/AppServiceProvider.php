<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Helper;
use Viandwi24\ModuleSystem\Facades\Module;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
        Helper::load();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // dd(Module::get());
    }
}
