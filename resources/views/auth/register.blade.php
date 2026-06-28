<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi — Villa Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/villa-theme.css') }}">
</head>
<body class="auth-bg d-flex align-items-center justify-content-center min-vh-100">
    <div class="auth-card">
        <div class="text-center mb-4">
            <i class="bi bi-person-plus-fill auth-icon"></i>
            <h3 class="mt-2">Buat Akun Baru</h3>
            <p class="text-muted">Daftar untuk mulai mengelola villa</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/register" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Buat username" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
            </div>
            <button type="submit" class="btn btn-villa-primary w-100 mt-2">
                <i class="bi bi-person-check me-1"></i> Daftar
            </button>
        </form>
        <p class="text-center mt-3 mb-0">Sudah punya akun? <a href="/login" class="text-warning">Login di sini</a></p>
    </div>
</body>
</html>