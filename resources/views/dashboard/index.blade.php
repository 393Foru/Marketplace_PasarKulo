@extends('layouts.main')

@section('title', 'Seller Centre - Pasarkulo')

@section('content')
<div class="bg-light min-vh-100 py-4">
    <div class="container">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold text-dark mb-1">Seller Centre</h4>
                <p class="text-muted small mb-0">Kelola toko dan pantau perkembangan bisnismu.</p>
            </div>
            <div class="d-flex align-items-center bg-white px-3 py-2 rounded shadow-sm">
                <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center me-2" 
                     style="width: 35px; height: 35px; font-weight:bold;">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <small class="d-block text-muted" style="font-size: 0.7rem; line-height: 1;">Halo,</small>
                    <span class="fw-bold text-dark" style="font-size: 0.9rem;">{{ Auth::user()->name }}</span>
                </div>
            </div>
        </div>

        <div class="row g-4">
            
            <div class="col-lg-3">
                <div class="dashboard-sidebar sticky-top" style="top: 90px; z-index: 1;">
                    <div class="p-3 border-bottom bg-white">
                        <small class="text-uppercase text-muted fw-bold" style="font-size: 0.7rem;">Menu Utama</small>
                    </div>
                    
                    <a href="{{ route('dashboard') }}" class="dashboard-menu-item active">
                        <i class="bi bi-grid-1x2"></i> Ringkasan Toko
                    </a>
                    
                    @if($shop)
                    <a href="{{ route('my-products.index') }}" class="dashboard-menu-item">
                        <i class="bi bi-box-seam"></i> Produk Saya
                    </a>
                    <a href="{{ route('shop.detail', $shop->slug) }}" class="dashboard-menu-item">
                        <i class="bi bi-shop-window"></i> Lihat Halaman Toko
                    </a>
                    <a href="#" class="dashboard-menu-item text-muted">
                        <i class="bi bi-receipt"></i> Pesanan <span class="badge bg-secondary ms-auto" style="font-size: 0.6rem;">Soon</span>
                    </a>
                    @endif
                    
                    <div class="p-3 border-bottom border-top bg-white mt-2">
                        <small class="text-uppercase text-muted fw-bold" style="font-size: 0.7rem;">Akun</small>
                    </div>
                    
                    <a href="{{ route('profile.edit') }}" class="dashboard-menu-item">
                        <i class="bi bi-person-gear"></i> Pengaturan Akun
                    </a>
                    
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dashboard-menu-item w-100 border-0 bg-transparent text-danger">
                            <i class="bi bi-box-arrow-right"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-9">

                @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm d-flex align-items-center mb-4">
                    <i class="bi bi-check-circle-fill fs-4 me-2"></i>
                    {{ session('success') }}
                </div>
                @endif

                @if(!$shop)
                    <div class="card border-0 shadow-sm text-center py-5">
                        <div class="card-body py-5">
                            <div class="mb-4">
                                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 120px; height: 120px;">
                                    <i class="bi bi-shop text-success" style="font-size: 4rem;"></i>
                                </div>
                            </div>
                            <h2 class="fw-bold text-dark">Mari Buka Toko Pertamamu!</h2>
                            <p class="text-muted col-md-8 mx-auto mb-4">
                                Bergabunglah dengan ratusan penjual lokal lainnya. Gratis biaya pendaftaran dan nikmati kemudahan berjualan lewat WhatsApp.
                            </p>
                            <a href="{{ route('shop.create') }}" class="btn btn-success btn-lg px-5 fw-bold shadow-sm">
                                <i class="bi bi-plus-circle me-2"></i> Buka Toko Gratis Sekarang
                            </a>
                        </div>
                    </div>

                @else
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="text-muted small mb-1 fw-bold">TOTAL PRODUK</p>
                                        <h3 class="fw-bold text-dark mb-0">{{ $shop->products->count() }}</h3>
                                    </div>
                                    <div class="stat-icon-bg bg-primary bg-opacity-10 text-primary mb-0">
                                        <i class="bi bi-box"></i>
                                    </div>
                                </div>
                                <a href="{{ route('my-products.index') }}" class="small text-decoration-none fw-bold mt-3 d-inline-block">Kelola Produk &rarr;</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="text-muted small mb-1 fw-bold">PENGUNJUNG</p>
                                        <h3 class="fw-bold text-dark mb-0">{{ rand(50, 500) }}</h3>
                                    </div>
                                    <div class="stat-icon-bg bg-warning bg-opacity-10 text-warning mb-0">
                                        <i class="bi bi-eye"></i>
                                    </div>
                                </div>
                                <span class="small text-muted mt-3 d-inline-block">Dalam 30 hari terakhir</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="text-muted small mb-1 fw-bold">RATING TOKO</p>
                                        <h3 class="fw-bold text-dark mb-0">4.9</h3>
                                    </div>
                                    <div class="stat-icon-bg bg-info bg-opacity-10 text-info mb-0">
                                        <i class="bi bi-star"></i>
                                    </div>
                                </div>
                                <span class="small text-muted mt-3 d-inline-block">Sangat Baik</span>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="fw-bold mb-0">Aksi Cepat</h5>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <a href="{{ route('my-products.create') }}" class="btn ungu-btn w-100 py-3 d-flex align-items-center justify-content-center gap-2 border-2 fw-bold">
                                        <i class="bi bi-plus-lg fs-5"></i> Tambah Produk Baru
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('shop.detail', $shop->slug) }}" target="_blank" class="btn btn-outline-secondary w-100 py-3 d-flex align-items-center justify-content-center gap-2 border-2 fw-bold">
                                        <i class="bi bi-box-arrow-up-right fs-5"></i> Lihat Toko Saya
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                            <h6 class="fw-bold mb-0">Produk Terakhir Ditambahkan</h6>
                            <a href="{{ route('my-products.index') }}" class="small text-judul">Lihat Semua</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="ps-4">Nama Produk</th>
                                            <th>Harga</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($shop->products->take(3) as $product)
                                        <tr>
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://dummyimage.com/100/dee2e6/6c757d.jpg' }}" 
                                                         class="rounded me-2" width="40" height="40" style="object-fit:cover;">
                                                    <span class="fw-bold text-dark">{{ $product->name }}</span>
                                                </div>
                                            </td>
                                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                            <td class="text-muted small">{{ $product->created_at->format('d M Y') }}</td>
                                            <td><span class="badge bg-success bg-opacity-10 text-success px-3">Aktif</span></td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4 text-muted">
                                                Belum ada produk. Yuk tambah produk pertamamu!
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                @endif

            </div>
        </div>
    </div>
</div>
@endsection