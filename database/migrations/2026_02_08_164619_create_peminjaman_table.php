<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id('PeminjamanID');
            $table->foreignId('id')->constrained('users')->onDelete('cascade'); // Relasi ke User
            $table->foreignId('BukuID')->constrained('buku', 'BukuID')->onDelete('cascade'); // Relasi ke Buku
            $table->date('TanggalPeminjaman');
            $table->date('TanggalPengembalian');
            $table->enum('StatusPeminjaman', ['Menunggu', 'Dipinjam', 'Kembali', 'Ditolak'])->default('Menunggu');
            $table->timestamps();
        });
    }
};
