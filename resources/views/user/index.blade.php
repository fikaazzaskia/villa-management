<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kelola User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/villa-theme.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    @include('partials.navbar')

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-person-gear me-2"></i>Kelola Staff</h2>
            <a href="/user-create" class="btn btn-villa-primary"><i class="bi bi-plus-lg me-1"></i>Tambah Staff</a>
        </div>

        @if(session('success'))
            <div class="alert-villa-success mb-3">{{ session('success') }}</div>
        @endif

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
                    @foreach($users as $u)
                    <tr>
                        <td>{{ $u->username }} @if($u->username == session('username')) <span class="badge bg-secondary">Anda</span> @endif</td>
                        <td><span class="badge {{ $u->role == 'admin' ? 'bg-dark' : 'bg-secondary' }}">{{ ucfirst($u->role) }}</span></td>
                        <td><span class="{{ $u->status == 'active' ? 'text-success' : 'text-danger' }}">{{ ucfirst($u->status) }}</span></td>
                        <td>
                            <a href="/user-edit/{{ $u->username }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                            @if($u->username != session('username'))
                            <button onclick="hapusUser('{{ $u->username }}')" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
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
</html>