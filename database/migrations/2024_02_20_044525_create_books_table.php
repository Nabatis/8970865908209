<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('cover_buku')->nullable();
            $table->string('judul');
            $table->string('penulis');
            $table->string('penerbit');
            $table->text('deskripsi');
            $table->unsignedBigInteger('id_kategori')->nullable();
            $table->unsignedSmallInteger('tahun_terbit');
            $table->unsignedInteger('stock')->default(0);
            $table->integer('jumlah_tambahan_stock')->default(0);
            $table->timestamps();

            $table->foreign('id_kategori')->references('id')->on('kategori')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buku');
    }
}