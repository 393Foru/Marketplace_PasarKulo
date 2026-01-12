@extends('layouts.main')

@section('content')
<style>
    /* Mengubah Header Kartu & Text Biru jadi Ungu */
    .bg-primary {
        background-color: #6f42c1 !important;
    }
    .text-primary {
        color: #6f42c1 !important;
    }

    /* OPSI: Jika ingin Tombol 'Bayar Sekarang' juga Ungu (bukan hijau/success) */
    /* Hapus bagian ini jika ingin tombol bayar tetap Hijau */
    .btn-success {
        background-color: #6f42c1 !important;
        border-color: #6f42c1 !important;
    }
    .btn-success:hover {
        background-color: #59359a !important;
        border-color: #59359a !important;
    }
</style>
<div class="container py-5">
    
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">Keranjang</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pengiriman & Pembayaran</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold"><i class="fa fa-map-marker-alt me-2 text-danger"></i> Alamat Pengiriman</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-muted small text-uppercase fw-bold">Penerima</label>
                            <input type="text" name="receiver_name" class="form-control" value="{{ Auth::user()->name }}" placeholder="Nama Lengkap" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted small text-uppercase fw-bold">Kontak</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">+62</span>
                                <input type="text" name="receiver_phone" class="form-control" placeholder="812xxxx" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small text-uppercase fw-bold">Alamat Lengkap</label>
                            <textarea name="receiver_address" class="form-control" rows="4" placeholder="Jalan, No. Rumah, Kecamatan, Kode Pos..." required></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card border-0 shadow-sm summary-card">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0 fw-bold">Rincian Pesanan</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @foreach($cartItems as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded me-3" style="width: 50px; height: 50px; background-image: url('{{ asset('storage/' . ($item->product->image ?? 'default.jpg')) }}'); background-size: cover;"></div>
                                <div>
                                    <h6 class="mb-0 text-truncate" style="max-width: 150px;">{{ $item->product->name }}</h6>
                                    <small class="text-muted">{{ $item->quantity }} x Rp {{ number_format($item->product->price) }}</small>
                                </div>
                            </div>
                            <span class="fw-bold">Rp {{ number_format($item->product->price * $item->quantity) }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer bg-light p-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span class="fw-bold">Rp {{ number_format($total) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Biaya Layanan</span>
                        <span class="fw-bold text-success">Gratis</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="fs-5 fw-bold">Total Bayar</span>
                        <span class="fs-4 fw-bold text-primary">Rp {{ number_format($total) }}</span>
                    </div>
                    
                    <button type="button" onclick="document.getElementById('checkoutForm').submit();" class="btn btn-success w-100 py-3 fw-bold fs-5 shadow">
                        Bayar Sekarang <i class="fa fa-chevron-right ms-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection