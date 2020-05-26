<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrMak01 extends Model
{
    protected $table = 'frmak01';
    protected $guarded = [];
    protected $casts = [
        'bukti_tl' => 'object',
        'bukti_l' => 'object',
        'bukti_t' => 'object',
    ];

    public function skema()
    {
        return $this->belongsTo('App\Models\Skema');
    }
}
