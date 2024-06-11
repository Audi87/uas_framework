<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // Function untuk menampilkan view login
    public function index(){
        return view('login.login', [
            'title' => 'Login'
        ]);
    }

    // Function untuk proses login
    public function login(Request $request)
    {
        $validateData = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        if(Auth::attempt($validateData)){
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Login successful!');
        }else{
            return redirect('/login')->with('error', 'Wrong username or password');
        }
    }

    // Function untuk proses logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logout successfully');
    }
}
