<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = setting('midtrans_server_key');
        Config::$isProduction = setting('midtrans_is_production') === 'true';
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }


    public function createTransaction(Request $request)
    {
        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . uniqid(),
                'gross_amount' => 100000,
            ],
            'customer_details' => [
                'first_name' => 'Budi',
                'email' => 'budi@email.com',
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json([
            'snap_token' => $snapToken
        ]);
    }
}
