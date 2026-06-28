<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Data Booking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/villa-theme.css')); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-calendar-check me-2"></i>Data Booking</h2>
            <a href="/booking-create" class="btn btn-villa-primary"><i class="bi bi-plus-lg me-1"></i>Tambah Booking</a>
        </div>

        <?php if(session('success')): ?>
            <div class="alert-villa-success mb-3"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-villa align-middle bg-white rounded shadow-sm">
                <thead>
                    <tr>
                        <th>Nama Tamu</th>
                        <th>Email</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Jml Tamu</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($b->nama_tamu); ?></td>
                        <td><?php echo e($b->email_tamu); ?></td>
                        <td><?php echo e(\Carbon\Carbon::parse($b->tanggal_checkin)->format('d M Y')); ?></td>
                        <td><?php echo e(\Carbon\Carbon::parse($b->tanggal_checkout)->format('d M Y')); ?></td>
                        <td><?php echo e($b->jumlah_tamu); ?></td>
                        <td>
                            <span class="badge-status status-<?php echo e($b->status); ?>"><?php echo e(ucfirst($b->status)); ?></span>
                        </td>
                        <td>
                            <a href="/booking-edit/<?php echo e($b->id); ?>" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                            <button onclick="hapusBooking(<?php echo e($b->id); ?>)" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="7" class="text-center text-muted py-4">Belum ada data booking.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
    function hapusBooking(id) {
        if (confirm('Yakin ingin menghapus booking ini?')) {
            $.ajax({
                url: '/booking-hapus/' + id,
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function () { location.reload(); },
                error: function () { alert('Gagal menghapus booking!'); }
            });
        }
    }
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\villa-management\resources\views/booking/index.blade.php ENDPATH**/ ?>