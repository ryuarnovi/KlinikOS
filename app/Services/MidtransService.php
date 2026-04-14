<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');
    }

    public function getSnapToken($order)
    {
        $params = [
            'transaction_details' => [
                'order_id' => $order->invoice_no,
                'gross_amount' => (int) $order->total,
            ],
            'customer_details' => [
                'first_name' => $order->prescription->patient_name ?? 'Guest',
                'email' => auth()->user()->email,
            ],
        ];

        return Snap::getSnapToken($params);
    }
}
