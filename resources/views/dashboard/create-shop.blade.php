@extends('layouts.main')

@section('title', 'Buka Toko - Pasarkulo')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="fw-bold mb-0 text-success"><i class="bi bi-shop"></i> Formulir Buka Toko</h5>
                </div>
                <div class="card-body p-4">
                    
                    <form action="{{ route('shop.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Toko</label>
                            <input type="text" name="name" class="form-control" placeholder="Contoh: Toko Sembako Bu Sri" required>
                            <div class="form-text">Nama toko harus unik dan menarik.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nomor WhatsApp</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">+62</span>
                                <input type="number" name="phone" class="form-control" placeholder="8123456789" required>
                            </div>
                            <div class="form-text">Gunakan format angka tanpa 0 di depan (contoh: 812...). Ini digunakan untuk tombol 'Chat Penjual'.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Alamat Lengkap</label>
                            <textarea name="address" class="form-control" rows="2" placeholder="Jalan, Kelurahan, Kecamatan..." required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Deskripsi Singkat</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Jelaskan apa yang kamu jual..." required></textarea>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('dashboard') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-success px-4 fw-bold">Simpan & Buka Toko</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection