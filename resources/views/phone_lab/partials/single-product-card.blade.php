<div class=" product_layout1 h-100 d-flex flex-column"
     style="height:500px; display:flex; flex-direction:column; border:1px solid #eee; border-radius:8px; overflow:hidden; transition:.3s; background:#fff;"
     onmouseover="this.style.boxShadow='0 8px 20px rgba(0,0,0,.08)'"
     onmouseout="this.style.boxShadow='none'">

    {{-- Badge --}}
    @if ($product->is_hot_deal && $product->hot_deal_end_date && \Carbon\Carbon::parse($product->hot_deal_end_date)->isFuture())
        <div class="item_badge hot_badge" style="background: linear-gradient(135deg, #f43f5e, #e11d48); padding: 4px 8px; border-radius: 4px; z-index: 2;">
            <span style="font-size: 10px; font-weight: 700; text-transform: uppercase;">Limited Offer</span>
        </div>
    @elseif (isset($badge))
        <div class="item_badge {{ $badge == 'SALE' ? 'sale_badge' : ($badge == 'NEW' ? 'new_badge' : 'hot_badge') }}">
            <span>{{ $badge }}</span>
        </div>
    @elseif ($product->is_discount || ($product->has_variants && $product->variants->where('is_discount', true)->count() > 0))
        <div class="item_badge sale_badge">
            <span>SALE</span>
        </div>
    @endif

    {{-- Images --}}
    <div class="item_image bg-white"
         style="height:240px; flex-shrink:0; overflow:hidden; display:flex; justify-content:center; align-items:center;">
        <img src="{{ asset($product->featured_image) }}" alt="{{ $product->name }}"
             style="width:100%; height:100%; object-fit:contain;">

        @if ($product->images->first())
            <img src="{{ asset($product->images->first()->image_path) }}" alt="{{ $product->name }}"
                 style="width:100%; height:100%; object-fit:contain;">
        @else
            <img src="{{ asset($product->featured_image) }}" alt="{{ $product->name }}"
                 style="width:100%; height:100%; object-fit:contain;">
        @endif

        <a class="quickview_btn" href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}"
            role="button">View</a>
    </div>

    {{-- Content --}}
    <div class="item_content bg-white d-flex flex-column flex-grow-1 p-3"
         style="flex:1; min-height:0; overflow:hidden; display:flex; flex-direction:column; padding:1rem;">

        {{-- Countdown row: always rendered so height never shifts --}}
<div class="hot-deal-countdown badge rounded-pill bg-danger text-white mb-2 fw-bold d-flex align-items-center gap-1 shadow-sm"
     @if ($product->is_hot_deal && $product->hot_deal_end_date && \Carbon\Carbon::parse($product->hot_deal_end_date)->isFuture())
        style="height:28px; flex-shrink:0; margin-bottom:0.5rem; font-weight:700; display:flex; align-items:center; gap:5px; font-size:11px; padding:5px 10px; width:fit-content; overflow:hidden; background:linear-gradient(135deg,#dc3545,#f43f5e) !important;"
        data-countdown="{{ \Carbon\Carbon::parse($product->hot_deal_end_date)->toIso8601String() }}"
     @else
        style="height:28px; flex-shrink:0; margin-bottom:0.5rem; visibility:hidden; overflow:hidden;"
     @endif
>
    <i class="fa-regular fa-clock" style="color:#fff; font-size:11px;"></i>
    <span class="countdown-timer" style="color:#fff; letter-spacing:.3px;">Loading...</span>
</div>


        <h3 class="item_title" style="height:48px; flex-shrink:0; overflow:hidden; line-height:24px;">
            <a href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}"
               style="display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">{{ $product->name }}</a>
        </h3>

        @php
            $rating = $product->reviews_avg_rating ?? 0;
        @endphp

        <ul class="rating_star ul_li align-items-center"
            style="height:24px; flex-shrink:0; overflow:hidden; display:flex; align-items:center; list-style:none; padding:0; margin:0;">
            @for ($i = 1; $i <= 5; $i++)
                <li style="display:inline-block;">
                    @if ($rating >= $i)
                        <i class="fa-solid fa-star" style="color:#ffc107;"></i>
                    @elseif ($rating >= ($i - 0.5))
                        <i class="fa-solid fa-star-half-stroke" style="color:#ffc107;"></i>
                    @else
                        <i class="fa-regular fa-star" style="color:#ffc107;"></i>
                    @endif
                </li>
            @endfor

            <li class="ms-2" style="margin-left:0.5rem; color:#6c757d; font-size:12px;">
                {{ number_format($rating, 1) }}
                ({{ $product->reviews_count ?? 0 }} reviews)
            </li>
        </ul>

        {{-- Price --}}
        <div class="item_price"
             style="height:42px; flex-shrink:0; display:flex; align-items:center; gap:6px; font-weight:600; overflow:hidden;">
            @if ($product->is_hot_deal && $product->hot_deal_end_date && \Carbon\Carbon::parse($product->hot_deal_end_date)->isFuture() && $product->hot_deal_discount_price > 0)
                <span style="color:#dc3545;">LKR {{ number_format($product->hot_deal_discount_price, 2) }}</span>
                <del class="ms-2" style="color:#6c757d; margin-left:0.5rem; font-size:13px;">LKR {{ number_format($product->base_price, 2) }}</del>
            @elseif ($product->has_variants && $product->variants->count() > 0)
                @php
                    $hasAnyVariantDiscount = $product->variants->where('is_discount', true)->count() > 0;
                    $minOriginalPrice = $product->variants->min('price');
                    $minActivePrice = $product->min_variant_price;
                @endphp
                @if ($hasAnyVariantDiscount && $minActivePrice < $minOriginalPrice)
                    <span style="color:#dc3545;">LKR {{ number_format($minActivePrice, 2) }}</span>
                    <del class="ms-2" style="color:#6c757d; margin-left:0.5rem; font-size:13px;">LKR {{ number_format($minOriginalPrice, 2) }}</del>
                @else
                    <span>LKR {{ number_format($minActivePrice, 2) }}</span>
                @endif
            @elseif ($product->is_discount && $product->discount_price > 0)
                <span style="color:#dc3545;">LKR {{ number_format($product->discount_price, 2) }}</span>
                <del class="ms-2" style="color:#6c757d; margin-left:0.5rem; font-size:13px;">LKR {{ number_format($product->base_price, 2) }}</del>
            @else
                <span>LKR {{ number_format($product->base_price, 2) }}</span>
            @endif
        </div>

        <ul class="item_btns_group ul_li w-100" style="margin-top:auto; flex-shrink:0; list-style:none; padding:0; margin-left:0; margin-right:0; margin-bottom:0;">
            <li class="w-100" style="width:100%;">
                <a class="add_to_cart_btn d-block text-center"
                    href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}"
                    style="display:block; text-align:center; width:100%; padding:10px;">Add To Cart</a>
            </li>
        </ul>
    </div>
</div>