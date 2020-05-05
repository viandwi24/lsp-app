<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skema extends Model
{
    protected $table = 'skema';
    protected $guarded = [];
    protected $casts = [ 'unit' => 'object','berkas' => 'object' ];

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
    
    public function kategori()
    {
        return $this->belongsToMany('App\Models\Kategori', 'skema_kategori');
    }
}
