<?php

namespace App\Http\Controllers\Asesi;

use App\Http\Controllers\Controller;
use App\Models\Berkas;
use App\User;
use DataTables;
use Illuminate\Http\Request;

class BerkasController extends Controller
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
            $berkas = User::findOrFail(auth()->user()->id)->berkas;
            return DataTables::of($berkas)->make();
        }
        
        return view('pages.asesi.berkas');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // var
        $upload_path = 'berkas';
        $user_id = auth()->user()->id;

        // validate
        $request->validate(['file' => 'required|file']);
        $file = $request->file;
        $role = 'private';
        if ($request->has('role'))
        {
            $request->validate(['role' => 'required|in:private,public']);
            $role = $request->role;
        }
        
        
        // get info file
        $file_name = $file->getClientOriginalName();
        $file_mime = $file->getClientMimeType();
        $file_size = $file->getSize();
        
        // upload
        $store = $file->store($upload_path);
        $file_stored = str_replace($upload_path . '/', '', $store);

        // db
        $upload_file = Berkas::create([
            'user_id' => $user_id,
            'nama' => $file_name,
            'path' => $file_stored,
            'tipe' => $file_mime,
            'ukuran' => $file_size,
            'role' => $role
        ]);

        return redirect()->route('asesi.berkas.index')
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        $berkas = Berkas::findOrFail($ids);
        $destroy = $berkas->each(function ($berkas, $key) {
            $berkas->delete();
        });
        return redirect()->route('asesi.berkas.index')
            ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Menghapus Data Berhasil.']);
    }
}
