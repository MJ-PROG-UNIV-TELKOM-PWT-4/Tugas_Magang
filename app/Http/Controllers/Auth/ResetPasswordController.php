<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Simpan password dalam bentuk plaintext (tidak dianjurkan)
        DB::table('users')
            ->where('email', $request->email)
            ->update([
                'password' => $request->password, // Simpan password langsung tanpa hashing
            ]);

        return redirect()->route('login.form')->with('success', 'Password berhasil direset. Silakan login.');
    }
}