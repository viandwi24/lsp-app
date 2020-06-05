<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\Permohonan;
use App\Models\Skema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Services\User;
use App\User as AppUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MigrationController extends Controller
{
    public function index() 
    {
        return view('migrasi.user');
    }

    public function prepare (Request $request)
    {
        $request->validate([
            'user' => 'required|array',
            'skema' => 'required|integer',
            'asesor' => 'required|integer',
            'jadwal' => 'required|integer',
        ]);
    
        $skema = DB::table("skema")->find($request->skema);
        $asesor = DB::table("users")->whereId($request->asesor)->where("role", "asesor")->first();
        $jadwal = DB::table("jadwal")->find($request->jadwal);
    
        $users = [];
        foreach ($request->user as $key => $user) {
            $user = DB::connection("mysql2")->table("users")->where("nama", "LIKE", "%". $user ."%")->first();
            $frapl1 = DB::connection("mysql2")->table("fr_apl1_user")->where("user_id", $user->id)->first();
            $users[$key] = (object) [
                'data' => $user,
                'frapl01' => $frapl1
            ];
        }
        
        $result = [
            'users' => $users,
            'skema' => $skema,
            'asesor' => $asesor,
            'jadwal' => $jadwal,
        ];
        return view("migrasi.prepare", $result);
    }

    public function migrate (Request $request)
    {
        $request->validate([
            'user' => 'required|array',
            'skema' => 'required|integer',
            'asesor' => 'required|integer',
            'jadwal' => 'required|integer',
        ]);

        $skema = Skema::find($request->skema);
        $asesor = DB::table("users")->find($request->asesor);
        $jadwal = DB::table("jadwal")->find($request->jadwal);

        $users = [];
        foreach ($request->user as $key => $user) {
            $user = DB::connection("mysql2")->table("users")->whereId($user)->first();
            $frapl1 = DB::connection("mysql2")->table("fr_apl1_user")->where("user_id", $user->id)->first();
            $users[$key] = (object) [
                'data' => $user,
                'frapl01' => $frapl1
            ];
        }
        
        $result = [];
        DB::transaction(function () use ($users, $skema, $asesor, $jadwal, &$result) {
            // insert user
            foreach ($users as $user) {
                $search_user = DB::table("users")->where("role", "asesi")->where("nama", $user->data->nama)->first();
                if ($search_user == null) {
                    $search_user = User::make('asesi', $user->data->nama, $user->data->email, $user->data->password, [], true);
                }

                // convert permohonan
                $old_data_diri = json_decode($user->frapl01->data_diri);
                $old_data_diri = $this->moveObj($old_data_diri, 'tgl_lahir', 'tanggal_lahir');
                $old_data_diri = $this->moveObj($old_data_diri, 'kelamin', 'jenis_kelamin');
                $old_perkejaan = json_decode($user->frapl01->pekerjaan);    
                $newData = [
                    "data_diri" => $old_data_diri,
                    "tujuan_asesmen" => json_decode($user->frapl01->skema_sertifikasi)->tujuan,
                    "bekerja" => isset($old_perkejaan->nama) ? true : false,
                ];
                if (isset($old_perkejaan->nama)) $newData['pekerjaan'] = ($old_perkejaan);
                $newData['kuk'] = [];
                foreach($skema->unit as $unit_index => $unit)
                {
                    foreach($unit->elemen as $elemen_index => $elemen)
                    {
                        foreach($elemen->kuk as $kuk_index => $kuk)
                        {
                            $newData['kuk'][$unit_index][$elemen_index][$kuk_index] = true;
                        }   
                    }
                }
                $newData['ttd'] = $user->frapl01->ttd;

                // convert berkas
                $newBerkas = $this->convertBerkas($user, $search_user);

                // insert permohonan
                $permohonan = Permohonan::create([
                    'asesi_id' => $search_user->id,
                    'skema_id' => $skema->id,
                    'skema' => $skema,
                    'data' => $newData,
                ]);

                // insert berkas
                foreach($newBerkas as $berkas)
                {
                    $permohonan->berkas()->attach( $berkas['id'], ['nama' => $berkas['nama'] ] );
                }

                // insert permohona  asesi asesor
                $permohonan->update(['approved_at' => Carbon::now()]);
                $permohonan->permohonan_asesi_asesor()->create([
                    'asesor_id' => $asesor->id,
                    'jadwal_id' => $jadwal->id,
                ]);

                $result[] = (object) [
                    "user" => $search_user,
                    "permohonan" => $permohonan,
                    "berkas" => $permohonan->berkas
                ];
            }
        });
        

        // 
        return view("migrasi.result", compact('result', 'skema', 'asesor', 'jadwal'));
    }

    public function rollback(Request $request) 
    {
        Permohonan::whereIn('id', $request->permohonan)->delete();
        Berkas::whereIn('id', $request->berkas)->delete();
        AppUser::whereIn('id', $request->user)->delete();

        dd([
            'status' => 'rollback success.',
            'delete' => $request->all()
        ]);
    }

    private function moveObj($array, $old, $new) {
        $array->{$new} = $array->{$old};
        unset($array->{$old});
        return $array;
    }

    private function convertBerkas($user, $newUser) {
        $old_path = base_path("../lsp_bak/storage/app/user_data/");
        $newPath = storage_path('app/berkas/');
        $file_bukti_persyaratan = json_decode($user->frapl01->file_bukti_persyaratan);
        foreach($file_bukti_persyaratan as $key => $item) {
            $file_bukti_persyaratan[$key] = $item;
            $file_bukti_persyaratan[$key]->path = realpath($old_path . $user->data->id . "/frapl1//" . $user->frapl01->id . "/bukti_persyaratan//" . $item->file);
        }
        $file_bukti_kompetensi = json_decode($user->frapl01->file_bukti_kompetensi);
        foreach($file_bukti_kompetensi as $key => $item) {
            $file_bukti_kompetensi[$key] = $item;
            $file_bukti_kompetensi[$key]->path = $old_path . $user->data->id . "/frapl1//" . $user->frapl01->id . "/bukti_kompetensi//" . $item->file;
        }
        $berkas = array_merge($file_bukti_persyaratan, $file_bukti_kompetensi);

        $result_berkas = [];
        foreach($berkas as $item) {
            $file = $newPath . $item->file;
            $file_name = $item->judul . "." . pathinfo($file)['extension'];
            $file_mime = File::mimeType($item->path);
            $file_size = File::size($item->path);
            File::copy($item->path, $file);
            $berkas_store = Berkas::create([
                'user_id' => $newUser->id,
                'nama' => $file_name,
                'path' => $item->file,
                'tipe' => $file_mime,
                'ukuran' => $file_size,
                'role' => 'private'
            ]);
            $result_berkas[] = ["nama" => $item->judul, "id" => $berkas_store->id];
        }

        return $result_berkas;
    }
}
