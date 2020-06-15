<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsesmenFrUmpanBalik extends Model
{
    protected $table = 'fr_asesmen_umpan_balik';
    protected $guarded = [];
    protected $casts = [ 'data' => 'object' ];

    public function asesmen()
    {
        return $this->belongsTo(Asesmen::class);
    }
}
