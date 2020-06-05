<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function frapl01($id)
    {
        $permohonan = Permohonan::findOrFail($id);
        return view();
    }
}
