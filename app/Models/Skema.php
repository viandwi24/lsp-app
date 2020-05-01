<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skema extends Model
{
    protected $table = 'skema';
    protected $guarded = [];
    protected $casts = [ 'unit' => 'array','berkas' => 'array' ];

    public function admin()
    {
        return $this->belongsTo('App\User');
    }
    
    public function asesor()
    {
        return $this->belongsToMany('App\User', 'skema_asesor');
    }
    
    public function tuk()
    {
        return $this->belongsToMany('App\Models\Tuk', 'skema_tuk');
    }
    
    public function jadwal()
    {
        return $this->belongsToMany('App\Models\Jadwal', 'skema_jadwal');
    }
}
