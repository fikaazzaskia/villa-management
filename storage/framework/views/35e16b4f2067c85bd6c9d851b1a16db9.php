<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catat Pembayaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/villa-theme.css')); ?>">
</head>
<body>
    <?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="container py-4">
        <a href="/pembayaran" class="btn btn-outline-secondary mb-3"><i class="bi bi-arrow-left"></i> Kembali</a>

        <div class="form-card">
            <h3 class="mb-4"><i class="bi bi-credit-card-2-front me-2"></i>Catat Pembayaran</h3>

            <?php if($errors->any()): ?>
                <div class="alert-villa-danger mb-3">
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="/pembayaran-store" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Pilih Booking</label>
                        <select name="booking_id" class="form-select" required>
                            <option value="">-- Pilih Booking --</option>
                            <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($b->id); ?>"><?php echo e($b->nama_tamu); ?> (<?php echo e($b->tanggal_checkin); ?> - <?php echo e($b->tanggal_checkout); ?>)</option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jumlah (Rp)</label>
                        <input type="number" name="jumlah" class="form-control" min="0" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Metode Pembayaran</label>
                        <select name="metode" class="form-select" required>
                            <option value="transfer">Transfer Bank</option>
                            <option value="cash">Cash</option>
                            <option value="qris">QRIS</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Bukti Bayar (opsional)</label>
                        <input type="file" name="bukti_bayar" class="form-control" accept="image/*">
                    </div>
                </div>
                <button type="submit" class="btn btn-villa-primary mt-4"><i class="bi bi-check-lg me-1"></i>Simpan</button>
            </form>
        </div>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\villa-management\resources\views/pembayaran/create.blade.php ENDPATH**/ ?>