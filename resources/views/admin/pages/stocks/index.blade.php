@extends('admin.layouts.app')

@push('title')
    <title>Stock Inventory Ledger</title>
@endpush

@push('styles')
<style>
    /* ── Stat Cards ── */
    .stat-card { border-radius: 10px; border: 1px solid #e4e7ef; padding: 16px 18px; background: #fff; }
    .stat-card .label { font-size: 11px; text-transform: uppercase; letter-spacing: 0.06em; color: #7b8299; margin-bottom: 4px; }
    .stat-card .value { font-size: 20px; font-weight: 700; }
    .stat-card .sub   { font-size: 12px; color: #7b8299; margin-top: 2px; }

    /* ── Table container ── */
    .wg-box { border-radius: 12px; border: 1px solid #e4e7ef; background: #fff; overflow: hidden; }

    /* ── Type badges ── */
    .badge-in  { background: #e6f9f0; color: #0d7a4e; border-radius: 20px; padding: 3px 10px; font-size: 11px; font-weight: 600; white-space: nowrap; }
    .badge-out { background: #fce8e8; color: #c0392b; border-radius: 20px; padding: 3px 10px; font-size: 11px; font-weight: 600; white-space: nowrap; }

    /* ── Quantity ── */
    .qty-in  { color: #0d7a4e; font-weight: 700; }
    .qty-out { color: #c0392b; font-weight: 700; }

    /* ── Variant badge ── */
    .variant-pill {
        display: inline-flex; align-items: center; gap: 4px;
        background: #eff6ff; color: #1d4ed8;
        border-radius: 4px; padding: 2px 8px;
        font-size: 11px; font-weight: 500; margin-top: 3px;
    }
    .simple-label { font-size: 11px; color: #7b8299; margin-top: 3px; font-style: italic; }

    /* ── Add button ── */
    .btn-add {
        display: inline-flex; align-items: center; gap: 6px;
        background: #1e2535; color: #fff; border: none;
        border-radius: 8px; padding: 9px 18px;
        font-size: 13px; font-weight: 600; text-decoration: none; white-space: nowrap;
        transition: background .15s ease;
    }
    .btn-add:hover { background: #2d3a50; color: #fff; }

    /* ── Search inputs ── */
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

    /* ── Desktop table ── */
    .table-stocks.table-all-user>* {
        min-width: auto !important;
    }
    .table-stocks .table-title,
    .table-stocks .user-item {
        display: flex;
        align-items: center;
        width: 100%;
        padding-left: 20px;
        padding-right: 20px;
    }
    .table-stocks .table-title {
        background: #f8f9fc;
        border-bottom: 1px solid #e4e7ef;
        padding-top: 12px;
        padding-bottom: 12px;
        margin-bottom: 0 !important;
    }
    .table-stocks .user-item {
        padding-top: 13px;
        padding-bottom: 13px;
        border-bottom: 1px solid #e4e7ef;
        transition: background-color 0.15s ease;
        border-left: 3px solid transparent;
    }
    .table-stocks .user-item.row-in  { border-left: 3px solid #0d7a4e; }
    .table-stocks .user-item.row-out { border-left: 3px solid #c0392b; }
    .table-stocks .user-item:last-child {
        border-bottom: none;
    }
    .table-stocks .user-item:hover {
        background-color: #f6f8ff;
    }
    .table-stocks .col-date {
        flex: 1 1 130px;
    }
    .table-stocks .col-product {
        flex: 2 1 250px;
    }
    .table-stocks .col-type {
        flex: 1 1 100px;
    }
    .table-stocks .col-qty {
        flex: 1 1 100px;
    }
    .table-stocks .col-note {
        flex: 2 1 200px;
    }

    .note-cell {
        max-width: 100%;
        overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
        color: #7b8299;
        display: block;
    }

    /* ── Mobile cards ── */
    .mobile-stock-cards { display: none; }
    .mobile-card {
        background: #fff; border-bottom: 1px solid #e4e7ef; padding: 14px 16px;
        border-left: 3px solid transparent;
    }
    .mobile-card.row-in  { border-left-color: #0d7a4e; }
    .mobile-card.row-out { border-left-color: #c0392b; }
    .mobile-card:last-child { border-bottom: none; }
    .mobile-card-header { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 10px; gap: 10px; }
    .mobile-card-row    { display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px; }
    .mobile-card-label  { font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em; color: #7b8299; font-weight: 600; }
    .mobile-card-value  { font-size: 13px; font-weight: 500; color: #1a1d2e; }
    .mobile-card-footer { display: flex; align-items: center; justify-content: space-between; margin-top: 10px; padding-top: 10px; border-top: 1px solid #f0f1f5; flex-wrap: wrap; gap: 6px; }
    .mobile-product-name { font-weight: 600; font-size: 14px; color: #1a1d2e; }

    /* ── Responsive ── */
    @media (max-width: 767px) {
        .desktop-table { display: none !important; }
        .mobile-stock-cards { display: block; }

        .stat-card .value { font-size: 18px; }
        .stat-card { padding: 12px 14px; }

        .box-header-count { display: none; }
        .pagination-wrap  { flex-direction: column; gap: 8px; align-items: flex-start !important; }

        .btn-add { width: 100%; justify-content: center; }
    }
</style>
@endpush

@section('index_content')
<div class="main-content-wrap">

    {{-- ── Stats ── --}}
    @php
        $totalEntries = $stocks->total();
        $stockIn      = $stocks->getCollection()->where('type', 'in')->count();
        $stockOut     = $stocks->getCollection()->where('type', 'out')->count();
    @endphp

    <div class="row g-3 mb-4">
        <div class="col-6 col-md-4">
            <div class="stat-card">
                <div class="label">Total Entries</div>
                <div class="value" style="color:#2275fc">{{ $totalEntries }}</div>
                <div class="sub">All time</div>
            </div>
        </div>
        <div class="col-6 col-md-4">
            <div class="stat-card">
                <div class="label">Stock In</div>
                <div class="value" style="color:#0d7a4e">{{ $stockIn }}</div>
                <div class="sub">Current page</div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="stat-card">
                <div class="label">Stock Out</div>
                <div class="value" style="color:#c0392b">{{ $stockOut }}</div>
                <div class="sub">Current page</div>
            </div>
        </div>
    </div>

    {{-- ── Main Box ── --}}
    <div class="wg-box">

        {{-- Box Header --}}
        <div class="d-flex align-items-center justify-content-between px-3 py-3 border-bottom flex-wrap gap-2">
            <h5 class="mb-0" style="font-size:15px;font-weight:600">Inventory Entries</h5>
            <div class="d-flex align-items-center gap-3 ">
                <a class="btn-add bg-primary" href="{{ route('stocks.create') }}">
                    <i class="icon-plus"></i> Add Stock Entry
                </a>
            </div>
        </div>

        {{-- Search & Filter --}}
        <form method="GET" action="{{ route('stocks.index') }}">
            <div class="px-3 py-3 search-group" style="background:#f8f9fc;border-bottom:1px solid #e4e7ef">
                <div class="row g-2">
                    <div class="col-12 col-md-5">
                        <input
                            type="text"
                            name="search"
                            placeholder="Search by product or note…"
                            value="{{ request('search') }}"
                            aria-label="Search inventory"
                        >
                    </div>
                    <div class="col-12 col-md-3">
                        <select name="type" aria-label="Filter by type" onchange="this.form.submit()">
                            <option value="">All Types</option>
                            <option value="in"  {{ request('type') == 'in'  ? 'selected' : '' }}>Stock In</option>
                            <option value="out" {{ request('type') == 'out' ? 'selected' : '' }}>Stock Out</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <button type="submit" class="btn btn-primary w-100" style="border-radius:7px;height:38px;font-size:13px">
                            <i class="icon-search me-1"></i> Search
                        </button>
                    </div>
                    <div class="col-6 col-md-2">
                        <a href="{{ route('stocks.index') }}"
                           class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center"
                           style="border-radius:7px;height:38px;font-size:13px;">
                            Reset
                        </a>
                    </div>
                </div>
            </div>
        </form>

        {{-- ── DESKTOP TABLE ── --}}
        <div class="desktop-table d-none d-md-block">
            <div class="wg-table table-all-user table-stocks">
                <ul class="table-title flex gap20 mb-14">
                    <li class="col-date"><div class="body-title">Date</div></li>
                    <li class="col-product"><div class="body-title">Product &amp; Variant</div></li>
                    <li class="col-type"><div class="body-title">Type</div></li>
                    <li class="col-qty"><div class="body-title">Quantity</div></li>
                    <li class="col-note"><div class="body-title">Note</div></li>
                </ul>

                <ul class="flex flex-column">
                    @forelse ($stocks as $stock)
                        <li class="user-item gap20 row-{{ $stock->type }}">
                            <div class="col-date">
                                <div style="font-weight:600;color:#1a1d2e">
                                    {{ $stock->created_at->format('M d, Y') }}
                                </div>
                                <div style="font-size:12px;color:#7b8299;margin-top:2px">
                                    {{ $stock->created_at->format('h:i A') }}
                                </div>
                            </div>
                            <div class="col-product">
                                <div style="font-weight:600;color:#1a1d2e">{{ $stock->product->name }}</div>
                                @if ($stock->variant)
                                    <div class="variant-pill">
                                        <i class="icon-tag" style="font-size:.75rem"></i>
                                        {{ $stock->variant->color }} · {{ $stock->variant->storage }} · {{ $stock->variant->ram }}
                                    </div>
                                @else
                                    <div class="simple-label">Simple Product</div>
                                @endif
                            </div>
                            <div class="col-type">
                                <span class="badge-{{ $stock->type }}">
                                    {{ $stock->type === 'in' ? 'Stock In' : 'Stock Out' }}
                                </span>
                            </div>
                            <div class="col-qty qty-{{ $stock->type }}">
                                {{ $stock->type === 'in' ? '+' : '−' }}{{ number_format($stock->quantity) }}
                            </div>
                            <div class="col-note">
                                <span class="note-cell" title="{{ $stock->note }}">
                                    {{ $stock->note ?? '—' }}
                                </span>
                            </div>
                        </li>
                    @empty
                        <li class="user-item justify-center py-5">
                            <div class="text-center text-muted w-full">
                                <i class="icon-inbox" style="font-size:32px;display:block;margin-bottom:8px;opacity:.4"></i>
                                No inventory records found.
                            </div>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>

        {{-- ── MOBILE CARDS ── --}}
        <div class="mobile-stock-cards">
            @forelse ($stocks as $stock)
                <div class="mobile-card row-{{ $stock->type }}">
                    {{-- Header: product name + badge --}}
                    <div class="mobile-card-header">
                        <div>
                            <div class="mobile-product-name">{{ $stock->product->name }}</div>
                            @if ($stock->variant)
                                <div class="variant-pill" style="margin-top:4px">
                                    <i class="icon-tag" style="font-size:.75rem"></i>
                                    {{ $stock->variant->color }} · {{ $stock->variant->storage }} · {{ $stock->variant->ram }}
                                </div>
                            @else
                                <div class="simple-label">Simple Product</div>
                            @endif
                        </div>
                        <span class="badge-{{ $stock->type }}">
                            {{ $stock->type === 'in' ? 'Stock In' : 'Stock Out' }}
                        </span>
                    </div>

                    {{-- Details --}}
                    <div class="mobile-card-row">
                        <span class="mobile-card-label">Date</span>
                        <span class="mobile-card-value" style="color:#7b8299">
                            {{ $stock->created_at->format('M d, Y') }} · {{ $stock->created_at->format('h:i A') }}
                        </span>
                    </div>
                    @if ($stock->note)
                        <div class="mobile-card-row">
                            <span class="mobile-card-label">Note</span>
                            <span class="mobile-card-value" style="color:#7b8299;text-align:right;max-width:60%;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
                                {{ $stock->note }}
                            </span>
                        </div>
                    @endif

                    {{-- Footer: quantity --}}
                    <div class="mobile-card-footer">
                        <span style="font-size:12px;color:#7b8299">Quantity</span>
                        <span class="qty-{{ $stock->type }}" style="font-size:16px">
                            {{ $stock->type === 'in' ? '+' : '−' }}{{ number_format($stock->quantity) }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted py-5">
                    <i class="icon-inbox" style="font-size:32px;display:block;margin-bottom:8px;opacity:.4"></i>
                    No inventory records found.
                </div>
            @endforelse
        </div>

        {{-- ── Pagination ── --}}
        @if ($stocks->hasPages())
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 px-3 py-3 pagination-wrap"
                 style="background:#f8f9fc;border-top:1px solid #e4e7ef">
                <span class="text-muted" style="font-size:12px">
                    Showing {{ $stocks->firstItem() }} to {{ $stocks->lastItem() }} of {{ $stocks->total() }} results
                </span>
                {{ $stocks->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>{{-- /.wg-box --}}

</div>{{-- /.main-content-wrap --}}
@endsection