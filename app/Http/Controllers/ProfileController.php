<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = [
            'name'   => auth()->user()->name ?? 'User Demo',
            'email'  => auth()->user()->email ?? 'demo@email.com',
            'phone'  => '0812-3456-7890',
            'joined' => auth()->user()
                ? auth()->user()->created_at->format('d F Y')
                : '10 Januari 2025',
        ];

        return view('profile', compact('profile'));
    }
}
