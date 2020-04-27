<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Module;

class ModuleController extends Controller
{
    public function index()
    {
        return view('pages.superadmin.module.index');
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
