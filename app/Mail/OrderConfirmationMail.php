<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use App\Models\Setting;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $siteSettings = Cache::remember('site_settings', 3600, function () {
            return Setting::pluck('value', 'key')->toArray();
        });

        $subject = 'Order Confirmation - #' . $this->order->order_code;
        if (!empty($siteSettings['site_name'])) {
            $subject .= ' | ' . $siteSettings['site_name'];
        }

        return $this->subject($subject)
            ->view('emails.order-confirmation')
            ->with([
                'order' => $this->order,
                'siteSettings' => $siteSettings,
            ]);
    }
}
