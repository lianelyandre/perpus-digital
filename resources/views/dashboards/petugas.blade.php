<div class="lux-card mt-4">

    {{-- HEADER --}}
    <div class="lux-header">
        <h5>
            <i class="fas fa-check-circle mr-2 text-indigo"></i>
            Konfirmasi Pinjaman (ACC)
        </h5>

        <span class="badge badge-soft">
            Pending ACC
        </span>
    </div>

    {{-- BODY --}}
    <div class="lux-body p-0">

        <table class="lux-table">
            <thead>
                <tr>
                    <th>Peminjam</th>
                    <th>Buku</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @php
                $listAcc = \App\Models\Peminjaman::where('StatusPeminjaman','Menunggu')
                ->with(['user','buku'])->get();
                @endphp

                @forelse($listAcc as $p)

                <tr>
                    <td>
                        <div class="user-cell">
                            <div class="user-avatar">
                                {{ strtoupper(substr($p->user->username,0,1)) }}
                            </div>
                            <span>{{ $p->user->username }}</span>
                        </div>
                    </td>

                    <td>
                        <span class="book-title">
                            {{ $p->buku->Judul }}
                        </span>
                    </td>

                    <td class="text-center">

                        <form action="{{ route('pinjam.acc',$p->PeminjamanID) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <button class="lux-btn-acc">
                                <i class="fas fa-check mr-1"></i>
                                ACC Sekarang
                            </button>
                        </form>

                    </td>
                </tr>

                @empty

                <tr>
                    <td colspan="3">
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <p>Tidak ada antrean ACC</p>
                        </div>
                    </td>
                </tr>

                @endforelse

            </tbody>
        </table>

    </div>
</div>
