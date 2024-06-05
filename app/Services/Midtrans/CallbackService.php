<?php

namespace App\Services\Midtrans;

use App\Models\Order;
use App\Services\Midtrans\Midtrans;
use Illuminate\Support\Facades\Log;

class CallbackService extends Midtrans
{

    protected $notification;
    protected $order;
    protected $serverKey;
    protected $request;
    public function __construct($request)
    {
        parent::__construct();

        $this->serverKey = config('midtrans.server_key');
        $this->_handleNotification($request);
    }

    public function isSignatureKeyVerified()
    {
        return ($this->_createLocalSignatureKey() == $this->notification['signature_key']);
    }

    public function isSuccess()
    {
        $statusCode = $this->notification['status_code'];
        $transactionStatus = $this->notification['transaction_status'];
        $fraudStatus = !empty($this->notification['fraud_status']) ? ($this->notification['fraud_status'] == 'accept') : true;

        return ($statusCode == 200 && $fraudStatus && ($transactionStatus == 'capture' || $transactionStatus == 'settlement'));
    }

    public function isExpire()
    {
        return ($this->notification['transaction_status'] == 'Kaldaluarsa');
    }

    public function isCancelled()
    {
        return ($this->notification['transaction_status'] == 'Dibatalkan');
    }

    public function getNotification()
    {
        return $this->notification;
    }

    public function getOrder()
    {
        return $this->order;
    }

    protected function _createLocalSignatureKey()
    {
        return hash('sha512', $this->notification['order_id'] . $this->notification['status_code'] . $this->notification['gross_amount'] . $this->serverKey);
    }

    protected function _handleNotification($request)
    {
        try {
            $notification  = $request;
            $orderNumber = $notification['order_id'];
            $order = Order::where('id', $orderNumber)->first();

            $this->notification = $notification;
            $this->order = $order;
        } catch (\Exception $e) {
            Log::channel('custom')->info(json_encode($e->getMessage()));
        }
    }
}
