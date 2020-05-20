<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermohonanAsesiAsesor extends Model
{

    protected $table = 'permohonan_asesi_asesor';
    protected $guarded = [];
    protected $casts = [];

    protected $appends = ['created_at_diff', 'status'];

    public function asesi()
    {
        return $this->belongsTo('App\User', 'asesi_id');
    }

    public function asesor()
    {
        return $this->belongsTo('App\User', 'asesor_id');
    }

    public function permohonan()
    {
        return $this->belongsTo('App\Models\Permohonan', 'permohonan_id');
    }

    public function getCreatedAtDiffAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
        return ($this->approved_at == null) ? 'Belum Disetujui' : 'Disetujui';
    }
}
