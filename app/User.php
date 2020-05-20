<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // protected $guarded = [];
    protected $fillable = [ 'nama', 'email', 'password', 'role', 'ttd', 'data' ];
    protected $hidden = [ 'password', 'remember_token', ];
    protected $casts = [ 'email_verified_at' => 'datetime', 'data' => 'object' ];

    public function berkas()
    {
        return $this->hasMany('App\Models\Berkas');
    }

    public function asesi_permohonan()
    {
        return $this->hasMany('App\Models\Permohonan', 'asesi_id');
    }

    public function asesor_skema()
    {
        return $this->belongsToMany('App\Models\Skema', 'skema_asesor');
    }
}
