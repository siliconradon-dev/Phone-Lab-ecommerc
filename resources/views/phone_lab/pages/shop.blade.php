@extends('phone_lab.layouts.app')

@section('title', $siteSettings['site_name'] . ' - Shop')

@section('content')
    <main>

        <!-- product quick view modal - start   ================================================== -->
        <div class="modal fade" id="quickview_popup" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
            tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel2">Product Quick View</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="product_details">
                            <div class="container">
                                <div class="row">
                                    <div class="col col-lg-6">
                                        <div class="product_details_image p-0">
                                            <img src="{{ asset('assets/images/details/product_details_img_1.webp') }}"
                                                alt="Getyootech - Gadgets Ecommerce Site Template">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="product_details_content">
                                            <h2 class="item_title">CURREN 8109 Watches</h2>
                                            <p>
                                                It is a long established fact that a reader will be distracted eget velit.
                                                Donec ac tempus ante. Fusce ultricies massa massa. Fusce aliquam, purus eget
                                                sagittis vulputate
                                            </p>
                                            <div class="item_review">
                                                <ul class="rating_star ul_li">
                                                    <li><i class="fa-solid fa-star"></i></li>
                                                    <li><i class="fa-solid fa-star"></i></li>
                                                    <li><i class="fa-solid fa-star"></i></li>
                                                    <li><i class="fa-solid fa-star"></i></li>
                                                    <li><i class="fa-solid fa-star"></i></li>
                                                </ul>
                                                <span class="review_value">3 Rating(s)</span>
                                            </div>
                                            <div class="item_price">
                                                <span>$620.00</span>
                                                <del>$720.00</del>
                                            </div>

                                            <hr>

                                            <div class="item_attribute">
                                                <h3 class="title_text">Options <span class="underline"></span></h3>
                                                <form action="#">
                                                    <div class="row">
                                                        <div class="col col-md-6">
                                                            <div class="select_option clearfix">
                                                                <h4 class="input_title">Size *</h4>
                                                                <select>
                                                                    <option data-display="- Please select -">Choose A Option
                                                                    </option>
                                                                    <option value="1">Some option</option>
                                                                    <option value="2">Another option</option>
                                                                    <option value="3" disabled>A disabled option
                                                                    </option>
                                                                    <option value="4">Potato</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col col-md-6">
                                                            <div class="select_option clearfix">
                                                                <h4 class="input_title">Color *</h4>
                                                                <select>
                                                                    <option data-display="- Please select -">Choose A Option
                                                                    </option>
                                                                    <option value="1">Some option</option>
                                                                    <option value="2">Another option</option>
                                                                    <option value="3" disabled>A disabled option
                                                                    </option>
                                                                    <option value="4">Potato</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="repuired_text">Repuired Fiields *</span>
                                                </form>
                                            </div>

                                            <div class="quantity_wrap">
                                                <form action="#">
                                                    <div class="quantity_input">
                                                        <button type="button" class="input_number_decrement">
                                                            <i class="fal fa-minus"></i>
                                                        </button>
                                                        <input class="input_number" type="text" value="1">
                                                        <button type="button" class="input_number_increment">
                                                            <i class="fal fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </form>

                                                <div class="total_price">
                                                    Total: $620,99
                                                </div>
                                            </div>

                                            <ul class="default_btns_group ul_li">
                                                <li><a class="add_to_cart_btn"
                                                        href="{{ route('phone_lab.shop_details') }}">Add To Cart</a></li>
                                            </ul>

                                            <ul class="default_share_links ul_li">
                                                <li>
                                                    <a class="facebook" href="#!">
                                                        <span><i class="fab fa-facebook-square"></i> Like</span>
                                                        <small>10K</small>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="twitter" href="#!">
                                                        <span><i class="fab fa-twitter-square"></i> Tweet</span>
                                                        <small>15K</small>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="google" href="#!">
                                                        <span><i class="fab fa-google-plus-square"></i> Google+</span>
                                                        <small>20K</small>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="share" href="#!">
                                                        <span><i class="fas fa-plus-square"></i> Share</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- product quick view modal - end
                                                    ================================================== -->

        <!-- breadcrumb_section - start
                                                    ================================================== -->
        <div class="breadcrumb_section">
            <div class="container">
                <ul class="breadcrumb_nav ul_li">
                    <li><a href="{{ route('phone_lab.index') }}">Home</a></li>
                    <li>Product Grid</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb_section - end
                                                    ================================================== -->

        <!-- product_section - start
                                                    ================================================== -->
        <section class="product_section section_space">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="filter_topbar">
                            <div class="row align-items-center">
                                <div class="col col-md-4 col-sm-4">
                                    <ul class="layout_btns nav" role="tablist">
                                        <li role="presentation">
                                            <button class="active" data-bs-toggle="tab" data-bs-target="#home"
                                                type="button" role="tab" aria-controls="home" aria-selected="true">
                                                <i class="fa-solid fa-grid"></i>
                                            </button>
                                        </li>
                                        <li role="presentation">
                                            <button data-bs-toggle="tab" data-bs-target="#profile" type="button"
                                                role="tab" aria-controls="profile" aria-selected="false">
                                                <i class="fa-solid fa-list"></i>
                                            </button>
                                        </li>
                                    </ul>
                                </div>


                                @if (request()->filled('category') || request()->filled('brand'))
                                    <div class="col-md-4 col-sm-4">
                                        <form action="{{ url()->current() }}" method="GET" id="sortingForm">
                                            @foreach (request()->except('sort', 'page') as $key => $value)
                                                <input type="hidden" name="{{ $key }}"
                                                    value="{{ $value }}">
                                            @endforeach

                                            <select name="sort"
                                                onchange="document.getElementById('sortingForm').submit();">
                                                <option value="default"
                                                    {{ request('sort') == 'default' ? 'selected' : '' }}>Default Sorting
                                                </option>
                                                <option value="name_asc"
                                                    {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Sort by Name
                                                </option>
                                                <option value="price_low_high"
                                                    {{ request('sort') == 'price_low_high' ? 'selected' : '' }}>Price: Low
                                                    to High</option>
                                                <option value="price_high_low"
                                                    {{ request('sort') == 'price_high_low' ? 'selected' : '' }}>Price: High
                                                    to Low</option>
                                            </select>
                                        </form>
                                    </div>
                                @else
                                    <div class="col-md-4 col-sm-4"></div>
                                @endif


                                <div class="col col-md-4 col-sm-4">
                                    <div class="result_text">
                                        @if ($products->total() > 0)
                                            Showing {{ $products->firstItem() }}-{{ $products->lastItem() }} of
                                            {{ $products->total() }} results
                                        @else
                                            No results found
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="tab-content">
                            {{-- 1. GRID VIEW TAB (#home) --}}
                            <div class=" tab-pane fade show active" id="home" role="tabpanel">
                                <div class="product_wrap d-flex flex-wrap  gap-3">

                                    @forelse($products as $product)

                                        <div class="product_layout1 bg-white" style="width: 260px;">
                                            @if ($product->created_at->diffInDays(now()) < 7)
                                                <div class="item_badge hot_badge"><span>NEW</span></div>
                                            @endif

                                            <div class="item_image bg-white">
                                                <img src="{{ asset($product->featured_image) }}"
                                                    alt="{{ $product->name }}">
                                                @if ($product->images->first())
                                                    <img src="{{ asset($product->images->first()->image_path) }}"
                                                        alt="{{ $product->name }}">
                                                @else
                                                    <img src="{{ asset($product->featured_image) }}"
                                                        alt="{{ $product->name }}">
                                                @endif
                                                <a class="quickview_btn"
                                                    href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}"
                                                    role="button">View</a>
                                            </div>

                                            <div class="item_content">
                                                <h3 class="item_title">
                                                    <a
                                                        href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}">{{ $product->name }}</a>
                                                </h3>
                                                @php
                                                    $rating = $product->reviews_avg_rating ?? 0;
                                                @endphp

                                                <div class="flex flex-row align-items-center justify-content-between mb-2">
                                                    <div>
                                                    @if($product->available_qty <= 0)
                                                        <span class="badge bg-danger">Out of Stock</span>
                                                    @else
                                                        <span class="badge bg-white text-white">....</span>
                                                    @endif
                                                </div>
                                                    <ul class="rating_star ul_li">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <li>
                                                            <i class="fa-solid fa-star"
                                                                style="color: {{ $i <= round($rating) ? '#f5c518' : '#ddd' }}">
                                                            </i>
                                                        </li>
                                                    @endfor
                                                </ul>
                                                
                                                </div>
                                                <div class="item_price">
                                                    @if ($product->has_variants)
                                                        <span>LKR
                                                            {{ number_format($product->variants->min('price'), 2) }}</span>
                                                    @else
                                                        <span>LKR {{ number_format($product->base_price, 2) }}</span>
                                                    @endif
                                                    
                                                </div>
                                                
                                                <ul class="item_btns_group ul_li">
                                                    <li><a class="add_to_cart_btn"
                                                            href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}">Add
                                                            To Cart</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="d-flex flex-column justify-content-center align-items-center text-center w-100"
                                            style="min-height: 60vh;">

                                            <img src="{{ asset('assets/images/shop/svg/no-products.svg') }}"
                                                alt="No products" style="max-width: 220px; width: 100%; opacity: 0.7;">

                                            <h5 class="text-muted mt-3">
                                                No products found
                                            </h5>

                                            <p class="text-muted small">
                                                Try adjusting your filters or search keywords
                                            </p>
                                        </div>
                                    @endforelse

                                </div>

                                {{-- Dynamic Pagination Links --}}
                                <div class="pagination_wrap">
                                    {{ $products->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                            {{-- 2. LIST VIEW TAB (#profile) --}}
                            <div class="tab-pane fade" id="profile" role="tabpanel">
                                <div class="product_layout2_wrap">

                                    @foreach ($products as $product)
                                        <div
                                            class="product_layout2 d-flex flex-column flex-md-row mb-3 p-3 border rounded">

                                            <!-- IMAGE -->
                                            <div class="item_image me-md-3 mb-3 mb-md-0" style="flex-shrink: 0;">
                                                <a class="image_wrap bg-white"
                                                    href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}">
                                                    <img src="{{ asset($product->featured_image) }}"
                                                        alt="{{ $product->name }}" class="img-fluid rounded"
                                                        style="max-width: 180px;">
                                                </a>
                                            </div>

                                            <!-- CONTENT -->
                                            {{-- min-width: 0 is the key fix — without it flex children won't shrink below their content size --}}
                                            <div class="item_content d-flex flex-column flex-grow-1"
                                                style="min-width: 0;">

                                                <h3 class="item_title">
                                                    <a
                                                        href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}">
                                                        {{ $product->name }}
                                                    </a>
                                                </h3>

                                                @php
                                                    $rating = $product->reviews_avg_rating ?? 0;
                                                @endphp

                                                <ul class="rating_star ul_li mb-2">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <li>
                                                            <i class="fa-solid fa-star"
                                                                style="color: {{ $i <= round($rating) ? '#f5c518' : '#ddd' }}">
                                                            </i>
                                                        </li>
                                                    @endfor
                                                </ul>
                                                 <div> @if($product->available_qty <= 0)
                                                        <span class="badge bg-danger" style="width: [20px];">Out of Stock</span>
                                                    @endif</div>

                                                {{-- CSS line-clamp keeps description inside the box regardless of length --}}
                                                <p class="mb-2 text-muted"
                                                    style="
                        overflow: hidden;
                        display: -webkit-box;
                        -webkit-line-clamp: 3;
                        -webkit-box-orient: vertical;
                    ">
                                                    {!! Str::limit(strip_tags($product->description), 150) !!}
                                                </p>

                                                <div class="item_price mb-3">
                                                    @if ($product->has_variants)
                                                        <span>LKR
                                                            {{ number_format($product->variants->min('price'), 2) }}</span>
                                                    @else
                                                        <span>LKR {{ number_format($product->base_price, 2) }}</span>
                                                    @endif
                                                </div>

                                                <!-- BUTTON (always bottom aligned) -->
                                                {{-- Removed w-100 w-md-auto — white-space: nowrap locks button to its natural width --}}
                                                <div class="mt-auto">
                                                    <a href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}"
                                                        class="btn btn-danger px-4 py-2 fw-semibold rounded-pill"
                                                        style="white-space: nowrap; align-self: flex-start;">
                                                        <i class="fas fa-shopping-cart me-2"></i>
                                                        Add To Cart
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                                <!-- PAGINATION -->
                                <div class="pagination_wrap mt-4">
                                    {{ $products->links('pagination::bootstrap-5') }}
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="col-lg-3 order-lg-first">
                        <aside class="sidebar_section ps-0 mt-lg-0">
                            {{-- Categories Widget --}}
                            <div class="sb_widget sb_category">
                                <h3 class="sb_widget_title">Categories</h3>
                                <ul class="sb_category_list ul_li_block">
                                    <li>
                                        <a href="{{ route('phone_lab.shop_grid') }}"
                                            class="{{ !request('category') ? 'fw-bold text-dark' : '' }}">
                                            All Categories
                                        </a>
                                    </li>
                                    @foreach ($sidebarCategories as $sCat)
                                        @if ($sCat->products_count > 0)
                                            <li>
                                                <a href="{{ route('phone_lab.shop_grid', ['category' => $sCat->id]) }}"
                                                    class="{{ request('category') == $sCat->id ? 'fw-bold text-primary' : '' }}">
                                                    {{ $sCat->name }} <span>({{ $sCat->products_count }})</span>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>

                            {{-- Brands Widget --}}
                            <div class="sb_widget sb_category">
                                <h3 class="sb_widget_title">Brands</h3>
                                <ul class="sb_category_list ul_li_block">
                                    <li>
                                        <a href="{{ route('phone_lab.shop_grid', request()->except('brand')) }}"
                                            class="{{ !request('brand') ? 'fw-bold text-dark' : '' }}">
                                            All Brands
                                        </a>
                                    </li>
                                    @foreach ($sidebarBrands as $sBrand)
                                        @if ($sBrand->products_count > 0)
                                            <li>
                                                <a href="{{ route('phone_lab.shop_grid', array_merge(request()->query(), ['brand' => $sBrand->id])) }}"
                                                    class="{{ request('brand') == $sBrand->id ? 'fw-bold text-primary' : '' }}">
                                                    {{ $sBrand->name }} 
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>

                            {{-- Latest Products Vertical Carousel Widget --}}
                            <div class="sb_widget latest_product_carousel mb-lg-0">
                                <div class="title_wrap">
                                    <h3 class="area_title">Latest Products</h3>
                                    <div class="carousel_nav">
                                        <button type="button" class="vs4i_left_arrow"><i
                                                class="fa-regular fa-angle-left"></i></button>
                                        <button type="button" class="vs4i_right_arrow"><i
                                                class="fa-regular fa-angle-right"></i></button>
                                    </div>
                                </div>
                                <div class="vertical_slider_4item" data-slick='{"dots": false}'>
                                    @foreach ($latestProducts as $lProduct)
                                        <div class="slider_item">
                                            <div class="small_product_layout">
                                                <a class="item_image"
                                                    href="{{ route('product.details', ['id' => $lProduct->id, 'slug' => $lProduct->slug]) }}">
                                                    <img src="{{ asset($lProduct->featured_image) }}"
                                                        alt="{{ $lProduct->name }}">
                                                </a>
                                                <div class="item_content">
                                                    <h3 class="item_title"><a
                                                            href="{{ route('product.details', ['id' => $lProduct->id, 'slug' => $lProduct->slug]) }}">{{ $lProduct->name }}</a>
                                                    </h3>
                                                    <div class="item_price">
                                                        @if ($lProduct->has_variants)
                                                            <span>LKR
                                                                {{ number_format($lProduct->variants->min('price'), 2) }}</span>
                                                        @else
                                                            <span>LKR {{ number_format($lProduct->base_price, 2) }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </section>
        <!-- product_section - end ================================================== -->

        <style>
            .product_layout2 {
                display: flex;
                height: 100%;
            }

            .product_layout2 .item_content {
                display: flex;
                flex-direction: column;
                flex: 1;
            }
        </style>


    </main>
    <!-- main body - end ================================================== -->
@endsection
