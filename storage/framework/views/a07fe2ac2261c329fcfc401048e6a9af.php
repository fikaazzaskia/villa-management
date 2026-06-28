<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Data Tamu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/villa-theme.css')); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-people me-2"></i>Data Tamu</h2>
            <a href="/tamu-create" class="btn btn-villa-primary"><i class="bi bi-plus-lg me-1"></i>Tambah Tamu</a>
        </div>

        <?php if(session('success')): ?>
            <div class="alert-villa-success mb-3"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-villa align-middle bg-white rounded shadow-sm">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>No KTP</th>
                        <th>JK</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $tamus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($t->nama); ?></td>
                        <td><?php echo e($t->email); ?></td>
                        <td><?php echo e($t->no_hp); ?></td>
                        <td><?php echo e($t->no_ktp); ?></td>
                        <td><?php echo e($t->jenis_kelamin); ?></td>
                        <td>
                            <a href="/tamu-edit/<?php echo e($t->id); ?>" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                            <button onclick="hapusTamu(<?php echo e($t->id); ?>)" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="6" class="text-center text-muted py-4">Belum ada data tamu.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
    function hapusTamu(id) {
        if (confirm('Yakin ingin menghapus data tamu ini?')) {
            $.ajax({
                url: '/tamu-hapus/' + id,
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function () { location.reload(); },
                error: function () { alert('Gagal menghapus data!'); }
            });
        }
    }
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\villa-management\resources\views/tamu/index.blade.php ENDPATH**/ ?>