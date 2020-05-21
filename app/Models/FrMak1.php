<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrMak1 extends Model
{
    protected $table = 'fr_mak_01';
    protected $guarded = [];

    public function skema()
    {
        return $this->belongsTo('App\Models\Skema');
    }
}
