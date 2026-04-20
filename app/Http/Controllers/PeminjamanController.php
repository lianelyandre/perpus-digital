<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        // 1. VALIDASI: Cek apakah BukuID ada dan jumlahnya masuk akal (minimal 1)
        $request->validate([
            'BukuID' => 'required|exists:buku,BukuID',
            'jumlah' => 'required|integer|min:1'
        ], [
            'jumlah.min' => 'Minimal pinjam 1 buku bray!',
            'BukuID.exists' => 'Bukunya nggak terdaftar nih.'
        ]);

        // 2. AMBIL DATA BUKU: Buat ngecek stok yang tersedia di database
        $buku = \App\Models\Buku::findOrFail($request->BukuID);

        // 3. CEK STOK: Jangan sampai user pinjam 5 tapi stok cuma 2
        if ($buku->Stok < $request->jumlah) {
            return back()->with('error', 'Waduh, stok "' . $buku->Judul . '" nggak cukup. Sisa stok: ' . $buku->Stok);
        }

        // 4. SIMPAN KE DATABASE: Masukin data ke tabel peminjaman
        \App\Models\Peminjaman::create([
            'user_id'             => auth()->id(), // MASUKKAN KE user_id, BUKAN id
            'BukuID'              => $request->BukuID,
            'TanggalPeminjaman'   => now(),
            'TanggalPengembalian' => now()->addDays(7),
            'StatusPeminjaman'    => 'Menunggu',
            'jumlah'              => $request->jumlah,
            'Denda'               => 0
        ]);

        // CATATAN: Stok JANGAN dikurangi di sini. 
        // Stok baru dikurangi nanti di fungsi 'accPinjaman' pas petugas klik tombol ACC.

        return redirect()->route('dashboard')
            ->with('success', 'Permintaan pinjam ' . $request->jumlah . ' buku "' . $buku->Judul . '" berhasil dikirim. Tunggu konfirmasi ya!');
    }

    public function accPinjaman($id)
    {
        $pinjam = \App\Models\Peminjaman::findOrFail($id);
        $buku = \App\Models\Buku::find($pinjam->BukuID);

        // Cek apakah stok di DB mencukupi
        if ($buku->Stok >= $pinjam->jumlah) {

            // 1. Update status pinjaman
            $pinjam->update([
                'StatusPeminjaman' => 'Dipinjam'
            ]);

            // 2. KURANGI STOK (Inilah yang bikin di DB dan tampilan berkurang)
            $buku->decrement('Stok', $pinjam->jumlah);

            return back()->with('success', 'Stok berhasil dikurangi!');
        }

        return back()->with('error', 'Stok tidak cukup!');
    }

    public function kembalikan($id)
    {
        $pinjam = \App\Models\Peminjaman::findOrFail($id);
        $buku = \App\Models\Buku::find($pinjam->BukuID);

        // Ubah status jadi 'Dikembalikan'
        $pinjam->update([
            'StatusPeminjaman' => 'Kembali',
            'TanggalPengembalian' => now()
        ]);

        // TAMBAH BALIK STOKNYA
        $buku->increment('Stok', $pinjam->jumlah);

        return back()->with('success', 'Buku sudah dikembalikan, stok otomatis bertambah!');
    }

    public function konfirmasi(Request $request, $id)
    {
        $pinjam = \App\Models\Peminjaman::findOrFail($id);
        $buku = \App\Models\Buku::find($pinjam->BukuID);
        $statusBaru = $request->status; // 'Dipinjam', 'Ditolak', atau 'Dikembalikan'

        // JIKA STATUS DIUBAH JADI 'Dipinjam' (Proses ACC)
        if ($statusBaru == 'Dipinjam' && $pinjam->StatusPeminjaman == 'Menunggu') {
            if ($buku->Stok >= $pinjam->jumlah) {
                $buku->decrement('Stok', $pinjam->jumlah);
            } else {
                return redirect()->back()->with('error', 'Stok buku tidak mencukupi bray!');
            }
        }

        // JIKA STATUS DIUBAH JADI 'Dikembalikan' (Buku pulang)
        if ($statusBaru == 'Dikembalikan' && $pinjam->StatusPeminjaman == 'Dipinjam') {
            $buku->increment('Stok', $pinjam->jumlah);
        }

        $pinjam->update([
            'StatusPeminjaman' => $statusBaru
        ]);

        return redirect()->back()->with('success', 'Status dan Stok berhasil diupdate!');
    }
}
