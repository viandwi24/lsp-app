<?php

namespace App\Http\Controllers\Asesor;

use App\Http\Controllers\Controller;
use App\Models\Permohonan;
use App\Models\PermohonanAsesiAsesor;
use Carbon\Carbon;
use DataTables;
use DB;
use Illuminate\Http\Request;

class PermohonanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $permohonan = PermohonanAsesiAsesor::with(['permohonan', 'permohonan.skema' => function ($query) { return $query->select('id', 'judul', 'kode'); }, 'permohonan.asesi' => function ($query) { return $query->select('id', 'nama'); }])
                ->where('asesor_id', auth()->user()->id)->get();
            return DataTables::of($permohonan)
                ->addColumn('status', function (PermohonanAsesiAsesor $permohonan) {
                    return ($permohonan->status == "Disetujui") 
                        ? '<span class="badge badge-success">'.$permohonan->status.'</span>'
                        : '<span class="badge badge-danger">'.$permohonan->status.'</span>';
                })
                ->addColumn('created_at', function (PermohonanAsesiAsesor $permohonan) {
                    return $permohonan->created_at->format("d-m-Y");
                })
                ->addColumn('action', function (PermohonanAsesiAsesor $permohonan) {
                    $result = '<div>';
                    if ($permohonan->approved_at == null)   
                    {
                        $result .= '<a href="'. route('asesor.permohonan.edit', [$permohonan->id]) .'?setujui" class="btn btn-sm btn-success"><i class="ft-check"></i> Setujui</a>';
                    } else {
                        $result .= '<form method="post" action="'.route('asesor.permohonan.update', [$permohonan->id]).'?batal">' . csrf_field() . method_field('put');
                        $result .= '<button class="btn btn-sm btn-danger"><i class="ft-x"></i> Batal</button>';
                        $result .= '</form>';
                    }
                    $result .= '<div>';
                    return $result;

                })
                ->rawColumns(['status', 'action'])
                ->make();
        }

        return view('pages.asesor.permohonan.index');
    }

    public function edit(PermohonanAsesiAsesor $permohonanAsesiAsesor)
    {
        if ($permohonanAsesiAsesor->approved_at == null || isset($_GET['setujui']))
        {
            return view('pages.asesor.permohonan.edit', compact('permohonanAsesiAsesor'));
        }
    }

    // 
    public function update($id)
    {
        $ids = \explode(',', $id);
        $permohonanAsesiAsesor = PermohonanAsesiAsesor::find($ids);
        $destroy = $permohonanAsesiAsesor->each(function ($permohonanAsesiAsesor, $key) {
            if (isset($_GET['setujui']) && $permohonanAsesiAsesor->approved_at == null)
            {
                $permohonan = Permohonan::findOrFail($permohonanAsesiAsesor->permohonan->id);
                DB::transaction(function () use ($permohonanAsesiAsesor, $permohonan) {
                    $permohonanAsesiAsesor->update(['approved_at' => Carbon::now()]);
                    $permohonan->asesmen()->updateOrCreate([
                        'asesor_id' => $permohonanAsesiAsesor->asesor_id,
                        'asesi_id' => $permohonan->asesi_id,
                        'skema_id' => $permohonan->skema_id,
                        'jadwal_id' => $permohonanAsesiAsesor->jadwal_id,
                        'tuk_id' => $permohonanAsesiAsesor->tuk_id,
                    ]);
                });
            } else if (isset($_GET['batal']) && $permohonanAsesiAsesor->approved_at != null) {

                // id
                $permohonan = Permohonan::findOrFail($permohonanAsesiAsesor->permohonan->id);
                DB::transaction(function () use ($permohonanAsesiAsesor, $permohonan) {
                    $permohonanAsesiAsesor->update(['approved_at' => null]);
                    $permohonan->asesmen()->delete();
                });
            }
        });
        
        if (isset($_GET['setujui']))
        {
            return redirect()->route('asesor.permohonan.index')
                ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Permohonan Disetujui.']);
        } else if (isset($_GET['batal']))
        {
            return redirect()->route('asesor.permohonan.index')
            ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Permohonan Dibatalkan.']);
        }

        return redirect()->back();
    }
}
