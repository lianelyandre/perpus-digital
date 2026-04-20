<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpus Digital | Dashboard</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <style>
        .main-sidebar {
            background-color: #1e293b !important;
        }

        /* Warna Navy Slate Modern */
        .nav-link.active {
            background-color: #3b82f6 !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
        }

        .brand-link {
            border-bottom: 1px solid #334155 !important;
        }

        .user-panel {
            border-bottom: 1px solid #334155 !important;
        }

        body {
            background: #f4f6fb;
        }

        /* CARD LUXURY */
        .lux-card {
            border-radius: 18px;
            border: none;
            box-shadow: 0 20px 40px rgba(0, 0, 0, .08);
            overflow: hidden;
        }

        /* HEADER GRADIENT */
        .lux-header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 18px 22px;
        }

        /* TABLE MODERN */
        .lux-table thead {
            background: #f8f9fc;
        }

        .lux-table tbody tr:hover {
            background: #f3f6ff;
            transition: .2s;
        }

        /* INPUT MODERN */
        .lux-input {
            border-radius: 12px;
            border: 1px solid #e4e7f2;
            padding: 10px 14px;
            transition: .25s;
        }

        .lux-input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, .15);
        }

        /* BUTTON PREMIUM */
        .lux-btn {
            border-radius: 12px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            color: white;
            font-weight: 600;
            padding: 10px 22px;
            transition: .3s;
            box-shadow: 0 8px 18px rgba(118, 75, 162, .25);
        }

        .lux-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(118, 75, 162, .35);
            color: white;
        }

        .lux-card {
            background: white;
            border-radius: 18px;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .lux-header {
            padding: 22px 28px;
            border-bottom: 1px solid #f1f3f6;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .lux-body {
            padding: 28px;
        }

        .text-indigo {
            color: #6366f1;
        }

        .badge-soft {
            background: #eef2ff;
            color: #4f46e5;
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
        }

        .lux-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .lux-table thead th {
            background: #fafafa;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #6b7280;
            padding: 16px 22px;
        }

        .lux-table tbody td {
            padding: 18px 22px;
            border-top: 1px solid #f3f4f6;
        }

        .lux-table tbody tr:hover {
            background: #fafbff;
        }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: white;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .book-title {
            font-weight: 600;
            color: #374151;
        }

        .lux-btn-acc {
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            border: none;
            color: white;
            padding: 8px 18px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 13px;
            box-shadow: 0 6px 18px rgba(79, 70, 229, .25);
            transition: .2s;
        }

        .lux-btn-acc:hover {
            transform: translateY(-2px);
        }

        .empty-state {
            padding: 40px;
            text-align: center;
            color: #9ca3af;
        }

        .empty-state i {
            font-size: 26px;
            margin-bottom: 10px;
        }

        /* ===== GLOBAL LUX SYSTEM ===== */

        .lux-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .06);
            overflow: hidden;
        }

        .lux-header {
            padding: 22px 28px;
            border-bottom: 1px solid #f1f3f6;
            font-weight: 600;
        }

        /* ===== STAT ===== */

        .lux-stat {
            display: flex;
            align-items: center;
            gap: 16px;
            background: white;
            padding: 22px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .05);
        }

        .lux-icon {
            width: 58px;
            height: 58px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 22px;
        }

        .lux-label {
            font-size: 13px;
            color: #9ca3af;
        }

        .lux-value {
            font-size: 26px;
            font-weight: 700;
        }

        /* ===== TABLE ===== */

        .lux-table {
            width: 100%;
        }

        .lux-table thead {
            background: #fafafa;
        }

        .lux-table th {
            padding: 16px 24px;
            font-size: 12px;
            text-transform: uppercase;
            color: #9ca3af;
        }

        .lux-table td {
            padding: 18px 24px;
            border-top: 1px solid #f3f4f6;
        }

        .lux-table tr:hover {
            background: #fafbff;
        }

        /* ===== BADGE ===== */

        .lux-badge {
            padding: 7px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-wait {
            background: #eef2ff;
            color: #4f46e5;
        }

        .badge-active {
            background: #dcfce7;
            color: #15803d;
        }

        /* ===== BUTTON ===== */

        .lux-btn-warning {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            box-shadow: 0 6px 18px rgba(217, 119, 6, .25);
        }

        .lux-btn-warning:hover {
            transform: translateY(-2px);
        }

        .deadline-text {
            font-size: 12px;
            color: #ef4444;
            margin-top: 6px;
        }
    </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom-0 shadow-sm">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('dashboard') }}" class="nav-link font-weight-bold">Home</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama_lengkap) }}&background=3b82f6&color=fff" class="user-image img-circle elevation-2" alt="User Image">
                        <span class="d-none d-md-inline text-dark">{{ Auth::user()->nama_lengkap }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right border-0 shadow">
                        <li class="user-header bg-primary">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama_lengkap) }}&background=fff&color=3b82f6" class="img-circle elevation-2" alt="User Image">
                            <p>
                                {{ Auth::user()->nama_lengkap }}
                                <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-default btn-flat float-right text-danger">
                                    <i class="fas fa-sign-out-alt mr-1"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ route('dashboard') }}" class="brand-link text-center">
                <i class="fas fa-book-reader text-primary mr-2"></i>
                <span class="brand-text font-weight-light font-weight-bold">PERPUS<span class="text-primary">DIGITAL</span></span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama_lengkap) }}&background=random" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->username }}</a>
                        <span class="badge badge-success text-xs">{{ strtoupper(Auth::user()->role) }}</span>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu">

                        <li class="nav-header text-xs text-muted">MAIN NAVIGATION</li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th-large"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        {{-- Menu Khusus Admin & Petugas --}}
                        @if(Auth::user()->role !== 'peminjam')
                        <li class="nav-header text-xs text-muted">MANAGEMENT</li>
                        <li class="nav-item">
                            <a href="{{ route('buku.index') }}" class="nav-link {{ request()->routeIs('buku.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Data Koleksi Buku</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pinjam.index') }}" class="nav-link {{ request()->routeIs('pinjam.index') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-exchange-alt"></i>
                                <p>Transaksi Pinjaman</p>
                            </a>
                        </li>
                        @endif

                        {{-- Menu Khusus Admin --}}
                        @if(Auth::user()->role == 'admin')
                        <li class="nav-header text-xs text-muted">ADMINISTRATOR</li>

                        {{-- 👇 INI TOMBOL YANG HILANG 👇 --}}
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>Kelola User</p>
                            </a>
                        </li>
                        {{-- 👆 SAMPAI SINI 👆 --}}

                        <li class="nav-header text-xs text-muted">REPORTS</li>
                        <li class="nav-item">
                            <a href="{{ route('laporan.index') }}" class="nav-link {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-file-pdf"></i>
                                <p>Laporan PDF</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    {{ $header ?? '' }}
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    @if(isset($slot))
                    {{ $slot }}
                    @else
                    @yield('content')
                    @endif
                </div>
            </section>
        </div>

        <footer class="main-footer text-sm">
            <div class="float-right d-none d-sm-block"><b>UKK</b> 2026</div>
            <strong>Copyright &copy; 2026 <a href="#">Perpus Digital</a>.</strong> All rights reserved.
        </footer>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    {{-- ================= TAMBAHAN SWEETALERT ================= --}}
    {{-- 1. CDN SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- 2. Script Notifikasi Otomatis (Nangkap pesan dari Controller) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // --- ALERT SUKSES ---
            @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{!! session("success") !!}',
                background: '#ffffff',
                color: '#0f172a',
                confirmButtonColor: '#3b82f6',
                timer: 3000,
                timerProgressBar: true,
            });
            @endif

            // --- ALERT ERROR ---
            @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Waduh...',
                text: '{!! session("error") !!}',
                background: '#ffffff',
                color: '#0f172a',
                confirmButtonColor: '#ef4444',
            });
            @endif
        });
    </script>

    {{-- 3. Script Konfirmasi Tombol (Hapus / ACC / Tolak) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cari semua form yang punya class 'form-konfirmasi'
            const forms = document.querySelectorAll('.form-konfirmasi');

            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); // Tahan form agar tidak langsung submit

                    // Ambil pesan dari atribut data-pesan
                    const pesan = this.getAttribute('data-pesan') || 'Apakah Anda yakin ingin melanjutkan aksi ini?';

                    Swal.fire({
                        title: 'Konfirmasi',
                        text: pesan,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3b82f6',
                        cancelButtonColor: '#ef4444',
                        confirmButtonText: 'Ya, Lanjutkan!',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Submit form jika user klik 'Ya'
                        }
                    });
                });
            });
        });
    </script>
    {{-- ================= AKHIR SWEETALERT ================= --}}

</body>

</html>