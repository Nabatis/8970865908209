<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookmarksTable extends Migration
{
    public function up()
    {
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_buku');
            $table->unsignedBigInteger('id_users');
            $table->boolean('is_bookmarked')->default(false);
            $table->timestamps();

            $table->foreign('id_buku')->references('id')->on('buku')->onDelete('cascade');
            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookmarks');
    }
}
