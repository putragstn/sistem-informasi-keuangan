<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register', [
            'title' => 'Page Register'
        ]);
    }

    public function store(Request $request)
    {
        // Rules Validation
        $validatedData = $request->validate([
            'name'      => 'required|min:3|max:255',
            'email'     => 'required|unique:users|email',
            'password'  => 'required|min:6|max:255'
        ]);

        // #1 Cara dari WPU
        // $validatedData['password'] = bcrypt($validatedData['password']);

        // #2 Cara dari Laravel
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Simpan data yang berhasil lolos validasi
        User::create($validatedData);

        /** 
         *  jika data lolos validasi dan berhasil disimpan, maka tampilkan pesan
         *  setelah itu alihkan ke halaman login
         */
        return redirect('/')->with('success', 'Registration Succesfull, Please login');
    }
}
