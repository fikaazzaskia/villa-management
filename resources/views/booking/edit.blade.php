<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/villa-theme.css') }}">
</head>
<body>
    @include('partials.navbar')

    <div class="container py-4">
        <a href="/booking" class="btn btn-outline-secondary mb-3"><i class="bi bi-arrow-left"></i> Kembali</a>

        <div class="form-card">
            <h3 class="mb-4"><i class="bi bi-pencil-square me-2"></i>Edit Booking</h3>

            <form action="/booking-update/{{ $booking->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Tamu Terdaftar</label>
                        <select name="tamu_id" class="form-select">
                            <option value="">-- Tanpa data tamu terdaftar --</option>
                            @foreach($tamus as $t)
                                <option value="{{ $t->id }}" {{ $booking->tamu_id == $t->id ? 'selected' : '' }}>{{ $t->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jumlah Tamu</label>
                        <input type="number" name="jumlah_tamu" class="form-control" min="1" value="{{ $booking->jumlah_tamu }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nama Tamu (pemesan)</label>
                        <input type="text" name="nama_tamu" class="form-control" value="{{ $booking->nama_tamu }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email Tamu</label>
                        <input type="email" name="email_tamu" class="form-control" value="{{ $booking->email_tamu }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tanggal Check-in</label>
                        <input type="date" name="tanggal_checkin" class="form-control" value="{{ $booking->tanggal_checkin }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Check-out</label>
                        <input type="date" name="tanggal_checkout" class="form-control" value="{{ $booking->tanggal_checkout }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="konfirmasi" {{ $booking->status == 'konfirmasi' ? 'selected' : '' }}>Konfirmasi</option>
                            <option value="selesai" {{ $booking->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="batal" {{ $booking->status == 'batal' ? 'selected' : '' }}>Batal</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Catatan</label>
                        <textarea name="catatan" class="form-control" rows="2">{{ $booking->catatan }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-villa-primary mt-4"><i class="bi bi-check-lg me-1"></i>Update</button>
            </form>
        </div>
    </div>
</body>
</html>