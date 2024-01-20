<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'id_buku',
        'id_users',
        'tgl_peminjaman',
        'tgl_pengembalian',
        'status_peminjaman',
    ];

    // Relasi dengan model Book
    public function book()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
}
