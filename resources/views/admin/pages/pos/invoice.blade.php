<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice {{ $order->order_code }}</title>
    <style>
        @page {
            size: A5;
            margin: 10mm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Helvetica, Arial, sans-serif;
            font-size: 11px;
            color: #2b2b2b;
            margin: 0;
            background: #f4f5f7;
        }

        .page {
            width: 148mm;
            min-height: 210mm;
            margin: 0 auto;
            background: #ffffff;
            padding: 8mm;
        }

        /* ---------- Print bar (hidden when printing) ---------- */
        .print-bar {
            max-width: 148mm;
            margin: 10px auto;
            display: flex;
            justify-content: flex-end;
        }

        .print-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #1d11fc;
            color: #fff;
            border: none;
            padding: 9px 18px;
            font-size: 13px;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(70, 107, 229, 0.35);
            transition: background 0.15s ease, transform 0.1s ease;
        }

        .print-btn:hover {
            background: #1942fa;
        }

        .print-btn:active {
            transform: scale(0.97);
        }

        .print-btn svg {
            width: 16px;
            height: 16px;
            fill: currentColor;
        }

        /* ---------- Header ---------- */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #1f13ff;
            padding-bottom: 8px;
            margin-bottom: 10px;
        }

        .logo {
            height: 42px;
            margin-bottom: 4px;
        }

        .shop-name {
            font-size: 17px;
            font-weight: 700;
            color: #1f1f1f;
            margin: 0;
            letter-spacing: 0.3px;
        }

        .shop-meta {
            font-size: 9.5px;
            color: #666;
            margin: 1px 0;
        }

        .invoice-tag {
            text-align: right;
        }

        .invoice-tag .label {
            font-size: 18px;
            font-weight: 700;
            color: #372df9;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0;
        }

        .invoice-tag .code {
            font-size: 11px;
            color: #555;
            margin-top: 2px;
        }

        /* ---------- Info cards ---------- */
        .info-grid {
            display: flex;
            gap: 8px;
            margin-bottom: 12px;
        }

        .info-card {
            flex: 1;
            background: #f8f8fc;
            border: 1px solid #e7e7f1;
            border-radius: 6px;
            padding: 8px 10px;
        }

        .info-card h4 {
            margin: 0 0 5px 0;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #414bd7;
            font-weight: 700;
        }

        .info-card p {
            margin: 2px 0;
            font-size: 10.5px;
            color: #333;
        }

        .info-card p strong {
            color: #777;
            font-weight: 600;
        }

        /* ---------- Items table ---------- */
        .item-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 4px;
        }

        .item-table thead th {
            background: #464be5;
            color: #fff;
            font-size: 9.5px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            padding: 7px 6px;
            text-align: left;
        }

        .item-table thead th:first-child {
            border-radius: 5px 0 0 0;
        }

        .item-table thead th:last-child {
            border-radius: 0 5px 0 0;
            text-align: right;
        }

        .item-table tbody td {
            padding: 7px 6px;
            border-bottom: 1px solid #eee;
            font-size: 10.5px;
            vertical-align: top;
        }

        .item-table tbody tr:nth-child(even) {
            background: #fafafe;
        }

        .item-table td.num,
        .item-table th.num {
            text-align: center;
        }

        .item-table td.amt,
        .item-table th.amt {
            text-align: right;
        }

        .item-name {
            font-weight: 600;
            color: #1f1f1f;
        }

        .imei-line {
            font-size: 8.5px;
            color: #888;
            margin-top: 2px;
        }

        .warranty-line {
            font-size: 8.5px;
            color: #d23838;
            font-weight: 700;
            margin-top: 2px;
        }

        .discount-line {
            font-size: 8.5px;
            color: #1a9e4c;
            font-weight: 700;
            margin-top: 2px;
        }

        .strike {
            text-decoration: line-through;
            color: #999;
            font-weight: 400;
            margin-right: 4px;
        }

        /* ---------- Totals ---------- */
        .totals-wrap {
            margin-top: 12px;
            display: flex;
            justify-content: flex-end;
        }

        .totals-box {
            width: 62%;
            background: #f8f8fc;
            border: 1px solid #e7e7f1;
            border-radius: 6px;
            padding: 10px 12px;
        }

        .totals-row {
            display: flex;
            justify-content: space-between;
            padding: 3px 0;
            font-size: 10.5px;
            color: #444;
        }

        .totals-row.discount span:last-child {
            color: #1a9e4c;
            font-weight: 700;
        }

        .totals-row.grand {
            border-top: 1.5px solid #4653e5;
            margin-top: 6px;
            padding-top: 7px;
            font-size: 13px;
            font-weight: 700;
            color: #1f1f1f;
        }

        .totals-row .label {
            color: #777;
        }

        .payment-method {
            margin-top: 10px;
            font-size: 10px;
            color: #555;
        }

        .payment-method strong {
            color: #4666e5;
        }

        /* ---------- Footer notes ---------- */
        .notes {
            margin-top: 16px;
            font-size: 9.5px;
            color: #555;
        }

        .notes p {
            margin: 4px 0;
            border-bottom: 1px dotted #ccc;
            padding-bottom: 3px;
        }

        .thank-you {
            text-align: center;
            margin-top: 18px;
            padding-top: 10px;
            border-top: 1px dashed #ccc;
            font-style: italic;
            color: #4651e5;
            font-size: 11px;
            font-weight: 600;
        }

        /* ---------- Print rules ---------- */
        @media print {
            body {
                background: #fff;
            }

            .print-bar {
                display: none !important;
            }

            .page {
                box-shadow: none;
                margin: 0;
                padding: 0;
                width: auto;
                min-height: auto;
            }
        }

        @media screen {
            .page {
                box-shadow: 0 4px 18px rgba(0, 0, 0, 0.08);
                border-radius: 6px;
                margin-bottom: 30px;
            }
        }
    </style>
</head>

<body>

    <!-- Print button (hidden on print) -->
    <div class="print-bar">
        <button class="print-btn" onclick="window.print()">
            <svg viewBox="0 0 24 24"><path d="M19 8H5c-1.66 0-3 1.34-3 3v6h4v4h12v-4h4v-6c0-1.66-1.34-3-3-3zm-3 11H8v-5h8v5zm3-7c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm-1-9H6v4h12V3z"/></svg>
            Print Invoice
        </button>
    </div>

    <div class="page">

        <!-- Header -->
        <div class="header">
            <div>
                @if (!empty($siteSettings['site_logo']))
                    <img src="{{ asset($siteSettings['site_logo']) }}" class="logo">
                @else
                    <img src="" style="display: none">
                @endif
                <p class="shop-name">{{ $siteSettings['site_name'] ?? 'MOBILE SHOP' }}</p>
                <p class="shop-meta">{{ $siteSettings['site_address'] ?? '' }}</p>
                <p class="shop-meta">Tel: {{ $siteSettings['site_phone'] ?? '' }}</p>
            </div>
            <div class="invoice-tag">
                <p class="label">Invoice</p>
                <p class="code">{{ $order->order_code }}</p>
                <p class="code">{{ $order->created_at->format('Y-m-d') }}</p>
            </div>
        </div>

        <!-- Info cards -->
        <div class="info-grid">
            <div class="info-card">
                <h4>Billed To</h4>
                <p><strong>Name:</strong> {{ $order->customer->name ?? '' }}</p>
                <p><strong>Phone:</strong> {{ $order->customer->mobile ?? '' }}</p>
                @if (!empty($order->customer->email))
                    <p><strong>Email:</strong> {{ $order->customer->email }}</p>
                @endif
                @if (!empty($order->customer->nic))
                    <p><strong>NIC:</strong> {{ $order->customer->nic }}</p>
                @endif
                @if (!empty($order->customer->address))
                    <p><strong>Address:</strong> {{ $order->customer->address }}</p>
                @endif
            </div>
            <div class="info-card">
                <h4>Invoice Details</h4>
                <p><strong>Invoice No:</strong> {{ $order->order_code }}</p>
                <p><strong>Order Date:</strong> {{ $order->created_at->format('Y-m-d h:i A') }}</p>
                <p><strong>Cashier ID:</strong> {{ $order->cashier_id }}</p>
                <p><strong>Payment:</strong> {{ ucfirst($order->payment_method) }}</p>
            </div>
        </div>

        <!-- Items -->
        <table class="item-table">
            <thead>
                <tr>
                    <th class="num">#</th>
                    <th>Item</th>
                    <th class="num">Qty</th>
                    <th class="amt">Price</th>
                    <th class="amt">Amount</th>
                </tr>
            </thead>
            <tbody>
               
                @foreach ($order->items as $index => $item)
              
                    @php
                        $lineSubtotal = $item->price;
                        $itemDiscountAmount = 0;

                        if ($item->discount_type === 'fixed') {
                            $itemDiscountAmount = $item->discount_value;
                            $lineSubtotal = $item->price + $item->discount_value;
                        } elseif ($item->discount_type === 'percent') {
                            if ($item->discount_value < 100) {
                                $lineSubtotal = $item->price / (1 - ($item->discount_value / 100));
                            } else {
                                $lineSubtotal = $item->product
                                    ? ($item->product->has_variants && $item->variant_id && $item->product->variants->where('id', $item->variant_id)->first()
                                        ? $item->product->variants->where('id', $item->variant_id)->first()->price
                                        : $item->product->base_price)
                                    : 0;
                            }
                            $itemDiscountAmount = $lineSubtotal * ($item->discount_value / 100);
                        }
                    @endphp
                    <tr>
                        <td class="num">{{ $index + 1 }}</td>
                        <td>
                            <div class="item-name">{{ $item->product->name ?? '' }}</div>
                            @if ($item->variant_id && $item->variant)
                                <div class="imei-line">Variant: {{ $item->variant->color }}{{ $item->variant->storage ? ' · ' . $item->variant->storage : '' }}</div>
                            @endif
                            @if (!empty($item->product->brand))
                                <div class="imei-line">Brand: {{ is_object($item->product->brand) ? $item->product->brand->name : $item->product->brand }}</div>
                            @endif
                            @foreach ($item->imeis as $imei)
                                <div class="imei-line">IMEI: {{ $imei->imei_number }}</div>
                            @endforeach
                            @if ($item->product->has_warranty ?? false)
                                <div class="warranty-line">Warranty: {{ $item->product->warranty_period }}</div>
                            @endif
                            @if ($itemDiscountAmount > 0)
                                <div class="discount-line">
                                    Discount:
                                 
                                    @if ($item->discount_type === 'percent')
                                        {{ rtrim(rtrim(number_format($item->discount_value, 2), '0'), '.') }}%
                                        
                                    @else
                                        Rs. {{ number_format($itemDiscountAmount, 2) }}
                                    @endif
                                </div>
                            @endif
                        </td>
                        <td class="num">{{ $item->quantity }}</td>
                    
                        <td class="amt">Rs. {{ number_format($lineSubtotal, 2) }}</td>
                        <td class="amt">
                            @if ($itemDiscountAmount > 0)
                                <span class="strike">Rs. {{ number_format($lineSubtotal, 2) }}</span><br>
                            @endif
                            Rs. {{ number_format($item->line_total, 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals -->
        <div class="totals-wrap">
            <div class="totals-box">
                <div class="totals-row">
                    <span class="label">Sub Total</span>
                    <span>Rs. {{ number_format($order->subtotal, 2) }}</span>
                </div>

                @if ($order->bill_discount_amount > 0)
                    <div class="totals-row discount">
                        <span class="label">
                            Bill Discount
                            @if ($order->bill_discount_type === 'percent')
                                ({{ rtrim(rtrim(number_format($order->bill_discount_value, 2), '0'), '.') }}%)
                            @endif
                        </span>
                        <span>- Rs. {{ number_format($order->bill_discount_amount, 2) }}</span>
                    </div>
                @endif

                <div class="totals-row grand">
                    <span>Grand Total</span>
                    <span>Rs. {{ number_format($order->total_amount, 2) }}</span>
                </div>

                <div class="totals-row">
                    <span class="label">Paid Amount</span>
                    <span>Rs. {{ number_format($order->paid_amount, 2) }}</span>
                </div>
                <div class="totals-row">
                    <span class="label">Balance</span>
                    <span>Rs. {{ number_format($order->balance_amount, 2) }}</span>
                </div>

                <div class="payment-method">
                    Paid via <strong>{{ ucfirst($order->payment_method) }}</strong>
                </div>
            </div>
        </div>

        <!-- Notes -->
        <div class="notes">
            <p><strong>Description:</strong> &nbsp;</p>
        </div>

        <div class="thank-you">
            Thank You for your Business! Please visit us again.
        </div>
    </div>

    <script>
        // Optional: auto-trigger print dialog when page is opened with ?autoprint=1
        (function () {
            var params = new URLSearchParams(window.location.search);
            if (params.get('autoprint') === '1') {
                window.addEventListener('load', function () {
                    window.print();
                });
            }
        })();
    </script>

</body>

</html>