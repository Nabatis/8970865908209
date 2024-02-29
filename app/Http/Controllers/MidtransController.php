<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Denda;
use App\Models\User;
use Midtrans\Config;
use Midtrans\Snap;

\Midtrans\Config::$serverKey = 'SB-Mid-server-DdInDX4kQo4McLgxvo_E5ojp';

\Midtrans\Config::$isProduction = false;

\Midtrans\Config::$isSanitized = true;

\Midtrans\Config::$is3ds = true;


class MidtransController extends Controller
{
    public function startPayment(Request $request)
    {
        $data = $request->post();

        // Ambil data denda terbaru dari database
        $latestDenda = Denda::latest()->first();
        $jumlahDenda = $latestDenda->jumlah;

        // Ambil data user berdasarkan id_user dari model user
        $idUser = $latestDenda->id_user;
        $user = User::find($idUser);

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $jumlahDenda, // Menggunakan jumlah denda dari database
            ),
            'customer_details' => array(
                'first_name' => $user->name, // Menggunakan nama user dari model user
                'email' => $user->email, // Menggunakan email user dari model user
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $opr['snapToken'] = $snapToken;
        $opr['data'] = $data;
        return response()->json($opr);
    }
}
