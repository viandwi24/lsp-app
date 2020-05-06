<?php

namespace App\Http\Controllers\Asesi;

use App\Http\Controllers\Controller;
use App\Models\Skema;
use DataTables;
use Illuminate\Http\Request;

class DaftarSkemaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $skema = Skema::with('admin')->whereNotIn('id', auth()->user()->permohonan->pluck('id'))->get();
            return DataTables::of($skema)->make();
        }
        
        return view('pages.asesi.skema');
    }
}
