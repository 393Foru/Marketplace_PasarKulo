@extends('layouts.main')

@section('title', 'Pusat Bantuan - Pasarkulo')

@section('content')
<div class="py-5 text-center text-white" style="background: linear-gradient(135deg, #42b549, #2d8a33);">
    <div class="container">
        <h1 class="fw-bold mb-2">Apa yang bisa kami bantu?</h1>
        <p class="lead opacity-75 mb-4">Temukan jawaban seputar belanja dan jualan di Pasarkulo.</p>
        
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white border-0 ps-4"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" class="form-control border-0 py-3" placeholder="Ketik kata kunci (misal: cara bayar)...">
                    <button class="btn btn-warning fw-bold px-4 text-dark">Cari</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <h5 class="fw-bold text-success mb-3"><i class="bi bi-question-circle-fill me-2"></i> Pertanyaan Umum</h5>
            <div class="accordion shadow-sm border-0 mb-5" id="accordionGeneral">
                
                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            Apa itu Pasarkulo?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#accordionGeneral">
                        <div class="accordion-body text-muted">
                            Pasarkulo adalah platform marketplace lokal yang menghubungkan pembeli dengan pedagang pasar tradisional dan UMKM di sekitar Yogyakarta. Kami memudahkan Anda berbelanja kebutuhan sehari-hari tanpa harus keluar rumah.
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            Apakah saya harus mendaftar untuk belanja?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#accordionGeneral">
                        <div class="accordion-body text-muted">
                            Tidak wajib. Anda bisa melihat-lihat produk sebagai tamu. Namun, untuk menghubungi penjual via WhatsApp dengan format otomatis, kami sarankan mendaftar agar pengalaman belanja lebih nyaman.
                        </div>
                    </div>
                </div>

            </div>

            <h5 class="fw-bold text-success mb-3"><i class="bi bi-bag-fill me-2"></i> Untuk Pembeli</h5>
            <div class="accordion shadow-sm border-0 mb-5" id="accordionBuyer">
                
                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            Bagaimana cara memesan barang?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#accordionBuyer">
                        <div class="accordion-body text-muted">
                            <ol>
                                <li>Pilih produk yang Anda inginkan.</li>
                                <li>Klik tombol <strong>"Beli Sekarang"</strong> di halaman detail produk.</li>
                                <li>Anda akan diarahkan ke WhatsApp penjual dengan pesan pemesanan yang sudah terisi otomatis.</li>
                                <li>Lakukan kesepakatan pembayaran dan pengiriman langsung dengan penjual.</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                            Metode pembayaran apa yang tersedia?
                        </button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#accordionBuyer">
                        <div class="accordion-body text-muted">
                            Karena transaksi dilakukan langsung dengan penjual (Direct to Seller), metode pembayaran tergantung kesepakatan. Umumnya bisa melalui:
                            <ul>
                                <li>COD (Bayar di tempat)</li>
                                <li>Transfer Bank (BCA, BRI, Mandiri)</li>
                                <li>E-Wallet (GoPay, OVO, Dana)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <h5 class="fw-bold text-success mb-3"><i class="bi bi-shop me-2"></i> Untuk Penjual</h5>
            <div class="accordion shadow-sm border-0 mb-5" id="accordionSeller">
                
                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                            Apakah membuka toko dipungut biaya?
                        </button>
                    </h2>
                    <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#accordionSeller">
                        <div class="accordion-body text-muted">
                            Tidak! Membuka toko dan mengupload produk di Pasarkulo <strong>100% GRATIS</strong>. Kami ingin mendukung UMKM lokal untuk tumbuh.
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                            Bagaimana cara upload produk?
                        </button>
                    </h2>
                    <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#accordionSeller">
                        <div class="accordion-body text-muted">
                            Masuk ke akun Anda -> Klik Menu Profil -> Pilih <strong>Dashboard Toko</strong> -> Klik tombol <strong>Tambah Produk</strong>. Isi foto dan deskripsi, lalu simpan.
                        </div>
                    </div>
                </div>

            </div>

            <div class="card border-0 bg-light p-4 text-center rounded-3">
                <h5 class="fw-bold mb-3">Masih butuh bantuan?</h5>
                <p class="text-muted mb-4">Tim support kami siap membantu Anda setiap hari (08.00 - 17.00 WIB).</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-success fw-bold px-4">
                        <i class="bi bi-whatsapp"></i> Chat WhatsApp
                    </a>
                    <a href="mailto:help@pasarkulo.com" class="btn btn-outline-secondary fw-bold px-4">
                        <i class="bi bi-envelope"></i> Email Kami
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    /* Sedikit styling tambahan untuk Accordion */
    .accordion-button:not(.collapsed) {
        color: var(--primary-color);
        background-color: #f0fdf4;
        box-shadow: inset 0 -1px 0 rgba(0,0,0,.125);
    }
    .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(0,0,0,.125);
    }
</style>
@endsection