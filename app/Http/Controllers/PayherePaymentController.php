<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;

class PayherePaymentController extends Controller
{
    public function paymentNotify(Request $request)
    {
        // Validate fields
        $merchant_id = env('PAYHERE_MERCHANT_ID');
        $merchant_secret = strtoupper(md5(env('PAYHERE_MERCHANT_SECRET')));

        $order_id = $request->order_id;
        $payhere_amount = $request->payhere_amount;
        $payhere_currency = $request->payhere_currency;
        $status = $request->status_code;
        $received_md5sig = $request->md5sig;

        $local_md5sig = strtoupper(md5($merchant_id . $order_id . $payhere_amount . $payhere_currency . $status . $merchant_secret));

        if ($received_md5sig !== $local_md5sig) {
            Log::error("PayHere Signature Mismatch for Order: {$order_id}");
            return response('Signature mismatch', 400);
        }

        $order = Order::where('order_code', $order_id)->first();
        if (!$order)
            return response('Order not found', 404);

        if ((int) $status === 2) {
            if ($order->payment_status !== 'paid') {
                $order->update(['payment_status' => 'paid', 'order_status' => 'processing']);
                
                $order->load(['items.product', 'items.variant']);
                try {
                    Mail::to($order->email)->send(new OrderConfirmationMail($order));
                } catch (\Exception $mailEx) {
                    Log::error("Failed to send order confirmation email (PayHere callback) for Order {$order->order_code}: " . $mailEx->getMessage());
                }
            }
        } else {
            $order->update(['payment_status' => 'failed']);
        }

        return response('OK', 200);
    }
}
