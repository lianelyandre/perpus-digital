<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id(); // primary key default: id

            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->foreignId('BukuID')
                ->constrained('buku', 'BukuID')
                ->onDelete('cascade');

            $table->date('TanggalPeminjaman');
            $table->date('TanggalPengembalian');

            $table->enum('StatusPeminjaman', [
                'Menunggu',
                'Dipinjam',
                'Kembali',
                'Ditolak'
            ])->default('Menunggu');

            $table->integer('jumlah')->default(1);

            $table->integer('Denda')->default(0);

            $table->timestamps();
        });
    }
};
