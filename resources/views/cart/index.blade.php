@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h2>Keranjang Belanja Saya</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>Rp {{ number_format($item->product->price) }}</td>
                <td>{{ $item->quantity }}</td>
                <td>Rp {{ number_format($item->product->price * $item->quantity) }}</td>
                <td>
                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                <td><strong>Rp {{ number_format($total) }}</strong></td>
                <td>
                    <a href="#" class="btn btn-success">Checkout</a>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection