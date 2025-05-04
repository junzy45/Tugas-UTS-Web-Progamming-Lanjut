@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Wisata</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('wisata.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Lokasi</label>
            <input type="text" name="lokasi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Harga Tiket</label>
            <input type="number" name="harga_tiket" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control">
    <button type="submit">Simpan</button>
        <a href="{{ route('wisata.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
