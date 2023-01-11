<?php

namespace App\Http\Controllers\Login;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

final class LoginController
{
    public function index()
    {
        return view('login.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(8)],
        ]);

        $user = User::query()
            ->where('email', $data['email'])
            ->firstOrFail();

        if (!Hash::check($data['password'], $user->password)) {
            redirect()->back();
        }

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()
            ->route('posts.index')
            ->with('success', 'Logged in');
    }
}
