<?php

namespace App\Http\Controllers\Asesi;

use App\Http\Controllers\Controller;
use App\Models\Permohonan;
use App\Models\Skema;
use App\Services\Select2;
use App\User;
use DataTables;
use Illuminate\Http\Request;

class PermohonanController extends Controller
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
            $user = auth()->user();
            $permohonan = Permohonan::with('user', 'skema')->whereUserId($user->id)->get();
            return DataTables::of($permohonan)->make();
        }

        return view('pages.asesi.permohonan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Skema $skema)
    {
        $user = auth()->user();
        $berkass = new Select2(auth()->user()->berkas, ['nama']);
        return view('pages.asesi.permohonan.create', compact('skema', 'user', 'berkass'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Skema $skema)
    {
        // var
        $user = auth()->user();
        $data = [];

        // data diri
        $request->validate([
            'data_diri.nama' => 'required',
            'data_diri.tempat_lahir' => 'required',
            'data_diri.tanggal_lahir' => 'required|date',
            'data_diri.jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'data_diri.kebangsaan' => 'required',
            'data_diri.alamat' => 'required',
            'data_diri.no_telp' => 'required',
            'data_diri.email' => 'required|email',
            'data_diri.pendidikan_terakhir' => 'required',
            'tujuan_asesmen' => 'required|in:sertifikasi,sertifikasi_ulang,lainnya',
            'bekerja' => 'required|in:0,1|boolean',
        ]);
        $data['data_diri'] = $request->data_diri;
        $data['tujuan_asesmen'] = $request->tujuan_asesmen;
        $data['bekerja'] = ($request->bekerja) ? true : false;


        // pekerjaan
        if ($request->bekerja == '1')
        {
            $request->validate([
                'pekerjaan.nama' => 'required',
                'pekerjaan.jabatan' => 'required',
                'pekerjaan.alamat' => 'required',
                'pekerjaan.no_telp' => 'required',
                'pekerjaan.email' => 'required|email',
            ]);
            $data['pekerjaan'] = $request->pekerjaan;
        }


        // tanda tangan
        if (empty($user->data->ttd))
        {
            return redirect()->back()
                ->withInput($request->all())
                ->with('alert', ['type' => 'error', 'title' => 'Error', 'text' => 'Anda belum mengeset tanda tangan.']);            
        }
        $data['ttd'] = $user->data->ttd;

        // berkas validation
        $i = 0;
        foreach($skema->berkas as $berkas)
        {
            if ($berkas->tipe == 'ditentukan')
            {
                $request->validate(['berkas_file.' . $i => 'required|exists:berkas,id']);
            } else {
                $request->validate([
                    'berkas_nama.' . $i => 'required',
                    'berkas_file.' . $i => 'required|exists:berkas,id',
                ]);
            }
            $i++;
        }

        // 
        $permohonan = Permohonan::create([
            'user_id' => $user->id,
            'skema_id' => $skema->id,
            'skema' => $skema,
            'data' => $data,
        ]);

        // attach berkas
        $i = 0;
        foreach($skema->berkas as $berkas)
        {
            $berkas_nama = $request->berkas_nama[$i];
            if ($berkas->tipe == 'ditentukan') $berkas_nama = $berkas->nama;

            $i++;
        }
        $permohonan->berkas()->attach( $request->berkas_file, ['nama' => $berkas_nama ] );

        // 
        return redirect()->route('asesi.permohonan.index');
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
        //
    }
}
