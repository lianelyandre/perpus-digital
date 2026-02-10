<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Data Buku: {{ $buku->Judul }}
        </h2>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-warning shadow">
                <div class="card-header">
                    <h3 class="card-title text-white"><i class="fas fa-edit mr-2"></i> Form Perubahan Data</h3>
                </div>

                <form action="{{ route('buku.update', $buku->BukuID) }}" method="POST">
                    @csrf
                    @method('PUT') {{-- PENTING: Untuk update harus pakai method PUT --}}

                    <div class="card-body">
                        <div class="form-group">
                            <label>Judul Buku</label>
                            <input type="text" name="Judul" class="form-control" value="{{ $buku->Judul }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Penulis</label>
                                    <input type="text" name="Penulis" class="form-control" value="{{ $buku->Penulis }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Penerbit</label>
                                    <input type="text" name="Penerbit" class="form-control" value="{{ $buku->Penerbit }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tahun Terbit</label>
                                    <input type="number" name="TahunTerbit" class="form-control" value="{{ $buku->TahunTerbit }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Stok Tersedia</label>
                                    <input type="number" name="Stok" class="form-control" value="{{ $buku->Stok }}" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white">
                        <a href="{{ route('buku.index') }}" class="btn btn-default">Batal</a>
                        <button type="submit" class="btn btn-warning float-right px-4 shadow-sm text-white font-weight-bold">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>