<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\peminjaman;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\Denda;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DendaController extends Controller
{
    public function index()
    {
        $denda = Denda::with(['peminjaman', 'user'])->get();

        if ($denda->isEmpty()) {
            return response()->json(['success' => true, 'false' => 'Tidak ada data denda'], 404);
        }

        // Ubah data yang diperoleh menjadi format yang sesuai sebelum mengirimkan respons
        $formattedDenda = $denda->map(function ($dendaBuku) {
            // Hitung selisih hari
            $tglPengembalian = Carbon::parse($dendaBuku->peminjaman->tgl_pengembalian);
            $tglPembayaran = $dendaBuku->tgl_pembayaran ? Carbon::parse($dendaBuku->tgl_pembayaran) : Carbon::now();
            $selisihHari = $tglPengembalian->diffInDays($tglPembayaran);

            // Jika belum membayar dan terlambat, tambahkan denda per hari
            if ($selisihHari > 0 && $dendaBuku->status_pembayaran === 'belum_dibayar') {
                $dendaPerHari = 1000; // Denda per hari
                $totalDenda = $selisihHari * $dendaPerHari;
                // Jika selisih hari lebih dari jumlah hari denda yang telah ditambahkan sebelumnya
                if ($selisihHari > $dendaBuku->jumlah_hari_denda) {
                    $dendaBuku->jumlah += $dendaPerHari; // Tambahkan denda
                    $dendaBuku->jumlah_hari_denda = $selisihHari; // Update jumlah hari denda
                    $dendaBuku->save();
                }
            }

            return [
                'id' => $dendaBuku->id,
                'judul_buku' => $dendaBuku->peminjaman->bok->judul,
                'nama_user' => $dendaBuku->peminjaman->user->name,
                'nisn_user' => $dendaBuku->peminjaman->user->nisn,
                'tgl_peminjaman' => $dendaBuku->peminjaman->tgl_peminjaman,
                'tgl_pengembalian' => $dendaBuku->peminjaman->tgl_pengembalian,
                'jumlah_pinjam' => $dendaBuku->peminjaman->jumlah_pinjam,
                'tgl_pembayaran' => $dendaBuku->tgl_pembayaran,
                'jumlah' => $dendaBuku->jumlah, // Total jumlah termasuk denda
                'status_pembayaran' => $dendaBuku->status_pembayaran,
                'created_at' => $dendaBuku->created_at,
                'updated_at' => $dendaBuku->updated_at,
            ];
        });

        return response()->json(['success' => true, 'data' => $formattedDenda]);
    }

    public function indexDendaByUser($userId)
    {

        $denda = Denda::with(['peminjaman', 'user'])
            ->whereHas('user', function ($query) use ($userId) {
                $query->where('id', $userId);
            })
            ->get();


        if ($denda->isEmpty()) {
            return response()->json(['success' => true, 'false' => 'Tidak ada data denda'], 404);
        }

        // Ubah data yang diperoleh menjadi format yang sesuai sebelum mengirimkan respons
        $formattedDenda = $denda->map(function ($dendaBuku) {
            // Hitung selisih hari
            $tglPengembalian = Carbon::parse($dendaBuku->peminjaman->tgl_pengembalian);
            $tglPembayaran = $dendaBuku->tgl_pembayaran ? Carbon::parse($dendaBuku->tgl_pembayaran) : Carbon::now();
            $selisihHari = $tglPengembalian->diffInDays($tglPembayaran);

            // Jika belum membayar dan terlambat, tambahkan denda per hari
            if ($selisihHari > 0 && $dendaBuku->status_pembayaran === 'belum_dibayar') {
                $dendaPerHari = 1000; // Denda per hari
                $totalDenda = $selisihHari * $dendaPerHari;
                // Jika selisih hari lebih dari jumlah hari denda yang telah ditambahkan sebelumnya
                if ($selisihHari > $dendaBuku->jumlah_hari_denda) {
                    $dendaBuku->jumlah += $dendaPerHari; // Tambahkan denda
                    $dendaBuku->jumlah_hari_denda = $selisihHari; // Update jumlah hari denda
                    $dendaBuku->save();
                }
            }

            return [
                'id' => $dendaBuku->id,
                'id_buku' => $dendaBuku->peminjaman->book->id,
                'cover_buku' => $dendaBuku->peminjaman->book->cover_buku,
                'judul_buku' => $dendaBuku->peminjaman->book->judul,
                'penulis' => $dendaBuku->peminjaman->book->penulis,
                'penerbit' => $dendaBuku->peminjaman->book->penerbit,
                'tahun_terbit' => $dendaBuku->peminjaman->book->tahun_terbit,
                'nama_user' => $dendaBuku->peminjaman->user->name,
                'nisn_user' => $dendaBuku->peminjaman->user->nisn,
                'tgl_peminjaman' => $dendaBuku->peminjaman->tgl_peminjaman,
                'tgl_pengembalian' => $dendaBuku->peminjaman->tgl_pengembalian,
                'jumlah_pinjam' => $dendaBuku->peminjaman->jumlah_pinjam,
                'status_peminjaman' => $dendaBuku->peminjaman->status_peminjaman,
                'tgl_pembayaran' => $dendaBuku->tgl_pembayaran,
                'jumlah' => $dendaBuku->jumlah, // Total jumlah termasuk denda
                'status_pembayaran' => $dendaBuku->status_pembayaran,
                'created_at' => $dendaBuku->created_at,
                'updated_at' => $dendaBuku->updated_at,
            ];
        });

        return response()->json(['success' => true, 'data' => $formattedDenda]);
    }


    public function show($id)
    {
        $denda = Denda::with(['peminjaman', 'user'])->find($id);

        if (!$denda) {
            return response()->json(['success' => false, 'msg' => 'Denda tidak ditemukan'], 404);
        }

        $data = [
            'id' => $denda->id,
            'id_buku' => $denda->peminjaman->book->id,
            'cover_buku' => $denda->peminjaman->book->cover_buku,
            'judul_buku' => $denda->peminjaman->book->judul,
            'penulis' => $denda->peminjaman->book->penulis,
            'penerbit' => $denda->peminjaman->book->penerbit,
            'tahun_terbit' => $denda->peminjaman->book->tahun_terbit,
            'nama_user' => $denda->peminjaman->user->name,
            'nisn_user' => $denda->peminjaman->user->nisn,
            'tgl_peminjaman' => $denda->peminjaman->tgl_peminjaman,
            'tgl_pengembalian' => $denda->peminjaman->tgl_pengembalian,
            'jumlah_pinjam' => $denda->peminjaman->jumlah_pinjam,
            'status_peminjaman' => $denda->peminjaman->status_peminjaman,
            'tgl_pembayaran' => $denda->tgl_pembayaran,
            'jumlah' => $denda->jumlah, // Total jumlah termasuk denda
            'status_pembayaran' => $denda->status_pembayaran,
            'created_at' => $denda->created_at,
            'updated_at' => $denda->updated_at,
        ];

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_peminjaman' => 'required|exists:peminjaman,id',
            'id_user' => 'nullable|exists:users,id',
            'tgl_pembayaran' => 'nullable|date',
            'status_pembayaran' => 'in:belum_dibayar,sudah_dibayar',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'msg' => $validator->errors()]);
        }

        $denda = Denda::create($request->all());

        return response()->json(['success' => true, 'msg' => 'Denda berhasil ditambahkan', 'data' => $denda]);
    }

    public function updateBayar(Request $request, $id)
    {
        $denda = Denda::find($id);

        if (!$denda) {
            return response()->json(['success' => false, 'msg' => 'Denda tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'status_pembayaran' => 'required|in:belum_dibayar,sudah_dibayar',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'msg' => $validator->errors()]);
        }

        $denda->update($request->all());

        return response()->json(['success' => true, 'msg' => 'Denda berhasil diupdate', 'data' => $denda]);
    }

    public function destroy($id)
    {
        $denda = Denda::find($id);

        if (!$denda) {
            return response()->json(['success' => false, 'msg' => 'Denda tidak ditemukan'], 404);
        }

        $denda->delete();

        return response()->json(['success' => true, 'msg' => 'Denda berhasil dihapus']);
    }

    public function sendReminderEmail($id)
    {
        // 1. Mengambil objek Denda berdasarkan $id
        $denda = Denda::find($id);

        if (!$denda) {
            return ['success' => false, 'msg' => 'Denda tidak ditemukan'];
        }

        // 2. Mengambil id_user dari objek Denda
        $id_user = $denda->id_user;

        // 3. Mengambil objek User berdasarkan id_user
        $user = User::find($id_user);

        if (!$user) {
            return ['success' => false, 'msg' => 'User tidak ditemukan'];
        }

        // 4. Mendapatkan alamat email dari objek User
        $email = $user->email;
        $subject = "Pengingat Masa Pinjam Buku";
        $message = "Masa pinjam Anda segera berakhir. Jangan lupa untuk mengembalikan buku agar tidak terkena denda!";

        try {
            // Kirim email
            Mail::raw($message, function ($mail) use ($email, $subject) {
                $mail->to($email)
                    ->subject($subject);
            });

            return ['success' => true, 'msg' => 'Email pengingat berhasil dikirim'];
        } catch (\Exception $e) {
            return ['success' => false, 'msg' => 'Gagal mengirim email pengingat: ' . $e->getMessage()];
        }
    }
}
