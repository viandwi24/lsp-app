<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Viandwi24\ModuleSystem\Facades\Menu;
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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 
    }




    // 
    protected function bindClass()
    {
        $this->app->bind('menu',function() {
            return new \App\Services\Menu;
        });
    }
}