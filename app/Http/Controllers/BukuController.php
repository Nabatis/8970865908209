<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class BukuController extends Controller
{

    public function pinjamBuku(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'id_buku' => 'required|exists:buku,id',
            'id_users' => 'required|exists:users,id',
            'tgl_peminjaman' => 'required|date',
            'tgl_pengembalian' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        // Validasi buku sebelum membuat peminjaman
        $buku = Buku::find($request->id_buku);

        if (!$buku) {
            return response()->json(['success' => false, 'msg' => 'Buku tidak ditemukan'], 404);
        }

        $peminjaman = Peminjaman::create([
            'id_buku' => $request->id_buku,
            'id_users' => $request->id_users,
            'tgl_peminjaman' => $request->tgl_peminjaman,
            'tgl_pengembalian' => $request->tgl_pengembalian,
            'status_peminjaman' => 'tertunda',
        ]);

        // Update book stock if the borrowing is approved
        if ($peminjaman->status_peminjaman === 'disetujui') {
            $buku->decrement('stock');
        }

        return response()->json([
            'success' => true,
            'msg' => 'Pinjam Berhasil',
            'peminjaman' => $peminjaman,
        ]);
    }

    public function getBuku()
    {

        $buku = Buku::all();

        if (!$buku) {
            return response()->json(['success' => false, 'msg' => 'Buku tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'msg' => 'Detail Buku', 'data' => $buku]);
    }

    public function detailBuku($id)
    {
        $buku = Buku::find($id);

        if ($buku) {
            return response()->json(['success' => true, 'data' => $buku]);
        } else {
            return response()->json(['success' => false, 'msg' => 'Buku tidak ditemukan.'], 404);
        }
    }

    public function tambahBuku(Request $request)
    {

        $request->validate([
            'stock' => 'required',
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'deskripsi' => 'required',
            'tahun_terbit' => 'required',
            'cover_buku' => 'image|mimes:jpeg,png,jpg'
        ]);

        if ($request->hasFile('cover_buku')) {
            // Store the file in the storage/app/public directory
            $cover_bukuPath = $request->file('cover_buku')->store('public/cover_bukus');

            // Get the public URL of the stored file
            $cover_bukuPath = url(Storage::url($cover_bukuPath));
        } else {
            // If no file is provided, set the default path to null or any default value you prefer
            $cover_bukuPath = null;
        }


        $tambahBuku = Buku::create([
            'stock' => $request->input('stock'),
            'judul' => $request->input('judul'),
            'penulis' => $request->input('penulis'),
            'penerbit' => $request->input('penerbit'),
            'deskripsi' => $request->input('deskripsi'),
            'id_kategori' => $request->input('id_kategori'),
            'tahun_terbit' => $request->input('tahun_terbit'),
            'cover_buku' =>  $cover_bukuPath,
        ]);

        return response()->json(['message' => 'buku created successfully', 'data' => $tambahBuku], 201);
    }

    public function editBuku($id, Request $request)
    {
        $dataBuku = Buku::find($id);

        if (empty($dataBuku)) {
            return response()->json([
                'status' => false,
                'message' => 'Data Buku Tidak Ditemukan',
            ], 404);
        }

        $rules = [
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'deskripsi' => 'required',
            'tahun_terbit' => 'required',
            'cover_buku' => 'image|mimes:jpeg,png,jpg'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data Gagal Diupdate',
                'data' => $validator->errors(),
            ]);
        }

        // Update the fields
        $dataBuku->judul = $request->input('judul');
        $dataBuku->penulis = $request->input('penulis');
        $dataBuku->penerbit = $request->input('penerbit');
        $dataBuku->deskripsi = $request->input('deskripsi');
        $dataBuku->tahun_terbit = $request->input('tahun_terbit');

        // Update cover image if provided
        if ($request->hasFile('cover_buku')) {
            $cover_bukuPath = $request->file('cover_buku')->store('public/cover_bukus');
            $dataBuku->cover_buku = url(Storage::url($cover_bukuPath));
        }

        // Save the updated book
        $dataBuku->save();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil Mengupdate Data Buku',
            'data' => $dataBuku,
        ]);
    }


    public function search(Request $request)
    {
        $query = $request->get('query');

        $buku = Buku::where('judul', 'like', "%$query%")
            ->orWhere('penulis', 'like', "%$query%")
            ->orWhere('penerbit', 'like', "%$query%")
            ->get();

        return response()->json(['message' => 'buku created successfully', 'searchBuku' => $buku], 201);
    }

    public function updateStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status_peminjaman' => 'required|in:disetujui,ditolak,dikembalikan,denda',
            // 'id_users' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        // Find the borrowing record
        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman) {
            return response()->json(['success' => false, 'msg' => 'Peminjaman tidak ditemukan'], 404);
        }

        // Check the current status and the requested status
        $currentStatus = $peminjaman->status_peminjaman;
        $newStatus = $request->status_peminjaman;

        // Update the status
        $peminjaman->update([
            'status_peminjaman' => $newStatus,
            // 'id_users' => $request->id_users,
        ]);

        // Update the book stock based on the status change
        if ($currentStatus !== $newStatus) {
            $buku = $peminjaman->book;

            if ($newStatus === 'disetujui') {
                // Decrease stock when the status changes to 'disetujui'
                $buku->decrement('stock');
            } elseif ($newStatus === 'dikembalikan') {
                // Increase stock when the status changes to 'dikembalikan'
                $buku->increment('stock');
            }
        }


        return response()->json([
            'success' => true,
            'msg' => 'Status Peminjaman Berhasil Diupdate',
            'peminjaman' => $peminjaman,
        ]);
    }

    public function tambahStokBuku(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jumlah_tambahan_stock' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        // Temukan buku berdasarkan ID
        $buku = Buku::find($id);

        if (!$buku) {
            return response()->json(['success' => false, 'msg' => 'Buku tidak ditemukan'], 404);
        }

        // Tambahkan stok buku
        $buku->increment('stock', $request->jumlah_tambahan_stock);

        return response()->json([
            'success' => true,
            'msg' => 'Stok Buku Berhasil Ditambahkan',
            'buku' => $buku,
        ]);
    }
}
