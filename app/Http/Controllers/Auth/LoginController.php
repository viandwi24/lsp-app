<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $remember = ($request->has('remember')) ? true : false;
        $auth = auth()->attempt($request->only('email', 'password'), $remember);

        if ($auth)
        {
            $home = auth()->user()->role;
            return redirect()->route($home . '.home');
        } else {
            return redirect()->back()->with('credentials', 'Invalid Credentials Input.');
        }
    }
    
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
