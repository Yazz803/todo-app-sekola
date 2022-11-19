<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index() {
        return view('logres.login', [
            'title' => 'Login'
        ]);
    }

    public function auth (Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            // mengapa kita melakukan regenerate pada session, ini untuk menghindari sebuah teknik hacking
            // yg namanya session fixation, jadi bagaimana seseorang itu masuk kedalam celah keamanan sistem 
            // menggunakan session, jadi pura2 masuk dengan session yg sama dengna sebelumnya, jadi gk perlu login lagi
            // karena dia sudah menggunakan session yg sama. Untuk menghindari ini, kita generate ulang sessionnya

            // redirect usernya ke halaman dashboard
            Alert::toast('Berhasil Login!', 'success');
            return redirect()->intended('/dashboard');
        }

        Alert::toast('Login Gagal! Coba periksa email dan passwordnya', 'error');
        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
