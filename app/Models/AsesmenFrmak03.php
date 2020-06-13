<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsesmenFrmak03 extends Model
{
    protected $table = 'asesmen_frmak03';
    protected $guarded = [];
    protected $casts = [
        'unit' => 'object',
        'dijelaskan' => 'boolean',
        'diskusi' => 'boolean',
        'orang_lain' => 'boolean',
    ];

    public function asesmen()
    {
        return $this->belongsTo(Asesmen::class);
    }
}
