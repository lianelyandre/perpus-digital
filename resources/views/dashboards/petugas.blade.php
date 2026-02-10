<div class="card card-primary card-outline shadow">
    <div class="card-header">
        <h5 class="m-0 font-weight-bold">Konfirmasi Pinjaman (ACC)</h5>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>Peminjam</th>
                    <th>Buku</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $listAcc = \App\Models\Peminjaman::where('StatusPeminjaman', 'Menunggu')->with(['user', 'buku'])->get(); @endphp
                @forelse($listAcc as $p)
                <tr>
                    <td>{{ $p->user->username }}</td>
                    <td>{{ $p->buku->Judul }}</td>
                    <td>
                        <form action="{{ route('pinjam.acc', $p->PeminjamanID) }}" method="POST">
                            @csrf @method('PUT')
                            <button class="btn btn-primary btn-sm">ACC SEKARANG</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-3">Tidak ada antrean ACC.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>