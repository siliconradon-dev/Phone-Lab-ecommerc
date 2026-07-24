<div class="section-menu-left">
    <div class="box-logo">
        <a href="{{ route('admin.dashboard') }}" id="site-logo-inner">
            <img class="" id="logo_header" alt=""
                src="{{ asset($siteSettings['site_logo']?? false) }}"
                style="max-height: 65px;"
                data-light="{{ asset($siteSettings['site_logo']?? false) ?? asset('assets/images/logo/logo-placeholder.png') }}"
                data-dark="{{ asset($siteSettings['site_logo']?? false) ?? asset('assets/images/logo/logo-placeholder.png') }}">
        </a>
        <div class="button-show-hide">
            <i class="icon-menu-left"></i>
        </div>
    </div>
   



    <div class="section-menu-left-wrap">
    <div class="center">
        <div class="center-item">
            <ul class="menu-list">

                <!-- Dashboard -->
                <li class="menu-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <div class="icon"><i class="icon-grid"></i></div>
                        <div class="text">Dashboard</div>
                    </a>
                </li>

                <!-- POS -->
                <li class="menu-item">
                    <a href="{{ route('pos.index') }}" class="{{ request()->routeIs('pos.*') ? 'active' : '' }}">
                        <div class="icon"><i class="icon-shopping-bag"></i></div>
                        <div class="text">POS</div>
                    </a>
                </li>

                <!-- POS Orders -->
                <li class="menu-item">
                    <a href="{{ route('pos-orders.index') }}"
                        class="{{ request()->routeIs('pos-orders.*') ? 'active' : '' }}">
                        <div class="icon"><i class="icon-shopping-cart"></i></div>
                        <div class="text">POS Orders</div>
                    </a>
                </li>

                <!-- Web Orders -->
                <li class="menu-item">
                    <a href="{{ route('orders.index') }}"
                        class="{{ request()->routeIs('orders.*') ? 'active' : '' }}">
                        <div class="icon"><i class="icon-shopping-cart"></i></div>
                        <div class="text">Web Orders</div>
                    </a>
                </li>

                <!-- Products -->
                <li class="menu-item">
                    <a href="{{ route('products.index') }}"
                        class="{{ request()->routeIs('products.*') ? 'active' : '' }}">
                        <div class="icon"><i class="icon-layers"></i></div>
                        <div class="text">Products</div>
                    </a>
                </li>

                <!-- Inventory -->
                <li class="menu-item has-children {{ request()->routeIs('stocks.*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-item-button">
                        <div class="icon"><i class="icon-layers"></i></div>
                        <div class="text">Inventory</div>
                    </a>
                    <ul class="sub-menu">
                        <li class="sub-menu-item">
                            <a href="{{ route('stocks.index') }}"
                                class="{{ request()->routeIs('stocks.index') ? 'active' : '' }}">
                                <div class="text">Stock Ledger</div>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="{{ route('stocks.create') }}"
                                class="{{ request()->routeIs('stocks.create') ? 'active' : '' }}">
                                <div class="text">Add New Stock</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Customers -->
                <li class="menu-item">
                    <a href="{{ route('customers.index') }}"
                        class="{{ request()->routeIs('customers.*') ? 'active' : '' }}">
                        <div class="icon"><i class="icon-user"></i></div>
                        <div class="text">Customers</div>
                    </a>
                </li>

                <!-- Testimonials -->
                <li class="menu-item">
                    <a href="{{ route('testimonials.index') }}"
                        class="{{ request()->routeIs('testimonials.*') ? 'active' : '' }}">
                        <div class="icon"><i class="icon-message-square"></i></div>
                        <div class="text">Testimonials</div>
                    </a>
                </li>

                <!-- Web Service (NEW) -->
                <li class="menu-item has-children {{ request()->routeIs('banners.*') || request()->routeIs('admin.web-service.*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-item-button">
                        <div class="icon"><i class="icon-globe"></i></div>
                        <div class="text">Web Service</div>
                    </a>
                    <ul class="sub-menu" style="{{ request()->routeIs('banners.*') || request()->routeIs('admin.web-service.*') ? 'display: block;' : '' }}">

                        <li class="sub-menu-item">
                            <a href="{{ route('banners.index') }}"
                                class="{{ request()->routeIs('banners.*') ? 'active' : '' }}">
                                <div class="text">Banner</div>
                            </a>
                        </li>

                        <li class="sub-menu-item">
                            <a href="{{ route('admin.web-service.discount') }}"
                                class="{{ request()->routeIs('admin.web-service.discount') ? 'active' : '' }}">
                                <div class="text">Discount</div>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="{{ route('admin.web-service.new-arrivals') }}"
                                class="{{ request()->routeIs('admin.web-service.new-arrivals') ? 'active' : '' }}">
                                <div class="text">New Arrivals</div>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="{{ route('admin.web-service.hot-deals') }}"
                                class="{{ request()->routeIs('admin.web-service.hot-deals') ? 'active' : '' }}">
                                <div class="text">Hot Deals</div>
                            </a>
                        </li>

                    </ul>
                </li>

                <!-- Settings -->
                <li class="menu-item has-children {{ request()->routeIs('categories.*', 'brands.*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-item-button">
                        <div class="icon"><i class="icon-settings"></i></div>
                        <div class="text">Settings</div>
                    </a>
                    <ul class="sub-menu"
                        style="{{ request()->routeIs('categories.*', 'brands.*') ? 'display: block;' : '' }}">
                        <li class="sub-menu-item">
                            <a href="{{ route('categories.index') }}"
                                class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">
                                <div class="text">Categories</div>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="{{ route('brands.index') }}"
                                class="{{ request()->routeIs('brands.*') ? 'active' : '' }}">
                                <div class="text">Brands</div>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="{{ route('settings.edit') }}"
                                class="{{ request()->routeIs('settings.edit') ? 'active' : '' }}">
                                <div class="text">System Settings</div>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
</div>
