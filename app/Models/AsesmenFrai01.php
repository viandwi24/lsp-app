<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsesmenFrai01 extends Model
{
    protected $table = 'asesmen_frai01';
    protected $guarded = [];
    protected $casts = [
        'data' => 'object'
    ];

    public function asesmen()
    {
        return $this->belongsTo(Asesmen::class);
    }
}
