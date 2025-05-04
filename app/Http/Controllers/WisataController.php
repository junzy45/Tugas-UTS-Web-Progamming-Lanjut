<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wisata;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class WisataController extends Controller
{
    // TAMPILKAN DATA + CARI
    public function index(Request $request)
    {
        $query = $request->input('q');

        $wisatas = Wisata::when($query, function ($qBuilder) use ($query) {
            return $qBuilder->where('nama', 'like', "%$query%")
                            ->orWhere('lokasi', 'like', "%$query%");
        })
        ->latest()
        ->paginate(10);

        return view('wisata.index', compact('wisatas'));
    }

    // FORM TAMBAH
    public function create()
    {
        return view('wisata.create');
    }

    // SIMPAN DATA
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|max:255',
            'lokasi' => 'required',
            'deskripsi' => 'required',
            'harga_tiket' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('wisata', 'public');
            $data['gambar'] = $path;
        }

        Wisata::create($data);

        return redirect()->route('wisata.index')->with('success', 'Data berhasil ditambahkan!');
    }

    // FORM EDIT
    public function edit($id)
    {
        $wisata = Wisata::findOrFail($id);
        return view('wisata.edit', compact('wisata'));
    }

    // UPDATE DATA
    public function update(Request $request, $id)
{
    $data = $request->validate([
        'nama' => 'required|max:255',
        'lokasi' => 'required',
        'deskripsi' => 'required',
        'harga_tiket' => 'required|numeric',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    $wisata = Wisata::findOrFail($id);

    // Jika user centang hapus gambar
    if ($request->filled('hapus_gambar')) {
        if ($wisata->gambar) {
            Storage::disk('public')->delete(str_replace('/', DIRECTORY_SEPARATOR, $wisata->gambar));
            $data['gambar'] = null;
        }
    }

    // Jika user upload gambar baru
    if ($request->hasFile('gambar')) {
        if ($wisata->gambar) {
            Storage::disk('public')->delete(str_replace('/', DIRECTORY_SEPARATOR, $wisata->gambar));
        }
        $data['gambar'] = $request->file('gambar')->store('wisata', 'public');
    }

    $wisata->update($data);

    return redirect()->route('wisata.index')->with('success', 'Data berhasil diperbarui!');
}


    // HAPUS DATA
    public function destroy($id)
    {
        $wisata = Wisata::findOrFail($id);

        if ($wisata->gambar) {
            // FIX: Path delete disesuaikan supaya valid di Windows & Linux
            Storage::disk('public')->delete(str_replace('/', DIRECTORY_SEPARATOR, $wisata->gambar));
        }

        $wisata->delete();

        return redirect()->route('wisata.index')->with('success', 'Data berhasil dihapus!');
    }
}
