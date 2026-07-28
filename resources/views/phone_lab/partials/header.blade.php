<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<header class="header_section">
    <div class="header_top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col col-md-6">
                    <ul class="header_select_options ul_li">
                        <li>
                            <div class="select_option">
                            </div>
                        </li>
                        <li>
                            <div class="select_option">
                                <h3 class="title_text">
                                    Hi, {{ auth('public_user')->user() ? auth('public_user')->user()->name : 'Guest' }}
                                </h3>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col col-md-6">
                    <p class="header_hotline">Hotline: <strong>
                            @if ($siteSettings['site_phone'] ?? false)
                                {{ $siteSettings['site_phone'] }}
                            @else
                                +94 7X XXX XXXX
                            @endif
                        </strong></p>
                </div>
            </div>
        </div>
    </div>

    <div class="header_middle">
        <div class="container">
            <div class="row align-items-center">
                <div class="col col-lg-3 col-5">
                    <div class="brand_logo">
                        <a class="brand_link" href="{{ route('phone_lab.index') }}">
                            @if ($siteSettings['site_logo'] ?? false)
                                <img src="{{ asset($siteSettings['site_logo']) }}"
                                    alt="{{ $siteSettings['site_name'] ?? 'Site Name' }} Logo"
                                    style="max-height: 65px;">
                            @else
                                <img src="{{ asset('assets/images/logo/logo-placeholder.png') }}" alt="logo">
                            @endif
                        </a>
                    </div>
                </div>
                <div class="col col-lg-6 col-2">
                    <nav class="main_menu navbar navbar-expand-lg">
                        <div class="main_menu_inner collapse navbar-collapse justify-content-center"
                            id="main_menu_dropdown">
                            <ul class="main_menu_list ul_li">
                                <li class="">
                                    <a class="nav-link {{ request()->routeIs('phone_lab.index') ? 'active' : '' }}"
                                        href="{{ route('phone_lab.index') }}" id="home_submenu">Home</a>
                                </li>
                                <li class="">
                                    <a class="nav-link {{ request()->routeIs('phone_lab.shop_grid') ? 'active' : '' }}"
                                        href="{{ route('phone_lab.shop_grid') }}" id="shop_submenu">Shop</a>
                                </li>
                                <li class="">
                                    <a class="nav-link {{ request()->routeIs('phone_lab.about') ? 'active' : '' }}"
                                        href="{{ route('phone_lab.about') }}" id="pages_submenu">About
                                        Us</a>
                                </li>
                                <li class=""><a
                                        class="nav-link {{ request()->routeIs('phone_lab.contact') ? 'active' : '' }}"
                                        href="{{ route('phone_lab.contact') }}">Contact</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col col-md-3 col-6">
                    <button type="button" class="cart_btn" onclick="window.location.href='{{ route('cart.index') }}'">
                        <span class="cart_icon">
                            <i class="icon icon-ShoppingCart"></i>
                            <small class="cart_counter">{{ $globalCartCount ?? 0 }}</small>
                        </span>
                        <span class="cart_amount">LKR {{ number_format($globalCartTotal ?? 0, 2) }}</span>
                    </button>

                    <ul class="header_icons_group ul_li_right">
                        <li>
                            <button class="mobile_menu_btn navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#main_menu_dropdown" aria-controls="main_menu_dropdown"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fal fa-bars"></i>
                            </button>
                        </li>

                        <li><a href="{{ route('user.dashboard') }}"><i class="fa-regular fa-user"></i></a></li>
                    </ul>
                </div>
                <div class="col col-lg-3 col-5">

                </div>
            </div>
        </div>
    </div>

   



    <script>
        $(document).ready(function() {

            $('#searchInput').on('keyup', function() {
                let query = $(this).val();

                if (query.length < 2) {
                    $('#suggestions').hide();
                    return;
                }

                $.ajax({
                    url: "{{ route('products.search') }}",
                    type: "GET",
                    data: {
                        query: query
                    },
                    success: function(data) {

                        let html = '';

                        if (data.length > 0) {
                            data.forEach(product => {
                                html += `
                            <a href="/shop/${product.id}"
                               class="list-group-item list-group-item-action">
                                ${product.name}
                            </a>
                        `;
                            });
                        } else {
                            html = `<div class="list-group-item">No results</div>`;
                        }

                        $('#suggestions').html(html).show();
                    }
                });
            });

            // hide when click outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('#searchInput').length) {
                    $('#suggestions').hide();
                }
            });

        });
    </script>
</header>
