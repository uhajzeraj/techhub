<?php

namespace App\Http\Controllers\Register;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

final class RegisterController
{
    public function index()
    {
        return view('register.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $data = [
            ...$data,
            'username' => Str::slug($data['name']) . '-' . Str::random(8),
            'role' => 'author',
            'password' => Hash::make($data['password']),
        ];

        $user = User::create($data);

        Auth::login($user);

        return redirect()
            ->route('posts.index')
            ->with('success', 'User was created');
    }
}
