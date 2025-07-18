<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SignUpController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:admin,manager_gudang,staff_gudang',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'terms' => 'accepted'
        ]);

        $user = User::create([
            'name' => $request->name,
            'role' => match($request->role) {
                'admin' => 'Admin',
                'manager_gudang' => 'Manajer Gudang',
                'staff_gudang' => 'Staff Gudang',
            },
            'email' => $request->email,
            'password' => $request->password, // Simpan password dalam plaintext (tidak direkomendasikan)
        ]);

        return redirect()->route('login.form');
    }
}