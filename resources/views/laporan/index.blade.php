<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📄 Laporan Peminjaman
        </h2>
    </x-slot>

<style>

    body{
        background:#f4f6fb;
    }

    /* Card Luxury */
    .lux-card{
        border-radius:18px;
        border:none;
        box-shadow:0 20px 40px rgba(0,0,0,.08);
        overflow:hidden;
    }

    /* Header Gradient */
    .lux-header{
        background: linear-gradient(135deg,#667eea,#764ba2);
        color:white;
        padding:18px 22px;
    }

    /* Input Modern */
    .lux-input{
        border-radius:12px;
        border:1px solid #e4e7f2;
        padding:10px 14px;
        transition:.25s;
    }

    .lux-input:focus{
        border-color:#667eea;
        box-shadow:0 0 0 3px rgba(102,126,234,.15);
    }

    /* Button Premium */
    .lux-btn{
        border-radius:12px;
        background: linear-gradient(135deg,#667eea,#764ba2);
        border:none;
        padding:10px 24px;
        font-weight:600;
        transition:.3s;
        box-shadow:0 8px 18px rgba(118,75,162,.25);
    }

    .lux-btn:hover{
        transform:translateY(-2px);
        box-shadow:0 14px 30px rgba(118,75,162,.35);
    }

</style>


<div class="row justify-content-center mt-3">
    <div class="col-lg-5 col-md-7">

        <div class="card lux-card">

            {{-- Header --}}
            <div class="lux-header">
                <h5 class="mb-0">
                    <i class="fas fa-file-export mr-2"></i>
                    Filter Cetak Laporan PDF
                </h5>
            </div>

            <form action="{{ route('laporan.generate') }}" method="POST">
                @csrf

                {{-- Body --}}
                <div class="card-body p-4">

                    <p class="text-muted mb-4">
                        Pilih rentang tanggal peminjaman untuk menghasilkan laporan PDF.
                    </p>

                    <div class="form-group mb-3">
                        <label class="font-weight-semibold">Tanggal Mulai</label>
                        <input type="date"
                               name="tgl_mulai"
                               class="form-control lux-input"
                               required>
                    </div>

                    <div class="form-group mb-2">
                        <label class="font-weight-semibold">Tanggal Selesai</label>
                        <input type="date"
                               name="tgl_selesai"
                               class="form-control lux-input"
                               required>
                    </div>

                </div>

                {{-- Footer --}}
                <div class="card-footer bg-white border-0 text-right pb-4 pr-4">

                    <button type="submit" class="btn text-white lux-btn">
                        <i class="fas fa-file-pdf mr-2"></i>
                        Download PDF
                    </button>

                </div>
            </form>

        </div>

    </div>
</div>

</x-app-layout>
