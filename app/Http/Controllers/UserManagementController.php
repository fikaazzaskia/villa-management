<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->get();
        return view('user.index', ['users' => $users]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,staff',
        ]);

        $username = htmlspecialchars($request->username);
        $cryptpassword = Hash::make($request->password);
        $split = str_split($cryptpassword, 30);

        DB::table('users')->insert([
            'username' => $username,
            'password' => $split[0],
            'extend'   => $split[1] ?? '',
            'status'   => 'active',
            'role'     => $request->role,
        ]);

        return redirect('/user')->with('success', 'Akun berhasil dibuat!');
    }

    public function edit($username)
    {
        $user = DB::table('users')->where('username', $username)->first();
        return view('user.edit', ['user' => $user]);
    }

    public function update(Request $request, $username)
    {
        $data = [
            'role' => $request->role,
            'status' => $request->status,
        ];

        if ($request->filled('password')) {
            $cryptpassword = Hash::make($request->password);
            $split = str_split($cryptpassword, 30);
            $data['password'] = $split[0];
            $data['extend'] = $split[1] ?? '';
        }

        DB::table('users')->where('username', $username)->update($data);
        return redirect('/user')->with('success', 'Akun berhasil diupdate!');
    }

    public function destroy($username)
    {
        if ($username == session('username')) {
            return response()->json(['error' => 'Tidak bisa menghapus akun sendiri!'], 403);
        }
        DB::table('users')->where('username', $username)->delete();
        return response()->json(['success' => true]);
    }
}