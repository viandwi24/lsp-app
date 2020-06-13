<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrAc01 extends Model
{
    protected $table = 'frac01';
    protected $guarded = [];
    protected $casts = ['bukti' => 'object'];

    public function skema()
    {
        return $this->belongsTo('App\Models\Skema');
    }
}
