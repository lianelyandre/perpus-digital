<x-app-layout>

    <style>
        body {
            background: #f4f6fb;
        }

        /* CARD */
        .lux-card {
            border-radius: 18px;
            border: none;
            box-shadow: 0 20px 40px rgba(0, 0, 0, .08);
            overflow: hidden;
        }

        /* HEADER */
        .lux-header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 18px 22px;
        }

        /* TABLE */
        .lux-table thead {
            background: #f8f9fc;
        }

        .lux-table tbody tr:hover {
            background: #f3f6ff;
            transition: .2s;
        }

        /* BADGE MODERN */
        .lux-badge {
            border-radius: 20px;
            padding: 6px 14px;
            font-weight: 600;
            font-size: 12px;
        }

        /* BUTTON MINI */
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

        {{-- HEADER --}}
        <div class="lux-header">
            <h5 class="mb-0">
                📋 Daftar Antrian Peminjaman
            </h5>
        </div>

        {{-- BODY --}}
        <div class="card-body p-0">

            <table class="table lux-table table-hover mb-0 text-center">

                <thead>
                    <tr>
                        <th>Peminjam</th>
                        <th>Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
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

                        <td class="font-weight-semibold">
                            {{ $p->user->nama_lengkap }}
                        </td>

                        <td class="text-left font-weight-bold">
                            {{ $p->buku->Judul }}
                        </td>

                        <td>
                            {{ date('d M Y', strtotime($p->TanggalPeminjaman)) }}
                        </td>

                        <td>
                            {{ date('d M Y', strtotime($p->TanggalPengembalian)) }}
                        </td>

                        {{-- STATUS --}}
                        <td>

                            @if($p->StatusPeminjaman == 'Menunggu')
                            <span class="badge badge-warning lux-badge">
                                Menunggu
                            </span>

                            @elseif($p->StatusPeminjaman == 'Dipinjam')
                            <span class="badge badge-primary lux-badge">
                                Dipinjam
                            </span>

                            @elseif($p->StatusPeminjaman == 'Kembali')
                            <span class="badge badge-success lux-badge">
                                Sudah Kembali
                            </span>

                            @else
                            <span class="badge badge-danger lux-badge">
                                Ditolak
                            </span>
                            @endif

                        </td>


                        {{-- AKSI --}}
                        <td>

                            @if(Auth::user()->role == 'petugas')

                            {{-- MENUNGGU --}}
                            @if($p->StatusPeminjaman == 'Menunggu')

                            <form action="{{ route('pinjam.konfirmasi',$p->PeminjamanID) }}"
                                method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Dipinjam">

                                <button class="btn btn-success lux-btn-sm">
                                    ✔ Setujui
                                </button>
                            </form>


                            <form action="{{ route('pinjam.konfirmasi',$p->PeminjamanID) }}"
                                method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Ditolak">

                                <button class="btn btn-danger lux-btn-sm">
                                    ✖ Tolak
                                </button>
                            </form>


                            {{-- DIPINJAM --}}
                            @elseif($p->StatusPeminjaman == 'Dipinjam')

                            <form action="{{ route('pinjam.konfirmasi',$p->PeminjamanID) }}"
                                method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Kembali">

                                <button class="btn btn-info lux-btn-sm">
                                    📦 Terima Balik
                                </button>
                            </form>

                            @else
                            <span class="text-muted">-</span>
                            @endif

                            @else
                            <span class="text-muted small">
                                <i>No Access</i>
                            </span>
                            @endif

                        </td>

                    </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
    </div>

</x-app-layout>