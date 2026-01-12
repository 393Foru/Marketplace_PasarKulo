@extends('layouts.main')

@section('title', $shop->name . ' - Pasarkulo')

@section('content')

<div class="bg-white shadow-sm border-bottom pb-0">
    <div class="container pt-4">
        <div class="row align-items-center pb-4">
            <div class="col-md-auto text-center mb-3 mb-md-0">
                <div class="position-relative d-inline-block">
                    <div class="rounded-circle border border-4 border-white shadow bg-dark text-white d-flex align-items-center justify-content-center"
                        style="width: 100px; height: 100px; font-size: 2.5rem; background: linear-gradient(45deg, #42b549, #0d6efd);">
                        {{ substr($shop->name, 0, 1) }}
                    </div>
                </div>
            </div>

            <div class="col-md">
                <h2 class="fw-bold mb-1">{{ $shop->name }}</h2>
                <p class="text-muted mb-2 small">
                    <i class="bi bi-geo-alt-fill text-danger"></i> {{ $shop->address ?? 'Lokasi belum diatur' }}
                    <span class="mx-2">|</span>
                    Bergabung: {{ $shop->created_at->diffForHumans() }}
                </p>
                <div class="d-flex gap-2">
                    <a href="https://wa.me/{{ $shop->phone }}" target="_blank" class="btn btn-success btn-sm px-4 fw-bold">
                        <i class="bi bi-chat-dots"></i> Chat Penjual
                    </a>
                    <button class="btn btn-outline-secondary btn-sm px-4 fw-bold">
                        <i class="bi bi-plus"></i> Ikuti
                    </button>
                </div>
            </div>

            <div class="col-md-auto mt-3 mt-md-0 border-start ps-md-4">
                <div class="d-flex gap-4 text-center">
                    <div>
                        <div class="fw-bold fs-5">4.9</div>
                        <div class="small text-muted">Rating</div>
                    </div>
                    <div>
                        <div class="fw-bold fs-5">{{ $shop->products->count() }}</div>
                        <div class="small text-muted">Produk</div>
                    </div>
                    <div>
                        <div class="fw-bold fs-5">98%</div>
                        <div class="small text-muted">Performa Chat</div>
                    </div>
                </div>
            </div>
        </div>

        <ul class="nav nav-tabs border-bottom-0 mt-2">
            <li class="nav-item">
                <a class="nav-link active fw-bold border-bottom border-3 border-success text-success" aria-current="page" href="#">Semua Produk</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-muted" href="#">Terlaris</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-muted" href="#">Ulasan</a>
            </li>
        </ul>
    </div>
</div>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <small class="text-muted">Menampilkan <b>{{ $shop->products->count() }}</b> produk dari toko ini</small>
        <div class="dropdown">
            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                Urutkan: Terbaru
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Termurah</a></li>
                <li><a class="dropdown-item" href="#">Termahal</a></li>
            </ul>
        </div>
    </div>

    <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3">
        @forelse($shop->products as $product)
        <div class="col">
            <div class="card h-100 border-0 shadow-sm" style="transition: transform 0.2s;">
                <div class="position-relative">
                    <img src="{{ asset('img/products/' . $product->image) }}"
                        class="card-img-top object-fit-cover"
                        style="height: 150px;"
                        alt="{{ $product->name }}">
                </div>

                <div class="p-2 d-flex flex-column flex-grow-1 bg-white">
                    <p class="card-title text-dark text-truncate mb-1" style="font-size: 0.9rem;">
                        {{ $product->name }}
                    </p>
                    <p class="fw-bold text-success mb-1" style="font-size: 1rem;">
                        Rp{{ number_format($product->price, 0, ',', '.') }}
                    </p>
                    <div class="mt-auto d-flex align-items-center small text-muted" style="font-size: 0.7rem;">
                        <i class="bi bi-star-fill text-warning me-1"></i>
                        <span>4.8</span>
                        <span class="mx-1">|</span>
                        <span>Terjual 12</span>
                    </div>
                    <a href="{{ route('product.detail', $product->id) }}" class="stretched-link"></a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 py-5 text-center">
            <div class="text-muted mb-3">
                <i class="bi bi-box-seam" style="font-size: 3rem;"></i>
            </div>
            <h5>Toko ini belum memiliki produk.</h5>
        </div>
        @endforelse
    </div>
</div>

<style>
    /* Hover Effect khusus Card di Halaman Toko */
    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
    }
</style>
@endsection