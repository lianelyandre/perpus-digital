{{-- File: resources/views/peminjaman/modal_pinjam.blade.php --}}
<div class="modal fade" id="modalPinjam{{ $book->BukuID }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="{{ route('pinjam.store') }}" method="POST" class="modal-content border-0 shadow-lg">
            @csrf
            <input type="hidden" name="BukuID" value="{{ $book->BukuID }}">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold">Konfirmasi Pinjaman</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body py-4">
                <div class="text-center mb-3">
                    <i class="fas fa-book-reader fa-3x text-primary mb-3"></i>
                    <p class="text-muted mb-1">Anda akan meminjam buku:</p>
                    <h5 class="font-weight-bold">{{ $book->Judul }}</h5>
                </div>
                <div class="form-group">
                    <label class="small font-weight-bold">Tanggal Pengembalian:</label>
                    <input type="date" name="TanggalPengembalian" class="form-control" required min="{{ date('Y-m-d') }}">
                    <small class="text-muted mt-2 d-block">Minimal pengembalian adalah hari ini bray!</small>
                </div>
            </div>
            <div class="modal-footer bg-light border-0">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary px-4">GAS PINJAM!</button>
            </div>
        </form>
    </div>
</div>