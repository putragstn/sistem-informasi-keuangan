<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login', [
            'title' => 'Page Login'
        ]);
    }

    public function dologin(Request $request)
    {
        // validasi
        // $credentials = $request->validate([
        //     'email'     => ['required', 'email'],
        //     'password'  => ['required'],
        //     'is_active' => [1]
        // ]);


        // cek email dan password
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $request->session()->regenerate();

            // jika akun sudah diaktivasi, cek role
            if (auth()->user()->role_id === 1) {
                return redirect()->intended('/dashboard/admin');
            } else if (auth()->user()->role_id === 2) {
                return redirect()->intended('/dashboard/bendahara');
            } else {
                return redirect()->intended('/dashboard/karyawan');
            }
        } else {
            return back()->with('error', 'Email atau Password salah');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
