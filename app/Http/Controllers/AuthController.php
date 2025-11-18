<?php

namespace App\Http\Controllers;

use App\Models\Kasir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login'); 
    }

    public function login(Request $r)
    {
        $cred = $r->validate([
            'username' => ['required','string'],
            'password' => ['required','string'],
        ]);

        $kasir = Kasir::where('username',$cred['username'])->first();
        if (!$kasir || !Hash::check($cred['password'], $kasir->password)) {
            return back()->with('error','Username atau password salah.');
        }

        $r->session()->put('id_user', $kasir->id_user);
        $r->session()->put('nama',    $kasir->nama);

        return redirect()->route('dashboard');
    }

    public function logout(Request $r)
    {
        $r->session()->invalidate();
        $r->session()->regenerateToken();
        return redirect()->route('login');
    }
}
