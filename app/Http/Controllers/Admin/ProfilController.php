<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Services\User as UserServices;

class ProfilController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('pages.admin.profil', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:6',
            'data.nik' => 'required',
            'data.ttd' => 'required'
        ]);
        $user = auth()->user();
        $data = $request->only('nama');

        // validation
        if ($request->has('email') && $request->email != $user->email)
        {
            $request->validate(['email' => 'required|email']);
            $data['email'] = $request->email;
        }
        if ($request->has('password') && !empty($request->password) && $request->password != '')
        {
            $request->validate(['password' => 'required|min:6|confirmed']);
            $data['password'] = bcrypt($request->password);
        }

        // data
        $syncData = UserServices::validateData(auth()->user(), $request->data);
        $data['data'] = $syncData;

        $update = auth()->user()->update($data);
        return redirect()->back()->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Memperbarui Profil Berhasil.']);
    }
}
