<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use DataTables;

use App\User;
use App\Models\Skema;
use App\Models\Tuk;
use App\Services\Select2;
use App\Services\SkemaDashboard;

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
        $admins = new Select2($users, ['id', 'nama']);
        return view('pages.admin.skema.create', compact('admins'));
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
        ]);

        $store = Skema::create($request->only('judul', 'kode', 'admin_id'));
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
        $dashboardMenu = SkemaDashboard::getMenu($skema);
        $dashboardWidget = SkemaDashboard::getWidget($skema);
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

        // tuk
        } elseif ($request->get('tab') == 'tuk')
        {
            $tuks = Tuk::all();
            $tuks = new Select2($tuks, ['id', 'nama']);
            return view('pages.admin.skema.edit_tuk', compact('skema', 'tuks'));
        
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
            $admins = new Select2($users, ['id', 'nama']);
            return view('pages.admin.skema.edit', compact('skema', 'admins'));
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

        // tuk
        } elseif ($request->get('tab') == 'tuk')
        {
            $request->validate([ 'tuk' => 'required|array' ]);
            $update = $skema->tuk()->sync($request->tuk);
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
            ]);
            $update = $skema->update($request->only('judul', 'kode', 'admin_id'));
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
