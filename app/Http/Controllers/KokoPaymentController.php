<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;

class KokoPaymentController extends Controller
{
    public function handleResponse(Request $request)
    {
        $responseData = $request->all();
        Log::info('Koko Response:', $responseData);

        // Koko returns specific fields. Make sure to use orderId as in your request
        $orderCode = $responseData['orderId'] ?? null;
        $status = strtoupper($responseData['status'] ?? '');

        $order = Order::where('order_code', $orderCode)->first();
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        if ($status === 'SUCCESS') {
            if ($order->payment_status !== 'paid') {
                $order->update(['payment_status' => 'paid', 'order_status' => 'processing']);
                
                $order->load(['items.product', 'items.variant']);
                try {
                    Mail::to($order->email)->send(new OrderConfirmationMail($order));
                } catch (\Exception $mailEx) {
                    Log::error("Failed to send order confirmation email (Koko callback) for Order {$order->order_code}: " . $mailEx->getMessage());
                }
            }
        } else {
            $order->update(['payment_status' => 'failed']);
        }

        return response()->json(['status' => 'ok']);
    }
}
