<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Booking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/villa-theme.css') }}">
</head>
<body>
    @include('partials.navbar')

    <div class="container py-4">
        <a href="/booking" class="btn btn-outline-secondary mb-3"><i class="bi bi-arrow-left"></i> Kembali</a>

        <div class="form-card">
            <h3 class="mb-4"><i class="bi bi-calendar-plus me-2"></i>Tambah Booking Baru</h3>

            @if($errors->any())
                <div class="alert-villa-danger mb-3">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/booking-store" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Tamu Terdaftar (opsional)</label>
                        <select name="tamu_id" class="form-select">
                            <option value="">-- Tanpa data tamu terdaftar --</option>
                            @foreach($tamus as $t)
                                <option value="{{ $t->id }}">{{ $t->nama }} ({{ $t->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jumlah Tamu</label>
                        <input type="number" name="jumlah_tamu" class="form-control" min="1" value="1" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nama Tamu (pemesan)</label>
                        <input type="text" name="nama_tamu" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email Tamu</label>
                        <input type="email" name="email_tamu" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tanggal Check-in</label>
                        <input type="date" name="tanggal_checkin" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Check-out</label>
                        <input type="date" name="tanggal_checkout" class="form-control" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Catatan (opsional)</label>
                        <textarea name="catatan" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-villa-primary mt-4"><i class="bi bi-check-lg me-1"></i>Buat Booking</button>
            </form>
        </div>
    </div>
</body>
</html>