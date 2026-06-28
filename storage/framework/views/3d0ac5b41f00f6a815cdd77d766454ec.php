<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Booking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/villa-theme.css')); ?>">
</head>
<body>
    <?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="container py-4">
        <a href="/booking" class="btn btn-outline-secondary mb-3"><i class="bi bi-arrow-left"></i> Kembali</a>

        <div class="form-card">
            <h3 class="mb-4"><i class="bi bi-calendar-plus me-2"></i>Tambah Booking Baru</h3>

            <?php if($errors->any()): ?>
                <div class="alert-villa-danger mb-3">
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="/booking-store" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Pilih Villa</label>
                        <select name="villa_id" class="form-select" required>
                            <option value="">-- Pilih Villa --</option>
                            <?php $__currentLoopData = $villas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($v->id); ?>" <?php echo e((isset($selectedVilla) && $selectedVilla == $v->id) ? 'selected' : ''); ?>>
                                    <?php echo e($v->nama); ?> (Rp <?php echo e(number_format($v->harga_per_malam, 0, ',', '.')); ?>/malam)
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tamu Terdaftar (opsional)</label>
                        <select name="tamu_id" class="form-select">
                            <option value="">-- Tanpa data tamu terdaftar --</option>
                            <?php $__currentLoopData = $tamus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($t->id); ?>"><?php echo e($t->nama); ?> (<?php echo e($t->email); ?>)</option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nama Tamu (pemesan)</label>
                        <input type="text" name="nama_tamu" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jumlah Tamu</label>
                        <input type="number" name="jumlah_tamu" class="form-control" min="1" value="1" required>
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
</html><?php /**PATH C:\xampp\htdocs\villa-management\resources\views/booking/create.blade.php ENDPATH**/ ?>