<?php

namespace App\Http\Controllers\Asesor;

use App\Http\Controllers\Controller;
use App\Models\Asesmen;
use App\User;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;

class AsesiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $asesmen = Asesmen::with('asesi', 'skema')->where('asesor_id', auth()->user()->id)->get();
            return DataTables::of($asesmen)
                ->addColumn('keputusan', function (Asesmen $asesmen) {
                    $keputusan = $asesmen->keputusan;
                    return ($keputusan == null) ? 'Belum ditentukan' : $keputusan;
                })
                ->addColumn('action', function (Asesmen $asesmen) {
                    return '
                    <a class="btn btn-sm btn-primary" href="'. route('asesor.asesi.show', [$asesmen->id]) .'">
                        Buka
                    </a>
                    ';
                })
                ->make();
        }

        return view('pages.asesor.asesi.index');
    }

    public function show(Asesmen $asesmen)
    {
        return view('pages.asesor.asesi.show', compact('asesmen'));
    }

    public function frmak01(Asesmen $asesmen)
    {
        return view('pages.asesor.asesi.form.frmak01', compact('asesmen'));
    }

    public function frmak01_post(Asesmen $asesmen)
    {
        if ($asesmen->frmak01 != null && $asesmen->frmak01->signed_asesor_at == null)
        {
            $asesmen->frmak01()->update([
                'signed_asesor_at' => Carbon::now(),
            ]);
            return redirect()->route('asesor.asesi.show', $asesmen->id)
                ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Menandatangani formulir Berhasil.']);
        }

        // 
        return redirect()->route('asesor.asesi.show', $asesmen->id);
    }
}
