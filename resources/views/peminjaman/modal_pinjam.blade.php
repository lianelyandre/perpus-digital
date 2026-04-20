{{-- File: resources/views/peminjaman/modal_pinjam.blade.php --}}

<style>
    .lux-modal .modal-content {
        border-radius: 18px;
        border: none;
        overflow: hidden;
        box-shadow: 0 25px 50px rgba(0, 0, 0, .15);
    }

    .lux-modal-header {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 18px 22px;
    }

    .lux-modal-body {
        padding: 30px 28px;
    }

    .lux-input {
        border-radius: 12px;
        border: 1px solid #e4e7f2;
        padding: 10px 14px;
        transition: .25s;
    }

    .lux-input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, .15);
    }

    .lux-btn {
        border-radius: 12px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
        color: white;
        font-weight: 600;
        padding: 10px 22px;
        transition: .3s;
        box-shadow: 0 8px 18px rgba(118, 75, 162, .25);
    }

    .lux-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 30px rgba(118, 75, 162, .35);
        color: white;
    }
</style>


<div class="modal fade lux-modal" id="modalPinjam{{ $book->BukuID }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">

        <form action="{{ route('pinjam.store') }}" method="POST" class="modal-content">
            @csrf

            <input type="hidden" name="BukuID" value="{{ $book->BukuID }}">

            {{-- HEADER --}}
            <div class="lux-modal-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0 font-weight-bold">
                    📚 Konfirmasi Pinjaman
                </h5>

                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>


            {{-- BODY --}}
            <div class="lux-modal-body">

                <div class="text-center mb-4">
                    <i class="fas fa-book-reader fa-3x mb-3" style="color:#667eea;"></i>

                    <p class="text-muted mb-1">
                        Anda akan meminjam buku:
                    </p>

                    <h5 class="font-weight-bold">
                        {{ $book->Judul }}
                    </h5>
                </div>


                {{-- TANGGAL --}}
                <div class="form-group">
                    <label class="small font-weight-bold">
                        Tanggal Pengembalian
                    </label>

                    <input type="date"
                        name="TanggalPengembalian"
                        class="form-control lux-input"
                        required
                        min="{{ date('Y-m-d') }}">
                </div>


                {{-- JUMLAH PINJAM --}}
                <div class="form-group">

                    <label class="small font-weight-bold">
                        Jumlah Pinjam
                    </label>

                    <div class="d-flex align-items-center">

                        <button type="button"
                            class="btn btn-light"
                            onclick="kurangJumlah{{ $book->BukuID }}()">
                            -
                        </button>

                        <input type="number"
                            id="jumlah{{ $book->BukuID }}"
                            name="jumlah"
                            class="form-control lux-input text-center mx-2"
                            value="1"
                            min="1"
                            max="{{ $book->Stok }}"
                            required>

                        <button type="button"
                            class="btn btn-light"
                            onclick="tambahJumlah{{ $book->BukuID }}()">
                            +
                        </button>

                    </div>

                    <small class="text-muted">
                        Stok tersedia: {{ $book->Stok }}
                    </small>

                </div>

            </div>


            {{-- FOOTER --}}
            <div class="modal-footer bg-light border-0 px-4 pb-4">

                <button type="button" class="btn btn-light" data-dismiss="modal">
                    Batal
                </button>

                @if($book->Stok > 0)
                <button type="submit" class="btn lux-btn">
                    🚀 Pinjam Sekarang
                </button>
                @else
                <button class="btn btn-secondary" disabled>
                    Stok Habis
                </button>
                @endif

            </div>

        </form>
    </div>
</div>


<script>
    function tambahJumlah {
        {
            $book - > BukuID
        }
    }() {
        let input = document.getElementById('jumlah{{ $book->BukuID }}');
        let max = parseInt(input.max);
        let val = parseInt(input.value);

        if (val < max) {
            input.value = val + 1;
        }
    }

    function kurangJumlah {
        {
            $book - > BukuID
        }
    }() {
        let input = document.getElementById('jumlah{{ $book->BukuID }}');
        let val = parseInt(input.value);

        if (val > 1) {
            input.value = val - 1;
        }
    }
</script>