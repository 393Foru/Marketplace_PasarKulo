@extends('layouts.main')

@section('title', 'Masuk - Pasarkulo')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm p-4">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-judul">Selamat Datang Kembali</h3>
                    <p class="text-muted">Masuk untuk mulai belanja</p>
                </div>

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Email Address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn ungu w-100 py-2 fw-bold">Masuk Sekarang</button>
                </form>

                <div class="text-center mt-4 small">
                    Belum punya akun? <a href="{{ route('register') }}" class="text-judul fw-bold text-decoration-none">Daftar disini</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection