<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function displayLoginPage()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->withErrors(['error' => 'Username atau password salah']);
    }
    /**
     * @return \Illuminate\Http\Response
     */
    public function displayRegisterPage()
    {
        return view('register');
    }
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'nama' => 'required',
            'password' => 'required',
            'cpassword' => 'required'
        ]);
        if ($request->cpassword != $request->password) {
            return back()->withErrors(['error' => 'Konfirmasi password tidak sama dengan password']);
        }

        $user = new User();
        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/login')->with('message', 'Pendaftaran akun berhasil! silahkan log in');
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}