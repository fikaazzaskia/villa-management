<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilihan Kamar — Villa Serenity</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/villa-theme.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-villa">
        <div class="container">
            <a class="navbar-brand-villa" href="/"><i class="bi bi-houses-fill me-1"></i> Villa Serenity</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto gap-1">
                    <li class="nav-item"><a class="nav-link nav-link-villa" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-villa" href="/villa/galeri">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-villa active" href="/villa/kamar">Kamar</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <h2 class="text-center mb-4"><i class="bi bi-door-open me-2"></i>Pilihan Kamar</h2>

        <div class="row g-4">
            @forelse($kamars as $k)
            <div class="col-md-6 col-lg-4">
                <div class="villa-card">
                    @if($k->foto)
                        <img src="{{ Storage::url($k->foto) }}" class="villa-card-img">
                    @else
                        <div class="villa-card-img d-flex align-items-center justify-content-center bg-light">
                            <i class="bi bi-image text-muted" style="font-size:3rem;"></i>
                        </div>
                    @endif
                    <span class="badge-tipe badge-{{ $k->tipe }}">{{ ucfirst($k->tipe) }}</span>
                    <div class="villa-card-body">
                        <h5>{{ $k->nama }}</h5>
                        <p class="text-muted small mb-2">
                            <i class="bi bi-people-fill"></i> {{ $k->kapasitas }} orang
                            &nbsp;|&nbsp;
                            <span class="{{ $k->tersedia ? 'text-success' : 'text-danger' }}">{{ $k->tersedia ? 'Tersedia' : 'Penuh' }}</span>
                        </p>
                        <p class="villa-price">Rp {{ number_format($k->harga_per_malam, 0, ',', '.') }} <small class="text-muted">/malam</small></p>
                        <a href="/villa/kamar/{{ $k->id }}" class="btn btn-villa-primary w-100 mt-2">Lihat & Booking</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted py-5">Belum ada kamar tersedia.</div>
            @endforelse
        </div>
    </div>

    <footer class="footer-villa">
        <div class="container"><p class="mb-0">Villa Serenity &copy; {{ date('Y') }}</p></div>
    </footer>
</body>
</html>