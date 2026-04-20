{{-- resources/views/dashboards/admin.blade.php --}}
<div class="container-fluid py-4">
    <h4 class="font-weight-bold mb-4">🏠 Dashboard Management</h4>

    {{-- STATISTIK UTAMA --}}
    <div class="row mb-4">
        <div class="col-lg-4 col-6">
            <div class="lux-stat shadow-sm border-0">
                <div class="lux-icon bg-primary"><i class="fas fa-book"></i></div>
                <div>
                    <small class="text-muted">Total Koleksi</small>
                    <div class="h4 font-weight-bold mb-0 text-dark">{{ \App\Models\Buku::count() }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="lux-stat shadow-sm border-0">
                <div class="lux-icon bg-success"><i class="fas fa-exchange-alt"></i></div>
                <div>
                    <small class="text-muted">Sedang Dipinjam</small>
                    <div class="h4 font-weight-bold mb-0 text-dark">{{ \App\Models\Peminjaman::where('StatusPeminjaman', 'Dipinjam')->count() }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12 mt-lg-0 mt-3">
            <div class="lux-stat shadow-sm border-0">
                <div class="lux-icon bg-warning text-white"><i class="fas fa-users"></i></div>
                <div>
                    <small class="text-muted">Total Member</small>
                    <div class="h4 font-weight-bold mb-0 text-dark">{{ \App\Models\User::where('role', 'peminjam')->count() }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- TABEL KONFIRMASI PINJAMAN (ACC) --}}
    <div class="lux-card shadow-sm border-0">
        <div class="lux-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0 font-weight-bold"><i class="fas fa-check-circle mr-2"></i> Konfirmasi Pinjaman</h5>
            <span class="badge badge-light px-3 py-2 text-primary" style="border-radius:10px">Pending ACC</span>
        </div>
        <div class="table-responsive">
            <table class="table lux-table mb-0 text-center">
                <thead>
                    <tr>
                        <th class="border-0">Peminjam</th>
                        <th class="border-0">Judul Buku</th>
                        <th class="border-0">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $listAcc = \App\Models\Peminjaman::where('StatusPeminjaman','Menunggu')
                    ->with(['user','buku'])->latest()->get();
                    @endphp
                    @forelse($listAcc as $p)
                    <tr>
                        <td class="align-middle">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="bg-light rounded-circle mr-2 d-flex align-items-center justify-content-center" style="width:35px; height:35px; font-weight:bold; color:#4e54c8">
                                    {{ strtoupper(substr($p->user->username ?? 'U', 0, 1)) }}
                                </div>
                                <span>{{ $p->user->username ?? 'User' }}</span>
                            </div>
                        </td>
                        <td class="align-middle font-weight-bold text-dark">{{ $p->buku->Judul ?? '-' }}</td>
                        <td class="align-middle">
                            <form action="{{ route('pinjam.acc', $p->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">Setujui</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-5 text-muted">
                            <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                            Tidak ada antrean ACC saat ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>