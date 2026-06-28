<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $kamar->nama }} — Villa Serenity</title>
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
                    <li class="nav-item"><a class="nav-link nav-link-villa" href="/villa/kamar">Kamar</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <a href="/villa/kamar" class="btn btn-outline-secondary mb-3"><i class="bi bi-arrow-left"></i> Kembali</a>

        <div class="detail-card">
            <div class="row g-0">
                <div class="col-md-6">
                    @if($kamar->foto)
                        <img src="{{ Storage::url($kamar->foto) }}" class="detail-img">
                    @else
                        <div class="detail-img d-flex align-items-center justify-content-center bg-light">
                            <i class="bi bi-image text-muted" style="font-size:4rem;"></i>
                        </div>
                    @endif
                </div>
                <div class="col-md-6 p-4">
                    <span class="badge-tipe badge-{{ $kamar->tipe }}">{{ ucfirst($kamar->tipe) }}</span>
                    <h2 class="mt-2">{{ $kamar->nama }}</h2>
                    <p class="villa-price">Rp {{ number_format($kamar->harga_per_malam, 0, ',', '.') }} <small class="text-muted">/malam</small></p>
                    <p><i class="bi bi-people-fill"></i> Kapasitas {{ $kamar->kapasitas }} orang</p>
                    <p class="{{ $kamar->tersedia ? 'text-success' : 'text-danger' }}">
                        <i class="bi bi-circle-fill" style="font-size:8px;"></i> {{ $kamar->tersedia ? 'Tersedia' : 'Tidak tersedia' }}
                    </p>
                    <p>{{ $kamar->deskripsi }}</p>

                    @if($kamar->fasilitas)
                    <div class="mt-3">
                        <strong>Fasilitas:</strong>
                        <div class="d-flex flex-wrap gap-2 mt-2">
                            @foreach(explode(', ', $kamar->fasilitas) as $f)
                                <span class="badge-fasilitas"><i class="bi bi-check-circle"></i> {{ $f }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if($kamar->tersedia)
                    <a href="/villa/booking/{{ $kamar->id }}" class="btn btn-villa-primary mt-4"><i class="bi bi-calendar-check me-1"></i> Booking Sekarang</a>
                    @else
                    <button class="btn btn-secondary mt-4" disabled>Kamar Tidak Tersedia</button>
                    @endif
                </div>
            </div>

            @if($kamar->video_url)
            <div class="p-4 border-top">
                <h5 class="mb-3"><i class="bi bi-play-circle me-2"></i>Video Kamar</h5>
                <div class="ratio ratio-16x9">
                    <iframe src="{{ $kamar->video_url }}" allowfullscreen></iframe>
                </div>
            </div>
            @endif
        </div>
    </div>

    <footer class="footer-villa">
        <div class="container"><p class="mb-0">Villa Serenity &copy; {{ date('Y') }}</p></div>
    </footer>
</body>
</html>