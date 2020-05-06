<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{

    protected $table = 'permohonan';
    protected $guarded = [];
    protected $casts = [
        'skema' => 'object',
        'data' => 'object',
    ];
    protected $appends = ['created_at_diff', 'status'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function berkas()
    {
        return $this->belongsToMany('App\Models\Berkas', 'permohonan_berkas');
    }

    public function skema()
    {
        return $this->belongsTo('App\Models\Skema');
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
