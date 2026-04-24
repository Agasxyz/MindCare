<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.auth');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        // Check user exists
        if (!$user) {
            return back()->withErrors([
                'email' => 'Email/Password salah',
            ]);
        }

        // Verify password (MD5 as per dump? No, dump shows specific hashes, let's look at one. 'd0970714757783e6cf17b26fb8e2298f' is MD5 for '111111'. 'admin123' is 8 chars, hash is '321'?? 
        // Wait, the dump says: `password` varchar(255) NOT NULL
        // Insert: ('...','321','...') for admin_konten.
        // Insert: ('...','admin123','...') for admin. Wait, no.
        // VALUES (4, 'admin', 'admin@gmail.com', 'admin123', 'admin'); -> This is PLAIN TEXT 'admin123'.
        // VALUES (1, ..., 'd0970714757783e6cf17b26fb8e2298f', ...) -> This looks like MD5.
        // The user dump has mixed plain text and hashes? Or maybe they are all plain text and some just look like hashes?
        // 'd0970714757783e6cf17b26fb8e2298f' is MD5 of '123' actually. No wait.
        // Let's assume some might be MD5 and some plain text?
        // Laravel uses Bcrypt by default. I should check if I need to support MD5 or Plain text.
        // Given 'admin123' is inserted as is for ID 4, it's likely PLAIN TEXT or the dump provided credentials that need to be hashed.
        // BUT `admin@gmail.com` has password `admin123`.

        // Let's implement a check: if password matches plain text OR hash check.
        // Ideally should migrate to Hash.

        $passwordValid = false;

        if ($user->password === $credentials['password']) {
            $passwordValid = true;
        } elseif (md5($credentials['password']) === $user->password) {
            $passwordValid = true;
        } else {
            try {
                if (Hash::check($credentials['password'], $user->password)) {
                    $passwordValid = true;
                }
            } catch (\RuntimeException $e) {
                // Password is not a valid Bcrypt hash, ignore.
                $passwordValid = false;
            }
        }

        if ($passwordValid) {
            Auth::login($user);
            $request->session()->regenerate();

            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            }

            return redirect()->route('user.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email/Password salah',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
