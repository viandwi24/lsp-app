<?php
namespace Modules\TextEditor;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\ModuleServiceProvider;

class TextEditorServiceProvider extends ServiceProvider implements ModuleServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        // laod view
        $this->loadViewsFrom(__DIR__.'/views', 'TextEditor');
    }

    public function checkInstalled()
    {
        return [
            'status' => 'ready'
        ];
    }
}