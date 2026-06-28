<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Villa Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/villa-theme.css')); ?>">
</head>
<body class="auth-bg d-flex align-items-center justify-content-center min-vh-100">
    <div class="auth-card" data-aos="fade-up">
        <div class="text-center mb-4">
            <i class="bi bi-houses-fill auth-icon"></i>
            <h3 class="mt-2">Villa Management</h3>
            <p class="text-muted">Masuk untuk mengelola villa anda</p>
        </div>

        <?php if(session('error')): ?>
            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <form action="/login" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn btn-villa-primary w-100 mt-2">
                <i class="bi bi-box-arrow-in-right me-1"></i> Login
            </button>
        </form>
        <p class="text-center mt-3 mb-0">Belum punya akun? <a href="/register" class="text-warning">Daftar di sini</a></p>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\villa-management\resources\views/auth/login.blade.php ENDPATH**/ ?>