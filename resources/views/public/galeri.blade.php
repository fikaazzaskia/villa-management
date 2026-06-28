<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri — Villa Serenity</title>
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
                    <li class="nav-item"><a class="nav-link nav-link-villa active" href="/villa/galeri">Galeri</a></li>
                    
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <h2 class="text-center mb-4"><i class="bi bi-images me-2"></i>Galeri Villa</h2>

        <div class="row g-3">
            @forelse($galeris as $g)
            <div class="col-md-4">
                <div class="gallery-thumb" style="height:260px;">
                    @if($g->tipe == 'foto')
                        <img src="{{ Storage::url($g->file) }}" class="gallery-img">
                    @else
                        <video class="gallery-img" controls>
                            <source src="{{ Storage::url($g->file) }}">
                        </video>
                    @endif
                </div>
                @if($g->judul)
                <p class="text-center small text-muted mt-1 mb-0">{{ $g->judul }}</p>
                @endif
            </div>
            @empty
            <div class="col-12 text-center text-muted py-5">Belum ada media di galeri.</div>
            @endforelse
        </div>
    </div>

    <footer class="footer-villa">
        <div class="container"><p class="mb-0">Villa Serenity &copy; {{ date('Y') }}</p></div>
    </footer>
</body>
</html>