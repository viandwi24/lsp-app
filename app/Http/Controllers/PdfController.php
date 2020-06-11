<?php

namespace App\Http\Controllers;

use App\Models\Asesmen;
use App\Models\Permohonan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{
    public function __construct() {
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
    }

    private function pdf($view, $data, $name = "", $download = false)
    {
        $name = $name . '.pdf';
        $pdf = PDF::loadView($view, $data);
        // return view($view, $data);
        return ($download) ? $pdf->download($name) : $pdf->stream($name);
    }

    public function frapl01($id)
    {
        $permohonan = Permohonan::findOrFail($id);
        return view();
        // $pdf = PDF::loadView('pdf.invoice', $data);
        // return $pdf->download('invoice.pdf');
    }

    public function frmak01($id)
    {
        $asesmen = Asesmen::findOrFail($id);
        if ($asesmen->frmak01 == null) return dd("asesi belum menandatangani.");
        return $this->pdf('pdf.frmak01', compact('asesmen'), "frmak01");
    }

    public function frai01($id)
    {
        $asesmen = Asesmen::findOrFail($id);
        if ($asesmen->frai01 == null) return dd("asesor belum menilai.");
        return $this->pdf('pdf.frai01', compact('asesmen'), "frai01");
    }

    public function frai02($id)
    {
        $asesmen = Asesmen::findOrFail($id);
        if ($asesmen->frai02 == null) return dd("asesi belum mengisi.");
        return $this->pdf('pdf.frai02', compact('asesmen'), "frai02");
    }
}
