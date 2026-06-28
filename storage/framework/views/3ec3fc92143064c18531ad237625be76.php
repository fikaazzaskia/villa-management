<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Data Pembayaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/villa-theme.css')); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-credit-card me-2"></i>Data Pembayaran</h2>
            <a href="/pembayaran-create" class="btn btn-villa-primary"><i class="bi bi-plus-lg me-1"></i>Catat Pembayaran</a>
        </div>

        <?php if(session('success')): ?>
            <div class="alert-villa-success mb-3"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

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
                    <?php $__empty_1 = true; $__currentLoopData = $pembayarans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($p->nama_tamu); ?></td>
                        <td>Rp <?php echo e(number_format($p->jumlah, 0, ',', '.')); ?></td>
                        <td><?php echo e(ucfirst($p->metode)); ?></td>
                        <td><span class="badge-status status-<?php echo e($p->status == 'lunas' ? 'konfirmasi' : ($p->status == 'gagal' ? 'batal' : 'pending')); ?>"><?php echo e(ucfirst($p->status)); ?></span></td>
                        <td>
                            <?php if($p->bukti_bayar): ?>
                                <a href="<?php echo e(Storage::url($p->bukti_bayar)); ?>" target="_blank"><img src="<?php echo e(Storage::url($p->bukti_bayar)); ?>" width="50" class="rounded"></a>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="/pembayaran-edit/<?php echo e($p->id); ?>" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                            <button onclick="hapusPembayaran(<?php echo e($p->id); ?>)" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="6" class="text-center text-muted py-4">Belum ada data pembayaran.</td></tr>
                    <?php endif; ?>
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
</html><?php /**PATH C:\xampp\htdocs\villa-management\resources\views/pembayaran/index.blade.php ENDPATH**/ ?>