@extends('admin.layouts.app')

@push('title')
    <title>All Web Orders</title>
@endpush

@push('styles')
<style>
    .stat-card { border-radius: 10px; border: 1px solid #e4e7ef; padding: 16px 18px; background: #fff; }
    .stat-card .label { font-size: 11px; text-transform: uppercase; letter-spacing: 0.06em; color: #7b8299; margin-bottom: 4px; }
    .stat-card .value { font-size: 20px; font-weight: 700; }
    .stat-card .sub { font-size: 12px; color: #7b8299; margin-top: 2px; }

    .order-code { font-weight: 600; font-family: monospace; color: #2275fc; font-size: 13px; }

    .customer-avatar {
        width: 32px; height: 32px; border-radius: 50%;
        background: #e8f0fe; color: #2275fc;
        font-size: 11px; font-weight: 700;
        display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0;
    }

    .badge-completed  { background: #e6f9f0; color: #0d7a4e;  border-radius: 20px; padding: 3px 10px; font-size: 11px; font-weight: 600; white-space: nowrap; }
    .badge-processing { background: #e8f0fe; color: #1a5bbf;  border-radius: 20px; padding: 3px 10px; font-size: 11px; font-weight: 600; white-space: nowrap; }
    .badge-pending    { background: #fff4e5; color: #b45309;  border-radius: 20px; padding: 3px 10px; font-size: 11px; font-weight: 600; white-space: nowrap; }
    .badge-cancelled  { background: #fce8e8; color: #c0392b;  border-radius: 20px; padding: 3px 10px; font-size: 11px; font-weight: 600; white-space: nowrap; }

    .icon-btn {
        width: 32px; height: 32px; border-radius: 7px;
        display: inline-flex; align-items: center; justify-content: center;
        border: 1px solid #e4e7ef; background: #fff; color: #7b8299; text-decoration: none;
    }
    .icon-btn.view:hover { background: #e8f0fe; border-color: #2275fc; color: #2275fc; }

    .wg-box { border-radius: 12px; border: 1px solid #e4e7ef; background: #fff; overflow: hidden; }

    /* Desktop table */
    .table-orders.table-all-user>* {
        min-width: auto !important;
    }
    .table-orders .table-title,
    .table-orders .user-item {
        display: flex;
        align-items: center;
        width: 100%;
        padding-left: 20px;
        padding-right: 20px;
    }
    .table-orders .table-title {
        background: #f8f9fc;
        border-bottom: 1px solid #e4e7ef;
        padding-top: 12px;
        padding-bottom: 12px;
        margin-bottom: 0 !important;
    }
    .table-orders .user-item {
        padding-top: 13px;
        padding-bottom: 13px;
        border-bottom: 1px solid #e4e7ef;
        transition: background-color 0.15s ease;
    }
    .table-orders .user-item:last-child {
        border-bottom: none;
    }
    .table-orders .user-item:hover {
        background-color: #f6f8ff;
    }
    .table-orders .col-code {
        flex: 1 1 120px;
    }
    .table-orders .col-customer {
        flex: 2 1 200px;
    }
    .table-orders .col-date {
        flex: 1 1 120px;
    }
    .table-orders .col-total {
        flex: 1 1 120px;
    }
    .table-orders .col-status {
        flex: 1 1 120px;
    }
    .table-orders .col-payment {
        flex: 1 1 120px;
    }
    .table-orders .col-action {
        flex: 0 0 80px;
        width: 80px;
        display: flex;
        justify-content: flex-end;
    }

    /* Mobile cards — hidden on desktop */
    .mobile-order-cards { display: none; }
    .mobile-card {
        background: #fff; border-bottom: 1px solid #e4e7ef; padding: 14px 16px;
    }
    .mobile-card:last-child { border-bottom: none; }
    .mobile-card-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px; }
    .mobile-card-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px; }
    .mobile-card-label { font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em; color: #7b8299; font-weight: 600; }
    .mobile-card-value { font-size: 13px; font-weight: 500; color: #1a1d2e; }
    .mobile-card-footer { display: flex; align-items: center; justify-content: space-between; margin-top: 10px; padding-top: 10px; border-top: 1px solid #f0f1f5; }

    /* Search bar inputs */
    .search-group input,
    .search-group select {
        height: 38px; border: 1px solid #e4e7ef; border-radius: 7px;
        font-size: 13px; padding: 0 12px; outline: none;
        background: #fff; color: #1a1d2e; width: 100%;
    }
    .search-group input:focus,
    .search-group select:focus {
        border-color: #2275fc; box-shadow: 0 0 0 3px rgba(34,117,252,0.1);
    }

    /* Responsive breakpoint */
    @media (max-width: 767px) {
        .desktop-table { display: none !important; }
        .mobile-order-cards { display: block; }

        .stat-card .value { font-size: 18px; }
        .stat-card { padding: 12px 14px; }

        .box-header-count { display: none; }

        .pagination-wrap { flex-direction: column; gap: 8px; align-items: flex-start !important; }
    }
</style>
@endpush

@section('index_content')
<div class="main-content-wrap">

  

    {{-- Stats --}}
    @php
        $allQ       = \App\Models\Order::query();
        $totalRev   = (clone $allQ)->sum('total');
        $totalCount = (clone $allQ)->count();
        $completed  = (clone $allQ)->where('order_status', 'completed')->count();
        $pending    = (clone $allQ)->where('order_status', 'pending')->count();
        $processing = (clone $allQ)->where('order_status', 'processing')->count();
        $compPct    = $totalCount > 0 ? round($completed / $totalCount * 100) : 0;
    @endphp

    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="label">Total Orders</div>
                <div class="value" style="color:#2275fc">{{ $totalCount }}</div>
                <div class="sub">All time</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="label">Revenue</div>
                <div class="value" style="color:#0d7a4e">Rs. {{ number_format($totalRev, 2) }}</div>
                <div class="sub">All time</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="label">Completed</div>
                <div class="value" style="color:#0d7a4e">{{ $completed }}</div>
                <div class="sub">{{ $compPct }}% of total</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="label">Pending / Processing</div>
                <div class="value" style="color:#b45309">{{ $pending + $processing }}</div>
                <div class="sub">Needs attention</div>
            </div>
        </div>
    </div>

    {{-- Main Box --}}
    <div class="wg-box">

        {{-- Box Header --}}
        <div class="d-flex align-items-center justify-content-between px-3 py-3 border-bottom">
            <h5 class="mb-0" style="font-size:15px;font-weight:600">Orders List</h5>
            <span class="text-muted box-header-count" style="font-size:12px">
                Showing {{ $orders->firstItem() }}–{{ $orders->lastItem() }} of {{ $orders->total() }}
            </span>
        </div>

        {{-- Search & Filter --}}
        <form method="GET" action="{{ route('orders.index') }}">
            <div class="px-3 py-3 search-group" style="background:#f8f9fc;border-bottom:1px solid #e4e7ef">
                <div class="row g-2">
                    <div class="col-12 col-md-5">
                        <input type="text" name="search"
                            placeholder="Search by order code or customer…"
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-12 col-md-3">
                        <select name="status">
                            <option value="">All Statuses</option>
                            <option value="pending"    {{ request('status') == 'pending'    ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed"  {{ request('status') == 'completed'  ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled"  {{ request('status') == 'cancelled'  ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <button type="submit" class="btn btn-primary w-100" style="border-radius:7px;height:38px;font-size:13px">
                            <i class="icon-search me-1"></i> Search
                        </button>
                    </div>
                    <div class="col-6 col-md-2">
    <a href="{{ route('orders.index') }}" 
       class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center"
       style="border-radius:7px;height:38px;font-size:13px;">
        Reset
    </a>
</div>
                </div>
            </div>
        </form>

        {{-- DESKTOP TABLE --}}
        {{-- DESKTOP TABLE --}}
        <div class="desktop-table d-none d-md-block">
            <div class="wg-table table-all-user table-orders">
                <ul class="table-title flex gap20 mb-14">
                    <li class="col-code"><div class="body-title">Order Code</div></li>
                    <li class="col-customer"><div class="body-title">Customer</div></li>
                    <li class="col-date"><div class="body-title">Date</div></li>
                    <li class="col-total"><div class="body-title">Total</div></li>
                    <li class="col-status"><div class="body-title">Status</div></li>
                    <li class="col-payment"><div class="body-title">Payment</div></li>
                    <li class="col-action text-end"><div class="body-title">Actions</div></li>
                </ul>

                <ul class="flex flex-column">
                    @forelse ($orders as $order)
                        @php
                            $name     = $order->full_name ?? null;
                            $words    = $name ? array_filter(explode(' ', $name)) : [];
                            $initials = $name
                                ? strtoupper(implode('', array_map(fn($w) => $w[0], array_slice($words, 0, 2))))
                                : '?';
                            $status = strtolower($order->order_status ?? 'pending');
                        @endphp
                        <li class="user-item gap20">
                            <div class="col-code">
                                <span class="order-code">#{{ $order->order_code }}</span>
                            </div>
                            <div class="col-customer">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="customer-avatar">{{ $initials }}</span>
                                    <span style="font-weight:500;color:var(--Heading)">{{ $name ?? '—' }}</span>
                                </div>
                            </div>
                            <div class="col-date body-text">
                                {{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}
                            </div>
                            <div class="col-total">
                                <span style="font-weight:700;color:var(--Heading)">Rs. {{ number_format($order->total, 2) }}</span>
                            </div>
                            <div class="col-status">
                                <span class="badge-{{ $status }}">{{ ucfirst($status) }}</span>
                            </div>
                            <div class="col-payment body-text" style="text-transform:capitalize">
                                {{ $order->payment_method ?? '—' }}
                            </div>
                            <div class="col-action">
                                <a href="{{ route('orders.show', $order->id) }}" class="icon-btn view" title="View Order">
                                    <i class="icon-eye"></i>
                                </a>
                            </div>
                        </li>
                    @empty
                        <li class="user-item justify-center py-5">
                            <div class="text-center text-muted w-full">
                                <i class="icon-inbox" style="font-size:32px;display:block;margin-bottom:8px;opacity:.4"></i>
                                No orders found.
                            </div>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>

        {{-- MOBILE CARDS --}}
        <div class="mobile-order-cards">
            @forelse ($orders as $order)
                @php
                    $name     = $order->full_name ?? null;
                    $words    = $name ? array_filter(explode(' ', $name)) : [];
                    $initials = $name
                        ? strtoupper(implode('', array_map(fn($w) => $w[0], array_slice($words, 0, 2))))
                        : '?';
                    $status = strtolower($order->order_status ?? 'pending');
                @endphp
                <div class="mobile-card">
                    {{-- Header: avatar + name + action --}}
                    <div class="mobile-card-header">
                        <div class="d-flex align-items-center gap-2">
                            <span class="customer-avatar">{{ $initials }}</span>
                            <div>
                                <div style="font-weight:600;font-size:13px">{{ $name ?? 'Unknown' }}</div>
                                <div class="order-code">#{{ $order->order_code }}</div>
                            </div>
                        </div>
                        <a href="{{ route('orders.show', $order->id) }}" class="icon-btn view" title="View Order">
                            <i class="icon-eye"></i>
                        </a>
                    </div>

                    {{-- Details grid --}}
                    <div class="mobile-card-row">
                        <span class="mobile-card-label">Date</span>
                        <span class="mobile-card-value" style="color:#7b8299">
                            {{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}
                        </span>
                    </div>
                    <div class="mobile-card-row">
                        <span class="mobile-card-label">Payment</span>
                        <span class="mobile-card-value" style="text-transform:capitalize;color:#7b8299">
                            {{ $order->payment_method ?? '—' }}
                        </span>
                    </div>

                    {{-- Footer: status + total --}}
                    <div class="mobile-card-footer">
                        <span class="badge-{{ $status }}">{{ ucfirst($status) }}</span>
                        <span style="font-weight:700;font-size:15px">Rs. {{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted py-5">
                    <i class="icon-inbox" style="font-size:32px;display:block;margin-bottom:8px;opacity:.4"></i>
                    No orders found.
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 px-3 py-3 pagination-wrap"
             style="background:#f8f9fc;border-top:1px solid #e4e7ef">
            <span class="text-muted" style="font-size:12px">
                Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} results
            </span>
            {{ $orders->links() }}
        </div>

    </div>
</div>
@endsection