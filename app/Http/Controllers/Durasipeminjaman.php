<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\durasipinjam;
use Illuminate\Http\Request;

class Durasipeminjaman extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'durasi_hari' => 'required|integer|min:1',
        ]);

        $durasiPeminjaman = durasipinjam::create([
            'durasi_hari' => $request->input('durasi_hari'),
        ]);

        return response()->json(['message' => 'Durasi peminjaman berhasil ditambahkan', 'data' => $durasiPeminjaman], 201);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'durasi_hari' => 'required|integer|min:1',
        ]);

        $durasiPeminjaman = durasipinjam::findOrFail($id);
        $durasiPeminjaman->durasi_hari = $request->input('durasi_hari');
        $durasiPeminjaman->save();

        return response()->json(['message' => 'Durasi peminjaman berhasil diperbarui', 'data' => $durasiPeminjaman], 200);
    }
}
