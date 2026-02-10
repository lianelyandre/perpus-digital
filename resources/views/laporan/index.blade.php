<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Laporan Peminjaman
        </h2>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-primary shadow">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-print mr-2"></i> Filter Cetak Laporan</h3>
                </div>

                <form action="{{ route('laporan.generate') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <p class="text-muted">Pilih rentang tanggal peminjaman untuk menghasilkan laporan PDF.</p>

                        <div class="form-group">
                            <label for="tgl_mulai">Tanggal Mulai</label>
                            <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="tgl_selesai">Tanggal Selesai</label>
                            <input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control" required>
                        </div>
                    </div>

                    <div class="card-footer bg-white text-right">
                        <button type="submit" class="btn btn-primary px-4 shadow-sm">
                            <i class="fas fa-file-pdf mr-2"></i> Download PDF
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>