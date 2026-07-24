@extends('admin.layouts.app')

@push('title')
    <title>Order Details</title>
@endpush

@section('index_content')
    <div class="main-content-wrap">

        {{-- Page header --}}
        <div class="od-page-header">
            <div>
                <h3 class="od-page-title">Order details</h3>
                <nav class="od-breadcrumb">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <i class="icon-chevron-right"></i>
                    <a href="{{ route('orders.index') }}">Orders</a>
                    <i class="icon-chevron-right"></i>
                    <span>#{{ $order->order_code }}</span>
                </nav>
            </div>
            <a href="{{ route('orders.index') }}" class="od-btn od-btn-ghost">
                <i class="icon-arrow-left"></i> Back to orders
            </a>
        </div>

        {{-- ── Customer info & payment status ── --}}
        <div class="od-card od-info-grid">

            {{-- Left: customer details --}}
            <div class="od-info-col">
                <div class="od-col-eyebrow">Customer</div>
                <div class="od-info-row">
                    <span class="od-info-key">Name</span>
                    <span class="od-info-val">{{ $order->full_name }}</span>
                </div>
                <div class="od-info-row">
                    <span class="od-info-key">Email</span>
                    <span class="od-info-val od-link">{{ $order->email }}</span>
                </div>
                <div class="od-info-row">
                    <span class="od-info-key">Phone</span>
                    <span class="od-info-val">{{ $order->phone }}</span>
                </div>
                <div class="od-info-row">
                    <span class="od-info-key">Address</span>
                    <span class="od-info-val">{{ $order->address }}</span>
                </div>
                <div class="od-info-row">
                    <span class="od-info-key">City</span>
                    <span class="od-info-val">{{ $order->city }}</span>
                </div>
                <div class="od-info-row">
                    <span class="od-info-key">Postal code</span>
                    <span class="od-info-val">{{ $order->postal_code }}</span>
                </div>
            </div>

            {{-- Right: payment & status --}}
            <div class="od-info-col od-info-col-right">
                <div class="od-col-eyebrow">Payment &amp; status</div>

                <div class="od-info-row od-info-row-middle">
                    <span class="od-info-key">Method</span>
                    <span class="od-pill od-pill-blue">{{ strtoupper($order->payment_method) }}</span>
                    @if ($order->payment_method === 'cash' && $order->payment_status !== 'paid')
                        <form action="{{ route('orders.updatePaymentStatus', $order->id) }}" method="POST" style="margin:0">
                            @csrf
                            <button type="submit" class="od-mark-paid-btn">Mark as paid</button>
                        </form>
                    @endif
                </div>

                <div class="od-info-row od-info-row-middle">
                    <span class="od-info-key">Payment</span>
                    <span class="od-pill {{ $order->payment_status === 'paid' ? 'od-pill-green' : 'od-pill-red' }}">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </div>

                <div class="od-info-row od-info-row-middle">
                    <span class="od-info-key">Order</span>
                    <span class="od-pill {{ $order->order_status === 'completed' ? 'od-pill-green' : 'od-pill-amber' }}">
                        {{ ucfirst($order->order_status) }}
                    </span>
                </div>
            </div>
        </div>

        {{-- ── Order items + complete form ── --}}
        <form action="{{ route('orders.complete', $order->id) }}" method="POST">
            @csrf
            <div class="od-card od-mt">
                <div class="od-card-header">
                    <span class="od-card-title">Order items</span>
                </div>

                <div class="od-table-wrap">
                    <table class="od-table">
                        <thead>
                            <tr>
                                <th style="width:30%">Product</th>
                                <th style="width:15%">Variant</th>
                                <th style="width:25%">IMEI selection</th>
                                <th class="od-tc" style="width:8%">Qty</th>
                                <th class="od-tr" style="width:11%">Unit price (LKR)</th>
                                <th class="od-tr" style="width:11%">Subtotal (LKR)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr>
                                    <td class="od-fw">{{ $item->product->name }}</td>
                                    <td>
                                        @if ($item->variant)
                                            <span class="od-variant-pill">
                                                {{ $item->variant->color }} · {{ $item->variant->storage }}
                                            </span>
                                        @else
                                            <span class="od-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $availableImeis = \App\Models\ProductImei::where('product_id', $item->product_id)
                                                ->where('status', 'available')
                                                ->get();
                                        @endphp

                                        @if ($availableImeis->isNotEmpty())
                                            <select class="imei-select" data-item-id="{{ $item->id }}" style="width:100%">
                                                <option value="">Search IMEI...</option>
                                                @foreach ($availableImeis as $imei)
                                                    <option value="{{ $imei->id }}">{{ $imei->imei_number }}</option>
                                                @endforeach
                                            </select>
                                            <div id="imei-preview-{{ $item->id }}" class="od-imei-preview"></div>
                                        @else
                                            <span class="od-muted">No IMEI required</span>
                                        @endif
                                    </td>
                                    <td class="od-tc">{{ $item->quantity }}</td>
                                    <td class="od-tr">{{ number_format($item->unit_price, 2) }}</td>
                                    <td class="od-tr od-fw">{{ number_format($item->price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="od-total-row">
                    <span class="od-total-label">Grand total</span>
                    <span class="od-total-amount">Rs. {{ number_format($order->total, 2) }}</span>
                    @if ($order->order_status !== 'completed')
                        <button type="button" class="od-btn od-btn-success complete-order-btn">
                            <i class="icon-check"></i> Confirm &amp; complete order
                        </button>
                    @endif
                </div>
            </div>
        </form>

        {{-- ── Order tracking ── --}}
        <form action="{{ route('orders.updateTracking', $order->id) }}" method="POST">
            @csrf
            <div class="od-card od-mt">
                <div class="od-card-header">
                    <span class="od-card-title">Order tracking</span>
                    <button type="submit" class="od-btn od-btn-primary od-btn-sm">
                        <i class="icon-refresh-cw"></i> Update tracking
                    </button>
                </div>

                <div class="od-table-wrap">
                    <table class="od-table">
                        <thead>
                            <tr>
                                <th style="width:25%">Stage</th>
                                <th style="width:18%">Current status</th>
                                <th style="width:30%">Tracking number</th>
                                <th style="width:27%">Update status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderProcesses as $process)
                                <tr>
                                    <td class="od-fw">{{ $process->stage->name ?? 'N/A' }}</td>
                                    <td>
                                        <span class="od-status-badge od-status-{{ $process->status }}">
                                            {{ ucfirst($process->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <input type="text"
                                            name="processes[{{ $process->id }}][tracking_number]"
                                            value="{{ $process->tracking_number }}"
                                            placeholder="Enter tracking #"
                                            class="od-input">
                                    </td>
                                    <td>
                                        <select name="processes[{{ $process->id }}][status]" class="od-select">
                                            <option value="pending"    {{ $process->status == 'pending'    ? 'selected' : '' }}>Pending</option>
                                            <option value="processing" {{ $process->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="completed"  {{ $process->status == 'completed'  ? 'selected' : '' }}>Completed</option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </form>

    </div>
@endsection

@push('styles')
<style>
/* ── Layout ── */
.od-page-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 1.5rem;
}
.od-page-title {
    font-size: 18px;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 4px;
}
.od-breadcrumb {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: #94a3b8;
}
.od-breadcrumb a { color: #94a3b8; text-decoration: none; }
.od-breadcrumb a:hover { color: #475569; }
.od-breadcrumb i { font-size: 10px; }
.od-mt { margin-top: 1rem; }

/* ── Card ── */
.od-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    overflow: hidden;
}
.od-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 1.25rem;
    border-bottom: 1px solid #f1f5f9;
}
.od-card-title {
    font-size: 13px;
    font-weight: 600;
    color: #1e293b;
    text-transform: uppercase;
    letter-spacing: .05em;
}

/* ── Info grid (customer + payment) ── */
.od-info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
}
.od-info-col {
    padding: 1.25rem 1.5rem;
}
.od-info-col-right {
    border-left: 1px solid #f1f5f9;
}
.od-col-eyebrow {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .07em;
    color: #94a3b8;
    margin-bottom: .75rem;
}
.od-info-row {
    display: flex;
    align-items: baseline;
    gap: 10px;
    padding: 6px 0;
    border-bottom: 1px solid #f8fafc;
}
.od-info-row:last-child { border-bottom: none; }
.od-info-row-middle { align-items: center; }
.od-info-key {
    font-size: 12px;
    color: #64748b;
    min-width: 90px;
    flex-shrink: 0;
}
.od-info-val { font-size: 13px; color: #1e293b; }
.od-link { color: #185FA5; }

/* ── Pills / badges ── */
.od-pill {
    display: inline-flex;
    align-items: center;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    line-height: 1.4;
}
.od-pill-blue   { background: #E6F1FB; color: #0C447C; }
.od-pill-green  { background: #EAF3DE; color: #27500A; }
.od-pill-red    { background: #FCEBEB; color: #791F1F; }
.od-pill-amber  { background: #FAEEDA; color: #633806; }

.od-status-badge {
    display: inline-flex;
    align-items: center;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
}
.od-status-completed  { background: #EAF3DE; color: #27500A; }
.od-status-processing { background: #E6F1FB; color: #0C447C; }
.od-status-pending    { background: #FAEEDA; color: #633806; }

/* ── Buttons ── */
.od-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 14px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    border: 1px solid #e2e8f0;
    background: #fff;
    color: #475569;
    text-decoration: none;
    transition: background .15s, border-color .15s;
}
.od-btn:hover { background: #f8fafc; }
.od-btn-ghost { border-color: #e2e8f0; color: #475569; }
.od-btn-primary { background: #185FA5; border-color: #185FA5; color: #fff; }
.od-btn-primary:hover { background: #0c447c; }
.od-btn-success { background: #3B6D11; border-color: #3B6D11; color: #fff; }
.od-btn-success:hover { background: #27500a; }
.od-btn-sm { padding: 6px 12px; font-size: 12px; }
.od-mark-paid-btn {
    display: inline-flex;
    align-items: center;
    padding: 4px 10px;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 500;
    background: #E1F5EE;
    color: #085041;
    border: 1px solid #5DCAA5;
    cursor: pointer;
    margin-left: 4px;
}
.od-mark-paid-btn:hover { background: #9FE1CB; }

/* ── Table ── */
.od-table-wrap { overflow-x: auto; }
.od-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}
.od-table thead th {
    padding: 10px 14px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .05em;
    color: #94a3b8;
    border-bottom: 1px solid #f1f5f9;
    text-align: left;
    white-space: nowrap;
}
.od-table tbody td {
    padding: 11px 14px;
    color: #1e293b;
    border-bottom: 1px solid #f8fafc;
    vertical-align: middle;
}
.od-table tbody tr:last-child td { border-bottom: none; }
.od-table tbody tr:hover { background: #f8fafc; }
.od-tc { text-align: center !important; }
.od-tr { text-align: right !important; }
.od-fw { font-weight: 600; }
.od-muted { color: #94a3b8; font-style: italic; font-size: 12px; }

/* ── Variant pill ── */
.od-variant-pill {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 2px 9px;
    font-size: 11px;
    color: #475569;
}

/* ── IMEI preview chips ── */
.od-imei-preview { display: flex; flex-wrap: wrap; gap: 4px; margin-top: 5px; }

/* ── Total row ── */
.od-total-row {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 14px;
    padding: 1rem 1.25rem;
    border-top: 1px solid #f1f5f9;
}
.od-total-label { font-size: 13px; color: #64748b; }
.od-total-amount { font-size: 20px; font-weight: 700; color: #1e293b; }

/* ── Form controls ── */
.od-input {
    padding: 7px 10px;
    border: 1px solid #e2e8f0;
    border-radius: 7px;
    font-size: 12px;
    color: #1e293b;
    width: 100%;
    background: #fff;
}
.od-input:focus { outline: none; border-color: #93c5fd; box-shadow: 0 0 0 3px rgba(147,197,253,.25); }
.od-select {
    padding: 7px 10px;
    border: 1px solid #e2e8f0;
    border-radius: 7px;
    font-size: 12px;
    color: #1e293b;
    background: #fff;
    cursor: pointer;
}
.od-select:focus { outline: none; border-color: #93c5fd; }

@media (max-width: 640px) {
    .od-info-grid { grid-template-columns: 1fr; }
    .od-info-col-right { border-left: none; border-top: 1px solid #f1f5f9; }
    .od-page-header { flex-direction: column; gap: 10px; }
}
</style>
@endpush

@push('scripts')
<script>

$(document).ready(function () {

    $('.imei-select').select2({
        placeholder: "Search IMEI...",
        width: '100%'
    });

    $('.imei-select').on('select2:select', function (e) {

        let data = e.params.data;
        let itemId = $(this).data('item-id');
        let maxQty = $item = {{ $item->quantity }}; // Assuming you have access to the item quantity here

        let preview = $('#imei-preview-' + itemId);

        //  REAL COUNT (always accurate)
        let selectedCount = preview.find(`input[name="imei_ids_${itemId}[]"]`).length;

        // STRICT LIMIT CHECK
       if (selectedCount >= maxQty) {
    Swal.fire({
        icon: 'warning',
        title: 'Quantity limit reached',
        text: `You can select only ${maxQty} IMEIs for this item`
    }).then(() => {
        //  clear select input after OK
        $(this).val(null).trigger('change');
    });

    return;
}

        // 🚫 prevent duplicate
        if ($('#input-imei-' + itemId + '-' + data.id).length) return;

        preview.append(`
            <span class="od-pill od-pill-blue" id="badge-${itemId}-${data.id}" style="gap:6px;padding:3px 8px 3px 10px">
                ${data.text}
                <i class="icon-x"
                   onclick="removeImei(${itemId}, ${data.id})"
                   style="cursor:pointer;font-size:10px"></i>

                <input type="hidden"
                    name="imei_ids_${itemId}[]"
                    value="${data.id}"
                    id="input-imei-${itemId}-${data.id}">
            </span>
        `);

        // disable selected option
        $(this).find(`option[value="${data.id}"]`)
            .prop('disabled', true);

        $(this).val(null).trigger('change');
    });

    $('.complete-order-btn').on('click', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "This will confirm and complete the order, select the IMEIs, and deduct product stocks. This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3B6D11',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, complete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).closest('form').submit();
            }
        });
    });

});

// REMOVE FUNCTION (fully synced)
function removeImei(itemId, id) {

    $('#badge-' + itemId + '-' + id).remove();
    $('#input-imei-' + itemId + '-' + id).remove();

    let select = $('.imei-select[data-item-id="' + itemId + '"]');

    // re-enable option
    select.find(`option[value="${id}"]`)
        .prop('disabled', false);
}

@if (session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: "{{ session('success') }}",
        timer: 3000,
        showConfirmButton: false
    });
@endif

@if (session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: "{{ session('error') }}"
    });
@endif
</script>
@endpush