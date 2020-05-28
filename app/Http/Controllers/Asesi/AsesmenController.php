<?php

namespace App\Http\Controllers\Asesi;

use App\Http\Controllers\Controller;
use App\Models\Asesmen;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsesmenController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $user = auth()->user();
            $permohonan = Asesmen::with('skema', 'asesi', 'asesor')
                ->whereAsesiId(auth()->user()->id)->get();
            return DataTables::of($permohonan)
                ->addColumn('keputusan', function (Asesmen $asesi_skema) {
                    $keputusan = $asesi_skema->keputusan;
                    return ($keputusan == null) ? 'Belum ditentukan' : $keputusan;
                })
                ->addColumn('action', function (Asesmen $asesi_skema) {
                    return '
                    <a class="btn btn-sm btn-primary" href="'. route('asesi.asesmen.show', [$asesi_skema->id]) .'">
                        Buka
                    </a>
                    ';
                })
                ->make();
        }

        return view('pages.asesi.asesmen.index');
    }

    public function show(Asesmen $asesmen)
    {
        return view('pages.asesi.asesmen.show', compact('asesmen'));
    }

    public function frmak01(Asesmen $asesmen)
    {
        return view('pages.asesi.asesmen.form.frmak01', compact('asesmen'));
    }

    public function frmak01_post(Asesmen $asesmen)
    {
        if ($asesmen->frmak01 == null) 
        {
            $asesmen->frmak01()->create([
                'signed_asesi_at' => Carbon::now(),
            ]);
            return redirect()->route('asesi.asesmen.show', $asesmen->id)
                ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Menandatangani formulir Berhasil.']);
        }

        // 
        return redirect()->route('asesi.asesmen.show', $asesmen->id);
    }

    public function frai02(Asesmen $asesmen)
    {
        if (isset($_GET['reset']))
        {
            DB::transaction(function () use ($asesmen) {
                $asesmen->frai02()->delete();
            });
            return redirect()->route('asesi.asesmen.show', $asesmen->id)
                ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Reset formulir Berhasil.']);
        }

        // 
        if ($asesmen->frai02 == null) 
        {
            $pertanyaans = $asesmen->skema->frai02->pertanyaan;
            $data = [];
            foreach($pertanyaans as $pertanyaan)
            {
                $data[] = ['pertanyaan' => $pertanyaan, 'jawaban' => '', 'memuaskan' => false];
            }
            $asesmen->frai02()->create(['data' => $data]);
            return redirect()->route('asesi.asesmen.frai02', [$asesmen->id]);
        }

        return view('pages.asesi.asesmen.form.frai02', compact('asesmen'));
    }

    public function frai02_post(Request $request, Asesmen $asesmen)
    {
        if ($asesmen->frai02 != null) 
        {
            $request->validate([
                'data' => 'required|json'
            ]);
            $asesmen->frai02()->update([
                'data' => $request->data,
            ]);
            return redirect()->route('asesi.asesmen.show', $asesmen->id)
                ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Menyimpan formulir Berhasil.']);
        }

        // 
        return redirect()->route('asesi.asesmen.show', $asesmen->id);
    }
}
