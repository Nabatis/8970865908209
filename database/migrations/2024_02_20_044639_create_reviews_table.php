<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ulasans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_buku');
            $table->unsignedBigInteger('id_users');
            $table->decimal('rating');
            $table->text('ulasan')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_buku')->references('id')->on('buku')->onDelete('cascade');
            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasans');
    }
}