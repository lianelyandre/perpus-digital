<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan daftar user
    public function index()
    {
        $users = User::latest()->get();
        return view('user.index', compact('users'));
    }

    // Form tambah user
    public function create()
    {
        return view('user.create');
    }

    // Proses simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'nama_lengkap' => 'required',
            'role' => 'required',
            'alamat' => 'required',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nama_lengkap' => $request->nama_lengkap,
            'role' => $request->role,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan bray!');
    }

    // Form edit user
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    // Proses update user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nama_lengkap' => 'required',
            'role' => 'required',
            'alamat' => 'required',
        ]);

        // Update data dasar
        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'nama_lengkap' => $request->nama_lengkap,
            'role' => $request->role,
            'alamat' => $request->alamat,
        ]);

        // Kalau password diisi, update passwordnya
        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('user.index')->with('success', 'Data user berhasil diupdate!');
    }

    // Hapus user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus!');
    }
}
