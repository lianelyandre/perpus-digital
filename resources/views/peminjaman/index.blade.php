<x-app-layout>
    <style>
        body {
            background: #f4f6fb;
        }

        .lux-card {
            border-radius: 18px;
            border: none;
            box-shadow: 0 20px 40px rgba(0, 0, 0, .08);
            overflow: hidden;
        }

        .lux-header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 18px 22px;
        }

        .lux-table thead {
            background: #f8f9fc;
        }

        .lux-table tbody tr:hover {
            background: #f3f6ff;
            transition: .2s;
        }

        .lux-badge {
            border-radius: 20px;
            padding: 6px 14px;
            font-weight: 600;
            font-size: 12px;
        }

        .lux-btn-sm {
            border-radius: 10px;
            padding: 4px 10px;
            font-size: 12px;
            font-weight: 600;
            border: none;
            transition: .25s;
        }

        .lux-btn-sm:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(0, 0, 0, .15);
        }
    </style>

    <div class="card lux-card mt-3">
        <div class="lux-header">
            <h5 class="mb-0">📋 Daftar Antrian Peminjaman</h5>
        </div>

        <div class="card-body p-0">
            <table class="table lux-table table-hover mb-0 text-center">
                <thead>
                    <tr>
                        <th>Peminjam</th>
                        <th>Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                        <th>Denda (Rp 1.000/Hari)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $semuaPinjaman = \App\Models\Peminjaman::with(['user','buku'])
                    ->orderBy('created_at','desc')
                    ->get();
                    @endphp

                    @foreach($semuaPinjaman as $p)
                    <tr>
                        <td class="font-weight-semibold align-middle">
                            {{ $p->user->nama_lengkap ?? 'User tidak ditemukan' }}
                        </td>

                        <td class="text-left font-weight-bold align-middle">
                            {{ $p->buku->Judul ?? '-' }}
                        </td>

                        <td class="align-middle">
                            {{ date('d M Y', strtotime($p->TanggalPeminjaman)) }}
                        </td>

                        <td class="align-middle">
                            {{ date('d M Y', strtotime($p->TanggalPengembalian)) }}
                        </td>

                        <td class="align-middle">
                            @if($p->StatusPeminjaman == 'Menunggu')
                            <span class="badge badge-warning lux-badge">Menunggu</span>
                            @elseif($p->StatusPeminjaman == 'Dipinjam')
                            <span class="badge badge-primary lux-badge">Dipinjam</span>
                            @elseif($p->StatusPeminjaman == 'Kembali')
                            <span class="badge badge-success lux-badge">Sudah Kembali</span>
                            @else
                            <span class="badge badge-danger lux-badge">Ditolak</span>
                            @endif
                        </td>

                        {{-- REVISI KOLOM DENDA OTOMATIS --}}
                        <td class="align-middle">
                            @php
                            $dendaDisplay = 0;
                            $isLate = false;

                            // Jika sudah kembali, ambil denda yang tersimpan di DB
                            if($p->StatusPeminjaman == 'Kembali') {
                            $dendaDisplay = $p->Denda;
                            }
                            // Jika masih dipinjam, hitung denda berjalan (Real-time)
                            elseif($p->StatusPeminjaman == 'Dipinjam') {
                            $deadline = strtotime($p->TanggalPengembalian . ' 00:00:00');
                            $sekarang = strtotime(date('Y-m-d') . ' 00:00:00');

                            if($sekarang > $deadline) {
                            $selisih = $sekarang - $deadline;
                            $hari = floor($selisih / (60 * 60 * 24));
                            $dendaDisplay = $hari * 1000;
                            $isLate = true;
                            }
                            }
                            @endphp

                            @if($dendaDisplay > 0)
                            <span class="badge badge-danger lux-badge shadow-sm" style="background-color: #ef4444; color: white;">
                                Rp {{ number_format($dendaDisplay, 0, ',', '.') }}
                                @if($isLate) <small class="d-block">(Berjalan)</small> @endif
                            </span>
                            @elseif($p->StatusPeminjaman == 'Kembali' && $dendaDisplay == 0)
                            <span class="badge badge-success lux-badge" style="background-color: #10b981; color: white;">
                                Lunas/Aman
                            </span>
                            @else
                            <span class="text-muted font-weight-bold">-</span>
                            @endif
                        </td>

                        <td class="align-middle">
                            @if(Auth::user()->role == 'petugas')
                            @if($p->StatusPeminjaman == 'Menunggu')
                            <form action="{{ route('pinjam.konfirmasi',$p->id) }}" method="POST" class="d-inline">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="Dipinjam">
                                <button type="submit" class="btn btn-success lux-btn-sm">✔ ACC</button>
                            </form>

                            <form action="{{ route('pinjam.konfirmasi',$p->id) }}" method="POST" class="d-inline">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="Ditolak">
                                <button type="submit" class="btn btn-danger lux-btn-sm">✖ Tolak</button>
                            </form>

                            @elseif($p->StatusPeminjaman == 'Dipinjam')
                            <form action="{{ route('pinjam.kembalikan',$p->id) }}" method="POST" class="d-inline">
                                @csrf @method('PUT')
                                <button type="submit" class="btn btn-info lux-btn-sm text-white">📦 Balik</button>
                            </form>
                            @else
                            <span class="text-muted small">Selesai</span>
                            @endif
                            @else
                            <span class="text-muted small"><i>Admin Mode</i></span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>