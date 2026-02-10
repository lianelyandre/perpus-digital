<x-app-layout>

    <div class="row justify-content-center mt-3">
        <div class="col-lg-7">

            <div class="card lux-card">

                <div class="lux-header">
                    <h5 class="mb-0">
                        ✏️ Edit Buku — {{ $buku->Judul }}
                    </h5>
                </div>

                <form action="{{ route('buku.update',$buku->BukuID) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body p-4">

                        <div class="form-group">
                            <label>Judul Buku</label>
                            <input type="text" name="Judul" class="form-control lux-input"
                                value="{{ $buku->Judul }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Penulis</label>
                                    <input type="text" name="Penulis"
                                        class="form-control lux-input"
                                        value="{{ $buku->Penulis }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Penerbit</label>
                                    <input type="text" name="Penerbit"
                                        class="form-control lux-input"
                                        value="{{ $buku->Penerbit }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tahun Terbit</label>
                                    <input type="number" name="TahunTerbit"
                                        class="form-control lux-input"
                                        value="{{ $buku->TahunTerbit }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Stok</label>
                                    <input type="number" name="Stok"
                                        class="form-control lux-input"
                                        value="{{ $buku->Stok }}" required>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer bg-white text-right pr-4 pb-4 border-0">
                        <a href="{{ route('buku.index') }}" class="btn btn-light">
                            Batal
                        </a>

                        <button class="btn lux-btn ml-2">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</x-app-layout>