<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm()
    {
        if (session('username')) {
            return redirect('/dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = htmlspecialchars($request->username);
        $user = DB::table('users')->where('username', $username)->first();

        if ($user) {
            $fullpassword = $user->password . $user->extend;

            if (Hash::check($request->password, $fullpassword)) {
                if ($user->status != 'active') {
                    return redirect('/login')->with('error', 'Akun anda tidak aktif!');
                }

                session([
                    'username' => $user->username,
                    'role' => $user->role,
                ]);
                $request->session()->regenerate();

                return redirect('/dashboard')->with('success', 'Login berhasil! Selamat datang ' . $user->username);
            }
        }

        return redirect('/login')->with('error', 'Username atau password salah!');
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6',
        ]);

        $username = htmlspecialchars($request->username);
        $cryptpassword = Hash::make($request->password);
        $split = str_split($cryptpassword, 30);

        DB::table('users')->insert([
            'username' => $username,
            'password' => $split[0],
            'extend'   => $split[1] ?? '',
            'status'   => 'active',
            'role'     => 'staff',
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silahkan login.');
    }

    public function logout(Request $request)
    {
        session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}