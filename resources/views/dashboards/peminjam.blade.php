{{-- resources/views/dashboards/peminjam.blade.php --}}
<div class="container-fluid py-4">

    {{-- 1. NOTIFIKASI ALERT --}}
    <div id="alert-container">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 12px;">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle mr-3 fa-lg"></i>
                <div>
                    <strong class="d-block">Berhasil!</strong>
                    {{ session('success') }}
                </div>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 12px;">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-triangle mr-3 fa-lg"></i>
                <div>
                    <strong class="d-block">Waduh!</strong>
                    {{ session('error') }}
                </div>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </div>

    <h4 class="font-weight-bold mb-4">👋 Halo, {{ Auth::user()->username }}!</h4>

    {{-- 2. STATS PRIBADI --}}
    <div class="row mb-4 text-center">
        @php
        $uid = Auth::id();
        // Menggunakan 'user_id' agar sinkron dengan foreign key di DB
        $menunggu = \App\Models\Peminjaman::where('user_id', $uid)->where('StatusPeminjaman','Menunggu')->count();
        $dipinjam = \App\Models\Peminjaman::where('user_id', $uid)->where('StatusPeminjaman','Dipinjam')->count();
        @endphp
        <div class="col-6">
            <div class="lux-stat border-0 shadow-sm">
                <div class="lux-icon bg-info"><i class="fas fa-hourglass-half"></i></div>
                <div class="text-left">
                    <small class="text-muted">Menunggu ACC</small>
                    <div class="h5 font-weight-bold mb-0 text-dark">{{ $menunggu }}</div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="lux-stat border-0 shadow-sm">
                <div class="lux-icon bg-success"><i class="fas fa-book-reader"></i></div>
                <div class="text-left">
                    <small class="text-muted">Sedang Dipinjam</small>
                    <div class="h5 font-weight-bold mb-0 text-dark">{{ $dipinjam }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- 3. AKTIVITAS PINJAMAN SAYA --}}
    <div class="lux-card border-0 shadow-sm mb-5">
        <div class="lux-header bg-dark d-flex justify-content-between align-items-center">
            <h6 class="mb-0 font-weight-bold text-white"><i class="fas fa-layer-group mr-2 text-warning"></i> Aktivitas Pinjaman Saya</h6>
            @php
            $myLoan = \App\Models\Peminjaman::where('user_id', $uid)
            ->whereIn('StatusPeminjaman', ['Menunggu', 'Dipinjam'])
            ->with('buku')->latest()->get();
            $myLoanCount = $myLoan->count();
            @endphp
            <span class="badge badge-warning text-dark">{{ $myLoanCount }} Total</span>
        </div>
        <div class="table-responsive">
            <table class="table lux-table mb-0 text-center">
                <thead>
                    <tr>
                        <th class="border-0">Buku</th>
                        <th class="border-0">Jumlah</th>
                        <th class="border-0">Denda</th>
                        <th class="border-0">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($myLoan as $ml)
                    <tr>
                        <td class="align-middle font-weight-bold text-dark text-left">
                            <div class="d-flex align-items-center">
                                <div class="bg-light p-2 rounded mr-3"><i class="fas fa-book text-primary"></i></div>
                                {{ $ml->buku->Judul ?? 'Buku Dihapus' }}
                            </div>
                        </td>
                        <td class="align-middle"><span class="badge badge-primary px-3 py-2">{{ $ml->jumlah }} Eks</span></td>
                        <td class="align-middle">
                            @php
                            // 1. Ambil tanggal dari database
                            $tgl_dead = $ml->TanggalPengembalian;
                            $denda_final = 0;
                            $hari_telat = 0;

                            if ($tgl_dead) {
                            // 2. Hitung pake PHP murni biar gak bentrok sama namespace Carbon
                            $deadline_timestamp = strtotime($tgl_dead . ' 00:00:00');
                            $sekarang_timestamp = strtotime(date('Y-m-d') . ' 00:00:00');

                            if ($sekarang_timestamp > $deadline_timestamp) {
                            $selisih_detik = $sekarang_timestamp - $deadline_timestamp;
                            $hari_telat = floor($selisih_detik / (60 * 60 * 24)); // Konversi ke hari
                            $denda_final = $hari_telat * 1000;
                            }
                            }
                            @endphp

                            @if($denda_final > 0)
                            <div class="text-center">
                                <span class="badge badge-danger px-3 py-2 shadow-sm" style="border-radius: 8px;">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    Rp {{ number_format($denda_final, 0, ',', '.') }}
                                </span>
                                <small class="d-block text-danger font-weight-bold mt-1">Telat {{ $hari_telat }} Hari</small>
                            </div>
                            @else
                            <span class="badge badge-light text-success border px-3 py-2" style="border-radius: 8px;">
                                <i class="fas fa-check-circle mr-1"></i> Aman
                            </span>
                            @endif
                        </td>
                        <td class="align-middle">
                            @if($ml->StatusPeminjaman == 'Dipinjam')
                            <form action="{{ route('pinjam.kembalikan', $ml->id) }}" method="POST" onsubmit="return confirm('Yakin mau balikin buku bray?')">
                                @csrf @method('PUT')
                                <button class="btn btn-warning btn-sm shadow-sm font-weight-bold px-3" style="border-radius:8px">
                                    <i class="fas fa-undo mr-1"></i> Kembalikan
                                </button>
                            </form>
                            @else
                            <span class="badge badge-light text-muted p-2 border"><i class="fas fa-clock mr-1"></i> Menunggu ACC</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-5 text-muted">
                            <i class="fas fa-folder-open fa-3x mb-3 d-block opacity-50"></i>
                            Belum ada aktivitas pinjaman bray.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- 4. KATALOG BUKU --}}
    <h5 class="font-weight-bold mb-4"><i class="fas fa-book-open text-primary mr-2"></i> Pilih Buku Baru</h5>
    <div class="row">
        @foreach(\App\Models\Buku::all() as $b)
        <div class="col-md-3 mb-4">
            <div class="card h-100 border-0 shadow-sm book-card {{ $b->Stok <= 0 ? 'stock-empty' : '' }}"
                style="border-radius:15px; overflow: hidden;">

                <div class="card-body text-center d-flex flex-column">
                    <div class="my-3 icon-container">
                        <i class="fas fa-book fa-3x {{ $b->Stok <= 0 ? 'text-muted' : 'text-primary' }}"></i>
                    </div>
                    <h6 class="font-weight-bold text-dark mb-1">{{ $b->Judul }}</h6>
                    <small class="text-muted mb-3 d-block text-truncate">{{ $b->Penulis }}</small>

                    <div class="mt-auto pt-3">
                        @if($b->Stok > 0)
                        <form action="{{ route('pinjam.store') }}" method="POST" class="loan-form">
                            @csrf
                            <input type="hidden" name="BukuID" value="{{ $b->BukuID }}">

                            <div class="form-group mb-3 px-2">
                                <label class="small font-weight-bold text-muted mb-1">Jumlah Pinjam:</label>
                                <div class="input-group input-group-sm mx-auto shadow-none" style="max-width: 110px;">
                                    <input type="number" name="jumlah" value="1" min="1" max="{{ $b->Stok }}"
                                        class="form-control text-center qty-input"
                                        style="border-radius: 8px 0 0 8px; border: 1px solid #eee;">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-light text-muted small" style="border-radius: 0 8px 8px 0; border: 1px solid #eee; border-left:0;">
                                            /{{ $b->Stok }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block shadow-sm py-2" style="border-radius:10px; font-weight:bold;">
                                <i class="fas fa-plus-circle mr-1"></i> Pinjam Sekarang
                            </button>
                        </form>
                        @else
                        <div class="px-2">
                            <div class="alert alert-secondary py-2 mb-2 border-0" style="border-radius: 10px; font-size: 11px;">
                                <i class="fas fa-times-circle mr-1 text-danger"></i> Stok Habis di Rak
                            </div>
                            <button class="btn btn-light btn-block disabled text-muted mb-2" style="border-radius:10px; cursor: not-allowed; border: 1px dashed #ccc;">
                                Buku Kosong
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- CSS --}}
<style>
    .book-card {
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }

    .book-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
        border-color: rgba(0, 123, 255, 0.2);
    }

    .stock-empty {
        background-color: #f8f9fa;
        filter: grayscale(0.8);
        opacity: 0.8;
    }

    .lux-stat {
        padding: 1.25rem;
        border-radius: 18px;
        display: flex;
        align-items: center;
        background: #fff;
        transition: 0.3s;
    }

    .lux-stat:hover {
        transform: scale(1.02);
    }

    .lux-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: white;
        margin-right: 1rem;
    }

    .lux-card {
        border-radius: 20px;
        overflow: hidden;
        background: #fff;
    }

    .lux-header {
        padding: 1rem 1.5rem;
    }

    .lux-table thead th {
        background: #f8f9fa;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 1px;
        color: #777;
    }
</style>

{{-- JS --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            $('.alert').fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 5000);

        const qtyInputs = document.querySelectorAll('.qty-input');
        qtyInputs.forEach(input => {
            input.addEventListener('change', function() {
                const max = parseInt(this.getAttribute('max'));
                const val = parseInt(this.value);
                if (val > max) {
                    this.value = max;
                    alert('Maaf bray, stok cuma tersedia ' + max + ' buku.');
                } else if (val < 1 || isNaN(val)) {
                    this.value = 1;
                }
            });
        });
    });
</script>