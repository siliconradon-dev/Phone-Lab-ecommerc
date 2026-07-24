@extends('admin.layouts.app')

@push('title')
    <title>Product List</title>
@endpush

@push('styles')
<style>
    /* ── Layout ─────────────────────────────────────────── */
    .product-page-header {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 24px;
    }

    .product-page-header h3 {
        font-size: 1.35rem;
        font-weight: 700;
        margin: 0;
    }

    /* ── Toolbar ─────────────────────────────────────────── */
    .toolbar {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 20px;
    }

    .toolbar-left {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        flex: 1 1 auto;
    }

    .search-input-wrap {
        position: relative;
        flex: 1 1 200px;
        max-width: 320px;
    }

    .search-input-wrap i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #8a94a6;
        font-size: 14px;
        pointer-events: none;
    }

    .search-input-wrap input {
        width: 100%;
        padding: 9px 12px 9px 36px;
        border: 1px solid #e5e7ef;
        border-radius: 8px;
        font-size: 13px;
        background: var(--surface, #f8f9fc);
        color: inherit;
        transition: border-color .2s, box-shadow .2s;
    }

    .search-input-wrap input:focus {
        outline: none;
        border-color: var(--primary, #5f27cd);
        box-shadow: 0 0 0 3px rgba(95, 39, 205, .1);
    }

    .select-wrap select {
        padding: 9px 32px 9px 12px;
        border: 1px solid #e5e7ef;
        border-radius: 8px;
        font-size: 13px;
        background: var(--surface, #f8f9fc);
        color: inherit;
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%238a94a6' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        cursor: pointer;
        transition: border-color .2s;
    }

    .select-wrap select:focus {
        outline: none;
        border-color: var(--primary, #5f27cd);
    }

    .showing-label {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        color: #8a94a6;
        white-space: nowrap;
    }

    /* ── Card / Table ────────────────────────────────────── */
    .product-table-wrap {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e5e7ef;
    }

    .product-table-head {
        display: grid;
        grid-template-columns: 2.5fr 1fr 1fr 1fr 1.2fr 90px;
        gap: 8px;
        padding: 12px 20px;
        background: var(--surface, #f8f9fc);
        border-bottom: 1px solid #e5e7ef;
    }

    .product-table-head span {
        font-size: 11.5px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .06em;
        color: #8a94a6;
    }

    /* ── Row ─────────────────────────────────────────────── */
    .product-row {
        display: grid;
        grid-template-columns: 2.5fr 1fr 1fr 1fr 1.2fr 90px;
        gap: 8px;
        align-items: center;
        padding: 14px 20px;
        border-bottom: 1px solid #f0f1f5;
        transition: background .15s;
    }

    .product-row:last-child { border-bottom: none; }
    .product-row:hover { background: rgba(95, 39, 205, .025); }

    /* Product cell */
    .product-cell {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .product-thumb {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        object-fit: cover;
        flex-shrink: 0;
        border: 1px solid #e5e7ef;
        background: #f8f9fc;
    }

    .product-name {
        font-size: 13.5px;
        font-weight: 600;
        color: inherit;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: block;
        text-decoration: none;
        transition: color .15s;
    }

    .product-name:hover { color: var(--primary, #5f27cd); }

    /* Cells */
    .cell-sku,
    .cell-category,
    .cell-price {
        font-size: 13px;
    }

    .cell-sku { color: #8a94a6; font-size: 12px; font-family: monospace; }

    .cell-price { font-weight: 600; }

    /* Variant badges */
    .variant-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
        align-items: center;
    }

    .badge-variant {
        display: inline-block;
        padding: 3px 8px;
        border-radius: 5px;
        font-size: 11px;
        font-weight: 500;
        background: rgba(95, 39, 205, .1);
        color: var(--primary, #5f27cd);
    }

    .badge-more {
        font-size: 11px;
        color: #8a94a6;
    }

    .badge-none {
        font-size: 12px;
        color: #b0b7c3;
    }

    /* Actions */
    .cell-actions {
        display: flex;
        align-items: center;
        gap: 6px;
        justify-content: flex-end;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 7px;
        border: 1px solid #e5e7ef;
        background: transparent;
        color: #8a94a6;
        text-decoration: none;
        transition: background .15s, color .15s, border-color .15s;
        cursor: pointer;
    }

    .action-btn:hover { background: var(--primary, #5f27cd); color: #fff; border-color: var(--primary, #5f27cd); }
    .action-btn.danger:hover { background: #ef4444; color: #fff; border-color: #ef4444; }

    /* Scrollable list */
    .product-list-scroll {
        max-height: 520px;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #e0e3ef transparent;
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 48px 20px;
        color: #b0b7c3;
    }
    .empty-state i { font-size: 40px; margin-bottom: 10px; display: block; }
    .empty-state p { margin: 0; font-size: 14px; }

    /* ── Pagination row ──────────────────────────────────── */
    .pagination-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        padding-top: 16px;
        margin-top: 4px;
    }

    .pagination-info { font-size: 13px; color: #8a94a6; }

    /* ── Mobile cards (≤ 640 px) ─────────────────────────── */
    @media (max-width: 640px) {
        .product-table-head { display: none; }
        .product-list-scroll { max-height: none; overflow: visible; }

        .product-row {
            display: flex;
            flex-direction: column;
            gap: 0;
            padding: 16px;
        }

        /* Top row: image + name + actions */
        .product-row-top {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            margin-bottom: 10px;
        }

        .product-row-top .product-name { flex: 1; white-space: normal; }

        /* Meta grid */
        .product-row-meta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6px 16px;
            width: 100%;
        }

        .meta-pair { display: flex; flex-direction: column; gap: 2px; }
        .meta-label { font-size: 10.5px; font-weight: 600; text-transform: uppercase; letter-spacing: .05em; color: #b0b7c3; }
        .meta-value { font-size: 13px; }

        /* Hide original cells on mobile; show mobile layout instead */
        .product-cell,
        .cell-sku,
        .cell-category,
        .cell-price,
        .cell-variants,
        .cell-actions {
            display: none !important;
        }

        .mobile-card { display: flex !important; flex-direction: column; width: 100%; }
    }

    @media (min-width: 641px) {
        .mobile-card { display: none !important; }
    }
</style>
@endpush

@section('index_content')
<div class="main-content-wrap">


    <div class="wg-box">

        {{-- Tip bar --}}
        <div class="title-box mb-20">
            <i class="icon-coffee"></i>
            <div class="body-text">Tip: Search by name or SKU, or filter by category below.</div>
        </div>

        {{-- Toolbar --}}
        <form action="{{ route('products.index') }}" method="GET" id="filter-form">
        <div class="toolbar">
            <div class="toolbar-left">

                {{-- Per-page --}}
                <div class="showing-label">
                    Show
                    <div class="select-wrap">
                        <select name="per_page" onchange="document.getElementById('filter-form').submit()">
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                            <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        </select>
                    </div>
                    entries
                </div>

                {{-- Search --}}
                <div class="search-input-wrap">
                    <input type="text" name="search" placeholder="Search name or SKU…"
                           value="{{ request('search') }}">
                </div>

                {{-- Category --}}
                <div class="select-wrap">
                    <select name="category_id" onchange="document.getElementById('filter-form').submit()">
                        <option value="">All Categories</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            {{-- Add button --}}
            <a class="btn btn-primary gap-3"style="width: 120px; height: 40px; border: 1px solid #0d6efd ; border-radius: 5px; display: flex; align-items: center;"  href="{{ route('products.create') }}">
                <i class="icon-plus"></i>  Add Product
            </a>
        </div>
        </form>

        {{-- Table --}}
        <div class="product-table-wrap">

            {{-- Desktop header --}}
            <div class="product-table-head">
                <span>Product</span>
                <span>SKU / ID</span>
                <span>Category</span>
                <span>Price</span>
                <span>Variants</span>
                <span style="text-align:right">Actions</span>
            </div>

            {{-- Rows --}}
            <div class="product-list-scroll">
                @forelse ($products as $product)

                    {{-- ── DESKTOP ROW ── --}}
                    <div class="product-row">

                        {{-- Product name + image --}}
                        <div class="product-cell">
                            <img class="product-thumb"
                                 src="{{ asset($product->featured_image) }}"
                                 alt="{{ $product->name }}">
                            <a href="{{ route('products.edit', $product->id) }}"
                               class="product-name" title="{{ $product->name }}">
                                {{ $product->name }}
                            </a>
                        </div>

                        <div class="cell-sku">{{ $product->sku ?? '#' . $product->id }}</div>

                        <div class="cell-category">{{ $product->category->name }}</div>

                        <div class="cell-price">
                            @if ($product->has_variants)
                                From&nbsp;Rs.&nbsp;{{ number_format($product->variants->min('price'), 2) }}
                            @else
                                Rs.&nbsp;{{ number_format($product->base_price, 2) }}
                            @endif
                        </div>

                        <div class="cell-variants">
                            <div class="variant-badges">
                                @if ($product->has_variants)
                                    @foreach ($product->variants->take(2) as $variant)
                                        <span class="badge-variant">{{ $variant->storage }}</span>
                                    @endforeach
                                    @if ($product->variants->count() > 2)
                                        <span class="badge-more">+{{ $product->variants->count() - 2 }} more</span>
                                    @endif
                                @else
                                    <span class="badge-none">—</span>
                                @endif
                            </div>
                        </div>

                        <div class="cell-actions">
                          
                            <a class="action-btn"
                               href="{{ route('products.view', ['id' => $product->id, 'slug' => $product->slug]) }}"
                               target="_blank" title="View">
                                <i class="icon-eye"></i>
                            </a>
                            <a class="action-btn"
                               href="{{ route('products.edit', $product->id) }}"
                               title="Edit">
                                <i class="icon-edit-3"></i>
                            </a>
                        </div>

                        {{-- ── MOBILE CARD (hidden on desktop via CSS) ── --}}
                        <div class="mobile-card">
                            <div class="product-row-top">
                                <img class="product-thumb"
                                     src="{{ asset($product->featured_image) }}"
                                     alt="{{ $product->name }}">
                                <a href="{{ route('products.edit', $product->id) }}"
                                   class="product-name">{{ $product->name }}</a>
                                <div style="display:flex;gap:6px;margin-left:auto;flex-shrink:0;">
                                    <a class="action-btn"
                                       href="{{ url('/product/' . $product->id . '/' . $product->slug) }}"
                                       target="_blank" title="View">
                                        <i class="icon-eye"></i>
                                    </a>
                                    <a class="action-btn"
                                       href="{{ route('products.edit', $product->id) }}"
                                       title="Edit">
                                        <i class="icon-edit-3"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="product-row-meta">
                                <div class="meta-pair">
                                    <span class="meta-label">SKU</span>
                                    <span class="meta-value cell-sku">{{ $product->sku ?? '#' . $product->id }}</span>
                                </div>
                                <div class="meta-pair">
                                    <span class="meta-label">Category</span>
                                    <span class="meta-value">{{ $product->category->name }}</span>
                                </div>
                                <div class="meta-pair">
                                    <span class="meta-label">Price</span>
                                    <span class="meta-value cell-price">
                                        @if ($product->has_variants)
                                            From Rs. {{ number_format($product->variants->min('price'), 2) }}
                                        @else
                                            Rs. {{ number_format($product->base_price, 2) }}
                                        @endif
                                    </span>
                                </div>
                                <div class="meta-pair">
                                    <span class="meta-label">Variants</span>
                                    <span class="meta-value">
                                        <div class="variant-badges">
                                            @if ($product->has_variants)
                                                @foreach ($product->variants->take(2) as $variant)
                                                    <span class="badge-variant">{{ $variant->storage }}</span>
                                                @endforeach
                                                @if ($product->variants->count() > 2)
                                                    <span class="badge-more">+{{ $product->variants->count() - 2 }} more</span>
                                                @endif
                                            @else
                                                <span class="badge-none">—</span>
                                            @endif
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>

                @empty
                    <div class="empty-state">
                        <i class="icon-package"></i>
                        <p>No products found. Try adjusting your search or filters.</p>
                    </div>
                @endforelse
            </div>
        </div>
        @if(session('error'))
    <span class="text-danger">
        {{ session('error') }}
    </span>
@endif
    </div>
</div>
@endsection