@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Galeri: {{ $wisata->nama }}</h2>

    @if ($wisata->gambar)
        <div class="mb-4">
            <img src="{{ asset('storage/' . $wisata->gambar) }}" class="img-fluid" alt="Gambar Wisata">
        </div>
    @else
        <p>Tidak ada gambar tersedia.</p>
    @endif

    <a href="{{ route('wisata.index') }}" class="btn btn-secondary">Kembali ke Daftar Wisata</a>
</div>
@endsection
