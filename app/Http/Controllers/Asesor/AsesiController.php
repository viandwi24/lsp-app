<?php

namespace App\Http\Controllers\Asesor;

use App\Http\Controllers\Controller;
use App\Models\AsesiSkema;
use App\User;
use DataTables;
use Illuminate\Http\Request;

class AsesiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $asesi_skema = AsesiSkema::with('asesi', 'skema')->where('asesor_id', auth()->user()->id)->get();
            return DataTables::of($asesi_skema)
                ->addColumn('action', function (AsesiSkema $asesi_skema) {
                    return '';
                })
                ->make();
        }

        return view('pages.asesor.asesi.index');
    }
}
