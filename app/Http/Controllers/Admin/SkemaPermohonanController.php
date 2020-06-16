<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Models\Permohonan;
use App\Models\Skema;
use App\Models\Tuk;
use App\User;
use Carbon\Carbon;
use DataTables;
use DB;
use App\Services\Select2;
use Illuminate\Database\Eloquent\Builder;

class SkemaPermohonanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Skema $skema)
    {
        if ($request->ajax())
        {
            $permohonan = Permohonan::with(['asesi' => function ($query) {
                return $query->select('id', 'nama');
            }, 'skema' => function ($query) {
                return $query->select('id', 'judul', 'kode');
            }])
                ->select('id', 'created_at', 'asesi_id', 'skema_id', 'approved_at')
                ->whereSkemaId($skema->id)->get();
            return DataTables::of($permohonan)
                ->addColumn('action', function (Permohonan $permohonan) use ($skema) {
                    $result = '<div>';
                    if ($permohonan->approved_at == null)
                    {
                        $result .= '<a href="'. route('admin.skema.permohonan.edit', [$skema->id, $permohonan->id]) .'?setujui" class="btn btn-sm btn-success"><i class="ft-check"></i></a>';
                    } else {
                        $result .= '<a href="'. route('admin.skema.permohonan.edit', [$skema->id, $permohonan->id]) .'?batal" class="btn btn-sm btn-danger"><i class="ft-x"></i></a>';
                    }
                    $result .= '<form method="post" action="'. route('admin.skema.permohonan.destroy', [$skema->id, $permohonan->id]) .'" style="display:inline;">'.csrf_field().method_field('delete').'<button class="btn btn-sm btn-danger"><i class="ft-trash"></i></button>';
                    $result .= '<div>';
                    return $result;

                })
                ->make();
        }

        return view('pages.admin.skema.permohonan.index', compact('skema'));
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
        //
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
    public function edit(Skema $skema, Permohonan $permohonan)
    {
        if ($permohonan->approved_at != null || isset($_GET['batal']))
        {
            $permohonan->update(['approved_at' => null]);
            $permohonan->permohonan_asesi_asesor()->delete();
            return redirect()->back()
                ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Permohonan Dibatalkan.']);
        } else if ($permohonan->approved_at == null || isset($_GET['setujui']))
        {
            // dd($permohonan->data->data_diri);
            $users = User::where('role', 'asesor')->get();
            $asesors = new Select2($users, ['id', 'nama']);
            $skema_jadwal = $skema->jadwal;
            $jadwals = new Select2($skema_jadwal, ['id', 'nama']);
            $skema_tuk = $skema->tuk;
            $tuks = new Select2($skema_tuk, ['id', 'nama']);
            return view('pages.admin.skema.permohonan.edit', compact('skema', 'permohonan', 'asesors', 'jadwals', 'tuks'));
        }

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Skema $skema, Permohonan $permohonan)
    {
        if ($permohonan->approved_at == null)
        {
            $request->validate(['asesor' => 'required', 'jadwal' => 'required', 'tuk' => 'required']);
            $asesor = User::findOrFail($request->asesor);
            $jadwal = Jadwal::findOrFail($request->jadwal);
            $tuk = Tuk::findOrFail($request->tuk);

            DB::transaction(function () use ($permohonan, $asesor, $jadwal, $tuk) {
                $permohonan->update(['approved_at' => Carbon::now()]);
                $permohonan->permohonan_asesi_asesor()->create([
                    'asesor_id' => $asesor->id,
                    'jadwal_id' => $jadwal->id,
                    'tuk_id' => $tuk->id,
                ]);
            });
            return redirect()->route('admin.skema.permohonan.index', [$skema->id])
                ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Permohonan Disetujui.']);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skema $skema, Permohonan $permohonan)
    {
        $permohonan->delete();
        return redirect()->route('admin.skema.permohonan.index', [$skema->id])
            ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Permohonan dihapus.']);
    }
}
