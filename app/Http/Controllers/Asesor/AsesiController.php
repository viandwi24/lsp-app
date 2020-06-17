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
            $asesmen = Asesmen::with(['asesi' => function ($query) {
                return $query->select('id', 'nama');
            }, 'skema'  => function ($query) {
                return $query->select('id', 'judul', 'kode');
            }])->where('asesor_id', auth()->user()->id)->get();
            return DataTables::of($asesmen)
                ->addColumn('keputusan', function (Asesmen $asesmen) {
                    $keputusan = $asesmen->keputusan;
                    return ($keputusan == null) ? 'Belum ditentukan' : ($keputusan == 'kompeten' ? 'Kompeten' : 'Belum Kompeten');
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

    public function update(Request $request, Asesmen $asesmen)
    {
        $request->validate(['keputusan' => 'required|in:belum_kompeten,kompeten,null']);
        $keputusan = ($request->keputusan == "null") ? null : $request->keputusan;
        $asesmen->update(['keputusan' => $keputusan]);
        return redirect()->route('asesor.asesi.show', $asesmen->id)
                ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Berhasil merubah keputusan.']);
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
                            $data[$unit_k]->elemen[$elemen_k]->kuk[$kuk_k]->benchmark = 'SOP . ' . $unit->judul;
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
            $asesmen->frai01()->create([
                'data' => $data,
                'catatan' => "Semua KUK sudah terpenuhi."
            ]);
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
        if (isset($_GET['reset']))
        {
            DB::transaction(function () use ($asesmen) {
                $asesmen->frai02()->delete();
            });
            return redirect()->route('asesor.asesi.show', $asesmen->id)
                ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Reset formulir Berhasil.']);
        }

        // 
        if ($asesmen->frai02 == null) 
        {
            $units = $asesmen->skema->unit;
            $data = [];
            foreach($units as $unit_index => $unit)
            {
                $data[$unit_index] = clone $unit;
                $data[$unit_index]->pertanyaan = [];
                foreach($unit->pertanyaan as $index => $pertanyaan)
                {
                    $data[$unit_index]->pertanyaan[] = (object) ['pertanyaan' => $units[$unit_index]->pertanyaan[$index], 'jawaban' => '', 'memuaskan' => false];
                }
            }
            $asesmen->frai02()->create([
                'data' => $data,
                'catatan' => "Semua pertanyaan sudah terjawab dengan baik."
            ]);
            return redirect()->route('asesor.asesi.frai02', [$asesmen->id]);
        }
        return view('pages.asesor.asesi.form.frai02', compact('asesmen'));
    }

    public function frai02_post(Request $request, Asesmen $asesmen)
    {
        if ($asesmen->frai02 != null)
        {
            $request->validate([
                'pengetahuan' => 'required|in:memuaskan,tidak_memuaskan',
                'catatan' => 'required'
            ]);

            if ($request->has('pilihan'))
            {
                $request->validate(['pilihan' => 'required|array']);
            }

            if ($request->has('jawaban'))
            {
                $request->validate(['jawaban' => 'required|array']);
            }

            $data = $asesmen->frai02->data;
            foreach($asesmen->frai02->data as $index_unit => $unit)
            {
                foreach($unit->pertanyaan as $index => $pertanyaan)
                {
                    if (isset($request->pilihan[$index_unit][$index]) && $request->pilihan[$index_unit][$index] == "true")
                    {
                        $data[$index_unit]->pertanyaan[$index]->memuaskan = true;
                    } else {
                        $data[$index_unit]->pertanyaan[$index]->memuaskan = false;
                    }


                    @$data[$index_unit]->pertanyaan[$index]->jawaban = @$request->jawaban[$index_unit][$index];
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

    public function fraiae01(Asesmen $asesmen)
    {
        if ($asesmen->fraiae01 == null) return abort(404);
        return view('pages.asesor.asesi.form.fraiae01', compact('asesmen'));
    }

    public function fraiae01_post(Request $request, Asesmen $asesmen)
    {
        if ($asesmen->fraiae01 != null)
        {
            if ($request->has('pilihan'))
            {
                $request->validate(['pilihan' => 'required|array']);
            }

            $data = $asesmen->fraiae01->data;
            foreach($asesmen->fraiae01->data as $index => $pertanyaan)
            {
                if (isset($request->pilihan[$index]) && $request->pilihan[$index] == "true")
                {
                    $data[$index]->memuaskan = true;
                } else {
                    $data[$index]->memuaskan = false;
                }
            }

            $asesmen->fraiae01()->update([
                'data' => $data
            ]);

            return redirect()->route('asesor.asesi.show', $asesmen->id)
            ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Mengisi formulir Berhasil.']);
        }

        return redirect()->back();
    }

    public function fraiae03(Asesmen $asesmen)
    {
        if ($asesmen->fraiae03 == null) return abort(404);
        return view('pages.asesor.asesi.form.fraiae03', compact('asesmen'));
    }

    public function fraiae03_post(Request $request, Asesmen $asesmen)
    {
        if ($asesmen->fraiae03 != null)
        {
            if ($request->has('pilihan'))
            {
                $request->validate(['pilihan' => 'required|array']);
            }

            $data = $asesmen->fraiae03->data;
            foreach($asesmen->fraiae03->data as $index => $pertanyaan)
            {
                if (isset($request->pilihan[$index]) && $request->pilihan[$index] == "true")
                {
                    $data[$index]->memuaskan = true;
                } else {
                    $data[$index]->memuaskan = false;
                }
            }

            $asesmen->fraiae03()->update([
                'data' => $data
            ]);

            return redirect()->route('asesor.asesi.show', $asesmen->id)
            ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Mengisi formulir Berhasil.']);
        }

        return redirect()->back();
    }


    public function frac01(Asesmen $asesmen)
    {
        if (isset($_GET['reset']))
        {
            DB::transaction(function () use ($asesmen) {
                $asesmen->frac01()->delete();
            });
            return redirect()->route('asesor.asesi.show', $asesmen->id)
                ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Reset formulir Berhasil.']);
        }

        if ($asesmen->frac01 == null) 
        {
            $bukti = [];
            foreach($asesmen->skema->unit as $unit)
            {
                $ada_apa = [
                    'unit' => $unit,
                    'observasi' => false,
                    'portofolio' => false,
                    'pernyataan_pihak_ketiga' => false,
                    'pertanyaan_lisan' => false,
                    'pertanyaan_tertulis' => false,
                    'proyek_kerja' => false,
                    'lainnya' => false
                ];

                foreach ($unit->elemen as $elemen) {
                    foreach ($elemen->kuk as $kuk) {
                        $jawaban_metode = $kuk->rencana_asesmen->jawaban->metode;
                        $jawaban_jenis_bukti = $kuk->rencana_asesmen->jawaban->jenis_bukti;
                        $observasi_metode = $kuk->rencana_asesmen->observasi->metode;
                        $observasi_jenis_bukti = $kuk->rencana_asesmen->observasi->jenis_bukti;

                        if ($jawaban_metode == "CL" || $observasi_metode == "CL") {
                            $ada_apa['observasi'] = true;
                        }

                        if ($jawaban_metode == "DPT" || $observasi_metode == "DPT") {
                            $ada_apa['pertanyaan_tertulis'] = true;
                        }

                        if ($jawaban_metode == "DPL" || $observasi_metode == "DPL") {
                            $ada_apa['pertanyaan_lisan'] = true;
                        }

                        if ($jawaban_metode == "VP" || $observasi_metode == "VP") {
                            $ada_apa['portofolio'] = true;
                        }
                    }
                }

                $bukti[] = (object) $ada_apa;
            }

            $asesmen->frac01()->create([
                'bukti' => $bukti,
                'keputusan' => 'kompeten',
                'skema' => $asesmen->skema,
                'mulai' => $asesmen->jadwal->waktu_pelaksanaan,
                'selesai' => $asesmen->jadwal->waktu_pelaksanaan,
                'signed_asesor_at' => Carbon::now()
            ]);

            return redirect()->route('asesor.asesi.frac01', [$asesmen->id]);
        }

        return view('pages.asesor.asesi.form.frac01', compact('asesmen'));
    }

    public function frac01_post(Request $request, Asesmen $asesmen)
    {
        if ($asesmen->frac01 != null)
        {
            $request->validate([
                'bukti' => 'required',
                'keputusan' => 'required|in:kompeten,belum_kompeten',
                'tindak_lanjut' => 'required',
                'komentar' => 'required',
            ]);

            DB::transaction(function () use ($asesmen, $request) {
                $update = $asesmen->frac01()->update([
                    'bukti' => json_decode($request->bukti),
                    'keputusan' => $request->keputusan,
                    'tindak_lanjut' => $request->tindak_lanjut,
                    'komentar' => $request->komentar
                ]);
                $asesmen->update([ 'keputusan' => $request->keputusan ]);
            });

            return redirect()->route('asesor.asesi.show', $asesmen->id)
            ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Mengisi formulir Berhasil.']);
        }

        return redirect()->back();
    }
}
