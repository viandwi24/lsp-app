<?php
namespace Modules\PraAsesmen;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\ModuleServiceProvider;
use App\Services\SkemaDashboard;
use Illuminate\Support\Facades\Route;

class PraAsesmenServiceProvider extends ServiceProvider implements ModuleServiceProvider
{
    public function register()
    {
        // load route
        Route::middleware('web')->group(__DIR__ . '/routes.php');

        // load view
        $this->loadViewsFrom(__DIR__.'/views', 'PraAsesmen');
    }

    public function boot()
    {
        SkemaDashboard::addMenu([
            'link' => function ($item) {
                return route('admin.skema.index') . '/' . $item->id . '/permohonan';
            },
            'text' => '<i class="ft-book"></i> Permohonan'
        ]);
        SkemaDashboard::addWidget(function ($skema) {
            return view('PraAsesmen::widget');
        });
    }

    public function checkInstalled()
    {
        return [
            'status' => 'ready'
        ];
    }
}