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

        if ($user && $user->password === $request->password) {
            Auth::loginUsingId($user->id);
            $request->session()->regenerate();

            // Redirect berdasarkan role
            $normalizedRole = strtolower(str_replace(' ', '_', $user->role));
            switch ($normalizedRole) {
                case 'admin':
                    return redirect()->route('dashboard.index');
                case 'manajer_gudang':
                    return redirect()->route('dashboard.manager');
                case 'staff_gudang':
                    return redirect()->route('dashboard.staff');
                default:
                    return redirect()->route('login.form')->with('loginError', 'Role tidak dikenali');
            }
        }
    }
}