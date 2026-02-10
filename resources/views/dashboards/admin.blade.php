{{-- resources/views/dashboards/admin.blade.php --}}

<style>
    .dashboard-card {
        transition: all 0.25s ease;
        border-radius: 12px;
        overflow: hidden;
    }

    .dashboard-card:hover {
        transform: translateY(-4px) scale(1.01);
        box-shadow: 0 12px 25px rgba(0,0,0,0.15);
    }

    .dashboard-card .icon {
        opacity: 0.25;
        font-size: 70px;
    }

    .dashboard-link {
        text-decoration: none !important;
        color: inherit;
    }
</style>

<div class="row">

    {{-- Total Buku --}}
    <div class="col-lg-4 col-6">
        <a href="{{ route('buku.index') }}" class="dashboard-link">
            <div class="small-box bg-info shadow-sm dashboard-card">
                <div class="inner">
                    <h3>{{ \App\Models\Buku::count() }}</h3>
                    <p>Total Koleksi Buku</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
            </div>
        </a>
    </div>

    {{-- Buku Dipinjam --}}
    <div class="col-lg-4 col-6">
        <a href="{{ route('pinjam.index') }}" class="dashboard-link">
            <div class="small-box bg-success shadow-sm dashboard-card">
                <div class="inner">
                    <h3>{{ \App\Models\Peminjaman::where('StatusPeminjaman', 'Dipinjam')->count() }}</h3>
                    <p>Buku Sedang Dipinjam</p>
                </div>
                <div class="icon">
                    <i class="fas fa-exchange-alt"></i>
                </div>
            </div>
        </a>
    </div>

    {{-- Member --}}
    <div class="col-lg-4 col-12">
        <a href="{{ route('user.index') }}" class="dashboard-link">
            <div class="small-box bg-warning shadow-sm dashboard-card">
                <div class="inner text-white">
                    <h3>{{ \App\Models\User::where('role', 'peminjam')->count() }}</h3>
                    <p>Total Member</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </a>
    </div>

</div>


{{-- Monitoring Table --}}
<div class="card shadow-sm mt-4 border-0" style="border-radius:12px;">
    <div class="card-header bg-white border-0">
        <h5 class="font-weight-bold mb-0">
            <i class="fas fa-chart-line text-primary mr-2"></i>
            Monitor Aktivitas Peminjaman
        </h5>
    </div>

    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="bg-light">
                <tr>
                    <th>Peminjam</th>
                    <th>Judul Buku</th>
                    <th>Status</th>
                    <th>Tgl Pinjam</th>
                </tr>
            </thead>
            <tbody>
                @php
                $monitor = \App\Models\Peminjaman::with(['user','buku'])->latest()->take(10)->get();
                @endphp

                @forelse($monitor as $m)
                <tr>
                    <td>{{ $m->user->username }}</td>
                    <td>{{ $m->buku->Judul }}</td>
                    <td>
                        <span class="badge 
                        {{ $m->StatusPeminjaman == 'Dipinjam' ? 'badge-success' : 
                           ($m->StatusPeminjaman == 'Menunggu' ? 'badge-info' : 'badge-secondary') }}">
                            {{ $m->StatusPeminjaman }}
                        </span>
                    </td>
                    <td>{{ date('d/m/Y', strtotime($m->TanggalPeminjaman)) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-3 text-muted">
                        Belum ada aktivitas.
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>

    <div class="card-footer bg-white text-center border-0">
        <a href="{{ route('pinjam.index') }}" class="font-weight-bold text-primary">
            Lihat Semua Laporan →
        </a>
    </div>
</div>
