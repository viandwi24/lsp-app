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
                    return ($keputusan == null) ? 'Belum ditentukan' : ($keputusan == 'kompeten' ? 'Kompeten' : 'Belum Kompeten');
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
        if ($asesmen->frai02 == null) return dd("asesir belum mengisi.");
        return view('pages.asesi.asesmen.form.frai02', compact('asesmen'));
    }

    public function frai02_post(Request $request, Asesmen $asesmen)
    {
        // if ($asesmen->frai02 != null) 
        // {
        //     $request->validate([
        //         'data' => 'required|json'
        //     ]);
        //     $asesmen->frai02()->update([
        //         'data' => $request->data,
        //     ]);
        //     return redirect()->route('asesi.asesmen.show', $asesmen->id)
        //         ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Menyimpan formulir Berhasil.']);
        // }

        // // 
        // return redirect()->route('asesi.asesmen.show', $asesmen->id);
    }

    public function fraiae01(Asesmen $asesmen)
    {
        if (isset($_GET['reset']))
        {
            DB::transaction(function () use ($asesmen) {
                $asesmen->fraiae01()->delete();
            });
            return redirect()->route('asesi.asesmen.show', $asesmen->id)
                ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Reset formulir Berhasil.']);
        }

        // 
        if ($asesmen->fraiae01 == null) 
        {
            if ($asesmen->skema->fraiae01 == null) dd("fraiae01 kosong, belum di set asesor");
            $pertanyaans = $asesmen->skema->fraiae01->pertanyaan;
            $data = [];
            foreach($pertanyaans as $pertanyaan)
            {
                $data[] = ['pertanyaan' => $pertanyaan, 'jawaban' => '', 'memuaskan' => false];
            }
            $asesmen->fraiae01()->create(['data' => $data]);
            return redirect()->route('asesi.asesmen.fraiae01', [$asesmen->id]);
        }

        return view('pages.asesi.asesmen.form.fraiae01', compact('asesmen'));
    }

    public function fraiae01_post(Request $request, Asesmen $asesmen)
    {
        if ($asesmen->fraiae01 != null) 
        {
            $request->validate([
                'data' => 'required|json'
            ]);
            $asesmen->fraiae01()->update([
                'data' => $request->data,
            ]);
            return redirect()->route('asesi.asesmen.show', $asesmen->id)
                ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Menyimpan formulir Berhasil.']);
        }

        // 
        return redirect()->route('asesi.asesmen.show', $asesmen->id);
    }


    public function fraiae03(Asesmen $asesmen)
    {
        if (isset($_GET['reset']))
        {
            DB::transaction(function () use ($asesmen) {
                $asesmen->fraiae03()->delete();
            });
            return redirect()->route('asesi.asesmen.show', $asesmen->id)
                ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Reset formulir Berhasil.']);
        }

        // 
        if ($asesmen->fraiae03 == null) 
        {
            if ($asesmen->skema->fraiae03 == null) dd("fraiae03 kosong, belum di set asesor");
            $pertanyaans = $asesmen->skema->fraiae03->pertanyaan;
            $data = [];
            foreach($pertanyaans as $pertanyaan)
            {
                $data[] = ['pertanyaan' => $pertanyaan, 'jawaban' => '', 'memuaskan' => false];
            }
            $asesmen->fraiae03()->create(['data' => $data]);
            return redirect()->route('asesi.asesmen.fraiae03', [$asesmen->id]);
        }

        return view('pages.asesi.asesmen.form.fraiae03', compact('asesmen'));
    }

    public function fraiae03_post(Request $request, Asesmen $asesmen)
    {
        if ($asesmen->fraiae03 != null) 
        {
            $request->validate([
                'data' => 'required|json'
            ]);
            $asesmen->fraiae03()->update([
                'data' => $request->data,
            ]);
            return redirect()->route('asesi.asesmen.show', $asesmen->id)
                ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Menyimpan formulir Berhasil.']);
        }

        // 
        return redirect()->route('asesi.asesmen.show', $asesmen->id);
    }


    public function frac01(Asesmen $asesmen)
    {
        return view('pages.asesi.asesmen.form.frac01', compact('asesmen'));
    }

    public function frac01_post(Request $request, Asesmen $asesmen)
    {
        if ($asesmen->frac01->signed_asesi_at == null) 
        {
            $asesmen->frac01()->update([ 'signed_asesi_at' => Carbon::now() ]);
            return redirect()->route('asesi.asesmen.show', $asesmen->id)
                ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Menyimpan formulir Berhasil.']);
        }

        // 
        return redirect()->route('asesi.asesmen.show', $asesmen->id);
    }

    public function frmak03(Asesmen $asesmen)
    {
        return view('pages.asesi.asesmen.form.frmak03', compact('asesmen'));
    }

    public function frmak03_post(Request $request, Asesmen $asesmen)
    {
        if ($asesmen->frmak03 != null) return redirect()->back();

        $request->validate([
            'unit' => 'required|json',
            'alasan' => 'required',
            'dijelaskan' => 'required|in:true,false',
            'diskusi' => 'required|in:true,false',
            'orang_lain' => 'required|in:true,false',
        ]);

        $dijelaskan = ($request->dijelaskan == "true") ? true : false;
        $diskusi = ($request->diskusi == "true") ? true : false;
        $orang_lain = ($request->orang_lain == "true") ? true : false;
        
        $store = $asesmen->frmak03()->create([
            'dijelaskan' => $dijelaskan,
            'diskusi' => $diskusi,
            'orang_lain' => $orang_lain,
            'alasan' => $request->alasan,
            'unit' => json_decode($request->unit),
        ]);

        return redirect()->route('asesi.asesmen.show', $asesmen->id)
            ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'formulir banding berhasil dibuat.']);
    }
}
