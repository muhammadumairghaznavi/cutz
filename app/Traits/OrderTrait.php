<?php

namespace App\Traits;

use Exception;
use App\Delivery;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\CutzInvoiceConfirmation;

trait OrderTrait
{
    public function sendMailAfterCreateOrder($order)
    {
        try {
            Mail::to(['Callcenter@cutz.com.eg', $order->customer->email])->send(new CutzInvoiceConfirmation($order));
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }

        return true;
    }
}
