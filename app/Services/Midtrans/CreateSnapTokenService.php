<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;
use App\Models\OrdersProduct;

class CreateSnapTokenService extends Midtrans
{
    protected $order;

    public function __construct($order)
    {
        parent::__construct();

        $this->order = $order;
    }

    public function getSnapToken()
    {
        $item_details = OrdersProduct::with('product')
            ->where('order_id', $this->order->id) // Ambil item berdasarkan order_id
            ->get();

        $details = [];
        foreach ($item_details as $item) {
            $details[] = [
                'id' => $item->product_id, // ID produk
                'price' => round($item->product_price), // Harga produk dibulatkan
                'quantity' => $item->product_qty, // Kuantitas produk
                'name' => $item->product->product_name // Nama produk dari relasi product
            ];
        }

        $transactionDetails = [
            'transaction_details' => [
                'order_id' => $this->generateRandomString(10) . "-" . $this->order->id,
                'gross_amount' => round($this->order->grand_total),
            ],
            'item_details' => $details,
            'customer_details' => [
                'first_name' => $this->order->name,
                'email' => $this->order->email,
                'phone' => $this->order->phone
            ]
        ];

        $transactionDetails['item_details'][] = [
            'id' => 'shipping',
            'price' => $this->order->shipping_charges,
            'quantity' => 1,
            'name' => 'Shipping Charges',
        ];

        $snapToken = Snap::getSnapToken($transactionDetails);

        return $snapToken;
    }

    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
