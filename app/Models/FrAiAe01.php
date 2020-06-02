<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrAiAe01 extends Model
{
    protected $table = 'fraiae01';
    protected $guarded = [];
    protected $casts = ['pertanyaan' => 'object'];

    public function skema()
    {
        return $this->belongsTo('App\Models\Skema');
    }
}
