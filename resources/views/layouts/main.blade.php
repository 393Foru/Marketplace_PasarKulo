<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pasarkulo')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <link href="{{ asset('css/pasarkulo.css') }}" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand me-4" href="/">
                <i class="bi bi-basket3-fill"></i> Pasarkulo
            </a>

            <div class="flex-grow-1 d-none d-md-block mx-4">
                <div class="input-group">
                    <input type="text" class="form-control search-input py-2" placeholder="Cari beras, kripik, atau elektronik...">
                    <button class="btn search-btn px-3" type="button"><i class="bi bi-search"></i></button>
                </div>
            </div>

            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('cart.index') }}" class="nav-link">
                    <i class="bi bi-cart"></i>
                    <span class="badge bg-danger">
                        {{ \App\Models\Cart::where('user_id', auth()->id())->count() }}
                    </span>
                </a>
                
                <div class="vr mx-2 d-none d-lg-block"></div>

                @guest
                    <a href="{{ route('login') }}" class="btn ungu-btn btn-sm fw-bold px-3">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm fw-bold px-3 text-white" style="background-color: var(--primary-color); border:none;">Daftar</a>
                @endguest

                @auth
                    <div class="dropdown">
                        <a class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown">
                            <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px; font-weight:bold;">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="fw-bold small d-none d-lg-block">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li><a class="dropdown-item small" href="#">Profil Saya</a></li>
                            <li><a class="dropdown-item small" href="{{ route('dashboard') }}">Dashboard Toko</a></li>
                            <li><a class="dropdown-item small" href="#">Pesanan</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item small text-danger">Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
        <div class="container d-md-none mt-2">
            <div class="input-group w-100">
                <input type="text" class="form-control search-input" placeholder="Cari di Pasarkulo...">
                <button class="btn search-btn" type="button"><i class="bi bi-search"></i></button>
            </div>
        </div>
    </nav>

    <main class="flex-grow-1">
        @yield('content')
    </main>

    <div class="bg-white border-top mt-5 py-4">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <div class="rounded-circle bg-light p-3 me-3 text-success">
                        <i class="bi bi-shield-check fs-3"></i>
                    </div>
                    <div class="text-start">
                        <h6 class="fw-bold mb-0">Jaminan Aman</h6>
                        <small class="text-muted">Garansi uang kembali</small>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <div class="rounded-circle bg-light p-3 me-3 text-success">
                        <i class="bi bi-box-seam fs-3"></i>
                    </div>
                    <div class="text-start">
                        <h6 class="fw-bold mb-0">Produk Lokal</h6>
                        <small class="text-muted">Dukung UMKM Indonesia</small>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <div class="rounded-circle bg-light p-3 me-3 text-success">
                        <i class="bi bi-whatsapp fs-3"></i>
                    </div>
                    <div class="text-start">
                        <h6 class="fw-bold mb-0">Respon Cepat</h6>
                        <small class="text-muted">Hubungi langsung via WA</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-light pt-5 border-top">
        <div class="container pb-5">
            <div class="row g-4">
                
                <div class="col-lg-3 col-md-6">
                    <a class="d-flex align-items-center text-decoration-none text-judul mb-3" href="/">
                        <i class="bi bi-basket3-fill fs-3 me-2"></i>
                        <span class="fw-bold fs-4" style="letter-spacing: -1px;">Pasarkulo</span>
                    </a>
                    <p class="text-muted small mb-4" style="line-height: 1.6;">
                        Pasarkulo adalah platform marketplace gotong royong untuk menghubungkan pedagang pasar tradisional dan UMKM dengan pembeli modern.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold mb-3">Bantuan</h6>
                    <ul class="list-unstyled text-muted small footer-link-list">
                        <li><a href="#">Cara Belanja</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="#">Hubungi Kami</a></li>
                        <li><a href="#">Panduan Penjual</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold mb-3">Jelajahi</h6>
                    <ul class="list-unstyled text-muted small footer-link-list">
                        <li><a href="#">Makanan & Minuman</a></li>
                        <li><a href="#">Kerajinan Tangan</a></li>
                        <li><a href="#">Fashion Wanita</a></li>
                        <li><a href="#">Fashion Pria</a></li>
                        <li><a href="#">Oleh-oleh Jogja</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-bold mb-3">Pembayaran</h6>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <div class="payment-badge">BCA</div>
                        <div class="payment-badge">BRI</div>
                        <div class="payment-badge">Mandiri</div>
                        <div class="payment-badge">Gopay</div>
                        <div class="payment-badge">QRIS</div>
                    </div>

                    <h6 class="fw-bold mb-3">Jasa Pengiriman</h6>
                    <div class="d-flex flex-wrap gap-2">
                        <div class="shipment-badge">JNE</div>
                        <div class="shipment-badge">J&T</div>
                        <div class="shipment-badge">SiCepat</div>
                        <div class="shipment-badge">Gosend</div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-12">
                    <h6 class="fw-bold mb-3">Download App</h6>
                    <div class="d-flex flex-column gap-2">
                        <a href="#" class="btn btn-dark btn-sm text-start d-flex align-items-center px-3 py-2">
                            <i class="bi bi-google-play fs-4 me-2"></i>
                            <div style="line-height: 1.1">
                                <span style="font-size: 0.6rem; display:block;">GET IT ON</span>
                                <span class="fw-bold">Google Play</span>
                            </div>
                        </a>
                        <a href="#" class="btn btn-dark btn-sm text-start d-flex align-items-center px-3 py-2">
                            <i class="bi bi-apple fs-4 me-2"></i>
                            <div style="line-height: 1.1">
                                <span style="font-size: 0.6rem; display:block;">Download on the</span>
                                <span class="fw-bold">App Store</span>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
        </div>
        
        <div class="bg-white py-3 border-top">
            <div class="container text-center">
                <small class="text-muted">
                    &copy; 2026 <b>Pasarkulo Indonesia</b>. Hak Cipta Dilindungi. 
                    <span class="d-none d-md-inline ms-2">Dibuat dengan ❤️ di Yogyakarta.</span>
                </small>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>