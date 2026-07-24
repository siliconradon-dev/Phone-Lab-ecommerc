<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f6f8; margin: 0; padding: 20px;">

    <div style="max-width: 600px; margin: auto; background: #ffffff; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #eef2f5;">
        
        <!-- Header -->
        <div style="background-color: #1a202c; padding: 30px; text-align: center; color: #ffffff;">
            @if (!empty($siteSettings['site_logo']))
                <img src="{{ asset($siteSettings['site_logo']) }}" alt="{{ $siteSettings['site_name'] ?? 'Logo' }}" style="max-height: 60px; margin-bottom: 10px;">
            @else
                <h2 style="margin: 0; font-size: 24px; font-weight: bold; letter-spacing: 1px;">
                    {{ $siteSettings['site_name'] ?? 'Megha Mobile' }}
                </h2>
            @endif
            <p style="margin: 5px 0 0 0; font-size: 14px; color: #a0aec0;">Order Placed Successfully!</p>
        </div>

        <div style="padding: 30px;">
            <!-- Greeting & Info -->
            <h3 style="color: #2d3748; margin-top: 0; font-size: 18px;">Hello {{ $order->full_name }},</h3>
            <p style="color: #4a5568; line-height: 1.6; font-size: 14px;">
                Thank you for your order! We are preparing it for delivery. Here are your order details and real-time tracking information.
            </p>

            <!-- Order Summary Cards -->
            <div style="background-color: #f7fafc; border-radius: 8px; padding: 20px; margin: 25px 0; border: 1px solid #edf2f7;">
                <h4 style="margin: 0 0 15px 0; color: #2d3748; font-size: 15px; border-bottom: 1px solid #edf2f7; padding-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Order Summary</h4>
                
                <table style="width: 100%; font-size: 13px; border-collapse: collapse; color: #4a5568;">
                    <tr>
                        <td style="padding: 6px 0; font-weight: bold; width: 40%;">Order Code:</td>
                        <td style="padding: 6px 0;">#{{ $order->order_code }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 6px 0; font-weight: bold;">Date:</td>
                        <td style="padding: 6px 0;">{{ $order->created_at->format('M d, Y h:i A') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 6px 0; font-weight: bold;">Payment Method:</td>
                        <td style="padding: 6px 0; text-transform: uppercase;">{{ $order->payment_method }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 6px 0; font-weight: bold;">Payment Status:</td>
                        <td style="padding: 6px 0;">
                            <span style="padding: 3px 8px; border-radius: 20px; font-weight: bold; font-size: 11px; {{ $order->payment_status === 'paid' ? 'background-color: #e6fffa; color: #234e52;' : 'background-color: #fff5f5; color: #9b2c2c;' }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Shipping Info Card -->
            <div style="background-color: #f7fafc; border-radius: 8px; padding: 20px; margin: 25px 0; border: 1px solid #edf2f7;">
                <h4 style="margin: 0 0 15px 0; color: #2d3748; font-size: 15px; border-bottom: 1px solid #edf2f7; padding-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Shipping Address</h4>
                <p style="margin: 0; font-size: 13px; color: #4a5568; line-height: 1.5;">
                    <strong>{{ $order->full_name }}</strong><br>
                    {{ $order->address }},<br>
                    {{ $order->city }}, {{ $order->district }} {{ $order->postcode }}<br>
                    Tel: {{ $order->phone }}
                </p>
            </div>

            <!-- Items Table -->
            <h4 style="color: #2d3748; font-size: 15px; margin: 25px 0 10px 0; text-transform: uppercase; letter-spacing: 0.5px;">Items Ordered</h4>
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 25px; font-size: 13px;">
                <thead>
                    <tr style="background-color: #edf2f7; border-bottom: 2px solid #cbd5e0;">
                        <th style="text-align: left; padding: 10px; color: #4a5568; font-weight: bold;">Item</th>
                        <th style="text-align: center; padding: 10px; color: #4a5568; font-weight: bold;">Qty</th>
                        <th style="text-align: right; padding: 10px; color: #4a5568; font-weight: bold;">Price (LKR)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr style="border-bottom: 1px solid #edf2f7;">
                            <td style="padding: 12px 10px; color: #2d3748;">
                                <div style="font-weight: bold;">{{ $item->product->name }}</div>
                                @if ($item->variant)
                                    <div style="font-size: 11px; color: #718096; margin-top: 2px;">
                                        Variant: {{ $item->variant->color }} - {{ $item->variant->storage }}
                                    </div>
                                @endif
                            </td>
                            <td style="text-align: center; padding: 12px 10px; color: #4a5568;">{{ $item->quantity }}</td>
                            <td style="text-align: right; padding: 12px 10px; color: #2d3748; font-weight: bold;">
                                {{ number_format($item->price, 2) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" style="text-align: right; padding: 15px 10px 0 10px; font-weight: bold; color: #4a5568; font-size: 14px;">Grand Total:</td>
                        <td style="text-align: right; padding: 15px 10px 0 10px; font-weight: bold; color: #2d3748; font-size: 16px;">
                            Rs. {{ number_format($order->total, 2) }}
                        </td>
                    </tr>
                </tfoot>
            </table>

            <!-- Track Button CTA -->
            <div style="text-align: center; margin: 35px 0 20px 0;">
                <p style="font-size: 13px; color: #718096; margin-bottom: 15px;">You can track the shipment status of your order anytime by clicking below:</p>
                <a href="{{ route('phone_lab.order_tracking', ['order_id' => $order->order_code, 'billing_email' => $order->email]) }}" 
                   style="display: inline-block; padding: 14px 30px; background-color: #3b82f6; color: #ffffff; text-decoration: none; font-weight: bold; border-radius: 6px; font-size: 14px; box-shadow: 0 4px 6px rgba(59, 130, 246, 0.2); transition: background-color 0.2s;">
                    Track My Order Status
                </a>
            </div>

        </div>

        <!-- Footer -->
        <div style="background-color: #f7fafc; padding: 20px; text-align: center; border-top: 1px solid #edf2f7; font-size: 12px; color: #a0aec0;">
            <p style="margin: 0 0 5px 0;">If you have any questions, please contact our support.</p>
            <p style="margin: 0;">&copy; {{ date('Y') }} {{ $siteSettings['site_name'] ?? 'Megha Mobile' }}. All rights reserved.</p>
        </div>

    </div>

</body>
</html>
