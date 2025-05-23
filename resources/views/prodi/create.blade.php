@extends('layouts.app')

@section('title', 'Tambah Prodi')

@section('content')
    <div class="container mt-5">
        <h1>Tambah Prodi</h1>
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('prodi.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="kode_prodi" class="form-label">Kode Prodi</label>
                <input type="text" name="kode_prodi" class="form-control @error('kode_prodi') is-invalid @enderror" value="{{ old('kode_prodi') }}">
                @error('kode_prodi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nama_prodi" class="form-label">Nama Prodi</label>
                <input type="text" name="nama_prodi" class="form-control @error('nama_prodi') is-invalid @enderror" value="{{ old('nama_prodi') }}">
                @error('nama_prodi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('prodi.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection