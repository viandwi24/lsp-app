<?php
namespace App\Modules\PraAsesmen\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SetupController extends Controller
{
    public function index()
    {
        return view('PraAsesmen::setup');
    }

    public function install()
    {
        $basepath = base_path();
        $path = str_replace($basepath, '', realpath(__DIR__ . '/../migrations'));
        $command = Artisan::call('migrate', [
            '--path' => $path
        ]);
        return redirect()->route('superadmin.module.index');
    }
}
