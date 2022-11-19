<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterController extends Controller
{
    public function index() {
        return view('logres.register', [
            'title' => 'Register'
        ]);
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'name' => 'required|min:3|max:100',
            'username' => 'required|min:3|max:20|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4'
        ]);

        $validateData['password'] = Hash::make($validateData['password']);
        User::create($validateData);

        Alert::success('Berhasil Register!', 'Silahkan Login :)');
        return redirect()->route('login.index');
    }
}
