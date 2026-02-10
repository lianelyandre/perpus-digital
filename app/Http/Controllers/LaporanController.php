<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index'); // Pastikan file resources/views/laporan/index.blade.php sudah ada
    }

    public function generate(Request $request)
    {
        $request->validate([
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
        ]);

        $data = \App\Models\Peminjaman::with(['user', 'buku'])
            ->whereBetween('TanggalPeminjaman', [$request->tgl_mulai, $request->tgl_selesai])
            ->get();

        // Memanggil library DomPDF (Pastiin barryvdh/laravel-dompdf sudah terinstall)
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('laporan.pdf', compact('data', 'request'));

        return $pdf->download('Laporan-Perpus-' . now()->format('Ymd') . '.pdf');
    }
}
