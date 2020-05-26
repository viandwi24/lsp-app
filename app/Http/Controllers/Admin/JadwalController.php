<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;

use App\Models\Jadwal;
use Carbon\Carbon;

class JadwalController extends Controller
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
            $jadwal = Jadwal::query();
            return DataTables::eloquent($jadwal)->make();
        }

        return view('pages.admin.jadwal.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.jadwal.create');
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
            'nama' => 'required',
            'pengumuman' => 'required',
            'acara' => 'required|json',
            'jam' => 'required',
            'tanggal' => 'required|date'
        ]);

        // convert
        $result = date('Y-m-d H:i:s', strtotime("$request->tanggal $request->jam"));
        $waktu_pelaksanaan = Carbon::parse($result);

        $store = Jadwal::create([
            'nama' => $request->nama, 
            'pengumuman' => $request->pengumuman, 
            'acara' => json_decode($request->acara),
            'waktu_pelaksanaan' => $waktu_pelaksanaan,
        ]);

        return redirect()->route('admin.jadwal.index')
            ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Tambah Data Berhasil.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $jadwal)
    {
        return view('pages.admin.jadwal.edit', compact('jadwal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'nama' => 'required',
            'pengumuman' => 'required',
            'acara' => 'required|json',
            'jam' => 'required',
            'tanggal' => 'required|date'
        ]);

        // convert
        $result = date('Y-m-d H:i:s', strtotime("$request->tanggal $request->jam"));
        $waktu_pelaksanaan = Carbon::parse($result);

        $update = $jadwal->update([
            'nama' => $request->nama, 
            'pengumuman' => $request->pengumuman, 
            'acara' => json_decode($request->acara),
            'waktu_pelaksanaan' => $waktu_pelaksanaan,
        ]);
        
        return redirect()->route('admin.jadwal.index')
            ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Memperbarui Data Berhasil.']);
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
        $jadwal = Jadwal::findOrFail($ids);
        $destroy = $jadwal->each(function ($jadwal, $key) {
            $jadwal->delete();
        });
        return redirect()->route('admin.jadwal.index')
            ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Menghapus Data Berhasil.']);
    }
}
