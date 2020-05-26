<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrPaap01 extends Model
{
    protected $table = 'frpaap01';
    protected $guarded = [];

    public function skema()
    {
        return $this->belongsTo('App\Models\Skema');
    }
}
