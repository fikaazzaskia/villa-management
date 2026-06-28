<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Kelola User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/villa-theme.css')); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-person-gear me-2"></i>Kelola User</h2>
            <a href="/user-create" class="btn btn-villa-primary"><i class="bi bi-plus-lg me-1"></i>Tambah Akun</a>
        </div>

        <?php if(session('success')): ?>
            <div class="alert-villa-success mb-3"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-villa align-middle bg-white rounded shadow-sm">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($u->username); ?> <?php if($u->username == session('username')): ?> <span class="badge bg-secondary">Anda</span> <?php endif; ?></td>
                        <td><span class="badge <?php echo e($u->role == 'admin' ? 'bg-dark' : 'bg-secondary'); ?>"><?php echo e(ucfirst($u->role)); ?></span></td>
                        <td><span class="<?php echo e($u->status == 'active' ? 'text-success' : 'text-danger'); ?>"><?php echo e(ucfirst($u->status)); ?></span></td>
                        <td>
                            <a href="/user-edit/<?php echo e($u->username); ?>" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                            <?php if($u->username != session('username')): ?>
                            <button onclick="hapusUser('<?php echo e($u->username); ?>')" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
    function hapusUser(username) {
        if (confirm('Yakin ingin menghapus akun ' + username + '?')) {
            $.ajax({
                url: '/user-hapus/' + username,
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function () { location.reload(); },
                error: function (xhr) { alert(xhr.responseJSON?.error || 'Gagal menghapus akun!'); }
            });
        }
    }
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\villa-management\resources\views/user/index.blade.php ENDPATH**/ ?>