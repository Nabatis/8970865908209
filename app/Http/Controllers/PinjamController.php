<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Durasipinjam;
use App\Models\Buku;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\peminjaman;
use Illuminate\Http\Request;

class PinjamController extends Controller
{
    public function pinjamBukuUser(Request $request)
    {
        // Memeriksa apakah jumlah_pinjam telah diberikan dalam request, jika tidak, default nilainya menjadi 1
        $request->merge(['jumlah_pinjam' => $request->input('jumlah_pinjam', 1)]);

        $validator = Validator::make($request->all(), [
            'id_buku' => 'required|exists:buku,id',
            'id_users' => 'required|exists:users,id',
            'id_durasi_peminjaman' => 'required|exists:durasi_peminjaman,id',
            'tgl_peminjaman' => 'required|date',
            'jumlah_pinjam' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $buku = Buku::find($request->id_buku);

        if (!$buku) {
            return response()->json(['success' => false, 'msg' => 'Buku tidak ditemukan'], 404);
        }

        if ($request->jumlah_pinjam > $buku->stock) {
            return response()->json(['success' => false, 'msg' => 'Stock kami sedang habis', 'stock_tersedia' => $buku->stock], 400);
        }

        $user = User::find($request->id_users);

        if (!$user || $user->is_verified != 1) {
            return response()->json(['success' => false, 'msg' => 'Akun belum diverifikasi untuk meminjam buku'], 400);
        }

        $existingPeminjaman = Peminjaman::where('id_users', $request->id_users)
            ->whereNotIn('status_peminjaman', ['dikembalikan', 'ditolak'])
            ->count();

        if ($existingPeminjaman >= 1) {
            return response()->json(['success' => false, 'msg' => 'Anda sudah meminjam buku dan belum mengembalikannya, kembalikan terlebih dahulu'], 400);
        }

        try {
            $durasiPeminjaman = Durasipinjam::find($request->id_durasi_peminjaman);

            if (!$durasiPeminjaman) {
                return response()->json(['success' => false, 'msg' => 'Durasi peminjaman tidak ditemukan'], 404);
            }

            $tgl_pengembalian = Carbon::parse($request->tgl_peminjaman)->addDays($durasiPeminjaman->durasi_hari);

            $peminjaman = Peminjaman::create([
                'id_buku' => $request->id_buku,
                'id_users' => $request->id_users,
                'tgl_peminjaman' => $request->tgl_peminjaman,
                'id_durasi_peminjaman' => $request->id_durasi_peminjaman,
                'tgl_pengembalian' => $tgl_pengembalian,
                'status_peminjaman' => 'tertunda',
                'jumlah_pinjam' => $request->jumlah_pinjam,
            ]);

            if ($peminjaman->status_peminjaman === 'disetujui') {
                $buku->decrement('stock', $request->jumlah_pinjam);
            }

            return response()->json([
                'success' => true,
                'msg' => 'Pinjam Berhasil',
                'peminjaman' => $peminjaman,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => 'Pinjam Gagal Dibuat',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
