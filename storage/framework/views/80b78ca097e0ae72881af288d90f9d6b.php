<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri — Villa Serenity</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/villa-theme.css')); ?>">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-villa">
        <div class="container">
            <a class="navbar-brand-villa" href="/"><i class="bi bi-houses-fill me-1"></i> Villa Serenity</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto gap-1">
                    <li class="nav-item"><a class="nav-link nav-link-villa" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-villa active" href="/villa/galeri">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-villa" href="/villa/kamar">Kamar</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <h2 class="text-center mb-4"><i class="bi bi-images me-2"></i>Galeri Villa</h2>

        <div class="row g-3">
            <?php $__empty_1 = true; $__currentLoopData = $galeris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-4">
                <div class="gallery-thumb" style="height:260px;">
                    <?php if($g->tipe == 'foto'): ?>
                        <img src="<?php echo e(Storage::url($g->file)); ?>" class="gallery-img">
                    <?php else: ?>
                        <video class="gallery-img" controls>
                            <source src="<?php echo e(Storage::url($g->file)); ?>">
                        </video>
                    <?php endif; ?>
                </div>
                <?php if($g->judul): ?>
                <p class="text-center small text-muted mt-1 mb-0"><?php echo e($g->judul); ?></p>
                <?php endif; ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12 text-center text-muted py-5">Belum ada media di galeri.</div>
            <?php endif; ?>
        </div>
    </div>

    <footer class="footer-villa">
        <div class="container"><p class="mb-0">Villa Serenity &copy; <?php echo e(date('Y')); ?></p></div>
    </footer>
</body>
</html><?php /**PATH C:\xampp\htdocs\villa-management\resources\views/public/galeri.blade.php ENDPATH**/ ?>