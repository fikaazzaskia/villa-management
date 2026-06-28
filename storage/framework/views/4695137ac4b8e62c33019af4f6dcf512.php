<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Data Villa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/villa-theme.css')); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-houses me-2"></i>Data Villa</h2>
            <?php if(session('role') == 'admin'): ?>
            <a href="/villa-create" class="btn btn-villa-primary"><i class="bi bi-plus-lg me-1"></i>Tambah Villa</a>
            <?php endif; ?>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-villa-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-villa-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <form action="/villa/cari" method="GET" class="d-flex gap-2 mb-4">
            <input type="text" name="keyword" class="form-control" placeholder="Cari nama villa atau tipe..." value="<?php echo e($keyword ?? ''); ?>" style="max-width:350px;">
            <button type="submit" class="btn btn-villa-secondary"><i class="bi bi-search"></i> Cari</button>
            <a href="/villa" class="btn btn-outline-secondary">Reset</a>
        </form>

        <div class="row g-4">
            <?php $__empty_1 = true; $__currentLoopData = $villas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-6 col-lg-4">
                <div class="villa-card">
                    <?php if($v->foto): ?>
                        <img src="<?php echo e(Storage::url($v->foto)); ?>" class="villa-card-img">
                    <?php else: ?>
                        <div class="villa-card-img d-flex align-items-center justify-content-center bg-light">
                            <i class="bi bi-image text-muted" style="font-size:3rem;"></i>
                        </div>
                    <?php endif; ?>
                    <span class="badge-tipe badge-<?php echo e($v->tipe); ?>"><?php echo e(ucfirst($v->tipe)); ?></span>
                    <div class="villa-card-body">
                        <h5><?php echo e($v->nama); ?></h5>
                        <p class="text-muted small mb-2">
                            <i class="bi bi-people-fill"></i> <?php echo e($v->kapasitas); ?> orang
                            &nbsp;|&nbsp;
                            <span class="<?php echo e($v->tersedia ? 'text-success' : 'text-danger'); ?>">
                                <i class="bi bi-circle-fill" style="font-size:8px;"></i>
                                <?php echo e($v->tersedia ? 'Tersedia' : 'Penuh'); ?>

                            </span>
                        </p>
                        <p class="villa-price">Rp <?php echo e(number_format($v->harga_per_malam, 0, ',', '.')); ?> <small class="text-muted">/malam</small></p>
                        <div class="d-flex gap-2 mt-3">
                            <a href="/villa/<?php echo e($v->id); ?>" class="btn btn-sm btn-villa-secondary flex-fill">Detail</a>
                            <?php if(session('role') == 'admin'): ?>
                            <a href="/villa-edit/<?php echo e($v->id); ?>" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                            <button onclick="hapusVilla(<?php echo e($v->id); ?>)" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12 text-center text-muted py-5">
                <i class="bi bi-inbox" style="font-size:3rem;"></i>
                <p class="mt-2">Belum ada data villa.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function hapusVilla(id) {
        if (confirm('Yakin ingin menghapus villa ini?')) {
            $.ajax({
                url: '/villa-hapus/' + id,
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function () { location.reload(); },
                error: function () { alert('Gagal menghapus villa!'); }
            });
        }
    }
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\villa-management\resources\views/villa/index.blade.php ENDPATH**/ ?>