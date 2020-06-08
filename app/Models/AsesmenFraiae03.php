<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsesmenFraiae03 extends Model
{
    protected $table = 'asesmen_fraiae03';
    protected $guarded = [];
    protected $casts = [
        'data' => 'object'
    ];

    public function asesmen()
    {
        return $this->belongsTo(Asesmen::class);
    }
}
