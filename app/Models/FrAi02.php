<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrAi02 extends Model
{
    protected $table = 'frai02';
    protected $guarded = [];
    protected $casts = ['pertanyaan' => 'object'];

    public function skema()
    {
        return $this->belongsTo('App\Models\Skema');
    }
}
