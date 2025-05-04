@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Destinasi Wisata</h2>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('wisata.create') }}" class="btn btn-primary">+ Tambah Wisata</a>
        
        <form action="{{ route('wisata.index') }}" method="GET" class="w-50">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Cari wisata..." value="{{ request('q') }}">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
            </div>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nama</th>
                    <th>Lokasi</th>
                    <th>Deskripsi</th>
                    <th>Harga Tiket</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($wisatas as $wisata)
                    <tr>
                        <td>{{ $wisata->nama }}</td>
                        <td>{{ $wisata->lokasi }}</td>
                        <td>{{ Str::limit($wisata->deskripsi, 50) }}</td>
                        <td>Rp {{ number_format($wisata->harga_tiket, 0, ',', '.') }}</td>
                        <td>
                        @if ($wisata->gambar)
    <img src="{{ asset('storage/' . $wisata->gambar) }}" alt="Gambar" width="100">
@else
    Tidak ada gambar
@endif

                        </td>
                        <td class="d-flex gap-2">
                            <a href="{{ route('wisata.edit', $wisata->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('wisata.destroy', $wisata->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ addslashes($wisata->nama) }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data wisata.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($wisatas->hasPages())
        <div class="d-flex justify-content-center mt-3">
            {{ $wisatas->links() }}
        </div>
    @endif
</div>
@endsection