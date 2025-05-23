@extends('layouts.app')

@section('title', 'Daftar Mahasiswa')

@section('content')
    <div class="container mt-5">
        <h1>Daftar Mahasiswa</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary mb-3">Tambah Mahasiswa</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NPM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Kelas</th>
                    <th>Prodi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mahasiswa as $item)
                    <tr>
                        <td>{{ $item['npm'] }}</td>
                        <td>{{ $item['nama_mahasiswa'] }}</td>
                        <td>{{ $item['nama_kelas'] }}</td>
                        <td>{{ $item['nama_prodi'] }}</td>
                        <td>
                            <a href="{{ route('mahasiswa.edit', $item['npm']) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('mahasiswa.destroy', $item['npm']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data mahasiswa.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection