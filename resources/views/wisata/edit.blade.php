@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Wisata</h2>

    <form action="{{ route('wisata.update', $wisata->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $wisata->nama }}" required>
        </div>
        <div class="mb-3">
            <label>Lokasi</label>
            <input type="text" name="lokasi" class="form-control" value="{{ $wisata->lokasi }}" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required>{{ $wisata->deskripsi }}</textarea>
        </div>
        <div class="mb-3">
            <label>Harga Tiket</label>
            <input type="number" name="harga_tiket" class="form-control" value="{{ $wisata->harga_tiket }}" required>
        </div>
        <div class="mb-3">
            <label>Gambar</label><br>
            @if($wisata->gambar && file_exists(storage_path('app/public/' . $wisata->gambar)))
    <img src="{{ asset('storage/' . $wisata->gambar) }}" width="100"><br>
    <input type="checkbox" name="hapus_gambar" value="1"> Hapus gambar ini<br>
@endif

            <input type="file" name="gambar" class="form-control mt-2">
        </div>
        <button type="submit" class="btn btn-success">Perbarui</button>
        <a href="{{ route('wisata.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
