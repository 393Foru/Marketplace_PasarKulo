@extends('layouts.main')

@section('title', $product->name . ' - Pasarkulo')

@section('content')
<div class="container py-3">
    
    {{-- TAMBAHKAN KODE ALERT INI --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-3" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <a href="{{ route('cart.index') }}" class="fw-bold text-decoration-underline ms-1">Lihat Keranjang</a>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Lanjut ke Breadcrumb yang sudah ada... --}}
    <nav aria-label="breadcrumb" class="small mb-3">

<div class="container py-3">
    <nav aria-label="breadcrumb" class="small mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-muted">Beranda</a></li>
            <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">Kategori</a></li>
            <li class="breadcrumb-item active text-truncate" style="max-width: 200px;" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row g-4">
        <div class="col-md-4 col-lg-5">
            <div class="bg-white p-2 rounded shadow-sm border sticky-top" style="top: 90px; z-index: 1;">
                <img src="https://dummyimage.com/600x600/dee2e6/6c757d.jpg&text={{ urlencode($product->name) }}" 
                     class="img-fluid rounded w-100" alt="{{ $product->name }}">
                
                <div class="d-flex gap-2 mt-2 overflow-auto">
                    @for($i=0; $i<4; $i++)
                    <img src="https://dummyimage.com/100x100/dee2e6/6c757d.jpg" class="rounded border" style="width: 70px; cursor: pointer;">
                    @endfor
                </div>
            </div>
        </div>

        <div class="col-md-8 col-lg-7">
            <div class="bg-white p-4 rounded shadow-sm border mb-3">
                <h1 class="fs-4 fw-bold mb-2">{{ $product->name }}</h1>
                
                <div class="d-flex align-items-center text-muted small mb-3">
                    <span class="text-warning me-1">
                        <i class="bi bi-star-fill"></i> 4.8
                    </span>
                    <span class="mx-2">|</span>
                    <span>100+ Terjual</span>
                </div>

                <div class="p-3 rounded mb-4" style="background-color: #fafafa;">
                    <h2 class="text-danger fw-bold mb-0">Rp{{ number_format($product->price, 0, ',', '.') }}</h2>
                    @if(rand(0,1)) 
                    <div class="d-flex align-items-center mt-1">
                        <span class="badge bg-danger me-2">20%</span>
                        <span class="text-decoration-line-through text-muted small">Rp{{ number_format($product->price * 1.2, 0, ',', '.') }}</span>
                    </div>
                    @endif
                </div>

                <div class="mb-4">
                    <p class="mb-2 fw-bold text-muted small">Pilih Varian:</p>
                    <button class="btn btn-outline-secondary btn-sm me-2 active">Default</button>
                    <button class="btn btn-outline-secondary btn-sm me-2">Paket Hemat</button>
                </div>

                <hr>

                <div class="d-flex gap-3 mt-4">
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-grow-1">
                        @csrf
                        <button type="submit" class="btn ungu-btn btn-lg px-4 fw-bold w-100">
                            <i class="bi bi-cart-plus"></i> Keranjang
                        </button>
                    </form>
                    <a href="https://wa.me/{{ $product->shop->phone }}?text=Halo, saya mau beli *{{ $product->name }}* di Pasarkulo..." 
                       target="_blank"
                       class="btn ungu btn-lg px-4 fw-bold flex-grow-1">
                        Beli Sekarang
                    </a>
                </div>
            </div>

            <div class="bg-white p-3 rounded shadow-sm border d-flex align-items-center mb-3">
                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white fw-bold me-3" 
                     style="width: 60px; height: 60px; font-size: 1.5rem;">
                     {{ substr($product->shop->name, 0, 1) }}
                </div>
                <div class="flex-grow-1">
                    <h5 class="mb-0 fw-bold">{{ $product->shop->name }}</h5>
                    <div class="text-muted small">
                        <span class="me-2"><i class="bi bi-geo-alt"></i> {{ $product->shop->address ?? 'Kota Yogyakarta' }}</span>
                        <span><i class="bi bi-circle-fill text-success" style="font-size: 8px;"></i> Online</span>
                    </div>
                </div>
                <a href="{{ route('shop.detail', $product->shop->slug) }}" class="btn btn-outline-secondary btn-sm px-3">
                    <i class="bi bi-shop"></i> Kunjungi Toko
                </a>
            </div>

            <div class="bg-white p-4 rounded shadow-sm border">
                <h5 class="fw-bold mb-3">Deskripsi Produk</h5>
                <p class="text-secondary" style="white-space: pre-line; line-height: 1.6;">{{ $product->description }}</p>
            </div>
        </div>
    </div>
</div>
@endsection