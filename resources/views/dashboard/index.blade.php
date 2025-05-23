@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container mt-5">
        <h1>Dashboard</h1>
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Bagian Kelas -->
        <h2 class="mt-4">Daftar Kelas</h2>
        <a href="{{ route('kelas.index') }}" class="btn btn-primary mb-3">Kelola Kelas</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Kelas</th>
                    <th>Nama Kelas</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kelas as $item)
                    <tr>
                        <td>{{ $item['id_kelas'] }}</td>
                        <td>{{ $item['nama_kelas'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">Tidak ada data kelas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Bagian Mata Kuliah -->
        <h2 class="mt-4">Daftar Mata Kuliah</h2>
        <a href="{{ route('matkul.index') }}" class="btn btn-primary mb-3">Kelola Mata Kuliah</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode Mata Kuliah</th>
                    <th>Nama Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Semester</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($matkul as $item)
                    <tr>
                        <td>{{ $item['kode_matkul'] }}</td>
                        <td>{{ $item['nama_matkul'] }}</td>
                        <td>{{ $item['sks'] }}</td>
                        <td>{{ $item['semester'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data mata kuliah.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Bagian Prodi -->
        <h2 class="mt-4">Daftar Prodi</h2>
        <a href="{{ route('prodi.index') }}" class="btn btn-primary mb-3">Kelola Prodi</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode Prodi</th>
                    <th>Nama Prodi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($prodi as $item)
                    <tr>
                        <td>{{ $item['kode_prodi'] }}</td>
                        <td>{{ $item['nama_prodi'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">Tidak ada data prodi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Bagian Mahasiswa -->
        <h2 class="mt-4">Daftar Mahasiswa</h2>
        <a href="{{ route('mahasiswa.index') }}" class="btn btn-primary mb-3">Kelola Mahasiswa</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NPM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Kelas</th>
                    <th>Prodi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mahasiswa as $item)
                    <tr>
                        <td>{{ $item['npm'] }}</td>
                        <td>{{ $item['nama_mahasiswa'] }}</td>
                        <td>{{ $item['nama_kelas'] }}</td>
                        <td>{{ $item['nama_prodi'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data mahasiswa.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection