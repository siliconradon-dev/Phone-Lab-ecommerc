@extends('phone_lab.layouts.app')

@section('title', 'Shopping Cart - Getyootech - Gadgets Ecommerce Site Template')

@section('content')
    <main>

        <div class="breadcrumb_section">
            <div class="container">
                <ul class="breadcrumb_nav ul_li">
                    <li><a href="{{ route('phone_lab.index') }}">Home</a></li>
                    <li>Cart</li>
                </ul>
            </div>
        </div>

        <section class="cart_section pt-5">
            <div class="container">
                @forelse($cartItems as $item)
                    @if ($loop->first)
                        <div class="cart_table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>PRODUCT</th>
                                        <th class="text-center">PRICE</th>
                                        <th class="text-center">QUANTITY</th>
                                        <th class="text-center">TOTAL</th>
                                        <th class="text-center">REMOVE</th>
                                    </tr>
                                </thead>
                                <tbody>
                    @endif

                    @php
                        $price = $item->variant ? $item->variant->active_price : $item->product->active_price;
                        $lineTotal = $price * $item->quantity;
                        $subtotal = ($subtotal ?? 0) + $lineTotal;
                    @endphp
                    <tr>
                        <td>
                            <div class="cart_product">
                                 <a href="{{ route('product.details', [$item->product->id, $item->product->slug]) }}">
                                <img src="{{ asset($item->product->featured_image) }}" alt="{{ $item->product->name }}">
                                    </a>
                                <h3><a href="{{ route('product.details', [$item->product->id, $item->product->slug]) }}">{{ $item->product->name }}</a>
                                    @if ($item->variant)
                                        <br><small>{{ $item->variant->storage }} / {{ $item->variant->color }}</small>
                                    @endif
                                </h3>
                            </div>
                        </td>
                        <td class="text-center">Rs. {{ number_format($price, 2) }}</td>
                        <td class="text-center">
                            <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                @csrf
                                <div class="quantity_input">
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                        onchange="this.form.submit()" style="width: 60px; text-align: center;">
                                </div>
                            </form>
                        </td>
                        <td class="text-center">Rs. {{ number_format($lineTotal, 2) }}</td>
                        <td class="text-center">
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="remove_btn"><i class="fal fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>

                    @if ($loop->last)
                        </tbody>
                        </table>
            </div>

            <div class="cart_btns_wrap">
                <div class="row">
                    <div class="col-12">
                        <ul class="btns_group ul_li_right">
                            <li><a class="btn btn_dark" href="{{ route('phone_lab.checkout') }}">Proceed To Checkout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @endif
            @empty
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="fal fa-shopping-cart" style="font-size: 80px; color: #ccc;"></i>
                </div>
                <h2 class="mb-3">Your Cart is Empty</h2>
                <p class="text-muted mb-4">Looks like you haven't added any products to your cart yet.</p>
                <a href="{{ route('phone_lab.shop_grid') }}" class="btn btn_primary">Return to Shop</a>
            </div>
            @endforelse
            </div>
        </section>

        

    </main>
@endsection
