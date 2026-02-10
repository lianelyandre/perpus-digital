<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Ini otomatis jadi primary key 'id'
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->string('nama_lengkap');
            $table->text('alamat');
            $table->enum('role', ['admin', 'petugas', 'peminjam'])->default('peminjam');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
