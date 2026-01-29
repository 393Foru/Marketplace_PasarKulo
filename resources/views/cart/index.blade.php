@extends('layouts.main')

@section('content')
<style>
    /* Mengubah Text Biru jadi Ungu */
    .text-primary {
        color: #6f42c1 !important;
    }

    /* Mengubah Tombol Biru (Checkout) jadi Ungu */
    .btn-primary {
        background-color: #6f42c1 !important;
        border-color: #6f42c1 !important;
    }
    
    /* Efek Hover Tombol Ungu */
    .btn-primary:hover {
        background-color: #59359a !important;
        border-color: #59359a !important;
    }
</style>
<div class="container py-5">
    <div class="row">
        <div class="col-12 mb-4">
            <h2 class="fw-bold">Keranjang Belanja <span class="text-muted fs-5">({{ $cartItems->count() }} item)</span></h2>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 py-3" style="width: 40%">Produk</th>
                                    <th class="py-3" style="width: 25%">Jumlah</th>
                                    <th class="py-3" style="width: 25%">Total</th>
                                    <th class="py-3" style="width: 10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cartItems as $item)
                                <tr>
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/' . ($item->product->image ?? 'default.jpg')) }}" class="cart-img me-3" alt="Produk">
                                            <div>
                                                <h6 class="mb-1 fw-bold">{{ $item->product->name }}</h6>
                                                <small class="text-muted">Rp {{ number_format($item->product->price) }} / pcs</small>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="input-group input-group-sm" style="width: 100px;">
                                                <button type="submit" name="type" value="decrease" class="btn btn-outline-secondary" {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                                <input type="text" class="form-control text-center bg-white border-secondary" value="{{ $item->quantity }}" readonly>
                                                <button type="submit" name="type" value="increase" class="btn btn-outline-secondary">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </td>

                                    <td class="fw-bold text-primary">
                                        Rp {{ number_format($item->product->price * $item->quantity) }}
                                    </td>

                                    <td>
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('Hapus item ini?')">
                                                <i class="fa fa-trash-alt fa-lg"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fa fa-shopping-basket fa-3x mb-3"></i>
                                            <p>Keranjang Anda masih kosong.</p>
                                            <a href="{{ route('home') }}" class="btn btn-primary btn-sm">Mulai Belanja</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="card border-0 shadow-sm summary-card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Ringkasan Belanja</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Total Harga ({{ $cartItems->count() }} barang)</span>
                        <span class="fw-bold">Rp {{ number_format($total) }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fs-5 fw-bold">Total Tagihan</span>
                        <span class="fs-5 fw-bold text-primary">Rp {{ number_format($total) }}</span>
                    </div>
                    
                    @if($cartItems->isNotEmpty())
                        <a href="{{ route('checkout.index') }}" class="btn btn-primary w-100 py-2 fw-bold shadow-sm">
                            <i class="fa fa-lock me-2"></i> Lanjut ke Checkout
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection