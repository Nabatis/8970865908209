<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Ulasan;

class ReviewController extends Controller
{
    /**
     * Store a newly created review in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'id_buku' => 'required|exists:buku,id',
            'id_users' => 'required|exists:users,id',
            'rating' => 'required|integer|between:1,5',
            'ulasan' => 'nullable|string',
        ]);

        // Create the review
        $data = Ulasan::create([
            'id_buku' => $request->id_buku,
            'id_users' => $request->id_users,
            'rating' => $request->rating,
            'ulasan' => $request->ulasan,
        ]);

        return response()->json(['success' => true, 'msg' => 'Review has been created successfully', 'review' => $data], 201);
    }

    public function getUlasan()
    {
        $ulasan = Ulasan::with('user')->get();

        return response()->json([
            'success' => true,
            'message' => 'Ulasan berhasil diambil',
            'ulasans' => $ulasan,
        ], 200);
    }

    public function getTotalRating($id_buku)
    {
        // Validate the book ID
        $exists = DB::table('buku')->where('id', $id_buku)->exists();
        if (!$exists) {
            return response()->json(['success' => false, 'message' => 'Book not found'], 404);
        }

        // Calculate the total rating for the book
        $totalRating = Ulasan::where('id_buku', $id_buku)->avg('rating');

        return response()->json([
            'success' => true,
            'message' => 'Total rating retrieved successfully',
            'total_rating' => $totalRating,
        ], 200);
    }

    public function destroy($id)
    {
        try {
            $ulasan = Ulasan::findOrFail($id);

            // You may add additional authorization checks here if needed, e.g., check if the authenticated user owns the review.

            $ulasan->delete();

            return response()->json(['success' => true, 'message' => 'Review deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete review', 'error' => $e->getMessage()], 500);
        }
    }
}
