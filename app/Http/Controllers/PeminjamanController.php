<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function getPeminjaman()
    {
        $pinjam = Peminjaman::with(['book', 'user'])->get();

        if ($pinjam->isEmpty()) {
            return response()->json(['success' => true, 'false' => 'Tidak ada data denda'], 404);
        }

        // Ubah data yang diperoleh menjadi format yang sesuai sebelum mengirimkan respons
        $formattedPeminjaman = $pinjam->map(function ($peminjaman) {
            return [
                'id' => $peminjaman->id,
                'judul_buku' => $peminjaman->book->judul, // Mengambil judul buku dari relasi
                'nama_user' => $peminjaman->user->name, // Mengambil nama user dari relasi
                'nisn_user' => $peminjaman->user->nisn, // Mengambil NISN user dari relasi
                'tgl_peminjaman' => $peminjaman->tgl_peminjaman,
                'tgl_pengembalian' => $peminjaman->tgl_pengembalian,
                'jumlah_pinjam' => $peminjaman->jumlah_pinjam,
                'status_peminjaman' => $peminjaman->status_peminjaman,
                'created_at' => $peminjaman->created_at,
                'updated_at' => $peminjaman->updated_at
            ];
        });

        return response()->json(['success' => true, 'data' => $formattedPeminjaman]);
    }
}
