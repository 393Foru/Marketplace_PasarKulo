@extends('layouts.main')

@section('title', 'Edit Produk - Pasarkulo')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">Edit Produk</h5>
                </div>
                <div class="card-body p-4">
                    
                    <form action="{{ route('my-products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <div class="mb-3">
                            <label class="form-label fw-bold">Nama Produk</label>
                            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Harga (Rp)</label>
                            <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="4" required>{{ $product->description }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Ganti Foto (Opsional)</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                            @if($product->image)
                                <div class="mt-2">
                                    <small class="text-muted d-block mb-1">Foto Saat Ini:</small>
                                    <img src="{{ asset('storage/'.$product->image) }}" width="100" class="rounded border">
                                </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('my-products.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary fw-bold px-4">Update Produk</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection