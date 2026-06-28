<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VillaController extends Controller
{
    public function index()
    {
        $villas = DB::table('villas')->orderBy('created_at', 'desc')->get();
        return view('villa.index', ['villas' => $villas]);
    }

    public function cari(Request $request)
    {
        $keyword = htmlspecialchars($request->keyword);
        $villas = DB::table('villas')
            ->where('nama', 'like', "%$keyword%")
            ->orWhere('tipe', 'like', "%$keyword%")
            ->get();
        return view('villa.index', ['villas' => $villas, 'keyword' => $request->keyword]);
    }

    public function show($id)
    {
        $villa = DB::table('villas')->where('id', $id)->first();
        if (!$villa) return redirect('/villa')->with('error', 'Villa tidak ditemukan!');
        return view('villa.show', ['villa' => $villa]);
    }

    public function create()
    {
        return view('villa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga_per_malam' => 'required|numeric',
            'kapasitas' => 'required|integer',
            'tipe' => 'required',
            'foto' => 'nullable|image|max:5120',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('villa/foto', 'public');
        }

        DB::table('villas')->insert([
            'nama' => htmlspecialchars($request->nama),
            'deskripsi' => htmlspecialchars($request->deskripsi),
            'harga_per_malam' => $request->harga_per_malam,
            'kapasitas' => $request->kapasitas,
            'tipe' => $request->tipe,
            'tersedia' => $request->has('tersedia') ? 1 : 0,
            'fasilitas' => $request->fasilitas ? implode(', ', $request->fasilitas) : null,
            'foto' => $fotoPath,
            'video_url' => $request->video_url,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/villa')->with('success', 'Villa berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $villa = DB::table('villas')->where('id', $id)->first();
        return view('villa.edit', ['villa' => $villa]);
    }

    public function update(Request $request, $id)
    {
        $villa = DB::table('villas')->where('id', $id)->first();

        $data = [
            'nama' => htmlspecialchars($request->nama),
            'deskripsi' => htmlspecialchars($request->deskripsi),
            'harga_per_malam' => $request->harga_per_malam,
            'kapasitas' => $request->kapasitas,
            'tipe' => $request->tipe,
            'tersedia' => $request->has('tersedia') ? 1 : 0,
            'fasilitas' => $request->fasilitas ? implode(', ', $request->fasilitas) : null,
            'video_url' => $request->video_url,
            'updated_at' => now(),
        ];

        if ($request->hasFile('foto')) {
            if ($villa->foto) Storage::disk('public')->delete($villa->foto);
            $data['foto'] = $request->file('foto')->store('villa/foto', 'public');
        }

        DB::table('villas')->where('id', $id)->update($data);
        return redirect('/villa')->with('success', 'Villa berhasil diupdate!');
    }

    public function destroy($id)
    {
        $villa = DB::table('villas')->where('id', $id)->first();
        if ($villa->foto) Storage::disk('public')->delete($villa->foto);

        DB::table('villas')->where('id', $id)->delete();
        return response()->json(['success' => true]);
    }
}