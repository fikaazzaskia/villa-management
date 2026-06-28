<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = DB::table('galeri')->orderBy('urutan')->get();
        return view('galeri.index', ['galeris' => $galeris]);
    }

    public function create()
    {
        return view('galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipe' => 'required',
            'file' => 'required|file|max:20480',
        ]);

        $path = $request->file('file')->store('galeri', 'public');

        DB::table('galeri')->insert([
            'judul' => htmlspecialchars($request->judul),
            'tipe' => $request->tipe,
            'file' => $path,
            'urutan' => DB::table('galeri')->count() + 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/galeri')->with('success', 'Media berhasil ditambahkan ke galeri!');
    }

    public function destroy($id)
    {
        $galeri = DB::table('galeri')->where('id', $id)->first();
        if ($galeri->file) Storage::disk('public')->delete($galeri->file);

        DB::table('galeri')->where('id', $id)->delete();
        return response()->json(['success' => true]);
    }
}