<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Viandwi24\ModuleSystem\Facades\Module;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::get();
        return view('pages.superadmin.module.index', compact('modules'));
    }

    public function action()
    {
        if (!isset($_GET['action']) || !isset($_GET['name'])) return abort(404);
        if ($_GET['action'] == 'enable')
        {
            Module::enable($_GET['name']);
            return redirect()->back();
        } elseif ($_GET['action'] == 'disable') {
            Module::disable($_GET['name']);
            return redirect()->back();
        } else {
            return abort(404);
        }
    }
}
