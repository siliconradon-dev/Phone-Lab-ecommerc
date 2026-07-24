@extends('admin.layouts.app')

@push('title')
    <title>Manage New Arrivals</title>
@endpush

@section('index_content')
<div class="main-content-wrap">
    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Manage New Arrivals</h3>
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

    <!-- new-arrivals-list -->
    <div class="wg-box mb-30">
        <div class="flex items-center justify-between gap10 flex-wrap">
            <div class="wg-filter flex-grow">
                <form class="form-search" action="{{ route('admin.web-service.new-arrivals') }}" method="GET">
                    <fieldset class="name">
                        <input type="text" name="search" placeholder="Search products by name or SKU..." value="{{ request('search') }}" aria-required="true">
                    </fieldset>
                    <div class="button-submit">
                        <button type="submit"><i class="icon-search"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="wg-table table-all-user table-new-arrivals">
            <ul class="table-title flex gap20 mb-14">
                <li class="col-image"><div class="body-title">Image</div></li>
                <li class="col-name"><div class="body-title">Product Name</div></li>
                <li class="col-sku"><div class="body-title">SKU</div></li>
                <li class="col-category"><div class="body-title">Category</div></li>
                <li class="col-status text-end"><div class="body-title">New Arrival Status</div></li>
            </ul>

            <ul class="flex flex-column">
                @forelse ($products as $product)
                    <li class="user-item gap20">
                        <div class="image col-image">
                            <img src="{{ asset($product->featured_image) }}" alt="{{ $product->name }}">
                        </div>
                        <div class="col-name name">
                            <a href="#" class="body-title-2">{{ $product->name }}</a>
                            @if($product->is_new_arrival)
                                <div class="text-tiny mt-3"><span class="badge-status featured">Featured Arrival</span></div>
                            @endif
                        </div>

                        <div class="col-sku body-text">{{ $product->sku ?? '#' . $product->id }}</div>

                        <div class="col-category body-text">{{ $product->category->name }}</div>

                        <form action="{{ route('admin.web-service.new-arrivals.toggle') }}" method="POST" class="col-status flex items-center justify-end">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="is_new_arrival" value="0">

                            <label class="switch">
                                <input type="checkbox" name="is_new_arrival" value="1" {{ $product->is_new_arrival ? 'checked' : '' }} onchange="this.form.submit()">
                                <span class="slider round"></span>
                            </label>
                        </form>
                    </li>
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
    <!-- /new-arrivals-list -->

    <!-- new-arrivals-banner -->
    <div class="wg-box">
        <div class="flex items-center justify-between gap10 flex-wrap mb-20">
            <div class="body-title">New Arrivals Left Banner Settings</div>
        </div>

        <form action="{{ route('admin.web-service.new-arrivals.banner') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-20">
                    <label class="body-title-2 mb-10">Banner Badge</label>
                    <input type="text" name="banner_badge" placeholder="e.g. Limited Offer" value="{{ \App\Models\Setting::get('new_arrival_banner_badge', 'Limited Offer') }}" class="form-control" style="border-radius:12px; height:48px;">
                </div>
                <div class="col-md-6 mb-20">
                    <label class="body-title-2 mb-10">Banner Title</label>
                    <input type="text" name="banner_title" placeholder="e.g. Best Product Deals" value="{{ \App\Models\Setting::get('new_arrival_banner_title', 'Best Product Deals') }}" required class="form-control" style="border-radius:12px; height:48px;">
                </div>
                <div class="col-md-12 mb-20">
                    <label class="body-title-2 mb-10">Banner Description (Supports HTML tags like &lt;strong&gt;)</label>
                    <textarea name="banner_desc" rows="4" placeholder="e.g. Get a 20% Cashback when buying TWS Product from our Audio Technology." required style="width:100%; border:1px solid #e4e4e4; border-radius:12px; padding:15px;">{{ \App\Models\Setting::get('new_arrival_banner_desc', 'Get a 20% Cashback when buying TWS Product from our Audio Technology.') }}</textarea>
                </div>
                <div class="col-md-6 mb-20">
                    <label class="body-title-2 mb-10">Shop Link URL</label>
                    <input type="text" name="banner_link" placeholder="e.g. /shop or specific route" value="{{ \App\Models\Setting::get('new_arrival_banner_link', '/shop') }}" class="form-control" style="border-radius:12px; height:48px;">
                </div>
                <div class="col-md-6 mb-20">
                    <label class="body-title-2 mb-10">Banner Image</label>
                    <input type="file" name="banner_image" class="form-control" style="padding:10px; border-radius:12px; height:48px;">
                    @php
                        $bannerImg = \App\Models\Setting::get('new_arrival_banner_image');
                    @endphp
                    @if ($bannerImg)
                        <div class="mt-10">
                            <label class="text-tiny text-muted d-block mb-5">Current Image:</label>
                            <img src="{{ asset($bannerImg) }}" alt="Banner" style="max-height: 100px; border-radius: 8px; border: 1px solid #ddd;">
                        </div>
                    @endif
                </div>
            </div>
            <div class="flex items-center justify-end gap10 mt-10">
                <button class="tf-button style-1 w208" type="submit">Save Banner Settings</button>
            </div>
        </form>
    </div>
    <!-- /new-arrivals-banner -->
</div>
@endsection

@push('styles')
<style>
    /* Prevent table children from forcing a 1515px width and causing horizontal scroll */
    .table-new-arrivals.table-all-user>* {
        min-width: auto !important;
    }

    /* Table layout and alignments matching columns */
    .table-new-arrivals .table-title,
    .table-new-arrivals .user-item {
        display: flex;
        align-items: center;
        width: 100%;
    }

    .table-new-arrivals .col-image {
        flex: 0 0 50px;
        width: 50px;
    }

    .table-new-arrivals .col-name {
        flex: 2 1 300px;
    }

    .table-new-arrivals .col-sku {
        flex: 1 1 150px;
        color: var(--Heading) !important;
    }

    .table-new-arrivals .col-category {
        flex: 1 1 150px;
        color: var(--Heading) !important;
    }

    .table-new-arrivals .col-status {
        flex: 0 0 150px;
        width: 150px;
    }

    .table-new-arrivals .user-item .image {
        height: 50px;
        border-radius: 6px;
        overflow: hidden;
        background: #f8f9fc;
        border: 1px solid #eceef2;
    }
    .table-new-arrivals .user-item .image img {
        width: 100%; height: 100%; object-fit: contain;
    }

    .badge-status.featured {
        display: inline-block;
        padding: 2px 10px;
        font-size: 10px;
        font-weight: 600;
        color: #fff;
        background: #dc3545;
        border-radius: 20px;
    }

    /* Toggle switch, matching Remos-style status switch */
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