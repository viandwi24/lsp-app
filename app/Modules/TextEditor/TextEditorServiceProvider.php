<?php
namespace App\Modules\TextEditor;

use Viandwi24\ModuleSystem\Base\Service;
use Viandwi24\ModuleSystem\Interfaces\ModuleInterface;

class TextEditorServiceProvider extends Service implements ModuleInterface
{
    public function register()
    {
    }

    public function boot()
    {
        // laod view
        $this->loadViewsFrom(__DIR__.'/views', 'TextEditor');
    }

    public function check()
    {
        return [
            'state' => 'ready'
        ];
    }
}