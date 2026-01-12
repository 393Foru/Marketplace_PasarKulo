@extends('layouts.main')

@section('title', 'Kelola Produk - Pasarkulo')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Produk Saya</h3>
        <a href="{{ route('my-products.create') }}" class="btn btn-primary btn-pasarkulo">
            <i class="bi bi-plus-lg"></i> Tambah Produk
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="p-3">Produk</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td class="p-3">
                                <div class="d-flex align-items-center">
                                    <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://dummyimage.com/100x100/dee2e6/6c757d.jpg' }}" 
                                         class="rounded me-3" width="60" height="60" style="object-fit:cover;">
                                    <div>
                                        <h6 class="mb-0 fw-bold">{{ $product->name }}</h6>
                                        <small class="text-muted">Diupdate: {{ $product->updated_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td><span class="badge bg-success">Aktif</span></td>
                            <td>
                                <a href="{{ route('my-products.edit', $product->id) }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('my-products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <p class="text-muted">Belum ada produk. Ayo tambah jualanmu!</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="mt-3">
        <a href="{{ route('dashboard') }}" class="text-decoration-none text-muted"><i class="bi bi-arrow-left"></i> Kembali ke Dashboard</a>
    </div>
</div>
@endsection