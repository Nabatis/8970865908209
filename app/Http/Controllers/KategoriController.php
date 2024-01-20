<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return response()->json(['success' => true, 'data' => $kategori], 200);
    }

    public function show($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json(['success' => false, 'msg' => 'Kategori not found'], 404);
        }

        return response()->json(['success' => true, 'data' => $kategori], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $kategori = Kategori::create([
            'name' => $request->input('name'),
        ]);

        return response()->json(['msg' => 'Kategori created successfully', 'data' => $kategori], 201);
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json(['msg' => 'Kategori not found'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $kategori->update([
            'name' => $request->input('name'),
        ]);

        return response()->json(['msg' => 'Kategori updated successfully', 'data' => $kategori], 200);
    }

    public function destroy($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json(['msg' => 'Kategori not found'], 404);
        }

        $kategori->delete();

        return response()->json(['msg' => 'Kategori deleted successfully'], 200);
    }
}
