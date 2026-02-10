<x-app-layout>

    <div class="row justify-content-center mt-3">
        <div class="col-lg-7">

            <div class="card lux-card">

                <div class="lux-header">
                    <h5 class="mb-0">
                        ➕ Tambah Buku Baru
                    </h5>
                </div>

                <form action="{{ route('buku.store') }}" method="POST">
                    @csrf

                    <div class="card-body p-4">

                        <div class="form-group">
                            <label>Judul Buku</label>
                            <input type="text" name="Judul"
                                class="form-control lux-input"
                                placeholder="Masukkan Judul Buku" required>
                        </div>

                        <div class="form-group">
                            <label>Penulis</label>
                            <input type="text" name="Penulis"
                                class="form-control lux-input"
                                placeholder="Nama Penulis" required>
                        </div>

                        <div class="form-group">
                            <label>Penerbit</label>
                            <input type="text" name="Penerbit"
                                class="form-control lux-input"
                                placeholder="Nama Penerbit" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tahun Terbit</label>
                                    <input type="number" name="TahunTerbit"
                                        class="form-control lux-input"
                                        placeholder="Contoh 2024" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Stok</label>
                                    <input type="number" name="Stok"
                                        class="form-control lux-input"
                                        placeholder="Jumlah Stok" required>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer bg-white text-right pr-4 pb-4 border-0">
                        <a href="{{ route('buku.index') }}" class="btn btn-light">
                            Batal
                        </a>

                        <button class="btn lux-btn ml-2">
                            Simpan Buku
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</x-app-layout>