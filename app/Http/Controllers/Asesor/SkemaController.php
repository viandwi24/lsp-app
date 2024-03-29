<?php

namespace App\Http\Controllers\Asesor;

use App\Http\Controllers\Controller;
use App\Models\Skema;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SkemaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $skema_asesor = auth()->user()->asesor_skema->pluck('id');
            $skema = Skema::with('admin')->whereIn('id', $skema_asesor)->get();
            return DataTables::of($skema)
                ->addColumn('action', function (Skema $skema) {
                    return '
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Pilih
                        </button>
                        <div class="dropdown-menu" style="z-index: 100;" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="'. route('asesor.skema.frpaap01', [$skema->id]) .'">FR-PAAP</a>
                            <a class="dropdown-item" href="'. route('asesor.skema.frmak01', [$skema->id]) .'">FR-MAK-01</a>
                            <a class="dropdown-item" href="'. route('asesor.skema.frai02', [$skema->id]) .'">FR-AI-02</a>
                            <a class="dropdown-item" href="'. route('asesor.skema.fraiae01', [$skema->id]) .'">FR-AI-AE-01</a>
                            <a class="dropdown-item" href="'. route('asesor.skema.fraiae03', [$skema->id]) .'">FR-AI-AE-03</a>
                            <a class="dropdown-item" href="'. route('asesor.skema.umpanbalik', [$skema->id]) .'">Umpan Balik</a>
                        </div>
                    </div>
                    ';
                })
                ->make();
        }

        return view('pages.asesor.skema.index');
    }

    public function frpaap01(Skema $skema)
    {
        $selection = $this->formSelection($skema);
        return view('pages.asesor.skema.frpaap01', compact('skema', 'selection'));
    }

    public function frpaap01_update(Request $request, Skema $skema)
    {
        // validate
        $request->validate([
            'asesi' => 'required',
            'tujuan_asesmen' => 'required',
            'konteks_asesmen_lingkungan' => 'required',
            'konteks_asesmen_peluang_mengumpulan_bukti' => 'required',
            'konteks_asesmen_hubungan_standar_kompetensi' => 'required',
            'konteks_asesmen_pelaku_asesmen' => 'required',
            'relevan_dikonfirmasi' => 'required',
            'tolak_ukur' => 'required',
            'unit' => 'required|json'
        ]);

        // 
        DB::transaction(function () use ($skema, $request) {
            $skema->update([ 'unit' => json_decode($request->unit) ]);
            $skema->frpaap01()->update([
                'asesi' => $request->asesi,
                'tujuan_asesmen' => $request->tujuan_asesmen,
                'konteks_asesmen_lingkungan' => $request->konteks_asesmen_lingkungan,
                'konteks_asesmen_peluang_mengumpulan_bukti' => $request->konteks_asesmen_peluang_mengumpulan_bukti,
                'konteks_asesmen_hubungan_standar_kompetensi' => $request->konteks_asesmen_hubungan_standar_kompetensi,
                'konteks_asesmen_pelaku_asesmen' => $request->konteks_asesmen_pelaku_asesmen,
                'relevan_dikonfirmasi' => $request->relevan_dikonfirmasi,
                'tolak_ukur' => $request->tolak_ukur,
            ]);
        });

        // 
        return redirect()->back()
            ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Data berhasil diperbarui.']);
    }

    protected function formSelection($skema)
    {
        $data['asesi'] = ['Hasil pelatihan dan / atau pendidikan', 'Pekerja berpengalaman', 'Pelatihan / belajar mandiri'];
        $data['tujuan_asesmen'] = ['Sertifikasi', 'RCC', 'RPL', 'Hasil pelatihan / proses pembelajaran', 'Lainnya'];
        $data['konteks_asesmen_lingkungan'] = ['Tempat kerja nyata', 'Tempat kerja simulasi'];
        $data['konteks_asesmen_peluang_mengumpulan_bukti'] = ['Tersedia', 'Terbatas'];
        $data['konteks_asesmen_hubungan_standar_kompetensi'] = ['Bukti untuk mendukung asesmen / RPL', 'Aktivitas kerja di tempat kerja kandidat', 'Kegiatan Pembelajaran'];
        $data['konteks_asesmen_pelaku_asesmen'] = ['Lembaga Sertifikasi', 'Organisasi Pelatihan', 'Asesor Perusahaan'];
        $data['relevan_dikonfirmasi'] = ['Manajer sertifikasi LSP', 'Master Assessor / Master Trainer / Asesor Utama kompetensi', 'Manajer pelatihan Lembaga Training terakreditasi / Lembaga Training terdaftar', 'Lainnya'];
        $data['tolak_ukur'] = ['Standar kompetensi', 'Kriteria asesmen dari kurikulum pelatihan', 'Spesifikasi kinerja suatu perusahaan atau industri', 'Spesifikasi produk', 'Pedoman khusus'];
        return $data;
    }

    public function frmak01(Skema $skema)
    {
        return view('pages.asesor.skema.frmak01', compact('skema'));
    }
    
    public function frmak01_update(Request $request, Skema $skema)
    {
        $buktis = [
            [
                "judul" => "Bukti TL",
                "items" => ["vp", "dpw"],
            ],
            [
                "judul" => "Bukti L",
                "items" => ["clo", "ppo", "dit"],
            ],
            [
                "judul" => "Bukti T",
                "items" => ["dpt", "dpl"],
            ],
        ];
        $data = [
            'bukti_tl' => [],
            'bukti_l' => [],
            'bukti_t' => [],
        ];

        // forea
        foreach($buktis as $bukti)
        {
            foreach($bukti['items'] as $item) {
                $item = strtoupper($item);
                $key  = str_replace(" ", "_", strtolower($bukti['judul']));
                if ($request->has($item) && $request->input($item)) 
                {
                    $data[$key][] = $item;
                }
            }
        }

        // 
        $skema->frmak01()->update($data);

        // /
        return redirect()->back()
        ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Data berhasil diperbarui.']);    
    
    }

    public function frai02(Skema $skema)
    {   
        return view('pages.asesor.skema.frai02', compact('skema'));
    }

    public function frai02_update(Request $request, Skema $skema)
    {
        $request->validate([
            'pertanyaan' => 'required|json'
        ]);
        $update = $skema->update([ 'unit' => json_decode($request->pertanyaan) ]);
        
        return redirect()->back()
            ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Data berhasil diperbarui.']);
    }

    public function fraiae01(Skema $skema)
    {   
        return view('pages.asesor.skema.fraiae01', compact('skema'));
    }

    public function fraiae01_update(Request $request, Skema $skema)
    {
        $request->validate([
            'pertanyaan' => 'required|json'
        ]);
        $update = $skema->fraiae01()->update([ 'pertanyaan' => $request->pertanyaan ]);
        
        return redirect()->back()
            ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Data berhasil diperbarui.']);
    }

    public function fraiae03(Skema $skema)
    {   
        return view('pages.asesor.skema.fraiae03', compact('skema'));
    }

    public function fraiae03_update(Request $request, Skema $skema)
    {
        $request->validate([
            'pertanyaan' => 'required|json'
        ]);
        $update = $skema->fraiae03()->update([ 'pertanyaan' => $request->pertanyaan ]);
        
        return redirect()->back()
            ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Data berhasil diperbarui.']);
    }

    public function umpanbalik(Skema $skema)
    { 
        return view('pages.asesor.skema.umpanbalik', compact('skema'));
    }

    public function umpanbalik_update(Request $request, Skema $skema)
    {
        $request->validate([
            'pertanyaan' => 'required|json'
        ]);
        $update = $skema->umpanbalik()->update([ 'pertanyaan' => $request->pertanyaan ]);
        
        return redirect()->back()
            ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Data berhasil diperbarui.']);
    }
}
