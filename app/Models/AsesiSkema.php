<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsesiSkema extends Model
{

    protected $table = 'asesi_skema';
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
}
