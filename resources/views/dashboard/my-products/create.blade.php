@extends('layouts.main')

@section('title', 'Tambah Produk - Pasarkulo')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">Tambah Produk Baru</h5>
                </div>
                <div class="card-body p-4">
                    
                    <form action="{{ route('my-products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Produk</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Harga (Rp)</label>
                            <input type="number" name="price" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="4" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Foto Produk</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                            <div class="form-text">Format: JPG, PNG. Maks 2MB.</div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('my-products.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-success fw-bold px-4">Simpan Produk</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection