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
        Schema::create('denda', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_peminjaman');
            $table->unsignedBigInteger('id_user')->nullable(); // Menambah kolom id_user
            $table->unsignedInteger('jumlah');
            $table->date('tgl_pembayaran')->nullable(); // Menambah kolom tgl_pembayaran
            $table->enum('status_pembayaran', ['belum_dibayar', 'sudah_dibayar'])->default('belum_dibayar'); // Menambah kolom status_pembayaran
            $table->timestamps();

            $table->foreign('id_peminjaman')->references('id')->on('peminjaman')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('denda');
    }
};
