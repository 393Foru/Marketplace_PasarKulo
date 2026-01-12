@extends('layouts.main')

@section('title', 'Daftar - Pasarkulo')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-judul">Buat Akun Baru</h3>
                    <p class="text-muted">Bergabunglah dengan komunitas Pasarkulo</p>
                </div>

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small">Email Address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label fw-bold small">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                        <small class="text-muted mt-2">Minimal 6 karakter.</small>
                    </div>

                    <button type="submit" class="btn ungu w-100 py-2 fw-bold">Daftar Sekarang</button>
                </form>

                <div class="text-center mt-4 small">
                    Sudah punya akun? <a href="{{ route('login') }}" class="text-judul fw-bold text-decoration-none">Masuk disini</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection