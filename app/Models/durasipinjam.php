<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Durasipinjam extends Model
{
    protected $table = 'durasi_peminjaman';

    protected $fillable = [
        'durasi_hari',
    ];
}
