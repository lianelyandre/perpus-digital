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
</body>

</html>