<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Ulasan;
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

        // Validasi apakah buku sedang dipinjam oleh pengguna yang sama
        $existingPeminjaman = Peminjaman::where('id_buku', $request->id_buku)
            ->where('id_users', $request->id_users)
            ->where('status_peminjaman', '!=', 'dikembalikan')
            ->first();

        if ($existingPeminjaman) {
            return response()->json(['success' => false, 'msg' => 'Anda sudah meminjam buku ini dan belum mengembalikannya'], 400);
        }

        // Membuat peminjaman baru
        $peminjaman = Peminjaman::create([
            'id_buku' => $request->id_buku,
            'id_users' => $request->id_users,
            'tgl_peminjaman' => $request->tgl_peminjaman,
            'tgl_pengembalian' => $request->tgl_pengembalian,
            'status_peminjaman' => 'tertunda',
        ]);

        // Update stok buku jika peminjaman disetujui
        if ($peminjaman->status_peminjaman === 'disetujui') {
            $buku->decrement('stock');
        }

        return response()->json([
            'success' => true,
            'msg' => 'Pinjam Berhasil',
            'peminjaman' => $peminjaman,
        ]);
    }

    public function getTotalRatingAllBook()
    {
        // Get all books
        $books = Buku::orderBy('created_at', 'desc')->get();

        // Check if there are any books
        if ($books->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No books found'], 404);
        }

        $totalRatings = [];

        // Loop through each book to calculate total rating
        foreach ($books as $book) {
            $totalRating = Ulasan::where('id_buku', $book->id)->avg('rating');

            $formattedRating = number_format($totalRating, 1, '.', '');

            $totalRatings[] = [
                'book_id' => $book->id,
                'total_rating' => $formattedRating,
            ];
        }

        return response()->json([
            'success' => true,
            'message' => 'Total ratings for all books retrieved successfully',
            'total_ratings' => $totalRatings,
        ], 200);
    }

    public function getBuku()
    {
        $buku = Buku::orderBy('created_at', 'desc')->get();

        if ($buku->isEmpty()) {
            return response()->json(['success' => false, 'msg' => 'Buku tidak ditemukan'], 404);
        }

        // Get total ratings for all books
        $totalRatingsResponse = $this->getTotalRatingAllBook();

        // Check if total ratings retrieval was successful
        if ($totalRatingsResponse->getStatusCode() == 200) {
            $totalRatingsData = json_decode($totalRatingsResponse->getContent(), true);
            $totalRatings = $totalRatingsData['total_ratings'];
        } else {
            // If there's an error in getting total ratings, set it to an empty array
            $totalRatings = [];
        }

        // Merge total ratings with the book data
        foreach ($buku as $key => $book) {
            $buku[$key]['total_rating'] = $totalRatings[$key]['total_rating'] ?? null;
        }

        return response()->json([
            'success' => true,
            'msg' => 'Detail Buku',
            'data' => $buku,
        ]);
    }

    public function getBukuHighRating()
    {
        // Dapatkan buku yang diurutkan berdasarkan tanggal pembuatan
        $buku = Buku::orderBy('created_at', 'desc')->get();

        if ($buku->isEmpty()) {
            return response()->json(['success' => false, 'msg' => 'Buku tidak ditemukan'], 404);
        }

        // Dapatkan total rating untuk semua buku
        $totalRatingsResponse = $this->getTotalRatingAllBook();

        // Periksa apakah pengambilan total rating berhasil
        if ($totalRatingsResponse->getStatusCode() == 200) {
            $totalRatingsData = json_decode($totalRatingsResponse->getContent(), true);
            $totalRatings = $totalRatingsData['total_ratings'];
        } else {
            // Jika ada kesalahan dalam mendapatkan total rating, atur menjadi array kosong
            $totalRatings = [];
        }

        // Gabungkan buku dengan total rating
        $bukuDenganTotalRating = [];
        foreach ($buku as $key => $book) {
            $totalRating = $totalRatings[$key]['total_rating'] ?? null;
            $bukuDenganTotalRating[] = [
                'id' => $book->id,
                'cover_buku' => $book->cover_buku,
                'judul' => $book->judul,
                'penulis' => $book->penulis,
                'tanggal_pembuatan' => $book->created_at,
                'total_rating' => $totalRating,
            ];
        }

        // Urutkan buku berdasarkan total rating secara menurun
        usort($bukuDenganTotalRating, function ($a, $b) {
            return $b['total_rating'] <=> $a['total_rating'];
        });

        return response()->json([
            'success' => true,
            'msg' => 'Detail Buku',
            'data' => $bukuDenganTotalRating,
        ]);
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
            'judul' => 'string|max:255',
            'penulis' => 'string|max:255',
            'penerbit' => 'string|max:255',
            'deskripsi' => '',
            'tahun_terbit' => '',
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
        $dataBuku->id_kategori = $request->input('id_kategori');

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

    function deleteBuku($id)
    {
        $buku = Buku::find($id);

        if (!$buku) {
            return response()->json(['success' => false, 'msg' => 'Book not found!']);
        }

        try {
            $buku->delete();
            return response()->json(['success' => true, 'msg' => 'Book deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }
}
