<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Denda;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function getPeminjamanbyuser($userId)
    {
        // Mengambil peminjaman berdasarkan ID pengguna tertentu
        $pinjam = Peminjaman::with(['book', 'user'])
            ->where('id_users', $userId)
            ->get();

        if ($pinjam->isEmpty()) {
            return response()->json(['success' => true, 'false' => 'Tidak ada data'], 404);
        }

        // Ubah data yang diperoleh menjadi format yang sesuai sebelum mengirimkan respons
        $formattedPeminjaman = $pinjam->map(function ($peminjaman) {
            return [
                'id' => $peminjaman->id,
                'id_buku' => $peminjaman->book->id,
                'judul_buku' => $peminjaman->book->judul,
                'cover_buku' => $peminjaman->book->cover_buku,
                'deskripsi' => $peminjaman->book->deskripsi,
                'id_users' => $peminjaman->user->id,
                'name' => $peminjaman->user->name,
                'nisn' => $peminjaman->user->nisn,
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

    public function gettotaldataadmin()
    {
        $totalBuku = Buku::count();
        $totalUser = User::where('role', 'user')->count();
        $totalDenda = Denda::count();
        $totalKategori = Kategori::count();

        return response()->json([
            'total_buku' => $totalBuku,
            'total_denda' => $totalDenda,
            'total_user' => $totalUser,
            'total_Kategori' => $totalKategori,
        ]);
    }

    
}
