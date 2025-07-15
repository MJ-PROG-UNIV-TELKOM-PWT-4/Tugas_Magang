<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pages.practice.AdminPengguna', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required|in:Admin,Staff Gudang,Manajer Gudang'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        // Log aktivitas
        logActivity('create', 'user', $user->id, 'Menambahkan pengguna: ' . $user->name);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable',
            'role' => 'required|in:Admin,Staff Gudang,Manajer Gudang',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);


        if ($request->filled('password')) {
            $user->password = $request->password;
        }

        $user->role = $request->role;
        $user->save();

        // Log aktivitas
        logActivity('update', 'user', $user->id, 'Memperbarui pengguna: ' . $user->name);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        // Log dulu sebelum dihapus
        logActivity('delete', 'user', $user->id, 'Menghapus pengguna: ' . $user->name);

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
