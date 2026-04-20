<x-app-layout>

    <div class="card lux-card mt-3">

        <div class="lux-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                📚 Manajemen Koleksi Buku
            </h5>

            <a href="{{ route('buku.create') }}" class="btn lux-btn">
                <i class="fas fa-plus mr-1"></i> Tambah Buku
            </a>
        </div>

        <div class="card-body">

            @if(session('success'))
            <div class="alert alert-success shadow-sm">
                {{ session('success') }}
            </div>
            @endif

            <table class="table lux-table table-hover text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($buku as $b)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td class="text-left font-weight-bold">
                            {{ $b->Judul }}
                        </td>

                        <td>{{ $b->Penulis }}</td>

                        <td>
                            <span class="badge px-3 py-2 
                            {{ $b->Stok > 0 ? 'badge-info' : 'badge-danger' }}">
                                {{ $b->Stok }}
                            </span>
                        </td>

                        <td>
                            <a href="{{ route('buku.edit',$b->BukuID) }}"
                                class="btn btn-warning btn-sm shadow-sm">
                                Edit
                            </a>

                            <form action="{{ route('buku.destroy', $b->BukuID) }}" method="POST" class="d-inline form-konfirmasi" data-pesan="Yakin mau hapus buku {{ $b->Judul }} dari katalog?">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

</x-app-layout>