<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_buku');
            $table->unsignedBigInteger('id_durasi_peminjaman');
            $table->unsignedBigInteger('id_users');
            $table->dateTime('tgl_peminjaman')->default(null);
            $table->dateTime('tgl_pengembalian')->default(null);
            $table->unsignedInteger('jumlah_pinjam')->default(1);
            $table->enum('status_peminjaman', ['tertunda', 'disetujui', 'ditolak', 'dikembalikan', 'denda'])->default('tertunda');
            $table->timestamps();

            $table->foreign('id_buku')->references('id')->on('buku')->onDelete('cascade');
            $table->foreign('id_durasi_peminjaman')->references('id')->on('durasipinjam')->onDelete('cascade');
            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
}
