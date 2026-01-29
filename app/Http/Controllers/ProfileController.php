<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = [
            'name'   => $user->name ?? 'User Demo',
            'email'  => $user->email ?? 'demo@email.com',
            'phone'  => $user->phone ?? 'Belum diatur', // Mengambil dari DB
            'joined' => $user ? $user->created_at->format('d F Y') : '10 Januari 2025',
        ];

        return view('profile', compact('profile'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile-edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
        ]);

        $user->update([
            'name'  => $request->name,
            'phone' => $request->phone,
        ]);

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui!');
    }
}