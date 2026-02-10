<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        // Admin dan Petugas bisa lihat semua, tapi nanti di view tombol ACC cuma buat Petugas
        if (Auth::user()->role == 'peminjam') {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak!');
        }

        $peminjaman = Peminjaman::with(['user', 'buku'])->latest()->get();
        return view('peminjaman.index', compact('peminjaman'));
    }

    public function store(Request $request)
    {
        $buku = Buku::findOrFail($request->BukuID);

        // Cek stok sebelum request
        if ($buku->Stok <= 0) {
            return redirect()->back()->with('error', 'Waduh bray, stok buku ini udah abis!');
        }

        // STATUS AWAL: 'Menunggu' (Bukan 'Dipinjam')
        // Stok BELUM berkurang di sini
        Peminjaman::create([
            'id'                => auth()->id(),
            'BukuID'            => $request->BukuID,
            'TanggalPeminjaman' => now(),
            'TanggalPengembalian' => $request->TanggalPengembalian,
            'StatusPeminjaman'  => 'Menunggu',
        ]);

        return redirect()->route('dashboard')->with('success', 'Permintaan terkirim! Silahkan hubungi petugas untuk ACC.');
    }

    // FUNGSI KHUSUS PETUGAS (ACC PINJAMAN)
    public function accPinjaman($id)
    {
        // Proteksi: Hanya Petugas yang boleh!
        if (Auth::user()->role !== 'petugas') {
            return redirect()->back()->with('error', 'Cuma Petugas yang boleh ACC bray! Admin dilarang.');
        }

        $pinjam = Peminjaman::findOrFail($id);
        $buku = Buku::find($pinjam->BukuID);

        if ($buku->Stok > 0) {
            // Update status dan kurangi stok HANYA saat di-ACC
            $pinjam->update(['StatusPeminjaman' => 'Dipinjam']);
            $buku->decrement('Stok');

            return redirect()->back()->with('success', 'Pinjaman berhasil di-ACC oleh Petugas!');
        }

        return redirect()->back()->with('error', 'Gagal ACC, stok tiba-tiba habis!');
    }

    public function kembalikan($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        // Pastikan cuma bisa balikin yang statusnya emang lagi 'Dipinjam'
        if ($pinjam->StatusPeminjaman !== 'Dipinjam') {
            return redirect()->back()->with('error', 'Buku ini belum di-ACC atau sudah dikembalikan!');
        }

        $pinjam->update([
            'StatusPeminjaman' => 'Kembali',
            'TanggalPengembalian' => now()
        ]);

        $buku = Buku::find($pinjam->BukuID);
        if ($buku) {
            $buku->increment('Stok');
        }

        return redirect()->back()->with('success', 'Buku berhasil dikembalikan. Stok bertambah!');
    }

    public function konfirmasi(Request $request, $id)
    {
        $pinjam = \App\Models\Peminjaman::findOrFail($id);
        $statusBaru = $request->status; // 'Dipinjam', 'Ditolak', atau 'Kembali'

        // Kalau statusnya diubah jadi 'Kembali' (Buku pulang ke perpus)
        if ($statusBaru == 'Kembali') {
            $buku = \App\Models\Buku::find($pinjam->BukuID);
            $buku->increment('Stok'); // Stok nambah 1
        }

        $pinjam->update([
            'StatusPeminjaman' => $statusBaru
        ]);

        return redirect()->back()->with('success', 'Status berhasil diupdate bray!');
    }
}
