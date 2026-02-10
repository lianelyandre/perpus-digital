<x-app-layout>
    <div class="card shadow-sm">
        <div class="card-header bg-navy">
            <h3 class="card-title">Manajemen Koleksi Buku</h3>
            <div class="card-tools">
                <a href="{{ route('buku.create') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus mr-1"></i> Tambah Buku
                </a>
            </div>
        </div>

        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible shadow-sm">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                {{ session('success') }}
            </div>
            @endif

            <table class="table table-hover table-bordered text-center">
                <thead class="bg-light">
                    <tr>
                        <th style="width: 50px">No</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th style="width: 100px">Stok</th>
                        <th style="width: 200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($buku as $b)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-left font-weight-bold">{{ $b->Judul }}</td>
                        <td>{{ $b->Penulis }}</td>
                        <td>
                            <span class="badge {{ $b->Stok > 0 ? 'badge-info' : 'badge-danger' }}">
                                {{ $b->Stok }}
                            </span>
                        </td>
                        <td>
                            {{-- Tombol Edit --}}
                            <a href="{{ route('buku.edit', $b->BukuID) }}" class="btn btn-warning btn-sm shadow-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            {{-- Tombol Hapus --}}
                            <form action="{{ route('buku.destroy', $b->BukuID) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm shadow-sm" onclick="return confirm('Yakin ingin menghapus buku {{ $b->Judul }}?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>