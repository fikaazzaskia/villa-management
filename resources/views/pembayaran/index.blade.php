<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Pembayaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/villa-theme.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    @include('partials.navbar')

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-credit-card me-2"></i>Data Pembayaran</h2>
            <a href="/pembayaran-create" class="btn btn-villa-primary"><i class="bi bi-plus-lg me-1"></i>Catat Pembayaran</a>
        </div>

        @if(session('success'))
            <div class="alert-villa-success mb-3">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-villa align-middle bg-white rounded shadow-sm">
                <thead>
                    <tr>
                        <th>Nama Tamu</th>
                        <th>Jumlah</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Bukti</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayarans as $p)
                    <tr>
                        <td>{{ $p->nama_tamu }}</td>
                        <td>Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
                        <td>{{ ucfirst($p->metode) }}</td>
                        <td><span class="badge-status status-{{ $p->status == 'lunas' ? 'konfirmasi' : ($p->status == 'gagal' ? 'batal' : 'pending') }}">{{ ucfirst($p->status) }}</span></td>
                        <td>
                            @if($p->bukti_bayar)
                                <a href="{{ Storage::url($p->bukti_bayar) }}" target="_blank"><img src="{{ Storage::url($p->bukti_bayar) }}" width="50" class="rounded"></a>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <a href="/pembayaran-edit/{{ $p->id }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                            <button onclick="hapusPembayaran({{ $p->id }})" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">Belum ada data pembayaran.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
    function hapusPembayaran(id) {
        if (confirm('Yakin ingin menghapus pembayaran ini?')) {
            $.ajax({
                url: '/pembayaran-hapus/' + id,
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function () { location.reload(); },
                error: function () { alert('Gagal menghapus!'); }
            });
        }
    }
    </script>
</body>
</html>