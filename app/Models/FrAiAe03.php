<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fraiae03 extends Model
{
    protected $table = 'fraiae03';
    protected $guarded = [];
    protected $casts = ['pertanyaan' => 'object'];

    public function skema()
    {
        return $this->belongsTo('App\Models\Skema');
    }
}
