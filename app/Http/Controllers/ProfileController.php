<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // MENAMPILKAN HALAMAN EDIT
    public function edit()
    {
        $user = Auth::user();
        return view('dashboard.profile.edit', compact('user'));
    }

    // MENYIMPAN PERUBAHAN
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */  // <--- TAMBAHKAN BARIS INI
        $user = Auth::user();

        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|max:255|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|min:6|confirmed',
        ]);

        // Update Nama & Email
        $user->name = $request->name;
        $user->email = $request->email;

        // Update Foto (Avatar)
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Simpan ke folder public/img/users
            $file->move(public_path('img/users'), $filename);
            
            $user->avatar = $filename;
        }

        // Update Password (Hanya jika diisi)
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}