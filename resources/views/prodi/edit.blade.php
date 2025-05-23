@extends('layouts.app')

@section('title', 'Edit Prodi')

@section('content')
    <div class="container mt-5">
        <h1>Edit Prodi</h1>
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if (isset($prodi) && is_array($prodi) && !empty($prodi) && isset($prodi['kode_prodi']))
            <form action="{{ route('prodi.update', $prodi['kode_prodi']) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="kode_prodi" class="form-label">Kode Prodi</label>
                    <input type="text" name="kode_prodi" class="form-control" value="{{ $prodi['kode_prodi'] }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="nama_prodi" class="form-label">Nama Prodi</label>
                    <input type="text" name="nama_prodi" class="form-control @error('nama_prodi') is-invalid @enderror" value="{{ old('nama_prodi', $prodi['nama_prodi']) }}">
                    @error('nama_prodi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('prodi.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        @else
            <div class="alert alert-warning">Data prodi tidak ditemukan.</div>
            <a href="{{ route('prodi.index') }}" class="btn btn-secondary">Kembali</a>
        @endif
    </div>
@endsection