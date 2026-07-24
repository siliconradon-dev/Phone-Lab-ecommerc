@extends('phone_lab.layouts.app')

@section('title', $siteSettings['site_name'] . ' - ' . $product->name . ' - Product Details')

@section('content')
    <main>






        {{-- Breadcrumb Section --}}
        <div class="breadcrumb_section">
            <div class="container">
                <ul class="breadcrumb_nav ul_li">
                    <li><a href="{{ route('phone_lab.index') }}">Home</a></li>
                    <li><a href="{{ route('phone_lab.shop_grid') }}">Shop</a></li>
                    <li>{{ $product->name }}</li>
                </ul>
            </div>
        </div>

        {{-- Product Main Details Section --}}
        <section class="product_details pt-5 pb-0">
            <div class="container">

                @if ($errors->any())
                    <div class="alert alert-danger border-0 shadow-sm mb-4"
                        style="color: red; background-color: #ffebee; padding: 15px;">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success border-0 shadow-sm mb-4"
                        style="color: green; background-color: #e8f5e9; padding: 15px;">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    </div>
                @endif

                <div class="row">
                    {{-- Image Gallery Area --}}
                    <div class="col col-lg-6">
                        <div class="product_details_image">
                            {{-- Main Display Image --}}




                            {{-- Main Image with Zoom --}}
                            <div class="main-image-holder border mb-3 position-relative">
                                <img src="{{ asset($product->featured_image) }}" id="product_main_display"
                                    alt="{{ $product->name }}" class="img-fluid">

                                <button class="zoom-btn" id="openZoomModal" data-img="{{ asset($product->featured_image) }}"
                                    data-alt="{{ $product->name }}" aria-label="View full image">
                                    <i class="fas fa-search-plus"></i>
                                </button>
                            </div>




                            {{-- Zoom Modal --}}
                            <div id="imageZoomModal" class="zoom-modal-overlay" role="dialog" aria-modal="true"
                                aria-label="Image zoom viewer">
                                <div class="zoom-modal-box">
                                    <div class="zoom-modal-toolbar">
                                        <div class="zoom-tools">
                                            <button class="zoom-tool-btn" id="zoomIn" title="Zoom in"> <i
                                                    class="fas fa-plus"></i> </button>
                                            <span class="zoom-level" id="zoomLevel">100%</span>
                                            <button class="zoom-tool-btn" id="zoomOut" title="Zoom out"> <i
                                                    class="fas fa-minus"></i> </button>
                                            <button class="zoom-tool-btn" id="zoomReset" title="Reset"> <i
                                                    class="fas fa-compress-arrows-alt"></i> </button>
                                        </div>
                                        <button class="zoom-close-btn" id="closeZoomModal" aria-label="Close"><i
                                                class="fas fa-times"></i></button>
                                    </div>

                                    <div class="zoom-canvas" id="zoomCanvas">
                                        <img src="" id="zoomModalImage" alt="" draggable="false">
                                    </div>

                                    <div class="zoom-hint"><i class="fas fa-mouse"></i> Scroll to zoom &nbsp;·&nbsp; <i
                                            class="fas fa-hand-paper"></i> Drag to pan</div>
                                </div>
                            </div>









                            {{-- Sub Images & Gallery Thumbnails --}}
                            <div class="row g-2 justify-content-center">
                                <div class="col-2">
                                    <div class="border p-1 thumbnail-box thumb-img border-primary"
                                        data-image="{{ asset($product->featured_image) }}"
                                        style="cursor:pointer; border-radius: 5px;">
                                        <img src="{{ asset($product->featured_image) }}"
                                            class="img-fluid w-100 object-fit-cover">
                                    </div>
                                </div>
                                @foreach ($product->images as $galleryImg)
                                    <div class="col-2">
                                        <div class="border p-1 thumbnail-box thumb-img"
                                            data-image="{{ asset($galleryImg->image_path) }}"
                                            style="cursor:pointer; border-radius: 5px;">
                                            <img src="{{ asset($galleryImg->image_path) }}"
                                                class="img-fluid w-100 object-fit-cover">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Product Content & Variation Selectors --}}
                    <div class="col-lg-6">
                        <div class="product_details_content">
                            <span
                                class="badge bg-light text-uppercase border text-secondary px-2 py-1 mb-2">{{ $product->brand->name ?? 'Brand' }}</span>
                           <h2 class="item_title fw-bold text-dark mb-2 display-6">
    {{ $product->name }}
</h2>

{{-- Price Display Logic --}}
<div class="item_price mb-3">
    @if ($product->is_hot_deal && $product->hot_deal_end_date && \Carbon\Carbon::parse($product->hot_deal_end_date)->isFuture() && $product->hot_deal_discount_price > 0)
        <span class="fs-5 fw-semibold text-danger">
            LKR {{ number_format($product->hot_deal_discount_price, 2) }}
        </span>
        <del class="text-muted ms-2 fs-6">LKR {{ number_format($product->base_price, 2) }}</del>
        <span class="badge bg-danger text-white ms-2" style="font-size: 11px; padding: 4px 8px; vertical-align: middle; background: linear-gradient(135deg, #f43f5e, #e11d48);">Limited Offer</span>
    @elseif ($product->has_variants && $product->variants->count() > 0)
        @php
            $hasAnyVariantDiscount = $product->variants->where('is_discount', true)->count() > 0;
            $minOriginalPrice = $product->variants->min('price');
            $maxOriginalPrice = $product->variants->max('price');
            $minActivePrice = $product->min_variant_price;
            $maxActivePrice = $product->max_variant_price;
        @endphp
        @if ($hasAnyVariantDiscount && ($minActivePrice < $minOriginalPrice || $maxActivePrice < $maxOriginalPrice))
            <span class="fs-5 fw-semibold text-danger">
                LKR {{ number_format($minActivePrice, 2) }} - LKR {{ number_format($maxActivePrice, 2) }}
            </span>
            <del class="text-muted ms-2 fs-6">
                LKR {{ number_format($minOriginalPrice, 2) }} - LKR {{ number_format($maxOriginalPrice, 2) }}
            </del>
        @else
            <span class="fs-5 fw-semibold text-dark">
                LKR {{ number_format($minActivePrice, 2) }} - LKR {{ number_format($maxActivePrice, 2) }}
            </span>
        @endif
    @elseif ($product->is_discount && $product->discount_price > 0)
        <span class="fs-5 fw-semibold text-danger">
            LKR {{ number_format($product->discount_price, 2) }}
        </span>
        <del class="text-muted ms-2 fs-6">LKR {{ number_format($product->base_price, 2) }}</del>
    @else
        <span class="fs-5 fw-semibold text-dark">
            LKR {{ number_format($product->base_price, 2) }}
        </span>
    @endif
</div>

@if ($product->is_hot_deal && $product->hot_deal_end_date && \Carbon\Carbon::parse($product->hot_deal_end_date)->isFuture())
    <div class="hot-deal-countdown mb-3 text-danger fw-bold d-flex align-items-center gap-2" style="font-size: 14px; background: #fff1f2; padding: 8px 12px; border-radius: 8px; width: fit-content;" data-countdown="{{ \Carbon\Carbon::parse($product->hot_deal_end_date)->toIso8601String() }}">
        <i class="fa-regular fa-clock text-danger" style="font-size: 16px;"></i>
        <span>Ends In: <span class="countdown-timer">Loading...</span></span>
    </div>
@endif
                            @if ($product->warranty_period != null)
                                <p class="mb-2">
                                    <span class="d-inline-flex align-items-center gap-1 px-3 py-1"
                                        style="
                background: linear-gradient(135deg, #ffe1e1, #ffd1d1);
                color: #b30000;
                border-radius: 999px;
                font-weight: 500;
                font-size: 0.9rem;
                box-shadow: 0 2px 6px rgba(0,0,0,0.08);
              ">

                                        <i class="bi bi-shield-check"></i>
                                        <strong>Warranty:</strong> {{ $product->warranty_period }}
                                    </span>
                                </p>
                            @endif
                  <div class="product-desc mb-4 text-secondary" style="
    max-height: 120px;
    overflow-y: auto;
    overflow-wrap: break-word;
    word-break: break-word;
    white-space: pre-line;
    max-width: 100%;
    padding-right: 4px;
    scrollbar-width: none;
    -ms-overflow-style: none;
">
    {{ $product->description }}
</div>


                            <hr>

                            {{-- Main Add To Cart Form --}}
                            <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                {{-- VARIATION SELECTORS SECTION --}}
                                @if ($product->has_variants && $product->variants->count() > 0)
                                    <div class="item_attribute">
                                        <h4 class="title_text fw-bold mb-3">Select Options <span class="underline"></span>
                                        </h4>
                                        <div class="row">
                                            {{-- 1. Storage & RAM Combinations --}}
                                            <div class="col col-md-12 mb-3">
                                                <div class="select_option clearfix">
                                                    <h4 class="input_title fw-semibold" style="font-size: 14px;">Memory
                                                        (RAM/Storage) *</h4>
                                                    <select name="variant_id" class="variant-select">
                                                        <option value="">-- Choose Memory --</option>
                                                        @foreach ($product->variants->unique(function ($item) {
            return $item->storage . $item->ram;
        }) as $variant)
                                                            @php
                                                                $vPrice = $variant->active_price;
                                                                $isVDiscounted = $variant->is_discounted;
                                                            @endphp
                                                            <option value="{{ $variant->id }}">
                                                                {{ $variant->storage }} / {{ $variant->ram ?? 'N/A' }} RAM
                                                                (Rs. {{ number_format($vPrice, 2) }}@if($isVDiscounted) - Was Rs. {{ number_format($variant->price, 2) }}@endif)
                                                            </option>                                  
                                                        @endforeach                                      
                                                    </select>                                     
                                                </div>
                                            </div>

                                            {{-- 2. Colors Select --}}
                                            <div class="col col-md-12 mb-3">
                                                <div class="select_option clearfix">
                                                    <h4 class="input_title fw-semibold" style="font-size: 14px;">Color
                                                        Variant *</h4>
                                                    <div class="d-flex flex-wrap gap-2 mt-1">
                                                        @foreach ($product->variants->unique('color') as $vColor)
                                                            @if ($vColor->color)
                                                                <div class="color-thumbnail-wrapper color-click-box"
                                                                    data-image="{{ asset($vColor->variant_image ?? $product->featured_image) }}">
                                                                    <img src="{{ asset($vColor->variant_image ?? $product->featured_image) }}"
                                                                        class="img-fluid rounded mb-1"
                                                                        style="height: 40px; object-fit: contain;">
                                                                    <span class="d-block text-muted"
                                                                        style="font-size: 9px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $vColor->color }}</span>
                                                                    <input type="radio" name="color_name"
                                                                        value="{{ $vColor->color }}"
                                                                        class="color-radio d-none">
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </form>


                            

                            {{-- Quantity Line --}}
                            <div class="quantity_wrap d-flex align-items-center gap-3 mt-4">
                                <div class="quantity_input"  style="border:  1px solid #dee2e6; border-radius: 6px; display: inline-flex; align-items: center; padding: 0 5px;">
                                    <button type="button" class="custom_qty_decrement"><i
                                            class="fal fa-minus"></i></button>
                                    <input class="input_number custom_qty_input" type="number" name="quantity"
                                        value="1" min="1" readonly
                                        style="width: 50px; text-align: center; border: none; outline: none; background: transparent;">
                                   
                                    
                                        <button type="button" class="custom_qty_increment"><i
                                                class="fal fa-plus"></i></button>
                                </div>

                                {{-- Add To Cart Form --}}
                                <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="variant_id" class="add-to-cart-variant-id">
                                    <input type="hidden" name="quantity" class="add-to-cart-qty" value="1">
                                    @if($product->available_qty > 0)
                                        <button type="submit" class="btn btn-dark px-4 py-3"
                                            style="height: 55px;" id="addToCartBtn">
                                            Add to Cart
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-outline-secondary px-4 py-3" style="height: 55px;" disabled>
                                            Out of Stock
                                        </button>
                                    @endif
                                </form>

                                {{-- Buy Now Form --}}
                                <form action="{{ route('phone_lab.buy_now') }}" method="POST" id="buyNowForm">
                                    @csrf

                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="variant_id" class="buy-now-variant-id">
                                    <input type="hidden" name="quantity" class="buy-now-qty" value="1">
                                    <input type="hidden" name="buy_now" value="1">

                                    @if ($product->available_qty >  0)
                                        <button type="submit" class="btn btn-danger px-4 py-3"
                                            style="height: 55px;" id="buyNowBtn">
                                            Buy Now
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-secondary px-4 py-3" style="display: none;" disabled>
                                            Out of Stock
                                        </button>
                                    @endif
                                </form>
                            </div>

                        </div>
                    </div>
                </div>



                {{-- login required modal --}}
                <div class="modal fade" id="loginPopupModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content text-center p-3">

                            <div class="modal-header border-0">
                                <h5 class="modal-title w-100">Login Required</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <p>Please login first to continue.</p>
                            </div>

                            <div class="modal-footer border-0 justify-content-center">
                                <a href="{{ route('login') }}" class="btn btn-dark px-4">
                                    Go Login
                                </a>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancel
                                </button>
                            </div>

                        </div>
                    </div>
                </div>


                {{-- Login Model for Buy Now --}}
                <div class="modal fade" id="loginRequiredModal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-sm">
                        <div class="modal-content border-0 shadow">

                            <div class="modal-header">
                                <h5 class="modal-title">Login Required</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body text-center">
                                <p class="mb-3">You need to login before buying this product.</p>


                                <a href="{{ route('login') }}" class="btn btn_primary w-100">
                                    Go to Login
                                </a>
                            </div>

                        </div>
                    </div>
                </div>


                {{-- Description & Specifications Layout --}}
                <div class="details_information_tab section_space pb-0">
                    <ul class="tabs_nav nav ul_li" role="tablist">
                        <li role="presentation">
                            <button class="active" data-bs-toggle="tab" data-bs-target="#description_tab" type="button"
                                role="tab">Description</button>
                        </li>
                        <li role="presentation">
                            <button data-bs-toggle="tab" data-bs-target="#reviews_tab" type="button"
                                role="tab">Reviews</button>
                        </li>
                        <li role="presentation">
                            <button data-bs-toggle="tab" data-bs-target="#additional_information_tab" type="button"
                                role="tab">Specifications</button>
                        </li>
                    </ul>
                    <div class="tab-content border p-4" style="background: #fafafa; border-radius: 0 0 8px 8px;">
                      <div class="tab-pane fade show active" id="description_tab" role="tabpanel"
     style="min-width: 0; overflow: hidden;">

    @foreach (explode('</p>', $product->description) as $para)
        @if (trim(strip_tags($para)))
            <p class="mb-2 text-secondary"
               style="overflow-wrap: break-word;
                      word-break: break-word;
                      white-space: normal;
                      max-width: 100%;">
                {!! strip_tags($para, '<br>') !!}
            </p>
        @endif
    @endforeach

</div>
                        <div class="tab-pane fade" id="additional_information_tab" role="tabpanel">
                            <table class="table table-bordered table-striped bg-white">
                                <tr>
                                    <th style="width: 300px;">Product SKU</th>
                                    <td>{{ $product->sku ?? '#ID-' . $product->id }}</td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td>{{ $product->category->name ?? 'Gadgets' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="tab-pane fade" id="reviews_tab" role="tabpanel">
    <div class="bg-white p-4 rounded shadow-sm">

        <!-- Review Summary (basic dynamic version) -->
        <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-4">

            <div>
                <h4 class="fw-bold mb-1 text-danger">Customer Reviews</h4>

                @php
                    $avgRating = round($reviews->avg('rating'), 1);
                    $totalReviews = $reviews->total();
                @endphp

                <div class="text-warning fs-5">
                    ★★★★★
                    <span class="text-dark fs-6 ms-2">
                        {{ $avgRating }} out of 5
                    </span>
                </div>

                <small class="text-muted">
                    Based on {{ $totalReviews }} Reviews
                </small>
            </div>

            <button class="btn btn-danger rounded-pill px-4"
                data-bs-toggle="modal"
                data-bs-target="#reviewModal">
                Write Review
            </button>

        </div>

        <!-- Reviews List -->
        @forelse($reviews as $review)

            <div class="border rounded p-3 mb-4 bg-light">

                <!-- User Info -->
                <div class="d-flex align-items-center mb-3">

                    <img src="https://ui-avatars.com/api/?name={{ urlencode($review->name) }}"
                        class="rounded-circle border border-danger"
                        width="60" height="60">

                    <div class="ms-3">
                        <h6 class="mb-1 fw-bold">{{ $review->name }}</h6>

                        <div class="text-warning">
                            {!! str_repeat('★', $review->rating) !!}
                            {!! str_repeat('☆', 5 - $review->rating) !!}
                        </div>

                        <small class="text-muted">
                            Reviewed on {{ $review->created_at->format('M d, Y') }}
                        </small>
                    </div>

                </div>

                <!-- Review Text -->
               <p class="text-secondary mb-3" style="
    overflow-wrap: break-word;
    word-break: break-word;
    white-space: pre-line;
    max-width: 100%;
">
    {{ $review->comment }}
</p>

                <!-- Review Images -->
                @if(!empty($review->images))
                    <div class="row g-2">
                        @foreach($review->images as $img)
                            <div class="col-4 col-md-2">
                                <img src="{{ asset('storage/' . $img) }}"
                                    class="img-fluid rounded border">
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>

        @empty
            <div class="alert alert-info">
                No reviews yet. Be the first one 🚀
            </div>
        @endforelse

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $reviews->links() }}
        </div>

    </div>
</div>
        </section>




        {{-- popup form write revew section--}}

        <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="reviewModalLabel">Write a Review</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">

                <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                   
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label">Your Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                    </div>

                    <!-- Rating -->
                    <div class="mb-3">
                        <select name="rating" required>
                            <option value="5">★★★★★</option>
                            <option value="4">★★★★☆</option>
                            <option value="3">★★★☆☆</option>
                            <option value="2">★★☆☆☆</option>
                            <option value="1">★☆☆☆☆</option>
                        </select>
                    </div>

                    <!-- Review -->
                    <div class="mb-3">
                        <textarea name="comment" class="form-control" rows="4" placeholder="Write your experience..." required></textarea>
                    </div>

                    <!-- Images -->
                    <div class="mb-3">
                        <label class="form-label">Upload Images</label>
                        <input type="file" name="images[]" class="form-control" multiple>
                    </div>

                    <!-- Footer buttons inside form -->
                    <div class="modal-footer px-0 pb-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Submit Review</button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>
         




        {{-- Related Products Section --}}
        <section class="related_products_section section_space">
            <div class="container">
                <div class="section_title mb-0">
                    <h2 class="title_text">Related Products</h2>
                </div>
                <div class="product_wrap related_products_wrap">
                    @forelse($relatedProducts as $relProduct)
                        <div class="product_layout1">
                            <div class="item_badge sale_badge"><span>SALE</span></div>
                            <div class="item_image">
                                <img src="{{ asset($relProduct->featured_image) }}" alt="{{ $relProduct->name }}">
                                @if ($relProduct->images->first())
                                    <img src="{{ asset($relProduct->images->first()->image_path) }}"
                                        alt="{{ $relProduct->name }}">
                                @else
                                    <img src="{{ asset($relProduct->featured_image) }}" alt="{{ $relProduct->name }}">
                                @endif
                                <a class="quickview_btn"
                                    href="{{ route('product.details', ['id' => $product->id, 'slug' => $relProduct->slug]) }}"
                                    role="button">View</a>
                            </div>
                            <div class="item_content">
                                <h3 class="item_title">
                                    <a
                                        href="{{ route('product.details', ['id' => $product->id, 'slug' => $relProduct->slug]) }}">{{ $relProduct->name }}</a>
                                </h3>
                                <div class="item_price">
                                    <span>
                                        @if ($relProduct->has_variants)
                                            Rs. {{ number_format($relProduct->min_variant_price, 2) }}
                                        @else
                                            Rs. {{ number_format($relProduct->active_price, 2) }}
                                        @endif
                                    </span>
                                </div>
                                <ul class="item_btns_group ul_li">
                                    <li><a class="addtocart_btn" style="width: 100%;"
                                            href="{{ route('product.details', ['id' => $product->id, 'slug' => $relProduct->slug]) }}">Add
                                            To Cart</a></li>
                                </ul>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted ps-3">No related products found in this category.</p>
                    @endforelse
                </div>
            </div>
        </section>
    </main>
@endsection

@push('styles')
    <style>
        .main-image-holder {
            width: 100%;
            height: 450px !important;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fdfdfd;
            border-radius: 8px;
            overflow: hidden;
            padding: 15px;
        }

        #product_main_display {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            transition: opacity 0.2s ease-in-out;
        }

        /* Default Color Box Style */
        .color-thumbnail-wrapper {
            cursor: pointer;
            width: 65px;
            border-radius: 6px;
            background: #fff;
            border: 1px solid #edf2f7;
            padding: 5px;
            transition: all 0.2s ease-in-out;
        }

        .thumbnail-box:hover,
        .color-thumbnail-wrapper:hover {
            border-color: #00acc1 !important;
        }

        /* 💡 Active Thumbnails and Color Selection Highlight Borders */
        .active-thumb {
            border-color: #00acc1 !important;
            box-shadow: 0 0 0 2px rgba(0, 172, 193, 0.2);
        }

        .active-color-box {
            border-color: #00acc1 !important;
            box-shadow: 0 0 0 2px rgba(0, 172, 193, 0.2);
            background-color: #f4fcfd !important;
        }

        .quantity_wrap {
            display: flex !important;
            flex-wrap: wrap;
            /* Allows buttons to drop to a new line if needed */
            gap: 10px !important;
            align-items: center;
        }

        /* Ensure button has visibility */
        .btn-outline-primary {
            border: 2px solid #00acc1;
            color: #00acc1;
            background: transparent;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-outline-primary:hover {
            background: #00acc1;
            color: #fff;
        }

        .product-desc {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }












        /* --- Trigger Button --- */
        .main-image-holder {
            overflow: hidden;
        }

        .zoom-btn {
            position: absolute;
            bottom: 10px;
            right: 10px;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(0, 0, 0, .55);
            border: none;
            color: #fff;
            font-size: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background .2s, transform .2s;
            z-index: 10;
        }

        .zoom-btn:hover {
            background: rgba(0, 0, 0, .85);
            transform: scale(1.1);
        }

        /* --- Modal Overlay --- */
        .zoom-modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .92);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        .zoom-modal-overlay.active {
            display: flex;
        }

        /* --- Modal Box --- */
        .zoom-modal-box {
            position: relative;
            width: min(92vw, 860px);
            max-height: 90vh;
            background: #1a1a1a;
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 24px 64px rgba(0, 0, 0, .7);
        }

        /* --- Toolbar --- */
        .zoom-modal-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 14px;
            background: #111;
            border-bottom: 1px solid #2a2a2a;
            flex-shrink: 0;
        }

        .zoom-tools {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .zoom-tool-btn {
            width: 32px;
            height: 32px;
            background: #2a2a2a;
            border: none;
            border-radius: 6px;
            color: #ccc;
            font-size: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background .15s, color .15s;
        }

        .zoom-tool-btn:hover {
            background: #3a3a3a;
            color: #fff;
        }

        .zoom-level {
            font-size: 12px;
            color: #aaa;
            min-width: 42px;
            text-align: center;
            font-family: monospace;
        }

        .zoom-close-btn {
            width: 32px;
            height: 32px;
            background: #3a2020;
            border: none;
            border-radius: 6px;
            color: #e88;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background .15s;
        }

        .zoom-close-btn:hover {
            background: #c0392b;
            color: #fff;
        }

        /* --- Canvas (pan area) --- */
        .zoom-canvas {
            flex: 1;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: grab;
            min-height: 0;
            background: #111;
            position: relative;
        }

        .zoom-canvas.dragging {
            cursor: grabbing;
        }

        .zoom-canvas img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            transform-origin: center center;
            transition: transform .08s ease;
            user-select: none;
            pointer-events: none;
        }

        /* --- Hint bar --- */
        .zoom-hint {
            text-align: center;
            padding: 7px;
            font-size: 11px;
            color: #555;
            background: #111;
            border-top: 1px solid #222;
            flex-shrink: 0;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


 <script>
    let maxQty = {{ $product->available_qty ?? 1 }};
</script>

    <script>
        $(document).ready(function() {

            function swapProductImage(newSrc) {
                let mainImg = $('#product_main_display');
                mainImg.css('opacity', '0');
                setTimeout(function() {
                    mainImg.attr('src', newSrc).css('opacity', '1');
                }, 200);
            }

            // 1. Thumbnails Click
            $('.thumb-img').on('click', function() {
                let targetImage = $(this).data('image');
                swapProductImage(targetImage);

                $('.thumb-img').removeClass('active-thumb');
                $(this).addClass('active-thumb');
            });

            // 2. Color Box Click (Highlight Fix)
            $('.color-click-box').on('click', function() {
                let colorImage = $(this).data('image');
                swapProductImage(colorImage);

                // 💡 රේඩියෝ බටන් එක චෙක් කර 'change' එක trigger කිරීම
                $(this).find('.color-radio').prop('checked', true).trigger('change');

                // 💡 Active style පන්ති මාරු කිරීම
                $('.color-click-box').removeClass('active-color-box');
                $(this).addClass('active-color-box');
            });



            

           $('.custom_qty_increment').off('click').on('click', function (e) {
    e.preventDefault();

    let input = $(this).siblings('.custom_qty_input');

    // get max stock from parent
   
    
    let currentVal = parseInt(input.val()) || 0;
    //  stop if reached stock limit
    if (currentVal >= maxQty) {
        Swal.fire({
            icon: 'warning',
            title: 'Stock limit reached',
            text: `You can only select up to ${maxQty} items`
        });
        return;
    }
   
    let val = currentVal + 1;
    input.val(val);

    // Sync to hidden inputs
    $('.add-to-cart-qty').val(val);
    $('.buy-now-qty').val(val);
});

            $('.custom_qty_decrement').off('click').on('click', function(e) {
                e.preventDefault();
                let input = $(this).siblings('.custom_qty_input');
                let val = parseInt(input.val());
                if (val > 1) {
                    val -= 1;
                    input.val(val);
                    // Sync to hidden inputs
                    $('.add-to-cart-qty').val(val);
                    $('.buy-now-qty').val(val);
                }
            });

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true
                });
            @endif

            $('#addToCartForm').on('submit', function(e) {
                console.log("Add To Cart Form Submitted");

                // 1. Check login FIRST
                if (!isLoggedIn) {
                    console.log('isLoggedIn:', isLoggedIn);
                    e.preventDefault();
                    let modal = new bootstrap.Modal(document.getElementById('loginPopupModal'));
                    modal.show();
                    return false;
                }

                let variantSelect = $('select[name="variant_id"]');

                // Specs (Memory) තෝරා නැත්නම්
                if (variantSelect.length > 0 && (variantSelect.val() === "" || variantSelect.val() ===
                        null)) {
                    e.preventDefault();

                    Swal.fire({
                        icon: 'warning',
                        title: 'Specification Required',
                        text: 'Please select your preferred RAM / Storage specification before adding to cart.',
                        confirmButtonColor: '#00acc1',
                        didClose: () => {
                            // NiceSelect එකක් ඇත්නම් එය open කිරීම
                            let niceSelect = variantSelect.next('.nice-select');
                            if (niceSelect.length > 0) {
                                niceSelect.focus().addClass('open');
                            } else {
                                variantSelect.focus();
                            }
                        }
                    });
                    return false;
                }

                // පාට (Color) තෝරා නැත්නම්
                let isColorChecked = $('input[name="color_name"]:checked').val();
                if ($('.color-radio').length > 0 && !isColorChecked) {
                    e.preventDefault();

                    Swal.fire({
                        icon: 'warning',
                        title: 'Color Required',
                        text: 'Please choose your preferred Color Variant from the available choices.',
                        confirmButtonColor: '#00acc1'
                    });
                    return false;
                }
            });

        });

        // Sync variant selection to both forms
        $('select[name="variant_id"]').on('change', function() {
            let selectedId = $(this).val();
            $('.add-to-cart-variant-id').val(selectedId);
            $('.buy-now-variant-id').val(selectedId);
        });

        // Sync Buy Now form validation to match Add To Cart
        $('#buyNowForm').on('submit', function(e) {

            // 1. Check login FIRST
            if (!isLoggedIn) {
                e.preventDefault();
                let modal = new bootstrap.Modal(document.getElementById('loginPopupModal'));
                modal.show();
                return false;
            }


            let variantSelect = $('select[name="variant_id"]');
            if (variantSelect.length > 0 && variantSelect.val() === "") {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Specification Required',
                    text: 'Please select your RAM / Storage specification before buying!'
                });
                return false;
            }
        });























        (function() {
            const modal = document.getElementById('imageZoomModal');
            const canvas = document.getElementById('zoomCanvas');
            const img = document.getElementById('zoomModalImage');
            const levelLabel = document.getElementById('zoomLevel');
            const openBtn = document.getElementById('openZoomModal');
            const closeBtn = document.getElementById('closeZoomModal');
            const mainImg = document.getElementById('product_main_display');

            let scale = 1,
                minScale = 0.5,
                maxScale = 5;
            let tx = 0,
                ty = 0;
            let dragging = false,
                startX = 0,
                startY = 0,
                lastTx = 0,
                lastTy = 0;

            /* ── helpers ── */
            function applyTransform(animate = false) {
                img.style.transition = animate ? 'transform .2s ease' : 'none';
                img.style.transform = `translate(${tx}px, ${ty}px) scale(${scale})`;
                levelLabel.textContent = Math.round(scale * 100) + '%';
            }

            function resetView() {
                scale = 1;
                tx = 0;
                ty = 0;
                applyTransform(true);
            }

            function clampTranslation() {
                const cr = canvas.getBoundingClientRect();
                const ir = img.getBoundingClientRect();
                const maxX = Math.max(0, (ir.width - cr.width) / 2);
                const maxY = Math.max(0, (ir.height - cr.height) / 2);
                tx = Math.max(-maxX, Math.min(maxX, tx));
                ty = Math.max(-maxY, Math.min(maxY, ty));
            }

            /* ── open / close ── */
            function openModal() {
                img.src = openBtn.dataset.img;
                img.alt = openBtn.dataset.alt;
                resetView();
                modal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeModal() {
                modal.classList.remove('active');
                document.body.style.overflow = '';
            }

            openBtn.addEventListener('click', openModal);
            closeBtn.addEventListener('click', closeModal);
            modal.addEventListener('click', e => {
                if (e.target === modal) closeModal();
            });
            document.addEventListener('keydown', e => {
                if (e.key === 'Escape') closeModal();
            });

            /* ── toolbar buttons ── */
            document.getElementById('zoomIn').addEventListener('click', () => {
                scale = Math.min(maxScale, scale + 0.25);
                applyTransform(true);
            });
            document.getElementById('zoomOut').addEventListener('click', () => {
                scale = Math.max(minScale, scale - 0.25);
                clampTranslation();
                applyTransform(true);
            });
            document.getElementById('zoomReset').addEventListener('click', resetView);

            /* ── mouse wheel zoom ── */
            canvas.addEventListener('wheel', e => {
                e.preventDefault();
                const delta = e.deltaY < 0 ? 0.15 : -0.15;
                const rect = canvas.getBoundingClientRect();
                const ox = e.clientX - rect.left - rect.width / 2 - tx;
                const oy = e.clientY - rect.top - rect.height / 2 - ty;
                const prev = scale;
                scale = Math.min(maxScale, Math.max(minScale, scale + delta));
                const ratio = scale / prev;
                tx -= ox * (ratio - 1);
                ty -= oy * (ratio - 1);
                clampTranslation();
                applyTransform();
            }, {
                passive: false
            });

            /* ── drag to pan (mouse) ── */
            canvas.addEventListener('mousedown', e => {
                dragging = true;
                canvas.classList.add('dragging');
                startX = e.clientX;
                startY = e.clientY;
                lastTx = tx;
                lastTy = ty;
            });
            window.addEventListener('mousemove', e => {
                if (!dragging) return;
                tx = lastTx + (e.clientX - startX);
                ty = lastTy + (e.clientY - startY);
                clampTranslation();
                applyTransform();
            });
            window.addEventListener('mouseup', () => {
                dragging = false;
                canvas.classList.remove('dragging');
            });

            /* ── touch pinch + pan ── */
            let lastDist = null,
                touchTx = 0,
                touchTy = 0;

            canvas.addEventListener('touchstart', e => {
                if (e.touches.length === 1) {
                    dragging = true;
                    startX = e.touches[0].clientX;
                    startY = e.touches[0].clientY;
                    lastTx = tx;
                    lastTy = ty;
                } else if (e.touches.length === 2) {
                    dragging = false;
                    lastDist = Math.hypot(
                        e.touches[0].clientX - e.touches[1].clientX,
                        e.touches[0].clientY - e.touches[1].clientY
                    );
                }
            }, {
                passive: true
            });

            canvas.addEventListener('touchmove', e => {
                e.preventDefault();
                if (e.touches.length === 1 && dragging) {
                    tx = lastTx + (e.touches[0].clientX - startX);
                    ty = lastTy + (e.touches[0].clientY - startY);
                    clampTranslation();
                    applyTransform();
                } else if (e.touches.length === 2 && lastDist !== null) {
                    const dist = Math.hypot(
                        e.touches[0].clientX - e.touches[1].clientX,
                        e.touches[0].clientY - e.touches[1].clientY
                    );
                    scale = Math.min(maxScale, Math.max(minScale, scale * (dist / lastDist)));
                    lastDist = dist;
                    clampTranslation();
                    applyTransform();
                }
            }, {
                passive: false
            });

            canvas.addEventListener('touchend', () => {
                dragging = false;
                lastDist = null;
            });

            /* ── keep zoom button in sync when thumbnail changes main image ── */
            const observer = new MutationObserver(() => {
                openBtn.dataset.img = mainImg.src;
                openBtn.dataset.alt = mainImg.alt;
            });
            observer.observe(mainImg, {
                attributes: true,
                attributeFilter: ['src']
            });
        })();
    </script>
@endpush
