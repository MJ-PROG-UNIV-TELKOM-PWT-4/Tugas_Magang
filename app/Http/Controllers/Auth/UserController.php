<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // Menampilkan semua pengguna
    public function index()
    {
        $users = User::all(); // Mengambil semua pengguna dari database
        return view('pages.practice.AdminPengguna', compact('users')); // Pastikan nama view ini sesuai dengan file Blade Anda
    }

    // Menyimpan data pengguna baru
    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email', // Memastikan email unik
        'password' => 'required', // Pastikan password diisi
        'role' => 'required|in:Admin,Staff Gudang,Manajer Gudang' // Memastikan role valid sesuai ENUM di database
    ]);

    // Simpan pengguna dengan password dalam plaintext
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password, // Simpan password dalam plaintext (tidak dianjurkan)
        'role' => $request->role, // Simpan sesuai tipe ENUM
    ]);

    return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // Mengupdate data pengguna
    public function update(Request $request, User $user)
    {
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'nullable', // Password diizinkan untuk tidak diisi
        'role' => 'required|in:Admin,Staff Gudang,Manajer Gudang', // Memastikan role valid
    ]);

    // Update data pengguna
    $user->name = $request->name;
    $user->email = $request->email;

    // Hanya update password jika ada yang dimasukkan
    if ($request->filled('password')) {
        $user->password = $request->password; // Simpan password dalam plaintext
    }

    $user->role = $request->role; // Simpan role sesuai ENUM 
    $user->save(); // Simpan perubahan ke database

    return redirect()->route('users.index')->with('success', 'User updated successfully.'); // Redirect kembali ke daftar pengguna
    }

    // Menghapus pengguna
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}