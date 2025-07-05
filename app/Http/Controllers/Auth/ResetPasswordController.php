<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class ResetPasswordController extends Controller
{
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        DB::table('users')
            ->where('email', $request->email)
            ->update([
                'password' => Hash::make($request->password),
            ]);

        return redirect()->route('login.form')->with('success', 'Password berhasil direset. Silakan login.');
    }
}
