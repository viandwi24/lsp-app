<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{
    public function __construct() {
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
    }
    public function frapl01($id)
    {
        $permohonan = Permohonan::findOrFail($id);
        return view();
        // $pdf = PDF::loadView('pdf.invoice', $data);
        // return $pdf->download('invoice.pdf');
    }
}
