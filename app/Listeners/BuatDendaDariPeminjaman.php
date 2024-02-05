<?php

namespace App\Listeners;

use App\Events\PeminjamanDitandaiSebagaiDenda;
use App\Models\Denda;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BuatDendaDariPeminjaman implements ShouldQueue
{
    public function handle(PeminjamanDitandaiSebagaiDenda $event)
    {
        $peminjaman = $event->peminjaman;

        // Buat entitas Denda
        Denda::create([
            'id_peminjaman' => $peminjaman->id,
            'id_user' => $peminjaman->id_users,
            'tgl_pembayaran' => null,
            'status_pembayaran' => 'belum_dibayar',
        ]);
    }
}
