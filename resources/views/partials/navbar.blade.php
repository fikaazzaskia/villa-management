<nav class="navbar navbar-expand-lg navbar-villa">
    <div class="container">
        <a class="navbar-brand-villa" href="/dashboard">
            <i class="bi bi-houses-fill me-1"></i> Villa Management
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <i class="bi bi-list text-white" style="font-size:1.5rem;"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center gap-1">
                <li class="nav-item"><a class="nav-link nav-link-villa {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard"><i class="bi bi-grid-1x2 me-1"></i>Dashboard</a></li>
                <li class="nav-item"><a class="nav-link nav-link-villa {{ request()->is('booking*') ? 'active' : '' }}" href="/booking"><i class="bi bi-calendar-check me-1"></i>Booking</a></li>
                <li class="nav-item"><a class="nav-link nav-link-villa {{ request()->is('tamu*') ? 'active' : '' }}" href="/tamu"><i class="bi bi-people me-1"></i>Tamu</a></li>
                <li class="nav-item"><a class="nav-link nav-link-villa {{ request()->is('pembayaran*') ? 'active' : '' }}" href="/pembayaran"><i class="bi bi-credit-card me-1"></i>Pembayaran</a></li>
                @if(session('role') == 'admin')
                <li class="nav-item"><a class="nav-link nav-link-villa {{ request()->is('galeri*') ? 'active' : '' }}" href="/galeri"><i class="bi bi-images me-1"></i>Galeri</a></li>
                <li class="nav-item"><a class="nav-link nav-link-villa {{ request()->is('profile*') ? 'active' : '' }}" href="/profile"><i class="bi bi-info-circle me-1"></i>Profil Villa</a></li>
                <li class="nav-item"><a class="nav-link nav-link-villa {{ request()->is('user*') ? 'active' : '' }}" href="/user"><i class="bi bi-person-gear me-1"></i>Kelola Staff</a></li>
                @endif
                <li class="nav-item"><a class="nav-link nav-link-villa" href="/" target="_blank"><i class="bi bi-globe me-1"></i>Lihat Web Publik</a></li>
                <li class="nav-item ms-2">
                    <span class="text-white small me-2"><i class="bi bi-person-circle me-1"></i>{{ session('username') }} <span class="badge bg-light text-dark">{{ session('role') }}</span></span>
                    <a class="btn btn-villa-accent btn-sm px-3" href="/logout"><i class="bi bi-box-arrow-right me-1"></i>Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>