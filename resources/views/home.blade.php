@extends('layouts.main')

@section('title', 'Pasarkulo - Situs Belanja Online Lokal')

@section('content')

<div class="container mt-4">
    <div class="row">
        <div class="col-lg-8 mb-3">
            <div id="mainCarousel" class="carousel slide rounded-3 overflow-hidden shadow-sm" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div style="height: 300px; background: linear-gradient(45deg, #42b549, #a8e063); display:flex; align-items:center; justify-content:center; color:white;">
                            <div class="text-center">
                                <h1>Promo Pengguna Baru</h1>
                                <p>Diskon hingga 50% untuk jajan pasar!</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div style="height: 300px; background: linear-gradient(45deg, #FF512F, #DD2476); display:flex; align-items:center; justify-content:center; color:white;">
                            <div class="text-center">
                                <h1>Gratis Ongkir se-Jogja</h1>
                                <p>Tanpa minimum pembelian.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>
        </div>

        <div class="col-lg-4 d-none d-lg-block">
            <div class="rounded-3 mb-3 p-3 text-white shadow-sm" style="height: 140px; background-color: #fa591d;">
                <h5>Flash Sale</h5>
                <p class="small">Berakhir dalam 02:15:00</p>
                <button class="btn btn-sm btn-light text-warning fw-bold">Cek Sekarang</button>
            </div>
            <div class="rounded-3 p-3 text-white shadow-sm" style="height: 145px; background-color: #0d6efd;">
                <h5>Pulsa & Tagihan</h5>
                <p class="small">Cashback 5% hari ini</p>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="d-flex justify-content-between bg-white p-3 rounded-3 shadow-sm border overflow-auto">
        @foreach(['Elektronik', 'Fashion', 'Makanan', 'Hobi', 'Otomotif', 'Rumah', 'Kesehatan', 'Voucher'] as $kategori)
        <div class="text-center mx-3" style="min-width: 60px; cursor: pointer;">
            <div class="rounded-3 border mb-2 d-flex align-items-center justify-content-center mx-auto" style="width: 50px; height: 50px; background-color: #fff;">
                <i class="bi bi-tag-fill text-success"></i>
            </div>
            <small class="text-muted" style="font-size: 0.75rem;">{{ $kategori }}</small>
        </div>
        @endforeach
    </div>
</div>

<div class="container mt-4 mb-5">
    <div class="d-flex align-items-center mb-3">
        <h5 class="fw-bold mb-0">Rekomendasi Untukmu</h5>
        <a href="#" class="ms-auto text-decoration-none text-success fw-bold small">Lihat Semua</a>
    </div>

    <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3">
        @forelse($products as $product)
        <div class="col">
            <div class="product-card d-flex flex-column">
                <div class="position-relative">
                    <img src="{{ asset('img/products/' . $product->image) }}"
                        class="card-img-top object-fit-cover"
                        style="height: 150px;"
                        alt="{{ $product->name }}">
                    <span class="position-absolute top-0 end-0 bg-warning text-dark badge m-1 rounded-1" style="font-size: 0.6rem;">10% OFF</span>
                </div>

                <div class="p-2 d-flex flex-column flex-grow-1">
                    <p class="card-title text-dark text-truncate mb-1" style="font-size: 0.9rem;">
                        {{ $product->name }}
                    </p>

                    <p class="product-price mb-1">
                        Rp{{ number_format($product->price, 0, ',', '.') }}
                    </p>

                    <div class="mt-auto">
                        <div class="shop-location mb-1 text-truncate">
                            <i class="bi bi-geo-alt-fill text-secondary"></i> {{ $product->shop->address ?? 'Yogyakarta' }}
                        </div>

                        <div class="d-flex align-items-center small text-muted" style="font-size: 0.7rem;">
                            <i class="bi bi-star-fill rating-star me-1"></i>
                            <span>4.8</span>
                            <span class="mx-1">|</span>
                            <span>Terjual {{ rand(10, 100) }}</span>
                        </div>
                    </div>

                    <a href="{{ route('product.detail', $product->id) }}" class="stretched-link"></a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted">Belum ada produk.</p>
        </div>
        @endforelse
    </div>
</div>

@endsection