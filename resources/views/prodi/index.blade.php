@extends('layouts.app')

@section('title', 'Daftar Prodi')

@section('content')
    <div class="container mt-5">
        <h1>Daftar Prodi</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <a href="{{ route('prodi.create') }}" class="btn btn-primary mb-3">Tambah Prodi</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode Prodi</th>
                    <th>Nama Prodi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($prodi as $item)
                    <tr>
                        <td>{{ $item['kode_prodi'] }}</td>
                        <td>{{ $item['nama_prodi'] }}</td>
                        <td>
                            <a href="{{ route('prodi.edit', $item['kode_prodi']) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('prodi.destroy', $item['kode_prodi']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada data prodi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection