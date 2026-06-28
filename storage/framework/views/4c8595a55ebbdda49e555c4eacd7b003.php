<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking — <?php echo e($profile->nama); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/villa-theme.css')); ?>">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-villa">
        <div class="container">
            <a class="navbar-brand-villa" href="/"><i class="bi bi-houses-fill me-1"></i> <?php echo e($profile->nama); ?></a>
        </div>
    </nav>

    <div class="container py-5" style="max-width:700px;">
        <a href="/" class="btn btn-outline-secondary mb-3"><i class="bi bi-arrow-left"></i> Kembali</a>

        <div class="form-card">
            <h3 class="mb-1"><i class="bi bi-calendar-check me-2"></i>Form Booking</h3>
            <p class="text-muted">
                <?php echo e($profile->nama); ?> — Rp <?php echo e(number_format($profile->harga_per_malam, 0, ',', '.')); ?>/malam
                &middot; Maks. <?php echo e($profile->kapasitas); ?> orang &middot; <?php echo e($profile->jumlah_kamar_tidur); ?> kamar tidur
            </p>

            <?php if(!$profile->tersedia): ?>
            <div class="alert-villa-danger">Maaf, villa sedang tidak tersedia untuk dibooking saat ini.</div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="alert-villa-danger mb-3">
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="/villa/booking-store" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_tamu" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email_tamu" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Check-in</label>
                        <input type="date" name="tanggal_checkin" class="form-control" min="<?php echo e(date('Y-m-d')); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Check-out</label>
                        <input type="date" name="tanggal_checkout" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jumlah Tamu</label>
                        <input type="number" name="jumlah_tamu" class="form-control" min="1" max="<?php echo e($profile->kapasitas); ?>" value="1" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Catatan (opsional)</label>
                        <textarea name="catatan" class="form-control" rows="2" placeholder="Permintaan khusus, dll"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-villa-primary w-100 mt-4"><i class="bi bi-check-lg me-1"></i>Konfirmasi Booking</button>
            </form>
        </div>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\villa-management\resources\views/public/booking-form.blade.php ENDPATH**/ ?>