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
        'status_pembayaran'
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
