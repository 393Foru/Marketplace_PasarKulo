@extends('layouts.main')

@section('title', 'Pengaturan Akun')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-person-gear me-2"></i>Pengaturan Akun</h5>
                </div>
                <div class="card-body p-4">
                    
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <div class="row mb-4 align-items-center">
                            <div class="col-md-3 text-center">
                                @if($user->avatar)
                                    <img src="{{ asset('img/users/' . $user->avatar) }}" class="rounded-circle img-thumbnail" style="width: 120px; height: 120px; object-fit: cover;">
                                @else
                                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center mx-auto" style="width: 120px; height: 120px; font-size: 3rem;">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-9">
                                <label class="form-label fw-bold">Ganti Foto Profil</label>
                                <input type="file" name="avatar" class="form-control">
                                <small class="text-muted">Format: jpg, png. Maks 2MB.</small>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="alert alert-light border mt-4">
                            <h6 class="fw-bold mb-3"><i class="bi bi-shield-lock me-1"></i> Ganti Password</h6>
                            <small class="text-muted d-block mb-3">Kosongkan jika tidak ingin mengubah password.</small>

                            <div class="mb-3">
                                <label class="form-label">Password Baru</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('dashboard') }}" class="btn btn-light me-md-2">Kembali</a>
                            <button type="submit" class="btn btn-primary fw-bold px-4">Simpan Perubahan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection