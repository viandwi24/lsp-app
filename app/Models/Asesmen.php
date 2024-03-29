<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asesmen extends Model
{

    protected $table = 'asesmen';
    protected $guarded = [];
    protected $appends = ['status'];

    public function permohonan()
    {
        return $this->belongsTo('App\Models\Permohonan');
    }

    public function skema()
    {
        return $this->belongsTo('App\Models\Skema');
    }

    public function asesor()
    {
        return $this->belongsTo('App\User', 'asesor_id');
    }

    public function asesi()
    {
        return $this->belongsTo('App\User', 'asesi_id');
    }

    public function getStatusAttribute()
    {
        $keputusan = $this->keputusan;
        if ($keputusan == null) return 'Proses';
        return 'Selesai';
    }

    public function jadwal()
    {
        return $this->belongsTo('App\Models\Jadwal');
    }

    public function tuk()
    {
        return $this->belongsTo('App\Models\Tuk');
    }

    public function frmak01()
    {
        return $this->hasOne('App\Models\AsesmenFrmak01');
    }

    public function frmak03()
    {
        return $this->hasOne('App\Models\AsesmenFrmak03');
    }

    public function frai01()
    {
        return $this->hasOne('App\Models\AsesmenFrai01');
    }

    public function frai02()
    {
        return $this->hasOne('App\Models\AsesmenFrai02');
    }

    public function fraiae01()
    {
        return $this->hasOne('App\Models\AsesmenFraiae01');
    }

    public function fraiae03()
    {
        return $this->hasOne('App\Models\AsesmenFraiae03');
    }

    public function frac01()
    {
        return $this->hasOne('App\Models\AsesmenFrac01');
    }

    public function umpanbalik()
    {
        return $this->hasOne('App\Models\AsesmenFrUmpanBalik');
    }
}
