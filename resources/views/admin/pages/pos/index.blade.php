@extends('admin.layouts.app')

@section('index_content')
    <div class="pos-container">

        {{-- ===== LEFT: Products Panel ===== --}}
        <div class="pos-products overflow-auto ">
            <div class="panel-header">
                <h2 class="panel-title m-0">Products</h2>
                <div class="search-wrap">
                    <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.35-4.35" />
                    </svg>
                    <input type="text" id="productSearch" class="search-input" placeholder="Search products…">
                </div>
            </div>

            <div class="product-grid  overflow-auto" id="productGrid">

                @foreach ($products as $product)
                    <div class="product-card"
                         data-id="{{ $product->id }}"
                         data-name="{{ addslashes($product->name) }}"
                         data-original-stock="{{ $product->available_qty }}">

                        <div class="product-card-body">
                            {{-- Badges row --}}
                            @if ($product->has_variants || $product->requires_imei)
                                <div class="product-card-badges-row">
                                    @if ($product->has_variants)
                                        <span class="badge-pill badge-pill--info">Variants</span>
                                    @endif
                                    @if ($product->requires_imei)
                                        <span class="badge-pill badge-pill--dark">IMEI</span>
                                    @endif
                                </div>
                            @endif

                            {{-- SKU --}}
                            <span class="product-card-sku">SKU: {{ $product->sku }}</span>

                            {{-- Name --}}
                            <h5 class="product-card-name" title="{{ $product->name }}">
                                {{ $product->name }}
                            </h5>

                            {{-- Price --}}
                            <div class="product-card-price-row">
                                @if ((float) $product->base_price > 0)
                                    <span class="product-card-price">
                                        Rs. {{ number_format($product->base_price, 2) }}
                                    </span>
                                @else
                                    <span class="product-card-price product-card-price--quote">
                                        Price on request
                                    </span>
                                @endif
                            </div>

                            {{-- Warranty --}}
                            @if ($product->has_warranty)
                                <div class="product-card-warranty">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z" />
                                    </svg>
                                    <span>{{ $product->warranty_period }}</span>
                                </div>
                            @endif

                            {{-- Stock --}}
                            <div class="product-card-footer">
                                <span class="stock-pill
                                    @if ($product->available_qty > 10) stock-pill--in
                                    @elseif($product->available_qty > 0) stock-pill--low
                                    @else stock-pill--out @endif">
                                    {{ $product->available_qty > 0 ? 'Stock: ' . $product->available_qty : 'Out of Stock' }}
                                </span>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>

            {{-- ===== Load More (incremental / lazy loading) ===== --}}
            <div class="load-more-wrap" id="loadMoreWrap" data-next-page="2" data-has-more="{{ $products->hasMorePages() ? '1' : '0' }}">
                <button type="button" class="btn-load-more" id="loadMoreBtn" onclick="loadMoreProducts()" @if(!$products->hasMorePages()) style="display:none;" @endif>
                    <span class="load-more-label">Load More Products</span>
                    <span class="load-more-spinner" style="display:none;">
                        <svg viewBox="0 0 24 24" width="16" height="16" class="spin-icon"><circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="3" stroke-dasharray="40" stroke-linecap="round"/></svg>
                        Loading…
                    </span>
                </button>
                <p class="load-more-end" id="loadMoreEnd" style="display:none;">You've reached the end of the catalogue</p>
            </div>
        </div>

        {{-- ===== RIGHT: Cart / Sidebar ===== --}}
        <div class="pos-sidebar">

            {{-- Customer Row --}}
            <div class="pos-sidebar__customer">
                <label class="pos-sidebar__label">Customer</label>
                <div class="customer-row">
                    <select id="customer-select">
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">
                                {{ $customer->name }} — {{ $customer->mobile }}
                            </option>
                        @endforeach
                    </select>
                    <button type="button"
                        class="btn-icon-circle"
                        onclick="$('#addCustomerModal').addClass('open')"
                        title="Add customer"
                        aria-label="Add customer">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="18" height="18">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Two-panel body: Cart | Bill --}}
            <div class="pos-sidebar__body">

                {{-- LEFT PANEL: Cart Items --}}
                <div class="pos-cart-panel">
                    <div class="pos-panel-head">
                        <span class="pos-panel-head__title">Cart Items</span>
                        <span class="cart-item-count" id="cartItemCount">0 items</span>
                    </div>
                    <div class="pos-cart-scroll" id="cart-items">
                        {{-- Rendered by JS renderCart() --}}
                    </div>
                </div>

                {{-- RIGHT PANEL: Bill Summary + Payment + Checkout --}}
                <div class="pos-bill-panel">
                    <div class="pos-panel-head">
                        <span class="pos-panel-head__title">Bill Summary</span>
                    </div>

                    <div class="pos-bill-body">

                        {{-- Subtotal --}}
                        <div class="bill-block">
                            <div class="bill-row">
                                <span>Subtotal</span>
                                <span class="bill-row-value">Rs. <span id="cart-subtotal">0.00</span></span>
                            </div>
                        </div>

                        {{-- Bill Discount --}}
                        <div class="bill-disc-block">
                            <div class="bill-disc-label">Bill discount</div>
                            <div class="discount-type-toggle" data-target="bill">
                                <button type="button" class="dtype-btn active" data-type="percent" onclick="setBillDiscountType('percent')">%</button>
                                <button type="button" class="dtype-btn" data-type="fixed" onclick="setBillDiscountType('fixed')">Rs</button>
                            </div>
                            <input type="number" id="billDiscountValue" class="bill-disc-input" placeholder="0" min="0" step="0.01" oninput="onBillDiscountInput()">
                            <div class="discount-converted-line" id="billDiscountConverted" style="display:none;"></div>
                        </div>

                        {{-- Discount Applied Row --}}
                        <div class="bill-row bill-row--discount" id="billDiscountAmountRow" style="display:none;">
                            <span>Discount</span>
                            <span class="bill-row-value bill-row-value--neg">− Rs. <span id="billDiscountAmount">0.00</span></span>
                        </div>

                        {{-- Grand Total --}}
                        <div class="bill-total-block">
                            <div class="bill-total-row">
                                <span class="bill-total-label">Total</span>
                                <span class="bill-total-value">Rs. <span id="cart-total">0.00</span></span>
                            </div>
                        </div>

                        {{-- Payment Method --}}
                        <div class="bill-pay-block">
                            <div class="bill-disc-label">Payment</div>
                            <div class="payment-tabs">
                                <button class="pay-tab active" data-method="cash">Cash</button>
                                <button class="pay-tab" data-method="card">Card</button>
                                <button class="pay-tab" data-method="koko">Koko</button>
                            </div>
                            <input type="hidden" id="paymentMethod" value="cash">
                        </div>

                        {{-- Cash Received --}}
                        <div id="cashSection" class="bill-cash-block">
                            <div class="bill-disc-label">Cash received</div>
                            <input type="number" id="cashReceived" class="bill-cash-input" placeholder="0.00" oninput="updateBalanceDisplay()">
                            <div class="quick-cash-row">
                                <button type="button" class="quick-cash-btn" onclick="setCashReceived(1000)">1,000</button>
                                <button type="button" class="quick-cash-btn" onclick="setCashReceived(5000)">5,000</button>
                                <button type="button" class="quick-cash-btn" onclick="setCashReceived(10000)">10,000</button>
                                <button type="button" class="quick-cash-btn quick-cash-btn--exact" onclick="setCashReceived('exact')" title="Exact amount">Exact</button>
                            </div>
                            <div id="balanceDisplay" class="balance-display"></div>
                        </div>

                    </div>

                    {{-- Checkout Button --}}
                    <button class="btn-checkout" onclick="checkout()">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                        Complete Order
                    </button>
                </div>

            </div>
        </div>

    </div>

    {{-- ===== Variant Modal ===== --}}
    <div id="variantModal" class="modal-overlay">
         <div class="modal-box d-flex flex-column" style="height: 400px; max-height: 90vh;">
            <div class="modal-header flex-shrink-0">
                <div class="modal-header-inner">
                    <div class="modal-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" width="22" height="22">
                            <rect x="2" y="7" width="20" height="14" rx="2"/>
                            <path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/>
                        </svg>
                    </div>
                    <div>
                        <p class="modal-eyebrow">Select Variant</p>
                        <h4 id="modalProductTitle" class="modal-title-text">Product Name</h4>
                    </div>
                </div>
                <button class="modal-close" onclick="closeVariantModal('variantModal')" title="Close">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18">
                        <path d="M18 6 6 18M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Variant search — shown only when >5 variants --}}
            <div id="variantSearchWrap" class="variant-search-wrap" style="display:none;">
                <div class="variant-search-inner">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16" class="variant-search-icon">
                        <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                    </svg>
                    <input type="text" id="variantSearch" class="variant-search-input" placeholder="Search variants…" oninput="filterVariants()">
                </div>
            </div>

            <div id="variant-list" class="variant-list"></div>

            <div id="variantEmpty" class="variant-empty" style="display:none;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="36" height="36">
                    <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                </svg>
                <p>No variants match your search</p>
            </div>
        </div>
    </div>

    {{-- ===== IMEI Modal ===== --}}
    <div id="imeiModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <div class="modal-header-inner">
                    <div class="modal-icon modal-icon--blue">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" width="22" height="22">
                            <rect x="5" y="2" width="14" height="20" rx="2"/>
                            <path d="M12 18h.01"/>
                        </svg>
                    </div>
                    <div>
                        <p class="modal-eyebrow">IMEI Selection</p>
                        <h4 class="modal-title-text">Select IMEIs</h4>
                    </div>
                </div>
                <button class="modal-close" onclick="closeVariantModal('imeiModal')" title="Close">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18">
                        <path d="M18 6 6 18M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="modal-search-section">
                <div class="variant-search-inner">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16" class="variant-search-icon">
                        <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                    </svg>
                    <input type="text" id="imeiSearch" class="variant-search-input" placeholder="Search IMEI number…" oninput="filterImeis()">
                </div>
            </div>

            <div id="imei-list" class="variant-list imei-list"></div>

            <div class="modal-footer-action">
                <button class="btn-checkout" onclick="addSelectedImeisToCart()">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                        <path d="M20 6 9 17l-5-5"/>
                    </svg>
                    Confirm Selection
                </button>
            </div>
        </div>
    </div>

    {{-- ===== Item Discount Modal ===== --}}
    <div id="itemDiscountModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <div class="modal-header-inner">
                    <div class="modal-icon modal-icon--green">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" width="22" height="22">
                            <path d="M9 2 2 9v6l9 9 11-11-9-11Z"/>
                            <circle cx="9" cy="9" r="1.5" fill="currentColor" stroke="none"/>
                        </svg>
                    </div>
                    <div>
                        <p class="modal-eyebrow">Item Discount</p>
                        <h4 id="itemDiscountProductTitle" class="modal-title-text">Product Name</h4>
                    </div>
                </div>
                <button class="modal-close" onclick="closeVariantModal('itemDiscountModal')" title="Close">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18">
                        <path d="M18 6 6 18M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="modal-form-body">

                <div class="item-discount-price-line">
                    <span>Unit price</span>
                    <span id="itemDiscountUnitPrice" class="item-discount-price-value">Rs. 0.00</span>
                </div>

                <div class="form-field">
                    <label class="form-label">Discount type</label>
                    <div class="discount-type-toggle discount-type-toggle--lg" data-target="item">
                        <button type="button" class="dtype-btn active" data-type="percent" onclick="setItemDiscountType('percent')">% Percentage</button>
                        <button type="button" class="dtype-btn" data-type="fixed" onclick="setItemDiscountType('fixed')">Rs Fixed</button>
                    </div>
                </div>

                <div class="form-field">
                    <label class="form-label" id="itemDiscountInputLabel">Discount percentage</label>
                    <input type="number" id="itemDiscountValue" class="styled-input" placeholder="0" min="0" step="0.01" oninput="onItemDiscountInput()">
                </div>

                <div class="discount-converted-line" id="itemDiscountConverted" style="display:none;"></div>

                <div class="item-discount-result">
                    <span>Price after discount</span>
                    <span id="itemDiscountFinalPrice" class="item-discount-result-value">Rs. 0.00</span>
                </div>

                <button class="btn-checkout" onclick="applyItemDiscount()">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                        <path d="M20 6 9 17l-5-5"/>
                    </svg>
                    Apply Discount
                </button>
                <button class="btn-clear-discount" onclick="clearItemDiscount()">Remove discount</button>
            </div>
        </div>
    </div>

    {{-- ===== Add Customer Modal ===== --}}
    <div id="addCustomerModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <div class="modal-header-inner">
                    <div class="modal-icon modal-icon--green">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" width="22" height="22">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                    <div>
                        <p class="modal-eyebrow">New Customer</p>
                        <h4 class="modal-title-text">Add Customer</h4>
                    </div>
                </div>
                <button class="modal-close" onclick="$('#addCustomerModal').removeClass('open')" title="Close">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18">
                        <path d="M18 6 6 18M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="modal-form-body">
                <div class="form-field">
                    <label class="form-label">Name <span class="required">*</span></label>
                    <input type="text" id="new_cust_name" class="styled-input" placeholder="Full name">
                    <span id="err_name" class="field-error"></span>
                </div>
                <div class="form-field">
                    <label class="form-label">Mobile <span class="required">*</span></label>
                    <input type="tel" id="new_cust_mobile" class="styled-input" pattern="[0-9]{10,15}" minlength="10" maxlength="15" placeholder="07X XXX XXXX">
                    <span id="err_mobile" class="field-error"></span>
                </div>
                <div class="form-field">
                    <label class="form-label">NIC <span class="optional">Optional</span></label>
                    <input type="text" id="new_cust_nic" class="styled-input" minlength="10" maxlength="12" placeholder="NIC number">
                </div>
                <div class="form-field">
                    <label class="form-label">Email <span class="optional">Optional</span></label>
                    <input type="email" id="new_cust_email" class="styled-input" pattern="^[^\s@]+@[^\s@]+\.[a-zA-Z]{2,}$" placeholder="email@example.com">
                </div>
                <div class="form-field">
                    <label class="form-label">Address <span class="optional">Optional</span></label>
                    <input type="text" id="new_cust_address" class="styled-input" placeholder="Street address">
                </div>

                <button class="btn-checkout" onclick="saveCustomer()">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v14a2 2 0 0 1-2 2z"/>
                        <polyline points="17 21 17 13 7 13 7 21"/>
                        <polyline points="7 3 7 8 15 8"/>
                    </svg>
                    Save Customer
                </button>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('admin_assets/css/pos.css') }}">
<style>

/* ── POS container: products | sidebar ───────────────────── */
.pos-container {
    display: grid;
    grid-template-columns: 1fr 620px;
    gap: 0;
    width: 100%;
    height: calc(100vh - 64px);
    overflow: hidden;
    margin-left: calc(-1 * var(--content-padding, 24px));
    margin-right: calc(-1 * var(--content-padding, 24px));
    padding-left: var(--content-padding, 24px);
    padding-right: 0;
    box-sizing: border-box;
}

/* ── Products panel ───────────────────────────────────────── */
.pos-products {
    overflow-y: auto;
    padding: 16px;
    background: #f8fafc;
    display: flex;
    flex-direction: column;
    gap: 14px;
}
.panel-header {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    flex-shrink: 0;
}
.panel-title { margin: 0; font-weight: 800; font-size: 1.1rem; color: #0f172a; }
.search-wrap { position: relative; flex: 1 1 160px; max-width: 240px; }
.search-icon { position: absolute; left: 11px; top: 50%; transform: translateY(-50%); width: 14px; height: 14px; color: #94a3b8; pointer-events: none; }
.search-input { width: 100%; padding: 7px 10px 7px 30px; border: 1.5px solid #e2e8f0; border-radius: 999px; font-size: 12px; outline: none; background: #fff; transition: border-color .15s; }
.search-input:focus { border-color: #2563EB; box-shadow: 0 0 0 3px rgba(99,102,241,.1); }

/* ── Product grid ─────────────────────────────────────────── */
.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 12px;
    overflow-y: auto;
    padding: 4px;
}
.product-grid::-webkit-scrollbar { display: none; }
.pos-products { -ms-overflow-style: auto; scrollbar-width: none; }
.pos-products::-webkit-scrollbar { display: none; }

/* ── Product Card ─────────────────────────────────────────── */
.product-card {
    display: flex;
    flex-direction: column;
    background: #fff;
    border-radius: 12px;
    border: 1px solid #eef0f4;
    box-shadow: 0 1px 3px rgba(0,0,0,.05);
    overflow: hidden;
    cursor: pointer;
    transition: transform .2s, box-shadow .2s, border-color .2s;
    height: 195px;
    width: 100%;
    margin: 0;
    box-sizing: border-box;
}
.product-card:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(15,23,42,.1); border-color: #e0e4ff; }
.product-card-badges-row { display: flex; gap: 4px; margin-bottom: 4px; }
.badge-pill { font-size: 10px; font-weight: 700; letter-spacing: .02em; color: #fff; padding: 3px 7px; border-radius: 999px; line-height: 1.4; }
.badge-pill--info { background: #0dcaf0; color: #053742; }
.badge-pill--dark { background: #1e293b; }
.product-card-body {
    display: flex;
    flex-direction: column;
    flex: 1;
    padding: 10px;
    gap: 4px;
    box-sizing: border-box;
    overflow: hidden;
}
.product-card-sku { font-size: 10px; font-weight: 600; letter-spacing: .04em; text-transform: uppercase; color: #94a3b8; }
.product-card-name { margin: 0; font-weight: 700; font-size: 1.50rem; line-height: 1.25; color: #0f172a; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; min-height: 2.1em; }
.product-card-price-row { margin-top: auto; }
.product-card-price { font-weight: 800; font-size: 1.4rem; color: #0f172a; }
.product-card-price--quote { font-weight: 500; font-style: italic; font-size: .78rem; color: #94a3b8; }
.product-card-warranty { display: flex; align-items: center; gap: 5px; font-size: 11px; font-weight: 600; color: #16a34a; }
.product-card-footer { margin-top: 3px; padding-top: 7px; border-top: 1px solid #f1f5f9; }
.stock-pill { display: inline-block; font-size: 10px; font-weight: 700; padding: 3px 9px; border-radius: 999px; color: #fff; }
.stock-pill--in { background: #16a34a; }
.stock-pill--low { background: #f59e0b; color: #1e1300; }
.stock-pill--out { background: #ef4444; }

/* ── Load More ────────────────────────────────────────────── */
.load-more-wrap { margin-top: 14px; text-align: center; }
.btn-load-more { border: 1.5px solid #c7d2fe; background: #fff; color: #2563EB; font-weight: 700; font-size: 12px; padding: 9px 20px; border-radius: 999px; cursor: pointer; display: inline-flex; align-items: center; gap: 7px; }
.btn-load-more:hover { background: #eef2ff; }
.btn-load-more:disabled { opacity: .6; cursor: not-allowed; }
.load-more-spinner { display: inline-flex; align-items: center; gap: 6px; }
.spin-icon { animation: spin .8s linear infinite; }
@keyframes spin { to { transform: rotate(360deg); } }
.load-more-end { font-size: 12px; color: #94a3b8; font-weight: 600; margin: 0; }
.product-card--new { animation: cardFadeIn .3s ease; }
@keyframes cardFadeIn { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }

/* ═══════════════════════════════════════════════════════════
   SIDEBAR — full height flex column
══════════════════════════════════════════════════════════════ */
.pos-sidebar {
    display: flex;
    flex-direction: column;
    background: #fff;
    border-left: 1px solid #e2e8f0;
    height: 100%;
    overflow: hidden;
    max-width: none;
}

/* Customer strip */
.pos-sidebar__customer {
    padding: 10px 14px;
    border-bottom: 1px solid #e2e8f0;
    flex-shrink: 0;
    background: #fff;
}
.pos-sidebar__label {
    display: block;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: .07em;
    text-transform: uppercase;
    color: #94a3b8;
    margin-bottom: 6px;
}
.customer-row { display: flex; gap: 8px; align-items: center; }
.customer-row select { flex: 1; min-width: 0; padding: 7px 10px; border: 1.5px solid #e2e8f0; border-radius: 999px; font-size: 12px; color: #0f172a; background: #f8fafc; outline: none; }
.btn-icon-circle { width: 34px; height: 34px; flex-shrink: 0; border-radius: 50%; border: 1.5px solid #c6c6c6; background: #fff; color: #6366f1; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: background .15s, border-color .15s; }
.btn-icon-circle:hover { background: #eef2ff; border-color: #2563EB; }
.customer-row .select2-container { flex: 1; min-width: 0; }

/* Two-panel body */
.pos-sidebar__body {
    flex: 1;
    display: flex;
    flex-direction: row;
    overflow: hidden;
    min-height: 0;
}

/* ── Cart Panel (left of sidebar body) ───────────────────── */
.pos-cart-panel {
    flex: 1;
    min-width: 0;
    display: flex;
    flex-direction: column;
    border-right: 1px solid #e2e8f0;
    overflow: hidden;
}
.pos-panel-head {
    padding: 9px 12px 8px;
    flex-shrink: 0;
    border-bottom: 1px solid #e2e8f0;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.pos-panel-head__title {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: .07em;
    text-transform: uppercase;
    color: #64748b;
}
.cart-item-count {
    background: #2563EB;
    color: #fff;
    font-size: 10px;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 999px;
}
.pos-cart-scroll {
    flex: 1;
    overflow-y: auto;
    padding: 8px;
    display: flex;
    flex-direction: column;
    gap: 6px;
    background: #f8fafc;
}

/* ── Cart Item Card ───────────────────────────────────────── */
.cart-empty-state { display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 28px 16px; color: #94a3b8; text-align: center; flex: 1; }
.cart-empty-state svg { margin-bottom: 8px; color: #cbd5e1; }
.cart-empty-state p { font-size: 13px; font-weight: 600; color: #64748b; margin: 0 0 3px; }
.cart-empty-state span { font-size: 11px; }

.pos-cart-scroll .card-item {
    background: #fff;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
    flex-shrink: 0;
}

/* ── Bill Panel (right of sidebar body) ──────────────────── */
.pos-bill-panel {
    width: 240px;
    flex-shrink: 0;
    display: flex;
    flex-direction: column;
    background: #fff;
    overflow: hidden;
}
.pos-bill-body {
    flex: 1;
    overflow-y: auto;
    padding: 10px 12px;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.bill-block { display: flex; flex-direction: column; gap: 4px; }
.bill-row { display: flex; align-items: center; justify-content: space-between; font-size: 11.5px; color: #475569; font-weight: 600; }
.bill-row-value { color: #0f172a; font-weight: 700; }
.bill-row--discount .bill-row-value--neg { color: #16a34a; }

.bill-disc-block {
    border-top: 1px dashed #e2e8f0;
    padding-top: 8px;
    display: flex;
    flex-direction: column;
    gap: 5px;
}
.bill-disc-label { font-size: 11px; font-weight: 700; color: #334155; }
.discount-type-toggle { display: flex; border: 1.5px solid #e2e8f0; border-radius: 999px; overflow: hidden; background: #f8fafc; }
.dtype-btn { border: none; background: transparent; color: #64748b; font-size: 11px; font-weight: 700; padding: 4px 10px; cursor: pointer; flex: 1; transition: background .15s, color .15s; }
.dtype-btn.active { background: #2563EB; color: #fff; }
.bill-disc-input { width: 100%; padding: 5px 8px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 12px; font-weight: 600; text-align: right; outline: none; background: #f8fafc; transition: border-color .15s, box-shadow .15s; }
.bill-disc-input:focus { border-color: #2563EB; box-shadow: 0 0 0 3px rgba(99,102,241,.1); }
.discount-converted-line { font-size: 10px; color: #2563EB; font-weight: 600; background: #eef2ff; border-radius: 6px; padding: 5px 8px; line-height: 1.4; }

.bill-total-block { border-top: 2px solid #0f172a; padding-top: 8px; }
.bill-total-row { display: flex; align-items: baseline; justify-content: space-between; }
.bill-total-label { font-size: 12px; font-weight: 700; color: #0f172a; }
.bill-total-value { font-size: 15px; font-weight: 900; color: #0f172a; }

.bill-pay-block { border-top: 1px solid #e2e8f0; padding-top: 8px; display: flex; flex-direction: column; gap: 5px; }
.payment-tabs { display: flex; gap: 4px; }
.pay-tab { flex: 1; padding: 5px 3px; border: 1.5px solid #e2e8f0; background: #fff; border-radius: 7px; font-size: 10px; font-weight: 700; color: #64748b; cursor: pointer; text-align: center; transition: background .15s, border-color .15s, color .15s; }
.pay-tab.active { background: #eef2ff; border-color: #2563EB; color: #2563EB; }

.bill-cash-block { border-top: 1px solid #e2e8f0; padding-top: 8px; display: flex; flex-direction: column; gap: 4px; }
.bill-cash-input { width: 100%; padding: 6px 9px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 12px; font-weight: 600; outline: none; background: #f8fafc; transition: border-color .15s; }
.bill-cash-input:focus { border-color: #2563EB; }
.balance-display { font-size: 10.5px; font-weight: 700; text-align: right; min-height: 16px; }
.quick-cash-row { display: flex; gap: 4px; margin-top: 4px; }
.quick-cash-btn { flex: 1; padding: 4px 2px; font-size: 10px; font-weight: 700; color: #2563EB; background: #f0f2ff; border: 1.5px solid #c7d2fe; border-radius: 6px; cursor: pointer; text-align: center; transition: background .15s, border-color .15s, color .15s; }
.quick-cash-btn:hover { background: #e0e4ff; border-color: #2563EB; }
.quick-cash-btn--exact { color: #16a34a; background: #f0fdf4; border-color: #bbf7d0; }
.quick-cash-btn--exact:hover { background: #dcfce7; border-color: #86efac; }

.btn-checkout {
    margin: 10px 12px 40px;
    width: calc(100% - 24px);
    padding: 11px;
    background: #2563EB;
    color: #fff;
    border: none;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    flex-shrink: 0;
    transition: background .15s;
}
.btn-checkout:hover { background: #4f46e5; }

/* Item discount affordances (used inside JS-rendered cart cards) */
.discount-add-btn { background: none; border: 1.5px solid #bbf7d0; color: #16a34a; font-size: 10px; font-weight: 700; padding: 2px 8px; border-radius: 999px; cursor: pointer; }
.discount-add-btn:hover { background: #f0fdf4; }
.discount-applied-badge { display: inline-flex; align-items: center; gap: 3px; font-size: 10px; font-weight: 700; padding: 2px 8px; border-radius: 999px; background: #fef9c3; color: #92400e; cursor: pointer; border: none; }
.cart-item-price-strike { text-decoration: line-through; color: #cbd5e1; font-weight: 600; font-size: 11px; margin-right: 3px; }
.imei-add-btn { background: none; border: 1.5px solid #c7d2fe; color: #6366f1; font-size: 10px; font-weight: 600; padding: 2px 8px; border-radius: 999px; cursor: pointer; }
.imei-add-btn:hover { background: #eef2ff; }
.imei-badge { display: inline-flex; align-items: center; gap: 3px; font-size: 10px; font-weight: 600; padding: 2px 8px; border-radius: 999px; }
.imei-badge--ok { background: #dcfce7; color: #16a34a; }
.cart-item-imei svg { opacity: .7; flex-shrink: 0; }

/* ── Modals ───────────────────────────────────────────────── */
.modal-overlay { display: none; position: fixed; inset: 0; background: rgba(15,23,42,.55); backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px); z-index: 1050; align-items: center; justify-content: center; padding: 16px; }
.modal-overlay.open,
.modal-overlay[style*="display: block"],
.modal-overlay[style*="display:block"] { display: flex !important; }
.modal-box { background: #fff; border-radius: 16px; width: 100%; max-width: 520px; max-height: 88vh; display: flex; flex-direction: column; box-shadow: 0 24px 64px rgba(0,0,0,.18), 0 4px 16px rgba(0,0,0,.08); overflow: hidden; animation: modalIn .22s cubic-bezier(.34,1.56,.64,1); }
@keyframes modalIn { from { opacity: 0; transform: scale(.94) translateY(10px); } to { opacity: 1; transform: scale(1) translateY(0); } }
.modal-header { display: flex; align-items: center; justify-content: space-between; gap: 10px; padding: 18px 20px; border-bottom: 1px solid #f1f5f9; flex-shrink: 0; }
@media (min-width: 480px) { .modal-header { padding: 20px 24px; } }
.modal-header-inner { display: flex; align-items: center; gap: 12px; min-width: 0; }
.modal-icon { width: 40px; height: 40px; border-radius: 12px; background: #f0f4ff; color: #4f6ef7; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
@media (min-width: 480px) { .modal-icon { width: 44px; height: 44px; } }
.modal-icon--blue { background: #eff6ff; color: #3b82f6; }
.modal-icon--green { background: #f0fdf4; color: #22c55e; }
.modal-eyebrow { font-size: 11px; font-weight: 600; letter-spacing: .07em; text-transform: uppercase; color: #94a3b8; margin: 0 0 2px; }
.modal-title-text { font-size: clamp(.95rem,.85rem + .5vw,17px); font-weight: 700; color: #0f172a; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: min(260px,60vw); }
.modal-close { width: 34px; height: 34px; border-radius: 8px; border: none; background: #f8fafc; color: #64748b; cursor: pointer; display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: background .15s, color .15s; }
.modal-close:hover { background: #fee2e2; color: #ef4444; }
.variant-search-wrap { padding: 14px 20px 0; flex-shrink: 0; }
.modal-search-section { padding: 14px 20px 0; flex-shrink: 0; }
@media (min-width: 480px) { .variant-search-wrap, .modal-search-section { padding-inline: 24px; } }
.variant-search-inner { position: relative; display: flex; align-items: center; }
.variant-search-icon { position: absolute; left: 12px; color: #94a3b8; pointer-events: none; }
.variant-search-input { width: 100%; padding: 10px 14px 10px 38px; border: 1.5px solid #e2e8f0; border-radius: 10px; font-size: 14px; color: #1e293b; background: #f8fafc; outline: none; transition: border-color .15s, box-shadow .15s; }
.variant-search-input:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,.12); background: #fff; }
.variant-list { overflow-y: auto; flex: 1; padding: 12px 20px 0; }
@media (min-width: 480px) { .variant-list { padding-inline: 24px; } }
.variant-item { display: flex; align-items: center; justify-content: space-between; gap: 10px; padding: 14px 16px; border-radius: 12px; margin-bottom: 8px; cursor: pointer; border: 1.5px solid #e8edf5; background: #fafbff; transition: background .15s, border-color .15s, transform .1s; }
.variant-item:hover { background: #eef2ff; border-color: #6366f1; transform: translateY(-1px); }
.variant-item:last-child { margin-bottom: 0; }
.variant-item-label { font-size: 14px; font-weight: 500; color: #1e293b; }
.variant-item-price { font-size: 14px; font-weight: 700; color: #6366f1; white-space: nowrap; }
.variant-item-stock { font-size: 11px; color: #94a3b8; margin-top: 2px; }
.variant-empty { padding: 32px 20px; text-align: center; color: #94a3b8; flex-shrink: 0; }
.variant-empty svg { margin-bottom: 8px; color: #cbd5e1; }
.variant-empty p { font-size: 14px; margin: 0; }
.imei-list { max-height: 280px; }
.imei-item { display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 10px; margin-bottom: 6px; border: 1.5px solid #e8edf5; background: #fafbff; cursor: pointer; transition: background .15s, border-color .15s; }
.imei-item:hover { background: #eff6ff; border-color: #3b82f6; }
.imei-item input[type="checkbox"] { width: 16px; height: 16px; accent-color: #6366f1; cursor: pointer; flex-shrink: 0; }
.imei-item-number { font-size: 14px; font-weight: 500; color: #1e293b; font-family: monospace; word-break: break-all; }
.modal-footer-action { padding: 16px 20px 20px; flex-shrink: 0; border-top: 1px solid #f1f5f9; }
@media (min-width: 480px) { .modal-footer-action { padding: 16px 24px 24px; } }
.modal-footer-action .btn-checkout { margin: 0; }
.modal-form-body { padding: 18px 20px 20px; overflow-y: auto; display: flex; flex-direction: column; gap: 12px; }
@media (min-width: 480px) { .modal-form-body { padding: 20px 24px 24px; } }
.form-field { display: flex; flex-direction: column; gap: 5px; }
.form-label { font-size: 13px; font-weight: 600; color: #374151; }
.required { color: #ef4444; }
.optional { font-size: 11px; font-weight: 400; color: #94a3b8; margin-left: 4px; }
.field-error { font-size: 11px; color: #ef4444; min-height: 14px; }
.styled-input { width: 100%; padding: 8px 12px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 13px; outline: none; background: #f8fafc; transition: border-color .15s; }
.styled-input:focus { border-color: #6366f1; }
.discount-type-toggle--lg .dtype-btn { padding: 10px 14px; font-size: 13px; flex: 1; }
.discount-input-group { display: flex; align-items: center; gap: 8px; }
.discount-input { width: 90px; padding: 7px 10px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 13px; font-weight: 600; text-align: right; outline: none; transition: border-color .15s, box-shadow .15s; }
.discount-input:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,.12); }
.item-discount-price-line { display: flex; align-items: center; justify-content: space-between; background: #f8fafc; border-radius: 10px; padding: 10px 12px; font-size: 13px; font-weight: 600; color: #475569; }
.item-discount-price-value { color: #0f172a; font-weight: 800; }
.item-discount-result { display: flex; align-items: center; justify-content: space-between; background: #f0fdf4; border-radius: 10px; padding: 10px 12px; font-size: 13px; font-weight: 700; color: #166534; }
.item-discount-result-value { font-size: 16px; font-weight: 800; color: #16a34a; }
.btn-clear-discount { background: none; border: none; color: #ef4444; font-size: 12.5px; font-weight: 700; padding: 8px; cursor: pointer; text-align: center; }
.btn-clear-discount:hover { text-decoration: underline; }
.stock-ok { color: #16a34a; }
.stock-low { color: #d97706; }
.stock-none { color: #dc2626; }
#variantModal { display: none; }

/* ── Responsive ───────────────────────────────────────────── */
@media (max-width: 991px) {
    .pos-container { grid-template-columns: 1fr; height: auto; overflow: visible; padding-right: var(--content-padding, 24px); }
    .pos-sidebar { height: auto; border-left: none; border-top: 1px solid #e2e8f0; }
    .pos-sidebar__body { flex-direction: column; overflow: visible; }
    .pos-cart-panel { border-right: none; border-bottom: 1px solid #e2e8f0; max-height: 400px; }
    .pos-bill-panel { width: 100%; }
    .pos-cart-scroll { max-height: 360px; }
}
@media (max-width: 575.98px) {
    .payment-tabs { flex-wrap: wrap; }
}
</style>
@endpush

@push('scripts')
    <script>
        const assetBaseUrl = "{{ preg_replace('/^https?:/', '', asset('/')) }}";

        // ── Customer Select2 ──────────────────────────────────
        $('#customer-select').select2({ width: '100%' });

        // ── Payment tabs ──────────────────────────────────────
        document.querySelectorAll('.pay-tab').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.pay-tab').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                const method = this.dataset.method;
                document.getElementById('paymentMethod').value = method;
                document.getElementById('cashSection').style.display = method === 'cash' ? 'block' : 'none';
            });
        });
        document.getElementById('cashSection').style.display = 'block';

        // ── Show Variants ─────────────────────────────────────
        $(document).on('click', '.product-card', function() {

            let productId   = $(this).data('id');
            let productName = $(this).data('name');

            $('#modalProductTitle').text(productName);

            $.ajax({
                url: '/admin/pos/get-variants/' + productId,
                method: 'GET',
                success: function(response) {
                    let listContainer = $('#variant-list');
                    listContainer.empty();
                    $('#variantEmpty').hide();
                    $('#variantSearch').val('');

                    if (response.type === 'variable') {
                        let variants = response.variants;

                        // Show search bar only when more than 5 variants
                        if (variants.length > 5) {
                            $('#variantSearchWrap').show();
                            setTimeout(() => $('#variantSearch').focus(), 200);
                        } else {
                            $('#variantSearchWrap').hide();
                        }

                        let cart = JSON.parse(localStorage.getItem('pos_cart')) || [];

                        variants.forEach(v => {
                            let cartItem = cart.find(item => item.product_id == productId && item.variant_id == v.id);
                            let cartQty = cartItem ? parseInt(cartItem.qty) : 0;
                            let remainingQty = Math.max(v.qty - cartQty, 0);

                            let sanitizedName = productName.replace(/'/g, "\\'");
                            let stockLabel    = remainingQty > 10 ? `Stock: ${remainingQty}` : (remainingQty > 0 ? `Low stock: ${remainingQty}` : 'Out of stock');
                            let stockClass    = remainingQty > 10 ? 'stock-ok' : (remainingQty > 0 ? 'stock-low' : 'stock-none');

                            // Build a clean variant label string
                            let variantParts = [];
                            if (v.color) variantParts.push(v.color);
                            if (v.storage) variantParts.push(v.storage);
                            let variantLabel = variantParts.join(' · ').replace(/'/g, "\\'");

                            listContainer.append(`
                                <div class="variant-item"
                                     data-variant-id="${v.id}"
                                     data-original-stock="${v.qty}"
                                     data-search="${(v.color + ' ' + v.storage).toLowerCase()}"
                                     onclick="addToCart(${productId}, ${v.id}, '${sanitizedName}', ${v.price}, ${v.qty}, ${response.requires_imei}, '${variantLabel}')">
                                    <div>
                                        <div class="variant-item-label">${v.color || ''} ${v.color && v.storage ? '·' : ''} ${v.storage || ''}</div>
                                        <div class="variant-item-stock ${stockClass}">${stockLabel}</div>
                                    </div>
                                    <div class="variant-item-price">Rs. ${parseFloat(v.price).toLocaleString('en-LK', {minimumFractionDigits:2})}</div>
                                </div>
                            `);
                        });

                        if (response.variants.filter(v => v.qty > 0).length === 0) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Out of Stock',
                                text: 'This product is currently out of stock.'
                            });
                            return;
                        }

                        // Show modal — use addClass('open') so flex centering applies
                        $('#variantModal').addClass('open').css('display', 'flex');
                    } else {
                        if (response.product.qty <= 0) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Out of Stock',
                                text: 'This product is currently out of stock.'
                            });
                            return;
                        }
                        addToCart(productId, null, productName, response.product.price, response.product.qty, response.requires_imei);
                    }
                },
                error: function() {
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Failed to load variants. Please try again.' });
                }
            });
        });

        // Close variant modal on overlay click
        $('#variantModal').on('click', function(e) {
            if (e.target === this) closeVariantModal('variantModal');
        });

        $('#imeiModal').on('click', function(e) {
            if (e.target === this) closeVariantModal('imeiModal');
        });

        $('#itemDiscountModal').on('click', function(e) {
            if (e.target === this) closeVariantModal('itemDiscountModal');
        });

        function closeVariantModal(id) {
            $('#' + id).removeClass('open').fadeOut(150);
        }

        // ── Variant Search ────────────────────────────────────
        function filterVariants() {
            let q = $('#variantSearch').val().toLowerCase().trim();
            let anyVisible = false;

            $('#variant-list .variant-item').each(function() {
                let text = $(this).data('search') || '';
                let show = text.includes(q);
                $(this).toggle(show);
                if (show) anyVisible = true;
            });

            $('#variantEmpty').toggle(!anyVisible);
        }

        /* =======================================================
           DISCOUNT HELPERS
           Each cart item may carry:
             discount_type  -> 'percent' | 'fixed' | null
             discount_value -> the number the cashier typed
           Bill-level discount is tracked separately in two
           variables below and applied after summing item totals.
        ======================================================= */

        // Compute the discounted unit price for a single cart line.
        function getDiscountedUnitPrice(item) {
            let price = parseFloat(item.price) || 0;
            if (!item.discount_type || !item.discount_value) return price;

            let val = parseFloat(item.discount_value) || 0;
            if (item.discount_type === 'percent') {
                let capped = Math.min(Math.max(val, 0), 100);
                return price - (price * capped / 100);
            }
            // fixed amount off the unit price, never below zero
            return Math.max(price - val, 0);
        }

        function getItemDiscountAmountPerUnit(item) {
            let price = parseFloat(item.price) || 0;
            return Math.max(price - getDiscountedUnitPrice(item), 0);
        }

        /* =======================================================
           CART RENDER
        ======================================================= */
        $(document).ready(function() { renderCart(); });

        function addToCart(productId, variantId, name, price, stock, requiresImei, variantType = null) {
            let cart  = JSON.parse(localStorage.getItem('pos_cart')) || [];
            let index = cart.findIndex(item =>
                item.product_id == productId &&
                (variantId ? item.variant_id == variantId : !item.variant_id)
            );

            if (index > -1) {
                if (cart[index].qty < stock) {
                    cart[index].qty += 1;
                } else {
                    Swal.fire({ icon: 'warning', title: 'Out of Stock', text: 'Stock limit reached!' });
                }
            } else {
                cart.push({
                    product_id: productId,
                    variant_id: variantId,
                    name: name,
                    variant_type: variantType,
                    price: parseFloat(price),
                    qty: 1,
                    available_stock: stock,
                    requires_imei: requiresImei,
                    discount_type: null,
                    discount_value: 0
                });
            }

            localStorage.setItem('pos_cart', JSON.stringify(cart));
            renderCart();
            closeVariantModal('variantModal');
        }

        function renderCart() {
            let cart      = JSON.parse(localStorage.getItem('pos_cart')) || [];
            let container = $('#cart-items');
            container.empty();
            let subtotal = 0;

            // Item count badge
            let totalQty = cart.reduce((sum, item) => sum + (parseInt(item.qty) || 0), 0);
            $('#cartItemCount').text(totalQty + (totalQty === 1 ? ' item' : ' items'));

            if (cart.length === 0) {
                container.append(`
                    <div class="cart-empty-state">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="40" height="40">
                            <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                            <line x1="3" y1="6" x2="21" y2="6"/>
                            <path d="M16 10a4 4 0 0 1-8 0"/>
                        </svg>
                        <p>Cart is empty</p>
                        <span>Click a product to add it</span>
                    </div>
                `);
            }

            cart.forEach((item, index) => {
                
                let price            = parseFloat(item.price) || 0;
                let qty              = parseInt(item.qty) || 0;
                let discountedUnit   = getDiscountedUnitPrice(item);
                let lineSubtotal     = discountedUnit * qty;
                subtotal += lineSubtotal;

                let imeiHtml = '';
                if (item.requires_imei == 1 || item.requires_imei === true) {
                    if (item.imeis && item.imeis.length === qty) {
                        imeiHtml = `<div class="imei-badge imei-badge--ok" style="padding: 1px 6px; font-size: 9.5px; border-radius: 4px;">✔ ${item.imeis.length} IMEI</div>
                                     <button class="imei-add-btn" style="padding: 1px 6px; font-size: 9.5px; border-radius: 4px;" onclick="viewImeis(${index})">View</button>`;
                    } else {
                        imeiHtml = `<button class="imei-add-btn" style="padding: 1px 6px; font-size: 9.5px; border-radius: 4px;" onclick="openImeiModal(${index})">+ Add IMEI</button>`;
                    }
                }

                // Discount affordance: either a button to add one, or a badge showing what's applied
                let discountControlHtml = '';
                if (item.discount_type && item.discount_value > 0) {
                    let label = item.discount_type === 'percent'
                        ? `${parseFloat(item.discount_value)}% off`
                        : `Rs. ${parseFloat(item.discount_value).toFixed(2)} off`;
                    discountControlHtml = `<span class="discount-applied-badge" style="padding: 1px 6px; font-size: 9.5px; border-radius: 4px;" onclick="openItemDiscountModal(${index})">🏷 ${label}</span>`;
                } else {
                    discountControlHtml = `<button class="discount-add-btn" style="padding: 1px 6px; font-size: 9.5px; border-radius: 4px;" onclick="openItemDiscountModal(${index})">+ Discount</button>`;
                }

                let priceLineHtml = '';
                if (item.discount_type && item.discount_value > 0) {
                    priceLineHtml = `
                        <span class="cart-item-price-strike">Rs. ${price.toFixed(2)}</span>
                        <small class="mb-0 fw-bold" style="font-size: 11px; color:#16a34a;">Rs. ${discountedUnit.toFixed(2)} / item</small>
                    `;
                } else {
                    priceLineHtml = `<small class="mb-0 fw-bold" style="font-size: 11px;">Rs. ${price.toFixed(2)} / item</small>`;
                }

                container.append(`
                    <div class="card-item border-0 shadow-sm position-relative" style="background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%); border-radius: 10px; border: 1px solid #e2e8f0; height: 115px; display: flex; flex-direction: column; justify-content: space-between; padding: 8px 10px; box-sizing: border-box;">
                        
                        <!-- Top Row: Name and Remove Button -->
                        <div class="d-flex justify-content-between align-items-start" style="padding-right: 20px;">
                            <div style="min-width: 0; flex: 1;">
                                <h6 class="mb-0 fw-semibold text-wrap" style="font-size: 12.5px; line-height: 1.25; color: #0f172a; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; max-height: 2.5em;">
                                    ${item.name}
                                </h6>
                                ${item.variant_type ? `
                                <div class="text-muted fw-semibold" style="font-size: 9.5px; margin-top: 2px; text-transform: uppercase; letter-spacing: 0.02em;">
                                    ${item.variant_type}
                                </div>
                                ` : ''}
                            </div>
                            <button
                                class="btn btn-link p-0 text-danger position-absolute"
                                style="top: 8px; right: 10px; font-size: 18px; line-height: 1; text-decoration: none; border: none; background: transparent; z-index: 10;"
                                onclick="removeItem(${index})"
                                title="Remove Item">
                                &times;
                            </button>
                        </div>

                        <!-- Middle Row: IMEI & Discount Info (if any) -->
                        ${imeiHtml || (item.discount_type && item.discount_value > 0) || !item.discount_type ? `
                        <div class="d-flex flex-wrap align-items-center gap-1.5" style="margin-bottom: 2px;">
                            ${imeiHtml}
                            ${discountControlHtml}
                        </div>
                        ` : ''}

                        <!-- Bottom Row: Price & Quantity Controls -->
                        <div class="d-flex justify-content-between align-items-end mt-auto pt-1" style="border-top: 1px solid #f1f5f9;">
                            <!-- Price details -->
                            <div class="d-flex flex-column" style="gap: 1px; min-width: 0;">
                                <div style="font-size: 10px; color: #64748b; line-height: 1.2;">
                                    ${priceLineHtml}
                                </div>
                                <div class="fw-bold text-success" style="font-size: 12.5px; line-height: 1.1;">
                                    Rs. ${lineSubtotal.toFixed(2)}
                                </div>
                            </div>

                            <!-- Quantity Selector (very compact inline) -->
                            <div class="d-flex align-items-center gap-1 bg-light rounded px-1.5 py-0.5" style="border: 1px solid #e2e8f0; height: 26px;">
                                <button
                                    class="btn btn-sm p-0 d-flex align-items-center justify-content-center"
                                    style="width: 18px; height: 18px; font-size: 11px; font-weight: bold; border-radius: 4px; color: #dc3545; border: none; background: transparent;"
                                    onclick="changeQty(${index}, -1)">
                                    -
                                </button>
                                <span class="fw-bold text-dark px-1" style="font-size: 12px; min-width: 14px; text-align: center; display: inline-block;">
                                    ${qty}
                                </span>
                                <button
                                    class="btn btn-sm p-0 d-flex align-items-center justify-content-center"
                                    style="width: 18px; height: 18px; font-size: 11px; font-weight: bold; border-radius: 4px; color: #0d6efd; border: none; background: transparent;"
                                    onclick="changeQty(${index}, 1)">
                                    +
                                </button>
                            </div>
                        </div>
                    </div>
                `);
            });

            $('#cart-subtotal').text(subtotal.toFixed(2));
            recalculateBillTotal();
            updateCatalogStock();
        }

        /* =======================================================
           ITEM DISCOUNT MODAL
        ======================================================= */
        let currentDiscountIndex = null;

        function openItemDiscountModal(index) {
            currentDiscountIndex = index;
            let cart = JSON.parse(localStorage.getItem('pos_cart')) || [];
            let item = cart[index];
            if (!item) return;

            $('#itemDiscountProductTitle').text(item.name);
            $('#itemDiscountUnitPrice').text('Rs. ' + parseFloat(item.price).toFixed(2));

            let type = item.discount_type || 'percent';
            setItemDiscountType(type, /*skipRecalc*/ true);
            $('#itemDiscountValue').val(item.discount_value > 0 ? item.discount_value : '');

            updateItemDiscountPreview();
            $('#itemDiscountModal').addClass('open');
        }

        function setItemDiscountType(type, skipRecalc) {
            let wrap = $('.discount-type-toggle[data-target="item"]');
            wrap.find('.dtype-btn').removeClass('active');
            wrap.find(`.dtype-btn[data-type="${type}"]`).addClass('active');
            $('#itemDiscountInputLabel').text(type === 'percent' ? 'Discount percentage' : 'Discount amount (Rs.)');
            $('#itemDiscountValue').attr('placeholder', type === 'percent' ? 'e.g. 8' : 'e.g. 1200');
            wrap.data('current-type', type);
            if (!skipRecalc) updateItemDiscountPreview();
        }

        function onItemDiscountInput() {
            updateItemDiscountPreview();
        }

        function updateItemDiscountPreview() {
            let cart = JSON.parse(localStorage.getItem('pos_cart')) || [];
            let item = cart[currentDiscountIndex];
            if (!item) return;

            let type  = $('.discount-type-toggle[data-target="item"]').data('current-type') || 'percent';
            let value = parseFloat($('#itemDiscountValue').val()) || 0;
            let price = parseFloat(item.price) || 0;

            let finalPrice, convertedLine = '';

            if (type === 'percent') {
                let capped = Math.min(Math.max(value, 0), 100);
                let amountOff = price * capped / 100;
                finalPrice = price - amountOff;
                if (value > 0) convertedLine = `${capped}% off ≈ Rs. ${amountOff.toFixed(2)} per item`;
            } else {
                let amountOff = Math.min(Math.max(value, 0), price);
                finalPrice = price - amountOff;
                if (value > 0 && price > 0) convertedLine = `Rs. ${amountOff.toFixed(2)} off ≈ ${((amountOff / price) * 100).toFixed(1)}% per item`;
            }

            $('#itemDiscountFinalPrice').text('Rs. ' + finalPrice.toFixed(2));

            if (convertedLine) {
                $('#itemDiscountConverted').text(convertedLine).show();
            } else {
                $('#itemDiscountConverted').hide();
            }
        }

        function applyItemDiscount() {
            let cart = JSON.parse(localStorage.getItem('pos_cart')) || [];
            let item = cart[currentDiscountIndex];
            if (!item) return;

            let type  = $('.discount-type-toggle[data-target="item"]').data('current-type') || 'percent';
            let value = parseFloat($('#itemDiscountValue').val()) || 0;

            if (value <= 0) {
                item.discount_type  = null;
                item.discount_value = 0;
            } else {
                if (type === 'percent' && value > 100) value = 100;
                if (type === 'fixed' && value > item.price) value = item.price;
                item.discount_type  = type;
                item.discount_value = value;
            }

            localStorage.setItem('pos_cart', JSON.stringify(cart));
            renderCart();
            $('#itemDiscountModal').removeClass('open');

            Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 1800, timerProgressBar: true })
                .fire({ icon: 'success', title: 'Discount applied' });
        }

        function clearItemDiscount() {
            let cart = JSON.parse(localStorage.getItem('pos_cart')) || [];
            let item = cart[currentDiscountIndex];
            if (!item) return;

            item.discount_type  = null;
            item.discount_value = 0;

            localStorage.setItem('pos_cart', JSON.stringify(cart));
            renderCart();
            $('#itemDiscountModal').removeClass('open');
        }

        /* =======================================================
           BILL-LEVEL DISCOUNT (applied after summing all items)
        ======================================================= */
        let billDiscountType = 'percent';

        function setBillDiscountType(type) {
            billDiscountType = type;
            let wrap = $('.discount-type-toggle[data-target="bill"]');
            wrap.find('.dtype-btn').removeClass('active');
            wrap.find(`.dtype-btn[data-type="${type}"]`).addClass('active');
            $('#billDiscountValue').attr('placeholder', type === 'percent' ? 'percent' : 'price');
            recalculateBillTotal();
        }

        function onBillDiscountInput() {
            recalculateBillTotal();
        }

        // Subtotal here is the sum of item lines (already net of item-level discounts).
        // The bill-level discount is applied on top of that, last.
        function recalculateBillTotal() {
            let subtotal = parseFloat($('#cart-subtotal').text()) || 0;
            let value    = parseFloat($('#billDiscountValue').val()) || 0;

            let discountAmount = 0;
            let convertedLine  = '';

            if (value > 0) {
                if (billDiscountType === 'percent') {
                    let capped = Math.min(Math.max(value, 0), 100);
                    discountAmount = subtotal * capped / 100;
                    convertedLine  = `${capped}% off ≈ Rs. ${discountAmount.toFixed(2)} off the bill`;
                } else {
                    discountAmount = Math.min(Math.max(value, 0), subtotal);
                    convertedLine  = subtotal > 0
                        ? `Rs. ${discountAmount.toFixed(2)} off ≈ ${((discountAmount / subtotal) * 100).toFixed(1)}% of the bill`
                        : '';
                }
            }

            let total = Math.max(subtotal - discountAmount, 0);

            $('#billDiscountAmount').text(discountAmount.toFixed(2));
            $('#billDiscountAmountRow').toggle(discountAmount > 0);
            $('#cart-total').text(total.toFixed(2));

            if (convertedLine) {
                $('#billDiscountConverted').text(convertedLine).show();
            } else {
                $('#billDiscountConverted').hide();
            }

            if (!isCashReceivedManual) {
                if (total > 0) {
                    $('#cashReceived').val(total.toFixed(2));
                } else {
                    $('#cashReceived').val('');
                }
            }

            updateBalanceDisplay();
        }

        /* =======================================================
           IMEI MODAL
        ======================================================= */
        let currentCartIndex = null;

        function openImeiModal(index) {
            currentCartIndex = index;
            let cart = JSON.parse(localStorage.getItem('pos_cart'));
            let item = cart[index];

            $('#imeiSearch').val('');

            $.get(`/admin/pos/get-available-imeis/${item.product_id}/${item.variant_id || 0}`, function(imeis) {
                let container = $('#imei-list');
                container.empty();

                if (imeis.length === 0) {
                    container.append('<p style="padding:16px; color:#ef4444; font-size:14px;">No available IMEIs found.</p>');
                } else {
                    imeis.forEach(imei => {
                        container.append(`
                            <div class="imei-item variant-item" style="cursor:pointer;" onclick="toggleImeiCheck(this)">
                                <input type="checkbox" value="${imei.id}" data-number="${imei.imei_number}" onclick="event.stopPropagation(); toggleImeiCheck(this.closest('.imei-item'))">
                                <span class=" fw-bold fs-4 w-100 text-center imei-item-number">${imei.imei_number}</span>
                            </div>
                        `);
                    });
                }

                $('#imeiModal').addClass('open');
                setTimeout(() => $('#imeiSearch').focus(), 100);
            }).fail(function() {
                Swal.fire({ icon: 'error', title: 'Error', text: 'Failed to load IMEI numbers.' });
            });
        }

        function viewImeis(index) {
            currentCartIndex = index;
            let cart = JSON.parse(localStorage.getItem('pos_cart'));
            let item = cart[index];

            if (!item.imeis || item.imeis.length === 0) {
                Swal.fire({ icon: 'info', title: 'No IMEIs', text: 'No IMEIs have been added for this item yet.' });
                return;
            }

            let imeiListHtml = item.imeis.map(imei => `<li>${imei.number}</li>`).join('');
            Swal.fire({
                title: 'IMEI Numbers',
                html: `<ul style="text-align:left; padding-left:20px;">${imeiListHtml}</ul>`,
                confirmButtonColor: '#6366f1'
            });
        }

        function toggleImeiCheck(row) {
            let cb = $(row).find('input[type="checkbox"]');
            cb.prop('checked', !cb.prop('checked'));
        }

        function filterImeis() {
            let filter = $('#imeiSearch').val().toLowerCase();
            $('#imei-list .variant-item').each(function() {
                let num = $(this).find('.imei-item-number').text().toLowerCase();
                $(this).toggle(num.includes(filter));
            });
        }

        function addSelectedImeisToCart() {
            let selected = [];
            $('#imei-list input:checked').each(function() {
                selected.push({ id: $(this).val(), number: $(this).data('number') });
            });

            let cart        = JSON.parse(localStorage.getItem('pos_cart'));
            let requiredQty = cart[currentCartIndex].qty;

            if (selected.length !== requiredQty) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Incorrect Quantity',
                    text: `Please select exactly ${requiredQty} IMEI number(s). You selected ${selected.length}.`,
                    confirmButtonColor: '#6366f1'
                });
                return;
            }

            cart[currentCartIndex].imeis = selected;
            localStorage.setItem('pos_cart', JSON.stringify(cart));
            renderCart();
            $('#imeiModal').removeClass('open');

            Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 2000, timerProgressBar: true })
                .fire({ icon: 'success', title: 'IMEIs added successfully!' });
        }

        // ── Cart Actions ──────────────────────────────────────
        function removeItem(index) {
            let cart = JSON.parse(localStorage.getItem('pos_cart'));
            cart.splice(index, 1);
            localStorage.setItem('pos_cart', JSON.stringify(cart));
            renderCart();
        }

        function changeQty(index, delta) {
            let cart = JSON.parse(localStorage.getItem('pos_cart'));
            let item = cart[index];
            let newQty = item.qty + delta;

            if (newQty <= 0) {
                cart.splice(index, 1);
            } else if (newQty <= item.available_stock) {
                item.qty = newQty;
            } else {
                Swal.fire('Warning', 'Only ' + item.available_stock + ' items in stock.', 'warning');
                return;
            }

            localStorage.setItem('pos_cart', JSON.stringify(cart));
            renderCart();
        }

        // ── Live Balance (cash received vs final discounted total) ──
        let isCashReceivedManual = false;

        function setCashReceived(value) {
            let total = parseFloat($('#cart-total').text()) || 0;
            if (value === 'exact') {
                $('#cashReceived').val(total > 0 ? total.toFixed(2) : '');
                isCashReceivedManual = false;
            } else {
                $('#cashReceived').val(value);
                isCashReceivedManual = true;
            }
            updateBalanceDisplay();
        }

        function updateBalanceDisplay() {
            let total    = parseFloat($('#cart-total').text()) || 0;
            let received = parseFloat($('#cashReceived').val()) || 0;
            let balance  = received - total;
            let el       = $('#balanceDisplay');

            if (!$('#cashReceived').val()) {
                el.text('');
                return;
            }

            if (balance >= 0) {
                el.text('Balance to return: Rs. ' + balance.toFixed(2));
                el.css('color', 'var(--success)');
            } else {
                el.text('Short by: Rs. ' + Math.abs(balance).toFixed(2));
                el.css('color', 'var(--danger)');
            }
        }

        // kept for any external callers using the old event-bound name
        $('#cashReceived').on('input', function() {
            let val = $(this).val();
            if (val === '') {
                isCashReceivedManual = false;
            } else {
                isCashReceivedManual = true;
            }
            updateBalanceDisplay();
        });

        // ── Real-Time Catalog Stock Update ────────────────────
        function updateCatalogStock() {
            let cart = JSON.parse(localStorage.getItem('pos_cart')) || [];
            
            // Map product_id to total quantity of that product in the cart
            let productQuantities = {};
            // Map variant_id to quantity in the cart
            let variantQuantities = {};

            cart.forEach(item => {
                let pid = item.product_id;
                let vid = item.variant_id || 0;
                
                productQuantities[pid] = (productQuantities[pid] || 0) + (parseInt(item.qty) || 0);
                if (vid > 0) {
                    variantQuantities[vid] = (variantQuantities[vid] || 0) + (parseInt(item.qty) || 0);
                }
            });

            // Update each product card in the DOM
            $('.product-card').each(function() {
                let card = $(this);
                let pid = card.data('id');
                let originalStock = parseInt(card.data('original-stock'));
                
                // Fallback: if data-original-stock is missing/not a number, try reading it from the text
                if (isNaN(originalStock)) {
                    let text = card.find('.stock-pill').text();
                    let match = text.match(/\d+/);
                    originalStock = match ? parseInt(match[0]) : 0;
                    card.attr('data-original-stock', originalStock);
                }

                let cartQty = productQuantities[pid] || 0;
                let remainingStock = Math.max(originalStock - cartQty, 0);

                let stockPill = card.find('.stock-pill');
                if (stockPill.length) {
                    stockPill.removeClass('stock-pill--in stock-pill--low stock-pill--out');
                    if (remainingStock > 10) {
                        stockPill.addClass('stock-pill--in');
                    } else if (remainingStock > 0) {
                        stockPill.addClass('stock-pill--low');
                    } else {
                        stockPill.addClass('stock-pill--out');
                    }
                    stockPill.text(remainingStock > 0 ? 'Stock: ' + remainingStock : 'Out of Stock');
                }
            });

            // Update variant items in the variant modal if currently displayed
            $('.variant-item').each(function() {
                let itemEl = $(this);
                let vid = itemEl.data('variant-id');
                let originalStock = parseInt(itemEl.data('original-stock'));

                if (isNaN(originalStock)) {
                    let text = itemEl.find('.variant-item-stock').text();
                    let match = text.match(/\d+/);
                    originalStock = match ? parseInt(match[0]) : 0;
                    itemEl.attr('data-original-stock', originalStock);
                }

                let cartQty = variantQuantities[vid] || 0;
                let remainingStock = Math.max(originalStock - cartQty, 0);

                let stockEl = itemEl.find('.variant-item-stock');
                if (stockEl.length) {
                    stockEl.removeClass('stock-ok stock-low stock-none');
                    if (remainingStock > 10) {
                        stockEl.addClass('stock-ok');
                        stockEl.text('Stock: ' + remainingStock);
                    } else if (remainingStock > 0) {
                        stockEl.addClass('stock-low');
                        stockEl.text('Low stock: ' + remainingStock);
                    } else {
                        stockEl.addClass('stock-none');
                        stockEl.text('Out of stock');
                    }
                }
            });
        }

        // ── Product Search (client-side, current page only) ───
        $('#productSearch').on('input', function() {
            let q = $(this).val().toLowerCase();
            $('.product-card').each(function() {
                let name = ($(this).data('name') || '').toLowerCase();
                $(this).toggle(name.includes(q));
            });
        });

        /* =======================================================
           INCREMENTAL "LOAD MORE" PRODUCT LOADING
           Replaces full pagination. Fetches the next page of
           products as JSON and appends cards to the grid, so a
           large catalogue never has to be sent all at once.
        ======================================================= */
        let isLoadingProducts = false;

        function loadMoreProducts() {
            if (isLoadingProducts) return;

            let wrap    = $('#loadMoreWrap');
            let btn     = $('#loadMoreBtn');
            let nextPage = parseInt(wrap.data('next-page')) || 2;
            let search   = $('#productSearch').val() || '';

            isLoadingProducts = true;
            btn.prop('disabled', true);
            btn.find('.load-more-label').hide();
            btn.find('.load-more-spinner').show();

            $.ajax({
                url: '/admin/pos/load-products',
                method: 'GET',
                data: { page: nextPage, search: search },
                success: function(response) {
                    let grid = $('#productGrid');

                    (response.products || []).forEach(function(product) {
                        grid.append(buildProductCardHtml(product));
                    });

                    updateCatalogStock();

                    if (response.has_more) {
                        wrap.data('next-page', nextPage + 1);
                        btn.show();
                        $('#loadMoreEnd').hide();
                    } else {
                        btn.hide();
                        $('#loadMoreEnd').show();
                    }
                },
                error: function() {
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Failed to load more products. Please try again.' });
                },
                complete: function() {
                    isLoadingProducts = false;
                    btn.prop('disabled', false);
                    btn.find('.load-more-label').show();
                    btn.find('.load-more-spinner').hide();
                }
            });
        }

        // Builds a product card matching the server-rendered markup,
        // from a JSON product object returned by /admin/pos/load-products.
        // Expected shape per product: { id, name, sku, featured_image,
        // has_variants, requires_imei, base_price, has_warranty,
        // warranty_period, available_qty }
        function buildProductCardHtml(product) {
            let safeName = (product.name || '').replace(/"/g, '&quot;');

            let variantBadge = product.has_variants ? `<span class="badge-pill badge-pill--info">Variants</span>` : '';
            let imeiBadge     = product.requires_imei ? `<span class="badge-pill badge-pill--dark">IMEI</span>` : '';
            let badgesHtml    = (variantBadge || imeiBadge) 
                ? `<div class="product-card-badges-row">${variantBadge} ${imeiBadge}</div>` 
                : '';

            let priceHtml = (parseFloat(product.base_price) > 0)
                ? `<span class="product-card-price">Rs. ${parseFloat(product.base_price).toLocaleString('en-LK', {minimumFractionDigits:2})}</span>`
                : `<span class="product-card-price product-card-price--quote">Price on request</span>`;

            let warrantyHtml = product.has_warranty
                ? `<div class="product-card-warranty">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z" />
                        </svg>
                        <span>${product.warranty_period || ''}</span>
                   </div>`
                : '';

            let stockClass = product.available_qty > 10 ? 'stock-pill--in' : (product.available_qty > 0 ? 'stock-pill--low' : 'stock-pill--out');
            let stockLabel = product.available_qty > 0 ? ('Stock: ' + product.available_qty) : 'Out of Stock';

            return `
                <div class="product-card product-card--new" data-id="${product.id}" data-name="${safeName.replace(/"/g, '\\"')}" data-original-stock="${product.available_qty}">
                    <div class="product-card-body">
                        ${badgesHtml}
                        <span class="product-card-sku">SKU: ${product.sku || ''}</span>
                        <h5 class="product-card-name" title="${safeName}">${product.name || ''}</h5>
                        <div class="product-card-price-row">${priceHtml}</div>
                        ${warrantyHtml}
                        <div class="product-card-footer">
                            <span class="stock-pill ${stockClass}">${stockLabel}</span>
                        </div>
                    </div>
                </div>
            `;
        }

        // ── Checkout ──────────────────────────────────────────
        function checkout() {
            let cart          = JSON.parse(localStorage.getItem('pos_cart'));
            let paymentMethod = $('#paymentMethod').val();
            let cashReceived  = parseFloat($('#cashReceived').val()) || 0;
            let subtotal      = parseFloat($('#cart-subtotal').text()) || 0;
            let total         = parseFloat($('#cart-total').text()) || 0;
            let billDiscVal   = parseFloat($('#billDiscountValue').val()) || 0;
            let billDiscAmt   = parseFloat($('#billDiscountAmount').text()) || 0;

            if (!cart || cart.length === 0) {
                Swal.fire({ icon: 'error', title: 'Cart is empty', text: 'Add at least one product to continue.' });
                return;
            }

            for (let item of cart) {
                if (item.requires_imei && (!item.imeis || item.imeis.length !== item.qty)) {
                    Swal.fire({ icon: 'warning', title: 'Missing IMEI', text: `Select exactly ${item.qty} IMEI(s) for "${item.name}".` });
                    return;
                }
            }

            if (paymentMethod === 'cash' && cashReceived < total) {
                Swal.fire({ icon: 'error', title: 'Insufficient Cash', text: 'Cash received is less than the total.' });
                return;
            }

            // Attach the discounted unit price + line total to every item
            // so the backend stores exactly what the cashier saw on screen.
            let cartForServer = cart.map(item => {
                let discountedUnit = getDiscountedUnitPrice(item);
                return Object.assign({}, item, {
                    discount_type: item.discount_type || null,
                    discount_value: item.discount_value || 0,
                    discounted_unit_price: discountedUnit,
                    line_total: discountedUnit * (parseInt(item.qty) || 0)
                });
            });

            let balance = paymentMethod === 'cash' ? (cashReceived - total) : 0;

            Swal.fire({
                title: 'Complete Order?',
                text: 'Are you sure you want to finalize this order?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Complete',
                confirmButtonColor: '#6366f1'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('/admin/pos/checkout', {
                        cart: JSON.stringify(cartForServer),
                        customer_id: $('#customer-select').val(),
                        payment_method: paymentMethod,
                        cash_received: cashReceived,
                        balance: balance,
                        subtotal: subtotal,
                        bill_discount_type: billDiscVal > 0 ? billDiscountType : null,
                        bill_discount_value: billDiscVal,
                        bill_discount_amount: billDiscAmt,
                        grand_total: total,
                        _token: '{{ csrf_token() }}'
                    }, function(res) {
                        if (res.success) {
                            localStorage.removeItem('pos_cart');
                            Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true })
                                .fire({ icon: 'success', title: res.message });
                            if (res.order_id)
                            window.open('/admin/pos/invoice/' + res.order_id, '_blank');
                            setTimeout(() => location.reload(), 2000);
                        } else {
                            Swal.fire({ icon: 'error', title: 'Error', text: res.message });
                        }
                    }).fail(function(xhr) {
                        Swal.fire({ icon: 'error', title: 'Server Error', text: xhr.responseJSON?.message || 'Failed.' });
                    });
                }
            });
        }

        // ── Save Customer ─────────────────────────────────────
        function saveCustomer() {
            $('.field-error').text('');
            $.post('/admin/customers/create', {
                name:    $('#new_cust_name').val(),
                mobile:  $('#new_cust_mobile').val(),
                nic:     $('#new_cust_nic').val(),
                email:   $('#new_cust_email').val(),
                address: $('#new_cust_address').val(),
                _token:  '{{ csrf_token() }}'
            })
            .done(function(res) {
                if (res.success) {
                    let opt = new Option(res.customer.name + ' — ' + res.customer.mobile, res.customer.id, true, true);
                    $('#customer-select').append(opt).trigger('change');
                    $('#addCustomerModal').removeClass('open');
                    Swal.fire({ icon: 'success', title: 'Customer added!' });
                }
            })
            .fail(function(xhr) {
                if (xhr.status === 422) {
                    $.each(xhr.responseJSON.errors, (key, val) => $('#err_' + key).text(val[0]));
                } else {
                    Swal.fire('Error', 'Something went wrong.', 'error');
                }
            });
        }

        // ── Session Alerts ────────────────────────────────────
        @if (session('success'))
            Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true })
                .fire({ icon: 'success', title: '{{ session('success') }}' });
        @endif
        @if (session('error'))
            Swal.fire({ icon: 'error', title: 'Oops…', text: '{{ session('error') }}' });
        @endif
        @if ($errors->any())
            Swal.fire({ icon: 'error', title: 'Validation Failed', html: '{!! implode('<br>', $errors->all()) !!}' });
        @endif
    </script>
@endpush