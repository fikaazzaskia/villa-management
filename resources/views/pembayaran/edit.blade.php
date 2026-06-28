<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pembayaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/villa-theme.css') }}">
</head>
<body>
    @include('partials.navbar')

    <div class="container py-4">
        <a href="/pembayaran" class="btn btn-outline-secondary mb-3"><i class="bi bi-arrow-left"></i> Kembali</a>

        <div class="form-card">
            <h3 class="mb-4"><i class="bi bi-pencil-square me-2"></i>Edit Pembayaran</h3>

            <form action="/pembayaran-update/{{ $pembayaran->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Booking</label>
                        <select name="booking_id" class="form-select" required>
                            @foreach($bookings as $b)
                                <option value="{{ $b->id }}" {{ $pembayaran->booking_id == $b->id ? 'selected' : '' }}>{{ $b->nama_tamu }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jumlah (Rp)</label>
                        <input type="number" name="jumlah" class="form-control" value="{{ $pembayaran->jumlah }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Metode</label>
                        <select name="metode" class="form-select" required>
                            <option value="transfer" {{ $pembayaran->metode == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                            <option value="cash" {{ $pembayaran->metode == 'cash' ? 'selected' : '' }}>Cash</option>
                            <option value="qris" {{ $pembayaran->metode == 'qris' ? 'selected' : '' }}>QRIS</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="pending" {{ $pembayaran->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="lunas" {{ $pembayaran->status == 'lunas' ? 'selected' : '' }}>Lunas</option>
                            <option value="gagal" {{ $pembayaran->status == 'gagal' ? 'selected' : '' }}>Gagal</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Ganti Bukti Bayar (opsional)</label>
                        <input type="file" name="bukti_bayar" class="form-control" accept="image/*">
                        @if($pembayaran->bukti_bayar)
                            <img src="{{ Storage::url($pembayaran->bukti_bayar) }}" width="100" class="rounded mt-2">
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-villa-primary mt-4"><i class="bi bi-check-lg me-1"></i>Update</button>
            </form>
        </div>
    </div>
</body>
</html>
