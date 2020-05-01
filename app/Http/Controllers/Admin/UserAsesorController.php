<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;

use App\User;
use App\Services\User as UserService;

class UserAsesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $user = User::where('role', 'asesor');
            return DataTables::of($user)->make();
        }

        return view('pages.admin.user.asesor.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.user.asesor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $store = UserService::make('asesor', $request->nama, $request->email, $request->password, []);
        return redirect()->route('admin.user.asesor.index')
            ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Tambah Data Berhasil.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('pages.admin.user.asesor.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
        ]);

        $new = $request->only('nama', 'email');
        if ($request->has("password") && !empty($request->password) && $request->password != '') $new['password'] = bcrypt($request->password);
        if ($request->has("email") && $request->email != $user->email) $request->validate(['email' => 'required|email|unique:users']);
        $update = $user->update($new);
        return redirect()->route('admin.user.asesor.index')
            ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Memperbarui Data Berhasil.']);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ids = \explode(',', $id);
        $user = User::find($ids);
        $destroy = $user->each(function ($user, $key) {
            $user->delete();
        });
        return redirect()->route('admin.user.asesor.index')
            ->with('alert', ['type' => 'success', 'title' => 'Sukses', 'text' => 'Menghapus Data Berhasil.']);
    }
}
