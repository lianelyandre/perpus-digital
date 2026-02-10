{{-- ================= ELEGANT BORROWER DASHBOARD ================= --}}

{{-- ================= 1. STATISTIC CARDS ================= --}}
<div class="row mb-4">

    @php
    $menunggu = \App\Models\Peminjaman::where('id', Auth::id())->where('StatusPeminjaman', 'Menunggu')->count();
    $dipinjam = \App\Models\Peminjaman::where('id', Auth::id())->where('StatusPeminjaman', 'Dipinjam')->count();
    $total = \App\Models\Peminjaman::where('id', Auth::id())->count();
    @endphp

    <div class="col-md-4">
        <div class="card stat-card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box bg-info">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <div class="ml-3">
                    <p class="stat-label">Menunggu ACC</p>
                    <h3 class="stat-value">{{ $menunggu }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card stat-card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box bg-success">
                    <i class="fas fa-book-reader"></i>
                </div>
                <div class="ml-3">
                    <p class="stat-label">Sedang Dipinjam</p>
                    <h3 class="stat-value">{{ $dipinjam }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card stat-card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box bg-dark">
                    <i class="fas fa-history"></i>
                </div>
                <div class="ml-3">
                    <p class="stat-label">Total Pernah Pinjam</p>
                    <h3 class="stat-value">{{ $total }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ================= 2. MY LOAN ACTIVITY ================= --}}

@php
$myBooks = \App\Models\Peminjaman::where('id', Auth::id())
->whereIn('StatusPeminjaman', ['Menunggu', 'Dipinjam'])
->with('buku')
->latest()
->get();
@endphp

@if($myBooks->count() > 0)
<div class="card elegant-table border-0 shadow-sm mb-5">
    <div class="card-header bg-gradient-dark text-white">
        <h6 class="mb-0 font-weight-bold">
            <i class="fas fa-layer-group mr-2 text-warning"></i>
            Aktivitas Pinjaman Saya
        </h6>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead>
                <tr>
                    <th>Buku</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($myBooks as $mb)
                <tr>
                    <td>
                        <div class="font-weight-bold text-dark">
                            {{ $mb->buku->Judul }}
                        </div>
                        <small class="text-muted">
                            ID: #{{ $mb->PeminjamanID }}
                        </small>
                    </td>

                    <td class="text-center">
                        <span class="badge badge-pill px-3 py-2
                            {{ $mb->StatusPeminjaman == 'Menunggu' ? 'badge-info' : 'badge-primary' }}">
                            {{ $mb->StatusPeminjaman }}
                        </span>
                    </td>

                    <td class="text-center">
                        @if($mb->StatusPeminjaman == 'Dipinjam')
                        <form action="{{ route('pinjam.konfirmasi', $mb->PeminjamanID) }}" method="POST" class="d-inline">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="Kembali">

                            <button class="btn btn-warning btn-sm font-weight-bold px-3">
                                <i class="fas fa-undo-alt mr-1"></i> Kembalikan
                            </button>
                        </form>

                        <div class="deadline-text">
                            Deadline: {{ date('d M Y', strtotime($mb->TanggalPengembalian)) }}
                        </div>
                        @else
                        <span class="text-muted small">
                            <i class="fas fa-clock mr-1"></i>
                            Menunggu Persetujuan
                        </span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

{{-- ================= 3. BOOK CATALOG ================= --}}

<h4 class="section-title">
    <i class="fas fa-book-open mr-2 text-primary"></i>
    Katalog Koleksi
</h4>

<div class="row">

    @foreach(\App\Models\Buku::with(['ulasanbuku.user'])->get() as $b)

    @php $avgRating = $b->ulasanbuku->avg('Rating'); @endphp

    <div class="col-lg-3 col-md-4 mb-4">
        <div class="card book-card border-0 shadow-sm h-100">

            <div class="card-body d-flex flex-column">

                <div class="d-flex justify-content-between mb-2">
                    <span class="badge badge-light border">
                        {{ $b->TahunTerbit }}
                    </span>

                    <span class="rating">
                        ⭐ {{ $avgRating ? number_format($avgRating,1) : '0' }}
                    </span>
                </div>

                <h6 class="book-title">
                    {{ Str::limit($b->Judul, 45) }}
                </h6>

                <p class="book-author">
                    {{ $b->Penulis }}
                </p>

                {{-- Review Preview --}}
                <div class="review-box mb-3">
                    <b class="small text-primary">Review Pembaca</b>

                    <div class="review-scroll">
                        @forelse($b->ulasanbuku->take(2) as $u)
                        <div class="review-item">
                            <b>{{ $u->user->username }}</b>
                            <span>"{{ Str::limit($u->Ulasan, 30) }}"</span>
                        </div>
                        @empty
                        <small class="text-muted">Belum ada review</small>
                        @endforelse
                    </div>
                </div>

                <div class="mt-auto">
                    <div class="stock-box">
                        Stok:
                        <b class="{{ $b->Stok > 0 ? 'text-success' : 'text-danger' }}">
                            {{ $b->Stok }} Eks
                        </b>
                    </div>

                    @if($b->Stok > 0)
                    <button class="btn btn-primary btn-block btn-sm font-weight-bold"
                        data-toggle="modal"
                        data-target="#modalPinjam{{ $b->BukuID }}">
                        Pinjam Sekarang
                    </button>
                    @else
                    <button class="btn btn-secondary btn-block btn-sm" disabled>
                        Stok Habis
                    </button>
                    @endif
                </div>
            </div>

            <div class="card-footer bg-white border-0">
                <form action="{{ route('ulasan.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="BukuID" value="{{ $b->BukuID }}">

                    <div class="input-group input-group-sm">
                        <select name="Rating" class="custom-select border-primary" style="max-width:70px">
                            <option value="5">5★</option>
                            <option value="4">4★</option>
                            <option value="3">3★</option>
                        </select>

                        <input type="text"
                            name="Ulasan"
                            class="form-control border-primary"
                            placeholder="Tulis review..."
                            required>

                        <div class="input-group-append">
                            <button class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    @include('peminjaman.modal_pinjam', ['book' => $b])

    @endforeach
</div>

{{-- ================= STYLES ================= --}}
<style>
    .section-title {
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 25px;
    }

    .stat-card {
        border-radius: 18px;
    }

    .icon-box {
        width: 55px;
        height: 55px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 20px;
    }

    .stat-label {
        font-size: 13px;
        color: #888;
        margin-bottom: 3px;
    }

    .stat-value {
        font-weight: 700;
    }

    .bg-gradient-dark {
        background: linear-gradient(45deg, #111, #333);
    }

    .elegant-table thead {
        background: #f7f7f7;
        font-size: 13px;
        letter-spacing: .5px;
    }

    .deadline-text {
        font-size: 12px;
        color: #dc3545;
        font-weight: 600;
    }

    .book-card {
        border-radius: 18px;
        transition: all .3s ease;
    }

    .book-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, .08);
    }

    .book-title {
        font-weight: 600;
        color: #222;
        min-height: 48px;
    }

    .book-author {
        font-size: 13px;
        color: #888;
    }

    .rating {
        font-size: 14px;
        font-weight: 600;
        color: #ffb400;
    }

    .review-box {
        background: #fafafa;
        border-radius: 10px;
        padding: 8px;
    }

    .review-scroll {
        max-height: 55px;
        overflow: auto;
    }

    .review-item {
        font-size: 12px;
        border-bottom: 1px solid #eee;
        margin-bottom: 4px;
    }

    .stock-box {
        font-size: 13px;
        margin-bottom: 10px;
    }
</style>