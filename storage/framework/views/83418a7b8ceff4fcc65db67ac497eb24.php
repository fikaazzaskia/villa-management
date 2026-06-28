<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($profile->nama ?? 'Villa Serenity'); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/villa-theme.css')); ?>">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-villa">
        <div class="container">
            <a class="navbar-brand-villa" href="/"><i class="bi bi-houses-fill me-1"></i> <?php echo e($profile->nama ?? 'Villa Serenity'); ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navPublic">
                <i class="bi bi-list text-white" style="font-size:1.5rem;"></i>
            </button>
            <div class="collapse navbar-collapse" id="navPublic">
                <ul class="navbar-nav ms-auto gap-1">
                    <li class="nav-item"><a class="nav-link nav-link-villa" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-villa" href="/villa/galeri">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-villa" href="#fasilitas">Fasilitas</a></li>
                    <li class="nav-item"><a class="btn btn-villa-accent btn-sm px-3 ms-2" href="/villa/booking"><i class="bi bi-calendar-check me-1"></i>Booking Sekarang</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-villa ms-2" href="/login"><i class="bi bi-box-arrow-in-right"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section text-center" style="padding: 5rem 0 7rem;">
        <div class="container" data-aos="fade-up">
            <h1 class="hero-title display-4"><?php echo e($profile->nama ?? 'Villa Serenity'); ?></h1>
            <p class="hero-subtitle lead"><?php echo e($profile->deskripsi ?? 'Pengalaman menginap mewah dengan pemandangan alam yang menenangkan.'); ?></p>
            <?php if($profile): ?>
            <div class="d-flex justify-content-center gap-4 mt-4 text-white flex-wrap">
                <span><i class="bi bi-people-fill me-1"></i> <?php echo e($profile->kapasitas); ?> orang</span>
                <span><i class="bi bi-door-closed-fill me-1"></i> <?php echo e($profile->jumlah_kamar_tidur); ?> kamar tidur</span>
                <span><i class="bi bi-tag-fill me-1"></i> Rp <?php echo e(number_format($profile->harga_per_malam, 0, ',', '.')); ?>/malam</span>
            </div>
            <?php endif; ?>
            <a href="/villa/booking" class="btn btn-villa-accent mt-4"><i class="bi bi-calendar-check me-1"></i> Booking Sekarang</a>
        </div>
    </section>

    <?php if($profile && $profile->foto_utama): ?>
    <div class="container" style="margin-top:-60px; position:relative; z-index:10;">
        <div class="detail-card" data-aos="zoom-in">
            <img src="<?php echo e(Storage::url($profile->foto_utama)); ?>" class="w-100" style="max-height:480px; object-fit:cover;">
        </div>
    </div>
    <?php endif; ?>

    <?php if($galeris->count() > 0): ?>
    <div class="container py-5">
        <h2 class="text-center mb-2" data-aos="fade-up">Galeri Villa</h2>
        <p class="text-center text-muted mb-4" data-aos="fade-up">Suasana dan fasilitas yang akan anda nikmati</p>
        <div class="row g-3">
            <?php $__currentLoopData = $galeris->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="<?php echo e($i * 100); ?>">
                <div class="gallery-thumb">
                    <?php if($g->tipe == 'foto'): ?>
                        <img src="<?php echo e(Storage::url($g->file)); ?>" class="gallery-img">
                    <?php else: ?>
                        <video class="gallery-img" muted></video>
                        <i class="bi bi-play-circle-fill gallery-play-icon"></i>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="text-center mt-3">
            <a href="/villa/galeri" class="btn btn-villa-secondary">Lihat Semua Galeri <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>
    <?php endif; ?>

    <?php if($profile && $profile->fasilitas_umum): ?>
    <div class="container py-4" id="fasilitas">
        <div class="glass-panel p-4 text-center" data-aos="fade-up">
            <h4 class="mb-3"><i class="bi bi-stars me-2"></i>Fasilitas</h4>
            <div class="d-flex justify-content-center flex-wrap gap-2">
                <?php $__currentLoopData = explode(', ', $profile->fasilitas_umum); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="badge-fasilitas"><i class="bi bi-check-circle"></i> <?php echo e($f); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="container py-5 text-center" data-aos="fade-up">
        <div class="form-card" style="max-width:600px; margin:0 auto;">
            <h4 class="mb-2">Siap untuk Liburan?</h4>
            <p class="text-muted">Booking sekarang dan nikmati pengalaman menginap terbaik di <?php echo e($profile->nama ?? 'villa kami'); ?>.</p>
            <a href="/villa/booking" class="btn btn-villa-primary w-100"><i class="bi bi-calendar-check me-1"></i> Booking Sekarang</a>
        </div>
    </div>

    <footer class="footer-villa">
        <div class="container">
            <p class="mb-1"><?php echo e($profile->alamat ?? ''); ?></p>
            <p class="mb-1"><?php echo e($profile->no_telp ?? ''); ?></p>
            <p class="mb-0"><?php echo e($profile->nama ?? 'Villa Serenity'); ?> &copy; <?php echo e(date('Y')); ?></p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ once: true });</script>
</body>
</html><?php /**PATH C:\xampp\htdocs\villa-management\resources\views/public/home.blade.php ENDPATH**/ ?>