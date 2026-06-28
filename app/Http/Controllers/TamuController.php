<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TamuController extends Controller
{
    public function index()
    {
        $tamus = DB::table('tamus')->orderBy('created_at', 'desc')->get();
        return view('tamu.index', ['tamus' => $tamus]);
    }

    public function create()
    {
        return view('tamu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required',
            'no_ktp' => 'required',
            'jenis_kelamin' => 'required',
        ]);

        DB::table('tamus')->insert([
            'nama' => htmlspecialchars($request->nama),
            'email' => htmlspecialchars($request->email),
            'no_hp' => htmlspecialchars($request->no_hp),
            'no_ktp' => htmlspecialchars($request->no_ktp),
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => htmlspecialchars($request->alamat),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/tamu')->with('success', 'Data tamu berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $tamu = DB::table('tamus')->where('id', $id)->first();
        return view('tamu.edit', ['tamu' => $tamu]);
    }

    public function update(Request $request, $id)
    {
        DB::table('tamus')->where('id', $id)->update([
            'nama' => htmlspecialchars($request->nama),
            'email' => htmlspecialchars($request->email),
            'no_hp' => htmlspecialchars($request->no_hp),
            'no_ktp' => htmlspecialchars($request->no_ktp),
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => htmlspecialchars($request->alamat),
            'updated_at' => now(),
        ]);

        return redirect('/tamu')->with('success', 'Data tamu berhasil diupdate!');
    }

    public function destroy($id)
    {
        DB::table('tamus')->where('id', $id)->delete();
        return response()->json(['success' => true]);
    }
}