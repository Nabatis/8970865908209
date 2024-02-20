<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';

    protected $fillable = [
        'stock',
        'judul',
        'penulis',
        'penerbit',
        'deskripsi',
        'tahun_terbit',
        'id_kategori',
        'cover_buku'
    ];

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'id_buku');
    }

    // Relasi dengan model Peminjaman
    public function MasukPeminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_buku');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function namaKategori()
    {
        return $this->kategori->name; // "name" adalah nama kolom di tabel kategori yang menyimpan nama kategori
    }
}
