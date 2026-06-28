<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Villa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/villa-theme.css') }}">
</head>
<body>
    @include('partials.navbar')

    <div class="container py-4">
        <div class="form-card">
            <h3 class="mb-4"><i class="bi bi-info-circle me-2"></i>Profil Villa</h3>

            @if(session('success'))
                <div class="alert-villa-success mb-3">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert-villa-danger mb-3">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @php
                $fasilitasArr = ($profile && $profile->fasilitas_umum) ? explode(', ', $profile->fasilitas_umum) : [];
            @endphp

            <form action="/profile-update" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label">Nama Villa</label>
                        <input type="text" name="nama" class="form-control" value="{{ $profile->nama ?? '' }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">No. Telepon</label>
                        <input type="text" name="no_telp" class="form-control" value="{{ $profile->no_telp ?? '' }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3">{{ $profile->deskripsi ?? '' }}</textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="2">{{ $profile->alamat ?? '' }}</textarea>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Harga per Malam (Rp)</label>
                        <input type="number" name="harga_per_malam" class="form-control" min="0" value="{{ $profile->harga_per_malam ?? 0 }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Kapasitas Maks. (orang)</label>
                        <input type="number" name="kapasitas" class="form-control" min="1" value="{{ $profile->kapasitas ?? 1 }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Jumlah Kamar Tidur</label>
                        <input type="number" name="jumlah_kamar_tidur" class="form-control" min="1" value="{{ $profile->jumlah_kamar_tidur ?? 1 }}" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Fasilitas Umum</label>
                        <div class="d-flex flex-wrap gap-3">
                            @foreach(['WiFi','Kolam Renang','AC','Dapur Lengkap','Parkir Luas','Smart TV','Kamar Mandi Dalam','BBQ Area','Taman','Sound System','Water Heater','Mesin Cuci'] as $f)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="fasilitas_umum[]" value="{{ $f }}" id="f_{{ Str::slug($f) }}" {{ in_array($f, $fasilitasArr) ? 'checked' : '' }}>
                                <label class="form-check-label" for="f_{{ Str::slug($f) }}">{{ $f }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Foto Utama Villa</label>
                        <input type="file" name="foto_utama" class="form-control" accept="image/*">
                        @if($profile && $profile->foto_utama)
                            <img src="{{ Storage::url($profile->foto_utama) }}" width="150" class="rounded mt-2">
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label class="form-label d-block">Status Ketersediaan</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" name="tersedia" id="tersedia" {{ ($profile->tersedia ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="tersedia">Villa tersedia untuk dibooking</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-villa-primary mt-4"><i class="bi bi-check-lg me-1"></i>Simpan Profil</button>
            </form>
        </div>
    </div>
</body>
</html>