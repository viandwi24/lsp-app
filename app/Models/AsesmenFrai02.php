<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsesmenFrai02 extends Model
{
    protected $table = 'asesmen_frai02';
    protected $guarded = [];
    protected $casts = [ 'data' => 'object' ];

    public function asesmen()
    {
        return $this->belongsTo(Asesmen::class);
    }
}
