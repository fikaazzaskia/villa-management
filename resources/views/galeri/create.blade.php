<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Media Galeri</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/villa-theme.css') }}">
</head>
<body>
    @include('partials.navbar')

    <div class="container py-4">
        <a href="/galeri" class="btn btn-outline-secondary mb-3"><i class="bi bi-arrow-left"></i> Kembali</a>

        <div class="form-card">
            <h3 class="mb-4"><i class="bi bi-plus-circle me-2"></i>Tambah Media Galeri</h3>

            @if($errors->any())
                <div class="alert-villa-danger mb-3">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/galeri-store" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label">Judul (opsional)</label>
                        <input type="text" name="judul" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tipe</label>
                        <select name="tipe" class="form-select" required>
                            <option value="foto">Foto</option>
                            <option value="video">Video</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Upload File</label>
                        <input type="file" name="file" class="form-control" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-villa-primary mt-4"><i class="bi bi-upload me-1"></i>Upload</button>
            </form>
        </div>
    </div>
</body>
</html>