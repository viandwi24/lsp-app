<?php
namespace App\Modules\PraAsesmen;

use App\Modules\PraAsesmen\Models\Permohonan;
use Viandwi24\ModuleSystem\Base\Service;
use Viandwi24\ModuleSystem\Interfaces\ModuleInterface;
use App\Services\SkemaDashboard;
use Illuminate\Support\Facades\Route;
use Schema;

class PraAsesmenServiceProvider extends Service implements ModuleInterface
{
    public function register()
    {
        Route::middleware('web')->group(__DIR__ . '/routes.php');
        $this->loadViewsFrom(__DIR__.'/views', 'PraAsesmen');
    }

    public function boot()
    {
        $this->addSkemaMenu();
    }

    public function check()
    {
        $error = null;

        // check table
        if (!$this->checkTable()) return [
            'state' => 'not_ready', 
            'setup' => route('PraAsesmen.setup'),
            'boot' => false
        ];

        // ready
        return [ 'state' => 'ready' ];
    }

    /**
     * add skema menu
     *
     * @return void
     */
    protected function addSkemaMenu()
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

    /**
     * check table exist
     */
    protected function checkTable()
    {
        $table = (new Permohonan)->getTable();
        return (Schema::hasTable($table));
    }
}