<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsesmenFrac01 extends Model
{
    protected $table = 'asesmen_frac01';
    protected $guarded = [];
    protected $casts = [
        'bukti' => 'object',
        'skema' => 'object',
    ];

    public function asesmen()
    {
        return $this->belongsTo(Asesmen::class);
    }
}
