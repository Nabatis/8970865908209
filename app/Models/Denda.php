<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    protected $table = 'denda';

    protected $fillable = [
        'id_peminjaman',
        'id_user',
        'jumlah',
        'tgl_pembayaran',
        'status_pembayaran',
        'jumlah_hari_denda'
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user')->select('id', 'email');
    }

    public function buku()
    {
        // Navigasi ke model Buku melalui relasi Peminjaman
        return $this->peminjaman->book;
    }

    public function pengguna()
    {
        // Navigasi ke model Buku melalui relasi Peminjaman
        return $this->peminjaman->user;
    }
}
