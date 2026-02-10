<?php

namespace App\Http\Controllers;

use App\Models\UlasanBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    public function index()
    {
        // Ambil semua ulasan, urutkan terbaru
        $ulasan = \App\Models\UlasanBuku::with(['user', 'buku'])->latest()->get();

        // Pastikan lu punya file view ini: resources/views/ulasan/index.blade.php
        return view('ulasan.index', compact('ulasan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'BukuID' => 'required|exists:buku,BukuID',
            'Ulasan' => 'required|string',
            'Rating' => 'required|integer|min:1|max:5',
        ]);

        UlasanBuku::create([
            'id' => Auth::id(),
            'BukuID' => $request->BukuID,
            'Ulasan' => $request->Ulasan,
            'Rating' => $request->Rating,
        ]);

        return back()->with('success', 'Terima kasih atas ulasannya!');
    }
}
