<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berkas;
use App\User;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            if ($request->get('q', null) != null && $request->get('users', null) != null)
            {
                return [
                    'data' => User::where('nama', 'LIKE', '%'.$request->get('q', '').'%')
                    ->select('id', 'nama')->get()
                ];
            }


            $berkas = Berkas::join('users', 'berkas.user_id', '=', 'users.id')
                ->select('berkas.nama', 'berkas.tipe', 'berkas.ukuran', 'users.nama as user_nama');
            return DataTables::of($berkas)
                ->make();
        }
        
        return view('pages.admin.berkas');
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
        // rule
        $request->validate([
            'user_id' => 'required|numeric',
            'file' => 'required|file'
        ]);

        // var
        $upload_path = 'berkas';

        // validate
        $request->validate(['file' => 'required|file']);
        $file = $request->file;
        $role = 'private';
        if ($request->has('role'))
        {
            $request->validate(['role' => 'required|in:private,public']);
            $role = $request->role;
        }
                
        // 
        $upload_file = null;
        DB::transaction(function () use ($file, $upload_path, $role, $request, &$upload_file) {
            // get info file
            $file_name = $file->getClientOriginalName();
            $file_mime = $file->getClientMimeType();
            $file_size = $file->getSize();

            // upload
            $store = $file->store($upload_path);
            $file_stored = str_replace($upload_path . '/', '', $store);
    
            // db
            $upload_file = Berkas::create([
                'user_id' => $request->user_id,
                'nama' => $file_name,
                'path' => $file_stored,
                'tipe' => $file_mime,
                'ukuran' => $file_size,
                'role' => $role
            ]);
        });

        // 
        return redirect()->route('admin.berkas')
            ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Upload Berkas Berhasil.']);
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
        return redirect()->route('admin.berkas')
            ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Menghapus Data Berhasil.']);
    }
}
