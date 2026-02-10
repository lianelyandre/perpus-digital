<x-app-layout>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tambah Buku Baru</h3>
                </div>
                <form action="{{ route('buku.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Judul Buku</label>
                            <input type="text" name="Judul" class="form-control" placeholder="Masukkan Judul" required>
                        </div>
                        <div class="form-group">
                            <label>Penulis</label>
                            <input type="text" name="Penulis" class="form-control" placeholder="Nama Penulis" required>
                        </div>
                        <div class="form-group">
                            <label>Penerbit</label>
                            <input type="text" name="Penerbit" class="form-control" placeholder="Nama Penerbit" required>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tahun Terbit</label>
                                    <input type="number" name="TahunTerbit" class="form-control" placeholder="Contoh: 2024" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Stok</label>
                                    <input type="number" name="Stok" class="form-control" placeholder="Jumlah Stok" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan Buku</button>
                        <a href="{{ route('buku.index') }}" class="btn btn-default">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>