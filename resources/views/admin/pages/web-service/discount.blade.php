@extends('admin.layouts.app')

@push('title')
    <title>Manage Discounts</title>
@endpush

@section('index_content')
<div class="main-content-wrap">
    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Manage Product Discounts</h3>
        
    </div>

    @if (session('status'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: @json(session('status')),
                    confirmButtonColor: '#28a745',
                });
            });
        </script>
    @endif

    <!-- discount-list -->
    <div class="wg-box">
        <div class="flex items-center justify-between gap10 flex-wrap">
            <div class="wg-filter flex-grow">
                <form class="form-search" action="{{ route('admin.web-service.discount') }}" method="GET">
                    <fieldset class="name">
                        <input type="text" name="search" placeholder="Search products by name or SKU..." value="{{ request('search') }}" aria-required="true">
                    </fieldset>
                    <div class="button-submit">
                        <button type="submit"><i class="icon-search"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="wg-table table-all-user table-discounts">
            <ul class="table-title flex gap20 mb-14">
                <li class="col-image"><div class="body-title">Image</div></li>
                <li class="col-name"><div class="body-title">Product Name</div></li>
                <li class="col-sku"><div class="body-title">SKU</div></li>
                <li class="col-price"><div class="body-title">Base Price</div></li>
                <li class="col-settings text-end"><div class="body-title">Discount Settings</div></li>
            </ul>

            <ul class="flex flex-column">
                @forelse ($products as $product)
                    @if ($product->has_variants && $product->variants->count() > 0)
                        <!-- Main Product Header Row -->
                        <li class="user-item gap20 product-header-row" style="background: #fdfdfd; border-bottom: 1px dashed #edf2f7;">
                            <div class="image col-image">
                                <img src="{{ asset($product->featured_image) }}" alt="{{ $product->name }}">
                            </div>
                            <div class="col-name name flex items-center gap10">
                                <button type="button" class="toggle-variants-btn" data-product-id="{{ $product->id }}" id="toggle-btn-{{ $product->id }}" style="background: none; border: none; cursor: pointer; padding: 4px; font-size: 14px; display: inline-flex; align-items: center; color: #4a5568;">
                                    <i class="icon-chevron-right" id="arrow-icon-{{ $product->id }}" style="transition: transform 0.2s;"></i>
                                </button>
                                <div>
                                    <span class="body-title-2" style="font-weight: 600; cursor: pointer;" onclick="document.getElementById('toggle-btn-{{ $product->id }}').click()">{{ $product->name }}</span>
                                    <div class="text-tiny mt-3"><span class="badge bg-secondary text-white" style="font-size: 9px; padding: 2px 6px;">Has Variants</span></div>
                                </div>
                            </div>

                            <div class="col-sku body-text text-muted">—</div>

                            <div class="col-price body-text text-muted" style="font-size: 13px;">
                                LKR {{ number_format($product->variants->min('price'), 2) }} - {{ number_format($product->variants->max('price'), 2) }}
                            </div>

                            <div class="col-settings text-end text-muted font-italic" style="font-size: 12px; padding-right: 15px;">
                                Click arrow to configure variant discounts
                            </div>
                        </li>

                        <!-- Indented Variant Rows -->
                        @foreach ($product->variants as $variant)
                            <li class="user-item gap20 variant-row-{{ $product->id }}" style="display: none; padding-left: 50px; background: #fafbfc; border-left: 3px solid #00acc1; border-bottom: 1px solid #f1f3f7;">
                                <div class="image col-image" style="opacity: 0.8; width: 40px; height: 40px;">
                                    <img src="{{ asset($variant->variant_image ?? $product->featured_image) }}" alt="{{ $product->name }}">
                                </div>
                                <div class="col-name name">
                                    <div class="body-title-2" style="font-size: 13px; color: #4a5568;">
                                        ↳ {{ $variant->color ?? '' }} {{ $variant->storage ? '/ '.$variant->storage : '' }} {{ $variant->ram ? '('.$variant->ram.' RAM)' : '' }}
                                    </div>
                                    @if($variant->is_discount)
                                        <div class="text-tiny mt-3"><span class="badge-status active">Active Discount</span></div>
                                    @endif
                                </div>

                                <div class="col-sku body-text" style="font-size: 12px;">{{ $variant->sku ?? '#' . $variant->id }}</div>

                                <div class="col-price body-text" style="font-size: 12px;">
                                    LKR {{ number_format($variant->price, 2) }}
                                </div>

                                <form action="{{ route('admin.web-service.discount.toggle') }}" method="POST" class="col-settings discount-form flex items-center gap10 justify-end">
                                    @csrf
                                    <input type="hidden" name="variant_id" value="{{ $variant->id }}">
                                    <input type="hidden" name="is_discount" value="0">

                                    <label class="switch">
                                        <input type="checkbox" name="is_discount" value="1" class="discount-toggle-switch" {{ $variant->is_discount ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>

                                    <input type="number" name="discount_price" class="discount-price-input" style="width: 150px; height: fit-content;" value="{{ $variant->discount_price }}" step="0.01" placeholder="Sale Price LKR" {{ $variant->is_discount ? '' : 'disabled' }}>

                                    <button type="submit" class="btn btn-primary rounded " title="Save Settings">
                                        <i class="icon-check"></i>
                                    </button>
                                </form>
                            </li>
                        @endforeach
                    @else
                        <!-- Normal Product without Variants -->
                        <li class="user-item gap20" style="border-bottom: 1px solid #f1f3f7;">
                            <div class="image col-image">
                                <img src="{{ asset($product->featured_image) }}" alt="{{ $product->name }}">
                            </div>
                            <div class="col-name name">
                                <a href="#" class="body-title-2">{{ $product->name }}</a>
                                @if($product->is_discount)
                                    <div class="text-tiny mt-3"><span class="badge-status active">Active Discount</span></div>
                                @endif
                            </div>

                            <div class="col-sku body-text">{{ $product->sku ?? '#' . $product->id }}</div>

                            <div class="col-price body-text">
                                LKR {{ number_format($product->base_price, 2) }}
                            </div>

                            <form action="{{ route('admin.web-service.discount.toggle') }}" method="POST" class="col-settings discount-form flex items-center gap10 justify-end">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="is_discount" value="0">

                                <label class="switch">
                                    <input type="checkbox" name="is_discount" value="1" class="discount-toggle-switch" {{ $product->is_discount ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>

                                <input type="number" name="discount_price" class="discount-price-input" style="width: 150px; height: fit-content;" value="{{ $product->discount_price }}" step="0.01" placeholder="Sale Price LKR" {{ $product->is_discount ? '' : 'disabled' }}>

                                <button type="submit" class="btn btn-primary rounded " title="Save Settings">
                                    <i class="icon-check"></i>
                                </button>
                            </form>
                        </li>
                    @endif
                @empty
                    <li class="user-item gap14 justify-center">
                        <div class="body-text w-full text-center">No products found.</div>
                    </li>
                @endforelse
            </ul>
        </div>

        <div class="divider"></div>
        <div class="flex items-center justify-between flex-wrap gap10">
            <div class="text-tiny">Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() ?? 0 }} entries</div>
            <div class="wg-pagination">{{ $products->appends(request()->input())->links('pagination::bootstrap-5') }}</div>
        </div>
    </div>
    <!-- /discount-list -->
</div>
@endsection

@push('styles')
<style>
    /* Prevent table children from forcing a 1515px width and causing horizontal scroll */
    .table-discounts.table-all-user>* {
        min-width: auto !important;
    }

    /* Table layout and alignments matching columns */
    .table-discounts .table-title,
    .table-discounts .user-item {
        display: flex;
        align-items: center;
        width: 100%;
    }

    .table-discounts .col-image {
        flex: 0 0 50px;
        width: 50px;
    }

    .table-discounts .col-name {
        flex: 2 1 300px;
    }

    .table-discounts .col-sku {
        flex: 1 1 150px;
        color: var(--Heading) !important;
    }

    .table-discounts .col-price {
        flex: 1 1 150px;
        color: var(--Heading) !important;
    }

    .table-discounts .col-settings {
        flex: 0 0 280px;
        width: 280px;
    }

    .table-discounts .user-item .image {
        height: 50px;
        border-radius: 6px;
        overflow: hidden;
        background: #f8f9fc;
        border: 1px solid #eceef2;
    }
    .table-discounts .user-item .image img {
        width: 100%; height: 100%; object-fit: contain;
    }

    .badge-status.active {
        display: inline-block;
        padding: 2px 10px;
        font-size: 10px;
        font-weight: 600;
        color: #fff;
        background: #28a745;
        border-radius: 20px;
    }

    .discount-price-input {
        width: 130px;
        padding: 6px 12px;
        border-radius: 6px;
        border: 1px solid #e2e5e9;
        font-size: 13px;
    }
    .discount-price-input:disabled {
        background: #f4f5f7;
        color: #9aa1ab;
    }

    .tf-button.icon-only {
        width: 32px;
        height: 32px;
        padding: 0;
        min-width: 32px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    /* Toggle switch, styled like a Remos-style status switch */
    .switch {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 22px;
        flex: 0 0 auto;
    }
    .switch input { opacity: 0; width: 0; height: 0; }
    .switch .slider {
        position: absolute;
        cursor: pointer;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: #d7dbe0;
        transition: .3s;
        border-radius: 34px;
    }
    .switch .slider:before {
        position: absolute;
        content: "";
        height: 16px; width: 16px;
        left: 3px; bottom: 3px;
        background-color: #fff;
        transition: .3s;
        border-radius: 50%;
    }
    .switch input:checked + .slider { background-color: #28a745; }
    .switch input:checked + .slider:before { transform: translateX(18px); }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const switches = document.querySelectorAll('.discount-toggle-switch');
        switches.forEach(function (sw) {
            sw.addEventListener('change', function () {
                const form = this.closest('form');
                const priceInput = form.querySelector('.discount-price-input');
                if (this.checked) {
                    priceInput.removeAttribute('disabled');
                    priceInput.focus();
                } else {
                    priceInput.setAttribute('disabled', 'disabled');
                }
            });
        });

        // Toggle variant rows display and chevron icon rotation
        const toggleButtons = document.querySelectorAll('.toggle-variants-btn');
        toggleButtons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                const productId = this.getAttribute('data-product-id');
                const rows = document.querySelectorAll('.variant-row-' + productId);
                const icon = document.getElementById('arrow-icon-' + productId);
                
                rows.forEach(function (row) {
                    if (row.style.display === 'none') {
                        row.style.display = 'flex';
                    } else {
                        row.style.display = 'none';
                    }
                });

                if (icon) {
                    if (icon.classList.contains('icon-chevron-right')) {
                        icon.classList.remove('icon-chevron-right');
                        icon.classList.add('icon-chevron-down');
                    } else {
                        icon.classList.remove('icon-chevron-down');
                        icon.classList.add('icon-chevron-right');
                    }
                }
            });
        });
    });
</script>
@endpush