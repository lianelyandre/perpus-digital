{{-- resources/views/dashboards/admin.blade.php --}}
<div class="container-fluid py-4" style="background: #f8fafc; min-height: 100vh;">
    <div class="d-flex align-items-center mb-4">
        <div class="bg-primary rounded-lg p-2 mr-3 shadow-sm">
            <i class="fas fa-chart-line text-white"></i>
        </div>
        <h4 class="font-weight-bold mb-0 text-dark">Dashboard Management</h4>
    </div>

    {{-- STATISTIK UTAMA --}}
    <div class="row mb-4">
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="lux-stat shadow-sm border-0 animate-up">
                <div class="lux-icon-wrapper bg-soft-primary">
                    <i class="fas fa-book text-primary"></i>
                </div>
                <div>
                    <small class="text-uppercase letter-spacing-1 font-weight-bold text-muted">Total Koleksi</small>
                    <div class="h3 font-weight-bold mb-0 text-dark">{{ \App\Models\Buku::count() }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="lux-stat shadow-sm border-0 animate-up">
                <div class="lux-icon-wrapper bg-soft-success">
                    <i class="fas fa-exchange-alt text-success"></i>
                </div>
                <div>
                    <small class="text-uppercase letter-spacing-1 font-weight-bold text-muted">Sedang Dipinjam</small>
                    <div class="h3 font-weight-bold mb-0 text-dark">{{ \App\Models\Peminjaman::where('StatusPeminjaman', 'Dipinjam')->count() }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 mb-3">
            <div class="lux-stat shadow-sm border-0 animate-up">
                <div class="lux-icon-wrapper bg-soft-warning">
                    <i class="fas fa-users text-warning"></i>
                </div>
                <div>
                    <small class="text-uppercase letter-spacing-1 font-weight-bold text-muted">Total Member</small>
                    <div class="h3 font-weight-bold mb-0 text-dark">{{ \App\Models\User::where('role', 'peminjam')->count() }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- TABEL MONITORING PINJAMAN --}}
    <div class="lux-card shadow-lg border-0 overflow-hidden">
        <div class="lux-header d-flex justify-content-between align-items-center bg-white border-bottom py-3 px-4">
            <div>
                <h5 class="mb-0 font-weight-bold text-dark">Monitoring Antrean Pinjaman</h5>
                <p class="text-muted small mb-0">Memantau permintaan buku yang masuk ke petugas</p>
            </div>
            <span class="badge badge-soft-warning px-3 py-2 font-weight-bold" style="border-radius:8px">
                <i class="fas fa-lock mr-1"></i> Otoritas Petugas
            </span>
        </div>
        <div class="table-responsive">
            <table class="table lux-table mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3 border-0 text-center">Peminjam</th>
                        <th class="py-3 border-0">Judul Buku</th>
                        <th class="py-3 border-0 text-center">Status & Log</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $listAcc = \App\Models\Peminjaman::where('StatusPeminjaman','Menunggu')
                    ->with(['user','buku'])->latest()->get();
                    @endphp
                    @forelse($listAcc as $p)
                    <tr class="lux-tr">
                        <td class="align-middle text-center px-4">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="avatar-circle mr-3">
                                    {{ strtoupper(substr($p->user->username ?? 'U', 0, 1)) }}
                                </div>
                                <div class="text-left">
                                    <span class="font-weight-bold d-block text-dark">{{ $p->user->username ?? 'User' }}</span>
                                    <small class="text-muted">Member Perpustakaan</small>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-bookmark text-muted mr-2"></i>
                                <span class="text-dark font-weight-500">{{ $p->buku->Judul ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="align-middle text-center">
                            <div class="badge-status-container">
                                <span class="badge-glow-warning">
                                    <i class="fas fa-shield-alt mr-1"></i> Menunggu Petugas
                                </span>
                                <small class="d-block text-muted mt-2 font-italic">Read-only mode for Admin</small>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-5 text-center">
                            <div class="empty-state">
                                <div class="empty-icon-circle mx-auto mb-3">
                                    <i class="fas fa-check text-success fa-2x"></i>
                                </div>
                                <h6 class="font-weight-bold text-dark">Data Bersih!</h6>
                                <p class="text-muted small">Tidak ada antrean pinjaman yang perlu dipantau.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    /* Global Helpers */
    .letter-spacing-1 {
        letter-spacing: 0.5px;
    }

    .font-weight-500 {
        font-weight: 500;
    }

    /* Animation */
    .animate-up {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .animate-up:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    /* Stat Cards */
    .lux-stat {
        background: #fff;
        padding: 25px;
        border-radius: 20px;
        display: flex;
        align-items: center;
    }

    .lux-icon-wrapper {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
        font-size: 24px;
    }

    /* Soft Colors */
    .bg-soft-primary {
        background: #eef2ff;
    }

    .bg-soft-success {
        background: #ecfdf5;
    }

    .bg-soft-warning {
        background: #fffbeb;
    }

    .badge-soft-warning {
        background: #fff3cd;
        color: #856404;
        border: 1px solid #ffeeba;
    }

    /* Table & Rows */
    .lux-card {
        background: #fff;
        border-radius: 20px;
    }

    .lux-tr {
        transition: background 0.2s ease;
    }

    .lux-tr:hover {
        background: #fcfcfd;
    }

    /* Avatar */
    .avatar-circle {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 8px rgba(118, 75, 162, 0.2);
    }

    /* Status Badge Glow */
    .badge-glow-warning {
        background: #fff8e1;
        color: #ff8f00;
        border-radius: 30px;
        padding: 8px 16px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        border: 1px solid #ffe082;
        display: inline-block;
        box-shadow: 0 0 10px rgba(255, 143, 0, 0.1);
    }

    /* Empty State */
    .empty-icon-circle {
        width: 70px;
        height: 70px;
        background: #f0fdf4;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>