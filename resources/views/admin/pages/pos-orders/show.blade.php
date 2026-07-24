@extends('admin.layouts.app')

@push('title')
    <title>POS Order Details - #{{ $order->order_code }}</title>
@endpush

@section('index_content')
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>POS Order Details</h3>
            <div class="flex gap10">
                <a href="{{ route('pos-orders.print-invoice', $order->id) }}" target="_blank" class="btn btn-primary">
                    <i class="icon-printer"></i> Print Invoice
                </a>
                <a href="{{ route('pos-orders.index') }}" class="btn btn-secondary">Back to POS Orders</a>
            </div>
        </div>

        <div class="wg-box">
            <div class="flex items-center justify-between mb-10">
                <h4 class="body-title">Order Code: #{{ $order->order_code }}</h4>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Customer:</strong> {{ $order->customer->name ?? 'Walk-in Customer' }}</p>
                    <p><strong>Phone:</strong> {{ $order->customer->mobile ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6 text-right">
                    <p><strong>Payment Method:</strong> <span
                            class="badge bg-primary">{{ strtoupper($order->payment_method) }}</span></p>
                    <p><strong>Date:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
                </div>
            </div>

            <div class="wg-box mt-4">
                <h4 class="body-title mb-3">Purchased Items</h4>
                <div class="custom-table-wrapper" style="overflow-x: auto;">
                    <table class="custom-order-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>IMEI Numbers</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr>
                                    <td class="font-weight-bold">
                                        {{ $item->product->name }}
                                        @if($item->variant_id && $item->variant)
                                            <div class="text-muted font-weight-normal" style="font-size: 11px; margin-top: 2px;">
                                                Variant: {{ $item->variant->color }}{{ $item->variant->storage ? ' · ' . $item->variant->storage : '' }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @forelse($item->imeis as $imei)
                                            <span class="badge bg-success text-white">{{ $imei->imei_number }}</span>
                                        @empty
                                            <span class="text-muted">No IMEI</span>
                                        @endforelse
                                    </td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-right">Rs. {{ number_format($item->price, 2) }}</td>
                                    <td class="font-weight-bold text-right">Rs.
                                        {{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 text-right">
                    <p>Subtotal: Rs. {{ number_format($order->total_amount, 2) }}</p>
                    <h3 class="mb-3">Grand Total: Rs. {{ number_format($order->total_amount, 2) }}</h3>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Tracking Table Customization */
        .wg-box .table {
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        .wg-box .table thead th {
            background-color: #f8f9fa;
            border: none;
            font-size: 0.85rem;
            text-transform: uppercase;
            color: #6c757d;
            padding: 12px;
        }

        .wg-box .table tbody tr {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
        }

        .wg-box .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-top: none;
            border-bottom: none;
        }

        /* Form Styles inside table */
        .wg-box .form-control-sm {
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 5px 10px;
            font-size: 0.85rem;
        }

        .wg-box .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
        }

        .wg-box .flex.gap5 {
            display: flex;
            align-items: center;
            gap: 5px;
            min-width: 300px;
        }

        /* Badge Styles */
        .badge-status {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .badge-completed {
            background: #c6f6d5;
            color: #22543d;
        }

        .badge-processing {
            background: #bee3f8;
            color: #2a4365;
        }

        .badge-pending {
            background: #feebc8;
            color: #744210;
        }

        /* Input & Buttons */
        .custom-input {
            padding: 8px 12px;
            border: 1px solid #cbd5e0;
            border-radius: 6px;
            width: 100%;
            font-size: 0.95rem;
        }

        .action-group {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .custom-select {
            padding: 8px;
            border: 1px solid #cbd5e0;
            border-radius: 6px;
        }

        .custom-btn {
            padding: 8px 10px;
            background: #3182ce;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
        }

        .custom-btn:hover {
            background: #2b6cb0;
        }
    </style>
@endpush
