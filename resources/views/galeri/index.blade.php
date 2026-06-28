<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Galeri Villa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/villa-theme.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    @include('partials.navbar')

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-images me-2"></i>Galeri Villa</h2>
            <a href="/galeri-create" class="btn btn-villa-primary"><i class="bi bi-plus-lg me-1"></i>Tambah Media</a>
        </div>

        @if(session('success'))
            <div class="alert-villa-success mb-3">{{ session('success') }}</div>
        @endif

        <div class="row g-3">
            @forelse($galeris as $g)
            <div class="col-md-4">
                <div class="gallery-thumb" style="height:220px;">
                    @if($g->tipe == 'foto')
                        <img src="{{ Storage::url($g->file) }}" class="gallery-img">
                    @else
                        <video class="gallery-img" controls>
                            <source src="{{ Storage::url($g->file) }}">
                        </video>
                    @endif
                </div>
                <div class="d-flex justify-content-between align-items-center mt-2">
                    <span class="small text-muted">{{ $g->judul ?: '(Tanpa judul)' }}</span>
                    <button onclick="hapusGaleri({{ $g->id }})" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted py-5">
                <i class="bi bi-images" style="font-size:3rem;"></i>
                <p class="mt-2">Belum ada media di galeri.</p>
            </div>
            @endforelse
        </div>
    </div>

    <script>
    function hapusGaleri(id) {
        if (confirm('Yakin ingin menghapus media ini?')) {
            $.ajax({
                url: '/galeri-hapus/' + id,
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function () { location.reload(); },
                error: function () { alert('Gagal menghapus media!'); }
            });
        }
    }
    </script>
</body>
</html>