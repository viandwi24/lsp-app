<?php

namespace App\Http\Controllers\Asesor;

use App\Http\Controllers\Controller;
use App\Models\Asesmen;
use App\User;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function frai01(Asesmen $asesmen)
    {
        if (isset($_GET['reset']))
        {
            DB::transaction(function () use ($asesmen) {
                $asesmen->frai01()->delete();
            });
            return redirect()->route('asesor.asesi.show', $asesmen->id)
                ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Reset formulir Berhasil.']);
        }

        // 
        if ($asesmen->frai01 == null) 
        {
            $skema = $asesmen->skema;
            $data = $skema->unit;
            foreach($data as $unit_k => $unit)
            {
                foreach($unit->elemen as $elemen_k => $elemen)
                {
                    foreach($elemen->kuk as $kuk_k => $kuk)
                    {
                        if (!isset($kuk->benchmark)) {
                            $data[$unit_k]->elemen[$elemen_k]->kuk[$kuk_k]->benchmark = '';
                        }
                        if (!isset($kuk->penilaian)) {
                            $data[$unit_k]->elemen[$elemen_k]->kuk[$kuk_k]->penilaian = '';
                        }
                        if (!isset($kuk->pilihan)) {
                            $data[$unit_k]->elemen[$elemen_k]->kuk[$kuk_k]->pilihan = true;
                        }
                    }
                }
            }
            $asesmen->frai01()->create(['data' => $data]);
            return redirect()->route('asesor.asesi.frai01', [$asesmen->id]);
        }
        return view('pages.asesor.asesi.form.frai01', compact('asesmen'));
    }

    public function frai01_post(Request $request, Asesmen $asesmen)
    {
        if ($asesmen->frai01 != null)
        {
            $request->validate([
                'pilihan' => 'required|array',
                'benchmark' => 'required|array',
                'penilaian' => 'required|array',
                'kinerja' => 'required|in:memuaskan,tidak_memuaskan',
                'catatan' => 'required',
            ]);
            $data = $asesmen->frai01->data;
            foreach($data as $unit_k => $unit)
            {
                foreach($unit->elemen as $elemen_k => $elemen)
                {
                    foreach($elemen->kuk as $kuk_k => $kuk)
                    {
                        $benchmark = $request->benchmark[$unit_k][$elemen_k][$kuk_k];
                        $data[$unit_k]->elemen[$elemen_k]->kuk[$kuk_k]->benchmark = $benchmark;

                        $penilaian = $request->penilaian[$unit_k][$elemen_k][$kuk_k];
                        $data[$unit_k]->elemen[$elemen_k]->kuk[$kuk_k]->penilaian = $penilaian;

                        $pilihan = ($request->pilihan[$unit_k][$elemen_k][$kuk_k] == "true") ? true : false;
                        $data[$unit_k]->elemen[$elemen_k]->kuk[$kuk_k]->pilihan = $pilihan;
                    }
                }
            }
            $asesmen->frai01()->update([
                'data' => $data,
                'kinerja' => $request->kinerja,
                'catatan' => $request->catatan,
            ]);
            return redirect()->route('asesor.asesi.show', $asesmen->id)
                ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Mengisi formulir Berhasil.']);
        }

        // 
        return redirect()->route('asesor.asesi.show', $asesmen->id);
    }

    public function frai02(Asesmen $asesmen)
    {
        if ($asesmen->frai02 == null) return abort(404);
        return view('pages.asesor.asesi.form.frai02', compact('asesmen'));
    }

    public function frai02_post(Request $request, Asesmen $asesmen)
    {
        if ($asesmen->frai01 != null)
        {
            $request->validate([
                'pengetahuan' => 'required|in:memuaskan,tidak_memuaskan',
                'catatan' => 'required'
            ]);

            if ($request->has('pilihan'))
            {
                $request->validate(['pilihan' => 'required|array']);
            }

            $data = $asesmen->frai02->data;
            foreach($asesmen->frai02->data as $index => $pertanyaan)
            {
                if (isset($request->pilihan[$index]) && $request->pilihan[$index] == "true")
                {
                    $data[$index]->memuaskan = true;
                } else {
                    $data[$index]->memuaskan = false;
                }
            }

            $asesmen->frai02()->update([
                'data' => $data,
                'pengetahuan' => $request->pengetahuan,
                'catatan' => $request->catatan
            ]);

            return redirect()->route('asesor.asesi.show', $asesmen->id)
            ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Mengisi formulir Berhasil.']);
        }

        return redirect()->back();
    }
}
