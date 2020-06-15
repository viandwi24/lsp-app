<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrUmpanBalik extends Model
{
    protected $table = 'fr_umpan_balik';
    protected $guarded = [];
    protected $casts = [ 'pertanyaan' => 'object' ];

    public function skema()
    {
        return $this->belongsTo('App\Models\Skema');
    }
}
