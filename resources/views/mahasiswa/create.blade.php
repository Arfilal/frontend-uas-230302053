@extends('layouts.app')

@section('title', 'Tambah Mahasiswa')

@section('content')
    <div class="container mt-5">
        <h1>Tambah Mahasiswa</h1>
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('mahasiswa.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="npm" class="form-label">NPM</label>
                <input type="text" name="npm" class="form-control @error('npm') is-invalid @enderror" value="{{ old('npm') }}">
                @error('npm')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa</label>
                <input type="text" name="nama_mahasiswa" class="form-control @error('nama_mahasiswa') is-invalid @enderror" value="{{ old('nama_mahasiswa') }}">
                @error('nama_mahasiswa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="id_kelas" class="form-label">Kelas</label>
                <select name="id_kelas" class="form-control @error('id_kelas') is-invalid @enderror">
                    <option value="">Pilih Kelas</option>
                    @foreach ($kelas as $k)
                        <option value="{{ $k['id_kelas'] }}" {{ old('id_kelas') == $k['id_kelas'] ? 'selected' : '' }}>{{ $k['nama_kelas'] }}</option>
                    @endforeach
                </select>
                @error('id_kelas')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="kode_prodi" class="form-label">Prodi</label>
                <select name="kode_prodi" class="form-control @error('kode_prodi') is-invalid @enderror">
                    <option value="">Pilih Prodi</option>
                    @foreach ($prodi as $p)
                        <option value="{{ $p['kode_prodi'] }}" {{ old('kode_prodi') == $p['kode_prodi'] ? 'selected' : '' }}>{{ $p['nama_prodi'] }}</option>
                    @endforeach
                </select>
                @error('kode_prodi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection