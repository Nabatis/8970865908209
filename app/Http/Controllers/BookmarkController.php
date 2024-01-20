<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function addToBookmark(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|exists:buku,id',
        ]);

        // Dapatkan pengguna yang terotentikasi dari permintaan
        $user = $request->user();

        // Pastikan bahwa pengguna terotentikasi sebelum melanjutkan
        if ($user) {
            $idBuku = $request->input('id_buku');

            // Periksa apakah buku sudah ada di bookmark
            if (!$user->bookmarks()->where('id_buku', $idBuku)->exists()) {
                $bookmark = new Bookmark([
                    'id_users' => $user->id,
                    'id_buku' => $idBuku,
                    'is_bookmarked' => true,
                ]);

                $bookmark->save();

                return response()->json(['message' => 'Buku berhasil ditambahkan ke bookmark'], 201);
            }

            return response()->json(['message' => 'Buku sudah ada di bookmark'], 400);
        }

        return response()->json(['message' => 'Pengguna tidak terotentikasi'], 401);
    }

    public function unbookmark(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|exists:buku,id',
        ]);

        $user = $request->user();

        if ($user) {
            $idBuku = $request->input('id_buku');

            // Hapus buku dari bookmark
            $user->bookmarks()->where('id_buku', $idBuku)->delete();

            return response()->json(['message' => 'Buku berhasil dihapus dari bookmark'], 200);
        }

        return response()->json(['message' => 'Pengguna tidak terotentikasi'], 401);
    }
}
