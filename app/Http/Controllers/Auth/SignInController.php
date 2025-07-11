<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    public function authenticate(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Temukan pengguna berdasarkan email
        $user = DB::table('users')->where('email', $request->email)->first();

        // Verifikasi jika pengguna ada dan passwordnya cocok
        if ($user && $user->password === $request->password) { 
            // Jika password cocok dengan plaintext
            Auth::loginUsingId($user->id); // Login pengguna menggunakan ID
            $request->session()->regenerate(); // Regenerate session 

            return redirect()->intended('/dashboard'); // Arahkan ke dashboard atau halaman lainnya
        }

        // Jika login gagal
        return back()->with('loginError', 'Email atau password salah');
    }
}