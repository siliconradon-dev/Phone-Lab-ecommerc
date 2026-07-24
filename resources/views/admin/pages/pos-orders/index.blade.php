@extends('admin.layouts.app')

@push('title')
    <title>All Orders</title>
@endpush

@push('styles')
<style>
    /* ── Base ───────────────────────────────────────────────── */
    .stat-card { border-radius: 10px; border: 1px solid #e4e7ef; padding: 16px 18px; background: #fff; }
    .stat-card .label { font-size: 11px; text-transform: uppercase; letter-spacing: 0.06em; color: #7b8299; margin-bottom: 4px; }
    .stat-card .value { font-size: 22px; font-weight: 700; }
    .stat-card .sub { font-size: 12px; color: #7b8299; margin-top: 2px; }
    .order-code { font-weight: 600; font-family: monospace; color: #2275fc; }
    .customer-avatar { width: 30px; height: 30px; border-radius: 50%; background: #e8f0fe; color: #2275fc;
        font-size: 11px; font-weight: 700; display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .customer-avatar.walkin { background: #f0f1f5; color: #7b8299; }
    .badge-cash   { background: #e6f9f0; color: #0d7a4e; border-radius: 20px; padding: 3px 10px; font-size: 11px; font-weight: 600; white-space: nowrap; }
    .badge-card   { background: #e8f0fe; color: #1a5bbf; border-radius: 20px; padding: 3px 10px; font-size: 11px; font-weight: 600; white-space: nowrap; }
    .badge-koko   { background: #fdf2f8; color: #db2777; border-radius: 20px; padding: 3px 10px; font-size: 11px; font-weight: 600; white-space: nowrap; }
    .badge-online { background: #fff4e5; color: #b45309; border-radius: 20px; padding: 3px 10px; font-size: 11px; font-weight: 600; white-space: nowrap; }
    .icon-btn { width: 32px; height: 32px; border-radius: 7px; display: inline-flex; align-items: center; justify-content: center;
        border: 1px solid #e4e7ef; background: #fff; color: #7b8299; text-decoration: none; }
    .icon-btn.view:hover  { background: #e8f0fe; border-color: #2275fc; color: #2275fc; }
    .icon-btn.print:hover { background: #e6f9f0; border-color: #0d7a4e; color: #0d7a4e; }
    .wg-box { border-radius: 12px; border: 1px solid #e4e7ef; background: #fff; overflow: hidden; }
    
    /* ── WG Table (Remos Style) ── */
    .table-pos-orders.table-all-user>* {
        min-width: auto !important;
    }
    .table-pos-orders .table-title,
    .table-pos-orders .user-item {
        display: flex;
        align-items: center;
        width: 100%;
        padding-left: 20px;
        padding-right: 20px;
    }
    .table-pos-orders .table-title {
        background: #f8f9fc;
        border-bottom: 1px solid #e4e7ef;
        padding-top: 12px;
        padding-bottom: 12px;
        margin-bottom: 0 !important;
    }
    .table-pos-orders .user-item {
        padding-top: 13px;
        padding-bottom: 13px;
        border-bottom: 1px solid #e4e7ef;
        transition: background-color 0.15s ease;
    }
    .table-pos-orders .user-item:last-child {
        border-bottom: none;
    }
    .table-pos-orders .user-item:hover {
        background-color: #f6f8ff;
    }
    .table-pos-orders .col-code {
        flex: 1 1 120px;
    }
    .table-pos-orders .col-customer {
        flex: 2 1 200px;
    }
    .table-pos-orders .col-date {
        flex: 1 1 120px;
    }
    .table-pos-orders .col-total {
        flex: 1 1 120px;
    }
    .table-pos-orders .col-payment {
        flex: 1 1 120px;
    }
    .table-pos-orders .col-action {
        flex: 0 0 100px;
        width: 100px;
        display: flex;
        justify-content: flex-end;
    }

    /* ── Mobile order cards (shown only on small screens) ──── */
    .mobile-order-card { padding: 12px 14px; border-bottom: 1px solid #e4e7ef; }
    .mobile-order-card:last-child { border-bottom: none; }
    .mob-card-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px; }
    .mob-card-meta { display: flex; align-items: center; justify-content: space-between; }
    .mob-card-footer { display: flex; align-items: center; justify-content: space-between; margin-top: 8px; }
    .mob-date { font-size: 11px; color: #7b8299; }
    .mob-amount { font-weight: 700; font-size: 14px; }

    /* ── Search bar ─────────────────────────────────────────── */
    .search-wrap { display: flex; gap: 8px; padding: 12px 14px; background: #f8f9fc; border-bottom: 1px solid #e4e7ef; align-items: center; }
    .search-wrap input,
    .search-wrap select {
        height: 38px; border: 1px solid #e4e7ef; border-radius: 7px;
        font-size: 13px; padding: 0 12px; outline: none;
        background: #fff; color: #1a1d2e;
    }
    .search-wrap input:focus,
    .search-wrap select:focus {
        border-color: #2275fc; box-shadow: 0 0 0 3px rgba(34,117,252,0.1);
    }

    /* ── Pagination row ─────────────────────────────────────── */
    .pag-row { display: flex; align-items: center; justify-content: space-between;
               padding: 10px 14px; background: #f8f9fc; border-top: 1px solid #e4e7ef; flex-wrap: wrap; gap: 8px; }
    .pag-row .pag-info { font-size: 12px; color: #7b8299; }

    /* ── Responsive overrides ───────────────────────────────── */
    @media (max-width: 575.98px) {
        /* Stats: tighter padding & smaller value on very small screens */
        .stat-card { padding: 12px 12px; }
        .stat-card .value { font-size: 18px; }
        .stat-card .label { font-size: 10px; }

        /* Search: stack vertically */
        .search-wrap { flex-direction: column; align-items: stretch; }
        .search-wrap .btn-row { display: flex; gap: 8px; }
        .search-wrap input,
        .search-wrap select { width: 100%; }

        /* Pagination: center everything */
        .pag-row { justify-content: center; }
        .pag-row .pag-info { width: 100%; text-align: center; }

        /* Order code size */
        .order-code { font-size: 14px; }
    }
</style>
@endpush

@section('index_content')
<div class="main-content-wrap">


    {{-- Stats --}}
@php
    $allOrders    = \App\Models\PosOrder::query();
    $totalRevenue = (clone $allOrders)->sum('total_amount');
    $totalCount   = (clone $allOrders)->count();
    $cashCount    = (clone $allOrders)->where('payment_method', 'cash')->count();
    $cardCount    = $totalCount - $cashCount;
    $cashPercent  = $totalCount > 0 ? round($cashCount / $totalCount * 100) : 0;
    $cardPercent  = 100 - $cashPercent;
@endphp

    {{-- Stats Row — 2 cols on xs, 4 cols on md+ --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="label">Total Orders</div>
                <div class="value" style="color:#2275fc">{{ $posOrders->total() }}</div>
                <div class="sub">All time</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="label">Revenue</div>
                <div class="value" style="color:#0d7a4e">Rs. {{ number_format($totalRevenue, 2) }}</div>
                <div class="sub">This month</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="label">Cash Orders</div>
                <div class="value" style="color:#b45309">{{ $cashCount }}</div>
                <div class="sub">{{ $cashPercent }}% of total</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="label">Card / Online</div>
                <div class="value" style="color:#c0392b">{{ $cardCount }}</div>
                <div class="sub">{{ $cardPercent }}% of total</div>
            </div>
        </div>
    </div>

    {{-- Main Table Box --}}
    <div class="wg-box">

        {{-- Box Header --}}
        <div class="d-flex align-items-center justify-content-between px-3 py-3 border-bottom flex-wrap gap-1">
            <h5 class="mb-0" style="font-size:15px;font-weight:600">Orders List</h5>
            <span class="text-muted" style="font-size:12px">
                Showing {{ $posOrders->firstItem() }}–{{ $posOrders->lastItem() }} of {{ $posOrders->total() }}
            </span>
        </div>

        {{-- Search Bar --}}
        <form method="GET" action="{{ route('pos-orders.index') }}">
            <div class="search-wrap flex-wrap">
                <input type="text" name="search"
                    placeholder="Search by order code or customer name…"
                    value="{{ request('search') }}"
                    style="flex: 2; min-width: 180px;">

                <select name="payment_method" style="flex: 1; min-width: 120px;">
                    <option value="">All Payments</option>
                    <option value="cash" {{ request('payment_method') === 'cash' ? 'selected' : '' }}>Cash</option>
                    <option value="card" {{ request('payment_method') === 'card' ? 'selected' : '' }}>Card</option>
                    <option value="koko" {{ request('payment_method') === 'koko' ? 'selected' : '' }}>Koko</option>
                </select>

                {{-- On mobile these buttons sit in a flex row below the inputs --}}
                <div class="d-flex gap-2 btn-row">
                    <button type="submit" class="btn btn-primary btn-sm px-3" style="border-radius:7px;white-space:nowrap;height:38px;">
                        <i class="icon-search me-1"></i> Search
                    </button>
                    <a href="{{ route('pos-orders.index') }}" 
                       class="btn btn-outline-secondary btn-sm px-3 d-flex align-items-center justify-content-center"
                       style="border-radius:7px; white-space:nowrap;height:38px;">
                        Reset
                    </a>
                </div>
            </div>
        </form>

        {{-- Desktop Table (hidden on xs) --}}
        {{-- Desktop Table (hidden on xs) --}}
        <div class="desktop-table d-none d-md-block">
            <div class="wg-table table-all-user table-pos-orders">
                <ul class="table-title flex gap20 mb-14">
                    <li class="col-code"><div class="body-title">Order Code</div></li>
                    <li class="col-customer"><div class="body-title">Customer</div></li>
                    <li class="col-date"><div class="body-title">Date</div></li>
                    <li class="col-total"><div class="body-title">Total</div></li>
                    <li class="col-payment"><div class="body-title">Payment</div></li>
                    <li class="col-action text-end"><div class="body-title">Actions</div></li>
                </ul>

                <ul class="flex flex-column">
                    @forelse ($posOrders as $order)
                        @php
                            $name     = $order->customer->name ?? null;
                            $initials = $name
                                ? strtoupper(implode('', array_map(fn($w) => $w[0], explode(' ', $name))))
                                : '?';
                            $method   = strtolower($order->payment_method);
                        @endphp
                        <li class="user-item gap20">
                            <div class="col-code">
                                <span class="order-code fs-5 fw-semibold">#{{ $order->order_code }}</span>
                            </div>
                            <div class="col-customer">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="customer-avatar {{ $name ? '' : 'walkin' }}">{{ $initials }}</span>
                                    <span style="font-size:13px;font-weight:500;{{ $name ? '' : 'color:#7b8299' }}">
                                        {{ $name ?? 'Walk-in Customer' }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-date body-text" style="font-size:13px">
                                {{ $order->created_at->format('M d, Y') }}
                            </div>
                            <div class="col-total">
                                <span style="font-weight:700;color:var(--Heading)">Rs. {{ number_format($order->total_amount, 2) }}</span>
                            </div>
                            <div class="col-payment">
                                <span class="badge-{{ in_array($method, ['card','koko','online']) ? $method : 'cash' }}">
                                    {{ ucfirst($method) }}
                                </span>
                            </div>
                            <div class="col-action">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('pos-orders.show', $order->id) }}" class="icon-btn view" title="View">
                                        <i class="icon-eye"></i>
                                    </a>
                                    <a href="{{ route('pos-orders.print-invoice', $order->id) }}" target="_blank"
                                       class="icon-btn print" title="Print Invoice">
                                        <i class="icon-printer"></i>
                                    </a>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="user-item justify-center py-5">
                            <div class="text-center text-muted w-full">
                                <i class="icon-inbox" style="font-size:32px;display:block;margin-bottom:8px;opacity:.4"></i>
                                No POS orders found.
                            </div>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>

        {{-- Mobile Cards (shown only on xs/sm) --}}
        <div class="d-block d-md-none">
            @forelse ($posOrders as $order)
                @php
                    $name     = $order->customer->name ?? null;
                    $initials = $name
                        ? strtoupper(implode('', array_map(fn($w) => $w[0], explode(' ', $name))))
                        : '?';
                    $method   = strtolower($order->payment_method);
                @endphp
                <div class="mobile-order-card">
                    {{-- Top row: order code + amount --}}
                    <div class="mob-card-top">
                        <span class="order-code">#{{ $order->order_code }}</span>
                        <span class="mob-amount">Rs. {{ number_format($order->total_amount, 2) }}</span>
                    </div>
                    {{-- Mid row: customer + payment badge --}}
                    <div class="mob-card-meta">
                        <div class="d-flex align-items-center gap-2">
                            <span class="customer-avatar {{ $name ? '' : 'walkin' }}">{{ $initials }}</span>
                            <span style="font-size:13px;font-weight:500;{{ $name ? '' : 'color:#7b8299' }}">
                                {{ $name ?? 'Walk-in Customer' }}
                            </span>
                        </div>
                        <span class="badge-{{ in_array($method, ['card','koko','online']) ? $method : 'cash' }}">
                            {{ ucfirst($method) }}
                        </span>
                    </div>
                    {{-- Footer row: date + action buttons --}}
                    <div class="mob-card-footer">
                        <span class="mob-date">{{ $order->created_at->format('M d, Y') }}</span>
                        <div class="d-flex gap-2">
                            <a href="{{ route('pos-orders.show', $order->id) }}" class="icon-btn view" title="View">
                                <i class="icon-eye"></i>
                            </a>
                            <a href="{{ route('pos-orders.print-invoice', $order->id) }}" target="_blank"
                               class="icon-btn print" title="Print Invoice">
                                <i class="icon-printer"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted py-5">
                    <i class="icon-inbox" style="font-size:32px;display:block;margin-bottom:8px;opacity:.4"></i>
                    No POS orders found.
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="pag-row">
            <span class="pag-info">
                Showing {{ $posOrders->firstItem() }} to {{ $posOrders->lastItem() }} of {{ $posOrders->total() }} results
            </span>
            {{ $posOrders->links() }}
        </div>
    </div>
</div>
@endsection