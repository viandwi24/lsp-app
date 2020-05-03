<?php
namespace App\Modules\SimpleHomePage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SimpleHomePageController extends Controller
{
    protected $file = null;

    public function __construct()
    {
        $this->file = \App\Services\Module::path('SimpleHomePage') . '/views/home.blade.php';
    }

    public function index()
    {
        $code = file_get_contents($this->file);
        return view('SimpleHomePage::edit', compact('code'));
    }

    public function update(Request $request)
    {
        $request->validate(['code' => 'required']);
        file_put_contents($this->file, $request->code);
        return redirect()->back()->with('alert', [ 'type' => 'success', 'title' => 'Sukses', 'text' => 'Template Home Berhasil Disimpan!' ]);
    }
}
