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

    public function getJumlahPeminjamanByYearAndMonth(Request $request)
    {
        $currentYear = date('Y'); // Mendapatkan tahun saat ini

        $monthlyStats = [];

        // Loop untuk setiap bulan dalam satu tahun
        for ($month = 1; $month <= 12; $month++) {
            $monthName = date('F', mktime(0, 0, 0, $month, 1)); // Nama bulan
            $monthNumber = str_pad($month, 2, '0', STR_PAD_LEFT); // Angka bulan

            // Menghitung jumlah peminjaman untuk bulan dan tahun saat ini
            $totalPinjam = Peminjaman::whereYear('tgl_peminjaman', $currentYear)
                ->whereMonth('tgl_peminjaman', $monthNumber)
                ->count();

            // Menambahkan data bulan ke dalam array statistik bulanan
            $monthlyStats[$monthName] = $totalPinjam;
        }

        // Membuat respons JSON
        $response = [
            'tahun' => $currentYear,
            'statistik_peminjaman' => $monthlyStats,
        ];

        return response()->json($response);
    }

    public function getPeminjamanstatustertunda()
    {
        $pinjam = Peminjaman::with(['book', 'user'])
            ->where('status_peminjaman', '=', 'tertunda')
            ->orderBy('created_at', 'desc')
            ->get();

        if ($pinjam->isEmpty()) {
            return response()->json(['success' => true, 'false' => 'Tidak ada data denda'], 404);
        }

        return response()->json(['success' => true, 'data' => $pinjam]);
    }
}
