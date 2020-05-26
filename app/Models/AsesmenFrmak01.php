<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsesmenFrmak01 extends Model
{
    protected $table = 'asesmen_frmak01';
    protected $guarded = [];

    public function asesmen()
    {
        return $this->belongsTo(Asesmen::class);
    }
}
