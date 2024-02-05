<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\peminjaman;
use Illuminate\Support\Facades\Validator;
use App\Models\Denda;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DendaController extends Controller
{
    public function index()
    {
        $denda = Denda::all();

        if ($denda->isEmpty()) {
            return response()->json(['success' => true, 'false' => 'Tidak ada data denda'], 404);
        }
        return response()->json(['success' => true, 'data' => $denda]);
    }

    public function show($id)
    {
        $denda = Denda::find($id);

        if (!$denda) {
            return response()->json(['success' => false, 'msg' => 'Denda tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => $denda]);
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

    public function update(Request $request, $id)
    {
        $denda = Denda::find($id);

        if (!$denda) {
            return response()->json(['success' => false, 'msg' => 'Denda tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_peminjaman' => 'exists:peminjaman,id',
            'id_user' => 'exists:users,id',
            'tgl_pembayaran' => 'nullable|date',
            'status_pembayaran' => 'in:belum_dibayar,sudah_dibayar',
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

    public function hitungDenda($id_peminjaman)
    {
        $denda = Denda::where('id_peminjaman', $id_peminjaman)->first();

        if (!$denda) {
            return response()->json(['success' => false, 'msg' => 'Denda tidak ditemukan'], 404);
        }

        if ($denda->status_pembayaran === 'belum_dibayar') {
            $peminjaman = $denda->peminjaman;
            $tglPengembalian = Carbon::parse($peminjaman->tgl_pengembalian);
            $tglKembali = Carbon::now();
            $selisihHari = $tglKembali->diffInDays($tglPengembalian);
            $dendaAmount = $selisihHari * 2000; // Denda 2000 per hari keterlambatan

            return response()->json(['success' => true, 'denda' => $dendaAmount]);
        }

        return response()->json(['success' => false, 'msg' => 'Denda sudah dibayar']);
    }
}
