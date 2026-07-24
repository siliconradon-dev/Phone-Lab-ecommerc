@extends('phone_lab.layouts.app')

@section('title', $siteSettings['site_name'] ?? 'Megha Mobile')

@section('content')
    <main>



        {{-- Success Message Modal (Order Placed ) --}}

        @if (session('success'))
            <div id="successModal" class="custom-modal"
                style="display:flex; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); justify-content:center; align-items:center; z-index:9999;">
                <div class="modal-box"
                    style="background:#fff; padding:30px; border-radius:10px; text-align:center; width:320px;">
                    <h3 style="margin:10px 0;">Order Placed!</h3>
                    <p>{{ session('success') }}</p>
                    <button id="closeSuccess"
                        style="margin-top:15px; padding:10px 25px; border:none; background:green; color:#fff; cursor:pointer; border-radius:5px; font-size:15px;">OK</button>
                </div>
            </div>

            <script>
                document.getElementById('closeSuccess').addEventListener('click', function() {
                    document.getElementById('successModal').style.display = 'none';
                });
            </script>
        @endif





        <section class="slider_section">
            <div class="main_slider" data-slick='{"arrows": false}'>
                @forelse($banners as $banner)
                    <div class="slider_item">
                        <div class="container">
                            <div class="row align-items-center justify-content-lg-between">
                                <div class="order-last col col-lg-6 col-md-6 col-sm-6">
                                    <div class="slider_image" data-animation="fadeInRight" data-delay=".2s">
                                        <img src="{{ asset($banner->image) }}" alt="Slider Image">
                                    </div>
                                </div>
                                <div class="col col-lg-5 col-md-6 col-sm-6">
                                    <div class="slider_content">
                                        @if($banner->subtitle)
                                            <h3 class="small_title" data-animation="fadeInUp2" data-delay=".2s">{{ $banner->subtitle }}</h3>
                                        @endif
                                        @if($banner->title)
                                            <h4 class="big_title" data-animation="fadeInUp2" data-delay=".4s">{{ $banner->title }}</h4>
                                        @endif
                                        @if($banner->offer_text)
                                            <p data-animation="fadeInUp2" data-delay=".6s">{{ $banner->offer_text }}</p>
                                        @endif
                                        @if($banner->price_sale)
                                            <div class="item_price" data-animation="fadeInUp2" data-delay=".6s">
                                                @if($banner->price_del)
                                                    <del>LKR {{ number_format($banner->price_del, 2) }}</del>
                                                @endif
                                                <span class="sale_price">LKR {{ number_format($banner->price_sale, 2) }}</span>
                                            </div>
                                        @endif
                                        <a class="btn btn_primary" href="{{ $banner->link ?? route('phone_lab.shop_grid') }}"
                                            data-animation="fadeInUp2" data-delay=".8s">Start Buying</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="slider_item">
                        <div class="container">
                            <div class="row align-items-center justify-content-lg-between">
                                <div class="order-last col col-lg-6 col-md-6 col-sm-6">
                                    <div class="slider_image" data-animation="fadeInRight" data-delay=".2s">
                                        <img src="{{ asset('assets/images/slider/slider_imaage_2.png') }}" alt="Ecommerce">
                                    </div>
                                </div>
                                <div class="col col-lg-5 col-md-6 col-sm-6">
                                    <div class="slider_content">
                                        <h3 class="small_title" data-animation="fadeInUp2" data-delay=".2s">Tech Products
                                        </h3>
                                        <h4 class="big_title" data-animation="fadeInUp2" data-delay=".4s">UP TO 30% OFF I
                                            Phone</h4>
                                        <p data-animation="fadeInUp2" data-delay=".6s">The Best Gadgets Collection 2026</p>
                                        <div class="item_price" data-animation="fadeInUp2" data-delay=".6s">
                                            <del>LKR 10520.00</del>
                                            <span class="sale_price">LKR 10460.00</span>
                                        </div>
                                        <a class="btn btn_primary" href="{{ route('phone_lab.shop_grid') }}"
                                            data-animation="fadeInUp2" data-delay=".8s">Start Buying</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="slider_item">
                        <div class="container">
                            <div class="row align-items-center justify-content-lg-between">
                                <div class="order-last col col-lg-6 col-md-6 col-sm-6">
                                    <div class="slider_image" data-animation="fadeInRight" data-delay=".2s">
                                        <img src="{{ asset('assets/images/slider/slider_image_1.webp') }}" alt="Ecommerce">
                                    </div>
                                </div>
                                <div class="col col-lg-5 col-md-6 col-sm-6">
                                    <div class="slider_content">
                                        <h3 class="small_title" data-animation="fadeInUp2" data-delay=".2s">Tech Products
                                        </h3>
                                        <h4 class="big_title" data-animation="fadeInUp2" data-delay=".4s">UP TO 30% OFF
                                            Speakers</h4>
                                        <p data-animation="fadeInUp2" data-delay=".6s">The Best Gadgets Collection 2026</p>
                                        <div class="item_price" data-animation="fadeInUp2" data-delay=".6s">
                                            <del>LKR 10520.00</del>
                                            <span class="sale_price">LKR 10460.00</span>
                                        </div>
                                        <a class="btn btn_primary" href="{{ route('phone_lab.shop_grid') }}"
                                            data-animation="fadeInUp2" data-delay=".8s">Start Buying</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="slider_item">
                        <div class="container">
                            <div class="row align-items-center justify-content-lg-between">
                                <div class="order-last col col-lg-6 col-md-6 col-sm-6">
                                    <div class="slider_image" data-animation="fadeInRight" data-delay=".2s">
                                        <img src="{{ asset('assets/images/slider/slider_image_3.png') }}" alt="Ecommerce">
                                    </div>
                                </div>
                                <div class="col col-lg-5 col-md-6 col-sm-6">
                                    <div class="slider_content">
                                        <h3 class="small_title" data-animation="fadeInUp2" data-delay=".2s">Tech Products
                                        </h3>
                                        <h4 class="big_title" data-animation="fadeInUp2" data-delay=".4s">UP TO 30% OFF
                                            Computer Repair</h4>
                                        <p data-animation="fadeInUp2" data-delay=".6s">The Best Gadgets Collection 2026</p>
                                        <div class="item_price" data-animation="fadeInUp2" data-delay=".6s">
                                            <del>LKR 10520.00</del>
                                            <span class="sale_price">LKR 10460.00</span>
                                        </div>
                                        <a class="btn btn_primary" href="{{ route('phone_lab.shop_grid') }}"
                                            data-animation="fadeInUp2" data-delay=".8s">Start Buying</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </section>
        <!-- slider_section - end
                                                                    ================================================== -->

        <!-- policy_section - start
                                                                    ================================================== -->
        <section class="policy_section">
            <div class="policy_item">
                <div class="item_icon">
                    <i class="icon icon-Truck"></i>
                </div>
                <div class="item_content">
                    <h3 class="item_title">Free Shipping</h3>
                    <p>
                        Free shipping on all US order
                    </p>
                </div>
            </div>

            <div class="policy_item">
                <div class="item_icon">
                    <i class="icon icon-Headset"></i>
                </div>
                <div class="item_content">
                    <h3 class="item_title">Support 24/7</h3>
                    <p>
                        Contact us 24 hours a day
                    </p>
                </div>
            </div>

            <div class="policy_item">
                <div class="item_icon">
                    <i class="icon icon-Wallet"></i>
                </div>
                <div class="item_content">
                    <h3 class="item_title">100% Money Back</h3>
                    <p>
                        You have 30 days to Return
                    </p>
                </div>
            </div>

            <div class="policy_item">
                <div class="item_icon">
                    <i class="fa-light fa-rocket"></i>
                </div>
                <div class="item_content">
                    <h3 class="item_title">30 Days Return</h3>
                    <p>
                        If goods have problems
                    </p>
                </div>
            </div>

            <div class="policy_item">
                <div class="item_icon">
                    <i class="icon icon-Dollars"></i>
                </div>
                <div class="item_content">
                    <h3 class="item_title">Payment Secure</h3>
                    <p>
                        We ensure secure payment
                    </p>
                </div>
            </div>
        </section>
        <!-- policy_section - end
                                                                    ================================================== -->

        <!-- category_section - start
                                                                    ================================================== -->
        <section class="category_section section_space">
            <div class="container">
                <div class="section_title mb-0">
                    <h2 class="title_text"><i class="fa-duotone fa-fire"></i> Top Categories</h2>
                </div>
                <div class="top_category_wrap arrows_topright">
                    <div class="top_category_carousel" data-slick='{"dots": false}'>

                        @forelse($globalCategories as $gCategory)
                           <div class="slider_item p-2">
    <div class="category_boxed border-0 rounded-3 overflow-hidden shadow-sm bg-white position-relative"
         style="transition: transform .22s ease, box-shadow .22s ease; cursor: pointer;"
         onmouseenter="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 12px 28px rgba(220,38,38,.18)'"
         onmouseleave="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 6px rgba(0,0,0,.08)'">

        {{-- Red top accent stripe --}}
        <div style="height:4px; background: linear-gradient(90deg, #DC2626, #991B1B);"></div>

        <a href="{{ route('phone_lab.shop_grid', ['category' => $gCategory->id]) }}"
           class="text-decoration-none d-flex flex-column align-items-center bg-white">

            {{-- Image area --}}
            <span class="item_image d-flex align-items-center justify-content-center w-100"
                  style="height:110px; background:#ffffff; padding:1rem;">
                @if ($gCategory->image && file_exists(public_path($gCategory->image)))
                    <img src="{{ asset($gCategory->image) }}"
                         alt="{{ $gCategory->name }}"
                         style="max-height:80px; max-width:100%; object-fit:contain;
                                transition: transform .3s ease;"
                         onmouseenter="this.style.transform='scale(1.1)'"
                         onmouseleave="this.style.transform='scale(1)'">
                @elseif($gCategory->image && file_exists(public_path('storage/' . $gCategory->image)))
                    <img src="{{ asset('storage/' . $gCategory->image) }}"
                         alt="{{ $gCategory->name }}"
                         style="max-height:80px; max-width:100%; object-fit:contain;
                                transition: transform .3s ease;"
                         onmouseenter="this.style.transform='scale(1.1)'"
                         onmouseleave="this.style.transform='scale(1)'">
                @else
                    <img src="{{ asset('assets/images/placeholder/category-placeholder.png') }}"
                         alt="No Image Available"
                         style="max-height:80px; max-width:100%; object-fit:contain; opacity:.5;">
                @endif
            </span>

            {{-- Category title --}}
            <span class="item_title d-block w-100 text-center fw-semibold px-2 py-2"
                  style="font-size:.82rem; color:#1A1A1A; border-top:1px solid #F1F1F1;
                         letter-spacing:.01em; transition: color .2s ease;">
                {{ $gCategory->name }}
            </span>
        </a>
    </div>
</div>
                        @empty
                            <div class="slider_item">
                                <div class="category_boxed bg-white">
                                    <a href="javascript:void(0);">
                                        <span class="item_title">No Categories Found</span>
                                    </a>
                                </div>
                            </div>
                        @endforelse

                    </div>

                    {{-- Carousel Navigation (වෙළඳපොළ තේමාවේ ඊතල යුගල) --}}
                    <div class="carousel_nav">
                        <button type="button" class="tc_left_arrow"><i class="fa-regular fa-angle-left"></i></button>
                        <button type="button" class="tc_right_arrow"><i class="fa-regular fa-angle-right"></i></button>
                    </div>
                </div>

            </div>
        </section>
        <!-- category_section - end
                                                                    ================================================== -->

        <!-- promotion_section - start
                                                                    ================================================== -->
       <section class="promotion_section section_space">
        <div class="container">
            <div class="section_title mb-0">
                <h2 class="title_text"><i class="fa-duotone fa-fire"></i> Hot Deals</h2>
            </div>
             <div class="product_carousel_wrap arrows_topright">
                <div class="product_carousel_wrap arrows_topright">
                    <div class="hot_deal_carousel m-2">
                        @foreach ($hotDeals as $product)
                            @include('phone_lab.partials.single-product-card', [
                                        'product' => $product,
                                        'badge' => 'HOT',
                                    ])
                                @endforeach
                            </div>
                            <div class="carousel_nav">
                                <button type="button" class="hdc_left_arrow"><i
                                        class="fa-regular fa-angle-left"></i></button>
                                <button type="button" class="hdc_right_arrow"><i
                                        class="fa-regular fa-angle-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
       </section>
        <!-- promotion_section - end
                                                                    ================================================== -->

        <!-- new_arrivals_section - start
                                                                    ================================================== -->
        <section class="new_arrivals_section section_space">
            <div class="container">
                <div class="section_title mb-0">
                    <h2 class="title_text"><i class="fa-duotone fa-sparkles"></i> New Arrivals</h2>
                </div>
                <div class="row newarrivals_products">
                    {{-- Static Banner --}}
                    <div class="col col-lg-5">
                        <div class="deals_product_layout1 m-2">
                            @php
                                $bannerBadge = \App\Models\Setting::get('new_arrival_banner_badge', 'Limited Offer');
                                $bannerTitle = \App\Models\Setting::get('new_arrival_banner_title', 'Best Product Deals');
                                $bannerDesc = \App\Models\Setting::get('new_arrival_banner_desc', 'Get a 20% Cashback when buying TWS Product from our Audio Technology.');
                                $bannerLink = \App\Models\Setting::get('new_arrival_banner_link', '/shop');
                                $bannerImage = \App\Models\Setting::get('new_arrival_banner_image');
                            @endphp
                            <div
                                style="max-width: 420px; margin: 0 auto; border-radius: var(--border-radius-lg); overflow: hidden; border: 0.5px solid var(--color-border-tertiary); background: var(--color-background-primary); display: flex; flex-direction: column;">

                                <div style="padding: 1.5rem 1.5rem 0; text-align: center;">
                                    @if ($bannerBadge)
                                        <span
                                            style="display: inline-block; background: #FCEBEB; color: #f31c1c; font-size: 11px; font-weight: 500; padding: 4px 12px; border-radius: 20px; letter-spacing: 0.04em; text-transform: uppercase; margin-bottom: 12px;">{{ $bannerBadge }}</span>
                                    @endif

                                    <h3
                                        style="font-size: 20px; font-weight: 500; color: var(--color-text-primary); margin: 0 0 8px;">
                                        {{ $bannerTitle }}</h3>

                                    <p
                                        style="font-size: 14px; color: var(--color-text-secondary); margin: 0 0 8px; line-height: 1.6;">
                                        {!! $bannerDesc !!}
                                    </p>

                                    <a href="{{ $bannerLink }}"
                                        style="display: inline-flex; align-items: center; gap: 6px; margin: 12px 0 1.25rem; padding: 9px 22px; border-radius: var(--border-radius-md); border: 1.5px solid #f34e18; color: #f34e18; font-size: 14px; font-weight: 500; text-decoration: none; transition: background 0.15s;">
                                        Shop Now <i class="ti ti-arrow-right" style="font-size:15px;"
                                            aria-hidden="true"></i>
                                    </a>
                                </div>

                                <div
                                    style="background: #ffffff; display: flex; justify-content: center; align-items: flex-end; min-height: 220px; padding: 1rem 1rem 0;">
                                    <img src="{{ $bannerImage ? asset($bannerImage) : asset('assets/images/author/image.png') }}" alt="{{ $bannerTitle }}"
                                        style="max-width: 100%; max-height: 220px; object-fit: contain; display: block;" />
                                </div>

                            </div>

                        </div>
                    </div>

                    {{-- දකුණු පැත්තේ ඇති Dynamic Products Carousel එක --}}
                 <div class="col-12 col-lg-7">
    <div class="new_arrivals_carousel arrows_topright">

        <div class="common_carousel_2" data-slick='{
            "dots": false,
            "rows": 1,
            "responsive": [
                { "breakpoint": 992, "settings": { "slidesToShow": 2 } },
                { "breakpoint": 768, "settings": { "slidesToShow": 1 } }
            ]
        }'>

            @forelse($newArrivals as $product)
                <div class="slider_item px-2 m-2">
                    <div class="card border-0 shadow-sm rounded-3 h-100 d-flex flex-column overflow-hidden">

                        {{-- IMAGE --}}
                        <div class="d-flex align-items-center justify-content-center bg-light p-2 p-md-3 bg-white"
                             style="height: 200px;">
                            <img src="{{ asset($product->featured_image) }}"
                                 class="img-fluid"
                                 style="max-height: 160px; object-fit: contain;"
                                 alt="{{ $product->name }}">
                        </div>

                        {{-- BODY --}}
                        <div class="card-body d-flex flex-column flex-grow-1 p-2 p-md-3">

                            {{-- TITLE --}}
                            <h6 class="fw-semibold mb-2"
                                style="
                                    font-size: 14px;
                                    height: 38px;
                                    overflow: hidden;
                                    display: -webkit-box;
                                    -webkit-line-clamp: 2;
                                    -webkit-box-orient: vertical;
                                ">
                                <a href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}"
                                   class="text-dark text-decoration-none">
                                    {{ $product->name }}
                                </a>
                            </h6>

                            {{-- RATING --}}
                            @php
    $rating = round($product->reviews_avg_rating ?? 0);
@endphp

<div class="text-warning small mb-2">
    @for ($i = 1; $i <= 5; $i++)
        @if ($i <= $rating)
            <i class="fa-solid fa-star"></i>
        @else
            <i class="fa-regular fa-star"></i>
        @endif
    @endfor

    <span class="text-muted ms-1">
        ({{ number_format($product->reviews_avg_rating ?? 0, 1) }})
    </span>
</div>

                            {{-- PRICE --}}
                            <div class="fw-bold mb-2" style="font-size: 14px;">
                                @if ($product->has_variants && $product->variants->count() > 0)
                                    LKR {{ number_format($product->variants->min('price'), 2) }}
                                @else
                                    LKR {{ number_format($product->base_price, 2) }}
                                @endif
                            </div>

                            {{-- BUTTON --}}
                            <div class="mt-auto">
                                <a href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}"
                                   class="btn btn-danger w-100 fw-semibold rounded-pill py-1"
                                   style="font-size: 13px;">
                                    Add To Cart
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            @empty
                <div class="slider_item">
                    <div class="text-center py-5 text-muted">
                        No new arrivals available at the moment.
                    </div>
                </div>
            @endforelse

        </div>

        {{-- NAV --}}
       <div class="d-flex justify-content-end gap-2 mt-3">
    <button class="btn btn-sm cc2_left_arrow"
        style="background-color: #EBEBEB; border: none; hover:bg-gray-300; ">
        <i class="fa fa-angle-left text-dark"></i>
    </button>

    <button class="btn btn-sm cc2_right_arrow"
        style="background-color: #EBEBEB; border: none; hover:bg-gray-300;">
        <i class="fa fa-angle-right text-dark"></i>
    </button>
</div>

    </div>
</div>
                    </div>
                </div>
            </div>
        </section>
        <!-- new_arrivals_section - end
                                                                    ================================================== -->

        <!-- product_section - start
                                                                    ================================================== -->
        <section class="product_section">
            <div class="container">
                {{-- Navigation Tabs --}}
                <ul class="tabs_nav nav" role="tablist">
                    <li role="presentation">
                        <button class="active" data-bs-toggle="tab" data-bs-target="#bestseller_tab" type="button"
                            role="tab" aria-selected="true">Best Seller</button>
                    </li>
                    <li role="presentation">
                        <button data-bs-toggle="tab" data-bs-target="#ourproduct_tab" type="button" role="tab"
                            aria-selected="false">Our Product</button>
                    </li>
                    <li role="presentation">
                        <button data-bs-toggle="tab" data-bs-target="#newproduct_tab" type="button" role="tab"
                            aria-selected="false">New Product</button>
                    </li>
                   
                </ul>

                <div class="tab-content tad_has_carousel">

                    {{-- 1. BEST SELLER TAB --}}
                    <div class="tab-pane fade show active" id="bestseller_tab" role="tabpanel">
    <div class="product_carousel_wrap arrows_topright">
        <div class="best_seller_carousel m-2" data-slick='{"dots": false, "rows": 1}'>
            @foreach ($bestSellers->sortByDesc('reviews_avg_rating') as $product)
                @include('phone_lab.partials.single-product-card', [
                    'product' => $product,
                    'badge' => 'SALE',
                ])
            @endforeach
        </div>

        <div class="carousel_nav">
            <button type="button" class="bsc_left_arrow">
                <i class="fa-regular fa-angle-left"></i>
            </button>

            <button type="button" class="bsc_right_arrow">
                <i class="fa-regular fa-angle-right"></i>
            </button>
        </div>
    </div>
</div>
                    {{-- 2. OUR PRODUCT TAB --}}
                    <div class="tab-pane fade" id="ourproduct_tab" role="tabpanel">
                        <div class="product_carousel_wrap arrows_topright">
                            <div class="common_carousel_3" data-slick='{"dots": false, "rows": 1}'>
                                @foreach ($ourProducts as $product)
                                    @include('phone_lab.partials.single-product-card', [
                                        'product' => $product,
                                        'badge' => null,
                                    ])
                                @endforeach
                            </div>
                            <div class="carousel_nav">
                                <button type="button" class="cc3_left_arrow"><i
                                        class="fa-regular fa-angle-left"></i></button>
                                <button type="button" class="cc3_right_arrow"><i
                                        class="fa-regular fa-angle-right"></i></button>
                            </div>
                        </div>
                    </div>

                    {{-- 3. NEW PRODUCT TAB --}}
                    <div class="tab-pane fade" id="newproduct_tab" role="tabpanel">
                        <div class="product_carousel_wrap arrows_topright">
                            <div class="new_product_carousel" data-slick='{"dots": false, "rows": 1}'>
                                @foreach ($newArrivals as $product)
                                    @include('phone_lab.partials.single-product-card', [
                                        'product' => $product,
                                        'badge' => 'NEW',
                                    ])
                                @endforeach
                            </div>
                            <div class="carousel_nav">
                                <button type="button" class="npc_left_arrow"><i
                                        class="fa-regular fa-angle-left"></i></button>
                                <button type="button" class="npc_right_arrow"><i
                                        class="fa-regular fa-angle-right"></i></button>
                            </div>
                        </div>
                    </div>

                  
                    

                </div>
            </div>
        </section>
        <!-- product_section - end
                                                                    ================================================== -->

        <!-- brand_section - start
                                                                    ================================================== -->
        <div class="brand_section section_space pb-0 bg-white">
            <div class="container bg-white">
                <div class="brand_carousel bg-white"
                    data-slick='{"dots": false, "arrows": false, "autoplay": true, "infinite": true}'>

                    @forelse($homeBrands as $brand)
                        <div class="slider_item ">
                            <a class="product_brand_logo"
                                href="{{ route('phone_lab.shop_grid', ['brand' => $brand->id]) }}">
                                @if ($brand->image && file_exists(public_path($brand->image)))
                                    <img src="{{ asset($brand->image) }}" alt="{{ $brand->name }}">
                                    <img src="{{ asset($brand->image) }}" alt="{{ $brand->name }}">
                                @else
                                    <img src="{{ asset('assets/images/placeholder/category-placeholder.png') }}"
                                        alt="{{ $brand->name }}">
                                    <img src="{{ asset('assets/images/placeholder/category-placeholder.png') }}"
                                        alt="{{ $brand->name }}">
                                @endif
                            </a>
                        </div>
                    @empty
                        <div class="slider_item">
                            <span class="text-muted text-tiny">No Brands Available</span>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
        <!-- brand_section - end
                                                                    ================================================== -->

        <!-- viewed_products_section - start
                                                                    ================================================== -->
        <section class="viewed_products_section section_space">
            <div class="container">
                <div class="section_title mb-0">
                    <h2 class="title_text"><i class="fa-duotone fa-eye"></i> Shop by Categories & Brands</h2>
                </div>

                <div class="viewed_products_wrap arrows_topright">
                    <div class="viewed_products_carousel row m-2" data-slick='{"dots": false, "rows": 1}'>

                        @forelse($carouselCategories->chunk(2) as $categoryChunk)
                            <div class="slider_item col">
                                @foreach ($categoryChunk as $carouselCat)
                                    <div class="d-flex align-items-start gap-3 bg-white border rounded-3 p-3 mb-3 shadow-sm"
                                        style="min-height: 110px; max-height: 110px; overflow: hidden;">

                                        {{-- Category Image --}}
                                        <div class="flex-shrink-0"
                                            style="width: 70px; height: 70px; overflow: hidden; border-radius: 8px; background: #f5f5f5;">
                                            @if ($carouselCat->image && file_exists(public_path($carouselCat->image)))
                                                <img src="{{ asset($carouselCat->image) }}"
                                                    alt="{{ $carouselCat->name }}" class="w-100 h-100"
                                                    style="object-fit: cover;">
                                            @else
                                                <img src="{{ asset('assets/images/placeholder/category-placeholder.png') }}"
                                                    alt="{{ $carouselCat->name }}" class="w-100 h-100"
                                                    style="object-fit: cover;">
                                            @endif
                                        </div>

                                        {{-- Category Name & Brands --}}
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h3 class="fs-6 fw-bold mb-1 text-truncate">
                                                <a href="{{ route('phone_lab.shop_grid', ['category' => $carouselCat->id]) }}"
                                                    class="text-dark text-decoration-none">
                                                    {{ $carouselCat->name }}
                                                </a>
                                            </h3>

                                            <ul class="list-unstyled mb-0 d-flex flex-wrap gap-1">
                                                @forelse($carouselCat->brands as $brand)
                                                    <li>
                                                        <a href="{{ route('phone_lab.shop_grid', ['category' => $carouselCat->id, 'brand' => $brand->id]) }}"
                                                            class="badge text-decoration-none fw-normal"
                                                            style="background: #f0f0f0; color: #444; font-size: 11px;">
                                                            {{ $brand->name }}
                                                        </a>
                                                    </li>
                                                @empty
                                                    <li>
                                                        <span class="text-muted" style="font-size: 11px;">No brands</span>
                                                    </li>
                                                @endforelse

                                                @if ($carouselCat->brands->count() > 0)
                                                    <li>
                                                        <a href="{{ route('phone_lab.shop_grid', ['category' => $carouselCat->id]) }}"
                                                            class="badge text-decoration-none fw-bold"
                                                            style="background: #e8f0fe; color: #1a56db; font-size: 11px;">
                                                            More...
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @empty
                                <div class="slider_item col text-center py-4">
                                    <p class="text-muted">No categories available.</p>
                                </div>
                            @endforelse

                        </div>

                        {{-- Carousel Nav Arrows --}}
                        <div class="carousel_nav">
                            <button type="button" class="vpc_left_arrow"><i class="fa-regular fa-angle-left"></i></button>
                            <button type="button" class="vpc_right_arrow"><i class="fa-regular fa-angle-right"></i></button>
                        </div>
                    </div>
                </div>
            </section>
            <!-- viewed_products_section - end-->







            {{-- Testimonials Section --}}




            <section class="section_space testimonials-section">
    <div class="container">

        {{-- Section Header --}}
        <div class="row mb-5">
            <div class="col-12 text-center">
                <span class="section-eyebrow">What People Say</span>
                <h2 class="section-title">Client Stories</h2>
                <p class="section-subtitle">Real experiences from people who trust us</p>
            </div>
        </div>

        {{-- Testimonial Cards --}}
        <div class="row g-4">

            @foreach ($testimonials as $testimonial)
                <div class="col-12 col-md-6 col-lg-4 d-flex">
                    <div class="testimonial-card h-100 w-100">

                        {{-- Quote Icon --}}
                        <div class="quote-icon">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                                <path
                                    d="M10 8C6.686 8 4 10.686 4 14v10h10V14H7c0-1.654 1.346-3 3-3V8zm18 0c-3.314 0-6 2.686-6 6v10h10V14h-7c0-1.654 1.346-3 3-3V8z"
                                    fill="currentColor" />
                            </svg>
                        </div>

                        {{-- Description --}}
                        <p class="testimonial-text">
                            {{ $testimonial->description }}
                        </p>

                        {{-- Author --}}
                       
                        <div class="testimonial-author">
                           <div class="author-avatar">
    @if(!empty($testimonial->image))
       <div class="avatar-placeholder">
            {{ strtoupper(substr($testimonial->name ?? 'NA', 0, 2)) }}
        </div>
        
    @else
        <div class="avatar-placeholder">
            {{ strtoupper(substr($testimonial->name ?? 'NA', 0, 2)) }}
        </div>
    @endif
</div>

                            <div class="author-info">
                                <strong class="author-name">{{ $testimonial->name }}</strong>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach

        </div>

        {{-- Pagination --}}
       <div class="d-flex justify-content-center mt-5 pagination-wrapper">
    {{ $testimonials->links('pagination::bootstrap-5') }}
</div>

    </div>
</section>
          

            <style>


/* Pagination wrapper alignment */
.pagination-wrapper {
    width: 100%;
}

/* Pagination container */
.pagination {
    gap: 6px;
}

/* Page items */
.pagination .page-item .page-link {
    color: #dc2626; /* red text */
    background-color: #ffffff;
    border: 1px solid #f1f1f1;
    border-radius: 8px;
    padding: 8px 14px;
    transition: all 0.2s ease;
    font-weight: 500;
}

/* Hover effect */
.pagination .page-item .page-link:hover {
    background-color: #dc2626;
    color: #ffffff;
    border-color: #dc2626;
}

/* Active page */
.pagination .page-item.active .page-link {
    background-color: #dc2626;
    border-color: #dc2626;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25);
}

/* Disabled buttons */
.pagination .page-item.disabled .page-link {
    color: #bbb;
    background-color: #f9f9f9;
    border-color: #eee;
}










                /* ─── Testimonials Section ─────────────────────────────── */
                .testimonials-section {
                    background-color: #FAFAFA;
                    padding: 80px 0;
                }

                .section-eyebrow {
                    display: inline-block;
                    font-size: 0.78rem;
                    font-weight: 600;
                    letter-spacing: 0.14em;
                    text-transform: uppercase;
                    color: #f44429;
                    margin-bottom: 10px;
                }

                .section-title {
                    font-size: 2.1rem;
                    font-weight: 700;
                    color: #1A1F36;
                    margin-bottom: 12px;
                }

                .section-subtitle {
                    font-size: 1rem;
                    color: #6B7280;
                    max-width: 480px;
                    margin: 0 auto;
                }

                /* ─── Card ─────────────────────────────────────────────── */
                .testimonial-card {
                    background: #ffffff;
                    border-radius: 16px;
                    padding: 36px 30px 28px;
                    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
                    border: 1px solid rgba(0, 0, 0, 0.05);
                    display: flex;
                    flex-direction: column;
                    gap: 18px;
                    transition: transform 0.28s cubic-bezier(0.34, 1.56, 0.64, 1),
                        box-shadow 0.28s ease;
                    cursor: default;
                    position: relative;
                    overflow: hidden;
                }

                .testimonial-card:hover {
                    transform: translateY(-6px) scale(1.025);
                    box-shadow: 0 16px 40px rgba(79, 107, 237, 0.14);
                }

                .testimonial-card::before {
                    content: '';
                    position: absolute;
                    left: 0;
                    top: 0;
                    bottom: 0;
                    width: 4px;
                    background: linear-gradient(180deg, #fa7979 0%, #ff0505 100%);
                    border-radius: 16px 0 0 16px;
                    opacity: 0;
                    transition: opacity 0.25s ease;
                }

                .testimonial-card:hover::before {
                    opacity: 1;
                }

                /* ─── Quote Icon ────────────────────────────────────────── */
                .quote-icon {
                    color: #fa0b0b;
                    opacity: 0.45;
                    line-height: 1;
                }

                /* ─── Text ──────────────────────────────────────────────── */
                .testimonial-text {
                    font-size: 0.96rem;
                    line-height: 1.75;
                    color: #374151;
                    flex: 1;
                    margin: 0;

                     display: -webkit-box;
    -webkit-line-clamp: 4; 
    -webkit-box-orient: vertical;
    overflow: hidden;
                }

                /* ─── Author ────────────────────────────────────────────── */
                .testimonial-author {
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    padding-top: 18px;
                    border-top: 1px solid #F0F0F0;
                    margin-top: auto;
                }

                .author-avatar {
                    flex-shrink: 0;
                    width: 46px;
                    height: 46px;
                    border-radius: 50%;
                    overflow: hidden;
                }

                .avatar-img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }

                .avatar-placeholder {
                    width: 100%;
                    height: 100%;
                    background: linear-gradient(135deg, #fc554f, #ee2929);
                    color: #fff;
                    font-weight: 700;
                    font-size: 1.1rem;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border-radius: 50%;
                }

                .author-name {
                    font-size: 0.93rem;
                    font-weight: 600;
                    color: #1A1F36;
                    display: block;
                }
            </style>





    



        </main>
        <!-- main body - end-->

    @endsection
