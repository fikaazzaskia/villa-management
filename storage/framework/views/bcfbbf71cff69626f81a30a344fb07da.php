<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Berhasil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/villa-theme.css')); ?>">
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100" style="background: linear-gradient(135deg, var(--wild-berry), var(--soft-rose));">
    <div class="auth-card text-center">
        <i class="bi bi-check-circle-fill" style="font-size:4rem; color:#1f6b3f;"></i>
        <h3 class="mt-3">Booking Berhasil!</h3>
        <p class="text-muted">Terima kasih, booking anda sudah kami terima dan sedang menunggu konfirmasi.</p>

        <div class="text-start mt-4 p-3" style="background: var(--powder-grey); border-radius: 12px;">
            <p class="mb-1"><strong>Nama:</strong> <?php echo e($booking->nama_tamu); ?></p>
            <p class="mb-1"><strong>Check-in:</strong> <?php echo e(\Carbon\Carbon::parse($booking->tanggal_checkin)->format('d M Y')); ?></p>
            <p class="mb-1"><strong>Check-out:</strong> <?php echo e(\Carbon\Carbon::parse($booking->tanggal_checkout)->format('d M Y')); ?></p>
            <p class="mb-0"><strong>Status:</strong> <span class="badge-status status-pending">Pending</span></p>
        </div>

        <a href="/" class="btn btn-villa-primary w-100 mt-4">Kembali ke Home</a>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\villa-management\resources\views/public/booking-sukses.blade.php ENDPATH**/ ?>