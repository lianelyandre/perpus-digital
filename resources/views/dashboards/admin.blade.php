{{-- resources/views/dashboards/admin.blade.php --}}
<div class="row">
    {{-- Widget Statistik --}}
    <div class="col-lg-4 col-6">
        <div class="small-box bg-info shadow-sm">
            <div class="inner">
                <h3>{{ \App\Models\Buku::count() }}</h3>
                <p>Total Koleksi Buku</p>
            </div>
            <div class="icon"><i class="fas fa-book"></i></div>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <div class="small-box bg-success shadow-sm">
            <div class="inner">
                <h3>{{ \App\Models\Peminjaman::where('StatusPeminjaman', 'Dipinjam')->count() }}</h3>
                <p>Buku Sedang Dipinjam</p>
            </div>
            <div class="icon"><i class="fas fa-exchange-alt"></i></div>
        </div>
    </div>
    <div class="col-lg-4 col-12">
        <div class="small-box bg-warning shadow-sm">
            <div class="inner text-white">
                <h3>{{ \App\Models\User::where('role', 'peminjam')->count() }}</h3>
                <p>Total Member</p>
            </div>
            <div class="icon"><i class="fas fa-users"></i></div>
        </div>
    </div>
</div>

{{-- Tabel Monitoring (Hanya Lihat, Tanpa Aksi ACC) --}}
<div class="card shadow-sm mt-3">
    <div class="card-header bg-white">
        <h5 class="card-title font-weight-bold mb-0">Monitor Aktivitas Peminjaman</h5>
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
                $monitor = \App\Models\Peminjaman::with(['user', 'buku'])->latest()->take(10)->get();
                @endphp
                @forelse($monitor as $m)
                <tr>
                    <td>{{ $m->user->username }}</td>
                    <td>{{ $m->buku->Judul }}</td>
                    <td>
                        <span class="badge {{ $m->StatusPeminjaman == 'Dipinjam' ? 'badge-success' : ($m->StatusPeminjaman == 'Menunggu' ? 'badge-info' : 'badge-secondary') }}">
                            {{ $m->StatusPeminjaman }}
                        </span>
                    </td>
                    <td>{{ date('d/m/Y', strtotime($m->TanggalPeminjaman)) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-3">Belum ada aktivitas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white text-center">
        <a href="{{ route('pinjam.index') }}" class="small font-weight-bold text-primary text-uppercase">Lihat Semua Laporan</a>
    </div>
</div>