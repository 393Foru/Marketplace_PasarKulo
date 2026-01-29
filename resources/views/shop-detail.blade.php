@extends('layouts.main')

@section('title', $shop->name . ' - Pasarkulo')

@section('content')

@if(session('success'))
    <div class="container pt-3">
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <a href="{{ route('cart.index') }}" class="fw-bold text-decoration-underline ms-1">Lihat Keranjang</a>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

<div class="bg-white shadow-sm border-bottom">
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

        <ul class="nav nav-tabs border-bottom-0">
            <li class="nav-item">
                <a class="nav-link {{ $tab == 'produk' ? 'active fw-bold border-bottom border-3 border-success text-success' : 'text-muted' }}" 
                   href="{{ route('shop.detail', ['slug' => $shop->slug, 'tab' => 'produk']) }}">
                   Semua Produk
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $tab == 'terlaris' ? 'active fw-bold border-bottom border-3 border-success text-success' : 'text-muted' }}" 
                   href="{{ route('shop.detail', ['slug' => $shop->slug, 'tab' => 'terlaris']) }}">
                   Terlaris
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $tab == 'ulasan' ? 'active fw-bold border-bottom border-3 border-success text-success' : 'text-muted' }}" 
                   href="{{ route('shop.detail', ['slug' => $shop->slug, 'tab' => 'ulasan']) }}">
                   Ulasan Pembeli
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="container py-4">
    
    {{-- LOGIKA TAMPILAN PRODUK (TAB PRODUK / TERLARIS) --}}
    @if($tab == 'produk' || $tab == 'terlaris')

        <div class="d-flex justify-content-between align-items-center mb-3">
            <small class="text-muted">
                Menampilkan <b>{{ $products->count() }}</b> produk 
                {{ $tab == 'terlaris' ? 'paling laris' : 'terbaru' }}
            </small>

            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Filter Lainnya
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Harga Terendah</a></li>
                    <li><a class="dropdown-item" href="#">Harga Tertinggi</a></li>
                </ul>
            </div>
        </div>

        <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3">
            @forelse($products as $product)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm shop-product-card">
                    <div class="position-relative">
                        <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://dummyimage.com/300x300/dee2e6/6c757d.jpg' }}" 
                             class="card-img-top" style="height: 150px; object-fit: cover;">

                        @if($tab == 'terlaris')
                            <span class="position-absolute top-0 start-0 bg-warning text-dark badge m-1 shadow-sm">
                                <i class="bi bi-fire"></i> Best Seller
                            </span>
                        @endif
                    </div>

                    <div class="p-2 d-flex flex-column flex-grow-1 bg-white">
                        <p class="card-title text-dark text-truncate mb-1" style="font-size: 0.9rem;">{{ $product->name }}</p>
                        <p class="fw-bold text-success mb-2">Rp{{ number_format($product->price, 0, ',', '.') }}</p>

                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <div class="small text-muted d-flex align-items-center" style="font-size: 0.7rem;">
                                <i class="bi bi-star-fill text-warning me-1"></i> 
                                <span>4.8</span>
                                <span class="mx-1">|</span>
                                <span>{{ $product->sold_count ?? 0 }} Terjual</span>
                            </div>

                            <form action="{{ route('cart.add', $product->id) }}" method="POST" style="position: relative; z-index: 10;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm p-0 d-flex align-items-center justify-content-center shadow-sm" 
                                        style="width: 30px; height: 30px; border-radius: 50%;" 
                                        title="Tambah ke Keranjang">
                                    <i class="bi bi-cart-plus"></i>
                                </button>
                            </form>
                        </div>

                        <a href="{{ route('product.detail', $product->id) }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 py-5 text-center">
                <div class="mb-3 text-muted opacity-50">
                    <i class="bi bi-basket" style="font-size: 3rem;"></i>
                </div>
                <h5 class="text-muted">Tidak ada produk ditemukan.</h5>
            </div>
            @endforelse
        </div> <div class="mt-4 d-flex justify-content-center">
            {{ $products->appends(['tab' => $tab])->links() }}
        </div>

    {{-- LOGIKA TAMPILAN ULASAN (TAB ULASAN) --}}
    @elseif($tab == 'ulasan')

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 bg-light mb-4 p-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="text-center">
                            <h1 class="fw-bold text-warning mb-0">4.9</h1>
                            <div class="text-warning small">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </div>
                        </div>
                        <div class="border-start ps-3">
                            <h6 class="mb-1">Kepuasan Pembeli</h6>
                            <small class="text-muted">Berdasarkan ulasan transaksi berhasil.</small>
                        </div>
                    </div>
                </div>

                @forelse($reviews as $review)
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                    {{ substr($review->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">{{ $review->user->name }}</h6>
                                    <small class="text-muted">Membeli: <span class="text-success">{{ $review->product->name }}</span></small>
                                </div>
                            </div>
                            <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                        </div>

                        <div class="mb-2">
                            @for($i=1; $i<=5; $i++)
                                <i class="bi bi-star-fill {{ $i <= $review->rating ? 'text-warning' : 'text-muted opacity-25' }}"></i>
                            @endfor
                        </div>

                        <p class="text-dark mb-0" style="line-height: 1.5;">{{ $review->comment }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-5">
                    <div class="mb-3 text-muted opacity-50">
                        <i class="bi bi-chat-square-quote" style="font-size: 3rem;"></i>
                    </div>
                    <h5 class="text-muted">Belum ada ulasan untuk toko ini.</h5>
                </div>
                @endforelse

                <div class="mt-4 d-flex justify-content-center">
                    {{ $reviews->appends(['tab' => 'ulasan'])->links() }}
                </div>
            </div>
        </div>

    @endif

</div> <style>
    /* Hover Effect khusus Card di Halaman Toko */
    .shop-product-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
        transition: all 0.2s ease-in-out;
    }
</style>
@endsection