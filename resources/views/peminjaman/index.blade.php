<x-app-layout>
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">Daftar Antrian Peminjaman</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
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
                    $semuaPinjaman = \App\Models\Peminjaman::with(['user', 'buku'])->orderBy('created_at', 'desc')->get();
                    @endphp
                    @foreach($semuaPinjaman as $p)
                    <tr>
                        <td>{{ $p->user->nama_lengkap }}</td>
                        <td>{{ $p->buku->Judul }}</td>
                        <td>{{ $p->TanggalPeminjaman }}</td>
                        <td>{{ $p->TanggalPengembalian }}</td>
                        <td>
                            @if($p->StatusPeminjaman == 'Menunggu')
                            <span class="badge badge-warning shadow-sm">Menunggu</span>
                            @elseif($p->StatusPeminjaman == 'Dipinjam')
                            <span class="badge badge-primary shadow-sm">Dipinjam</span>
                            @elseif($p->StatusPeminjaman == 'Kembali')
                            <span class="badge badge-success shadow-sm">Sudah Balik</span>
                            @else
                            <span class="badge badge-danger shadow-sm">Ditolak</span>
                            @endif
                        </td>
                        <td>
                            {{-- KUNCINYA DI SINI: Cek apakah yang login Petugas --}}
                            @if(Auth::user()->role == 'petugas')
                            @if($p->StatusPeminjaman == 'Menunggu')
                            <form action="{{ route('pinjam.konfirmasi', $p->PeminjamanID) }}" method="POST" style="display:inline">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="Dipinjam">
                                <button type="submit" class="btn btn-xs btn-success font-weight-bold">Setujui</button>
                            </form>
                            <form action="{{ route('pinjam.konfirmasi', $p->PeminjamanID) }}" method="POST" style="display:inline">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="Ditolak">
                                <button type="submit" class="btn btn-xs btn-danger font-weight-bold">Tolak</button>
                            </form>
                            @elseif($p->StatusPeminjaman == 'Dipinjam')
                            <form action="{{ route('pinjam.konfirmasi', $p->PeminjamanID) }}" method="POST" style="display:inline">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="Kembali">
                                <button type="submit" class="btn btn-xs btn-info font-weight-bold">Terima Balik Buku</button>
                            </form>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                            @else
                            {{-- Jika Admin atau Peminjam yang lihat halaman ini --}}
                            <span class="text-muted small"><i>No Access</i></span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>