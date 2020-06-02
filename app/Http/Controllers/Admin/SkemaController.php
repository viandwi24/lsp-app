<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Menu;
use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Kategori;
use Illuminate\Http\Request;
use DataTables;

use App\User;
use App\Models\Skema;
use App\Models\Tuk;
use App\Services\Select2;
use Illuminate\Support\Facades\DB;

class SkemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $skema = Skema::with('admin')->get();
            return DataTables::of($skema)->make();
        }

        return view('pages.admin.skema.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('role', 'admin')->get();
        $kategoris = Kategori::all();
        $tuks = Tuk::all();
        $admins = new Select2($users, ['id', 'nama']);
        $kategoris = new Select2($kategoris, ['nama']);
        $tuks = new Select2($tuks, ['id', 'nama']);
        return view('pages.admin.skema.create', compact('kategoris', 'admins', 'tuks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kode' => 'required',
            'admin_id' => 'required|numeric',
            'tuk_id' => 'required|numeric',
            'kategori_id' => 'required|array',
        ]);

        DB::transaction(function () use ($request) {
            // create
            $store = Skema::create($request->only('judul', 'kode', 'admin_id', 'tuk_id'));

            // add relation table
            $store->frpaap01()->create([
                'asesi' => 'Hasil pelatihan dan / atau pendidikan',
                'tujuan_asesmen' => 'Sertifikasi',
                'konteks_asesmen_lingkungan' => 'Tempat kerja nyata',
                'konteks_asesmen_peluang_mengumpulan_bukti' => 'Tersedia',
                'konteks_asesmen_hubungan_standar_kompetensi' => 'Bukti untuk mendukung asesmen / RPL',
                'konteks_asesmen_pelaku_asesmen' => 'Lembaga Sertifikasi',
                'relevan_dikonfirmasi' => 'Manajer sertifikasi LSP',
                'tolak_ukur' => 'Standar kompetensi',
            ]);
            $store->frmak01()->create([]);
            $store->frai02()->create([]);
            $store->fraiae01()->create([]);
            $skema->fraiae03()->create([]);

            // kategori
            $store->kategori()->sync($request->kategori_id);
        });


        return redirect()->route('admin.skema.index')
            ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Tambah Data Berhasil.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Skema $skema)
    {
        $dashboardMenu = Menu::get('dashboard.skema')->toArray('admin');
        $dashboardWidget = Menu::get('dashboard.skema.widget')->toArray('admin');
        return view('pages.admin.skema.show', compact('skema', 'dashboardMenu', 'dashboardWidget'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Skema $skema)
    {
        //  unit
        if ($request->get('tab') == 'unit')
        {
            return view('pages.admin.skema.edit_unit', compact('skema'));
        
        // asesor
        } elseif ($request->get('tab') == 'asesor')
        {
            $users = User::where('role', 'asesor')->get();
            $asesors = new Select2($users, ['id', 'nama']);
            return view('pages.admin.skema.edit_asesor', compact('skema', 'asesors'));
        
        // jadwal
        } elseif ($request->get('tab') == 'jadwal')
        {
            $jadwals = Jadwal::all();
            $jadwals = new Select2($jadwals, ['id', 'nama']);
            return view('pages.admin.skema.edit_jadwal', compact('skema', 'jadwals'));

        // berkas
        } elseif ($request->get('tab') == 'berkas')
        {
            return view('pages.admin.skema.edit_berkas', compact('skema'));

        // 
        } else {
            $users = User::where('role', 'admin')->get();
            $kategoris = Kategori::all();
            $admins = new Select2($users, ['id', 'nama']);
            $kategoris = new Select2($kategoris, ['nama']);
            $tuks = Tuk::all();
            $tuks = new Select2($tuks, ['id', 'nama']);
            return view('pages.admin.skema.edit', compact('skema', 'admins', 'kategoris', 'tuks'));
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Skema $skema)
    {
        if ($request->get('tab') == 'unit')
        {
            $request->validate([ 'unit' => 'required|json' ]);
            $unit = json_decode($request->unit);
            $update = $skema->update([ 'unit' => $unit ]);
            return redirect()->route('admin.skema.show', [$skema->id])
                ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Memperbarui Data Berhasil.']);

        // asesor
        } elseif ($request->get('tab') == 'asesor')
        {
            $request->validate([ 'asesor' => 'required|array' ]);
            $update = $skema->asesor()->sync($request->asesor);
            return redirect()->route('admin.skema.show', [$skema->id])
                ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Memperbarui Data Berhasil.']);

        // jadwal
        } elseif ($request->get('tab') == 'jadwal')
        {
            $request->validate([ 'jadwal' => 'required|array' ]);
            $update = $skema->jadwal()->sync($request->jadwal);
            return redirect()->route('admin.skema.show', [$skema->id])
                ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Memperbarui Data Berhasil.']);
        
        
        // berkas
        } elseif ($request->get('tab') == 'berkas')
        {
            $request->validate([ 'berkas' => 'required|json' ]);
            $berkas = json_decode($request->berkas);
            $update = $skema->update([ 'berkas' => $berkas ]);
            return redirect()->route('admin.skema.show', [$skema->id])
                ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Memperbarui Data Berhasil.']);
        
        
        // skema
        } else {

            $request->validate([
                'judul' => 'required',
                'kode' => 'required',
                'admin_id' => 'required|numeric',
                'tuk_id' => 'required|numeric',
                'kategori_id' => 'required|array',
            ]);
            $update = $skema->update($request->only('judul', 'kode', 'admin_id', 'tuk_id'));
            $skema->kategori()->sync($request->kategori_id);
            return redirect()->route('admin.skema.show', [$skema->id])
                ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Memperbarui Data Berhasil.']);
        
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ids = \explode(',', $id);
        $skema = Skema::findOrFail($ids);
        $destroy = $skema->each(function ($skema, $key) {
            $skema->delete();
        });
        return redirect()->route('admin.skema.index')
            ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Menghapus Data Berhasil.']);
    }
}
