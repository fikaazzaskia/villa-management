<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Villa Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="{{ asset('css/villa-theme.css') }}">
</head>
<body>
    @include('partials.navbar')

    <section class="hero-section">
        <div class="container position-relative" style="z-index:5;">
            <div class="row align-items-center">
                <div class="col-lg-8" data-aos="fade-right" data-aos-duration="800">
                    <h1 class="hero-title">Selamat Datang, <span style="color: var(--warm-oat);">{{ session('username') }}</span></h1>
                    <p class="hero-subtitle">Kelola profil villa, booking, tamu, dan pembayaran dengan mudah dari satu dashboard.</p>
                </div>
                <div class="col-lg-4 text-center" data-aos="fade-left" data-aos-duration="800">
                    <img src="{{ asset('img/hero-villa.jpeg') }}" alt="Villa" style="max-width:220px; border-radius:16px; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.3));">
                </div>
            </div>
        </div>
    </section>

    <div class="container" style="margin-top:-40px; position:relative; z-index:10;">
        <div class="glass-panel p-4 mb-4" data-aos="fade-up" data-aos-duration="600">
            <div class="row text-center">
                <div class="col-6 col-md-4 stat-box">
                    <div class="stat-number">{{ $totalBooking }}</div>
                    <div class="stat-label">Total Booking</div>
                </div>
                <div class="col-6 col-md-4 stat-box">
                    <div class="stat-number">{{ $bookingPending }}</div>
                    <div class="stat-label">Booking Pending</div>
                </div>
                <div class="col-6 col-md-4 stat-box">
                    <div class="stat-number">{{ $totalTamu }}</div>
                    <div class="stat-label">Tamu</div>
                </div>
                <div class="col-6 col-md-4 stat-box">
                    <div class="stat-number">{{ $totalPembayaran }}</div>
                    <div class="stat-label">Pembayaran</div>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-4">
        @if(session('success'))
            <div class="alert-villa-success mb-4" data-aos="fade-down">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        <h2 class="text-center mb-4" data-aos="fade-up">Menu Utama</h2>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <a href="/profile" class="dashboard-card">
                    <img src="{{ asset('img/icon-villa.jpeg') }}" class="icon-img" alt="Profil Villa">
                    <h5>Profil Villa</h5>
                    <p class="small text-muted">Atur info, harga & fasilitas villa</p>
                </a>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <a href="/booking" class="dashboard-card">
                    <img src="{{ asset('img/icon-booking.jpeg') }}" class="icon-img" alt="Booking">
                    <h5>Kelola Booking</h5>
                    <p class="small text-muted">Atur reservasi tamu & status booking</p>
                </a>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <a href="/tamu" class="dashboard-card">
                    <img src="{{ asset('img/icon-tamu.jpeg') }}" class="icon-img" alt="Tamu">
                    <h5>Kelola Tamu</h5>
                    <p class="small text-muted">Data tamu, email, no HP & KTP</p>
                </a>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                <a href="/pembayaran" class="dashboard-card">
                    <img src="{{ asset('img/icon-payment.jpeg') }}" class="icon-img" alt="Pembayaran">
                    <h5>Pembayaran</h5>
                    <p class="small text-muted">Catat pembayaran & bukti transfer</p>
                </a>
            </div>
        </div>
    </div>

    <footer class="footer-villa">
        <div class="container">
            <p class="mb-0">Villa Management System &copy; {{ date('Y') }} — Semua hak dilindungi.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ once: true });</script>
</body>
</html>