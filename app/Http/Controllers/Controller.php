<?php

namespace App\Http\Controllers;

use App\Models\DestinasiWisata;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class WisataController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('q');
    
    $wisatas = DestinasiWisata::when($search, function ($query) use ($search) {
            return $query->where('nama', 'like', '%'.$search.'%')
                       ->orWhere('lokasi', 'like', '%'.$search.'%');
        })
        ->latest()
        ->paginate(10);

    return view('wisata.index', compact('wisatas'));
}
    public function create()
    {
        return view('wisata.create');
    }

public function update(Request $request, Wisata $wisata)
{
    $request->validate([
        'nama' => 'required',
        'lokasi' => 'required',
        'deskripsi' => 'required',
        'harga_tiket' => 'required|numeric',
        'gambar' => 'nullable|image|max:2048',
    ]);

    $wisata->fill($request->except('gambar'));

    if ($request->hasFile('gambar')) {
        // Hapus gambar lama jika ada
        if ($wisata->gambar) {
            Storage::disk('public')->delete($wisata->gambar);
        }

        $path = $request->file('gambar')->store('wisata', 'public');
        $wisata->gambar = $path;
    }

    $wisata->save();

    return redirect()->route('wisata.index')->with('success', 'Data wisata berhasil diperbarui.');
}}