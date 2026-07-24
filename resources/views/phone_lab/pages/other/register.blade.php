@extends('phone_lab.layouts.app')

@section('title', 'Register - Getyootech - Gadgets Ecommerce Site Template')

@section('content')
    <main>

        <!-- sidebar cart - start
            ================================================== -->
        <div class="sidebar-menu-wrapper">
            <div class="cart_sidebar">
                <button type="button" class="close_btn"><i class="fal fa-times"></i></button>

                <ul class="cart_items_list ul_li_block mb_30 clearfix">
                    <li>
                        <div class="item_image">
                            <img src="{{ asset('assets/images/cart/cart_img_1.webp') }}"
                                alt="Getyootech - Gadgets Ecommerce Site Template">
                        </div>
                        <div class="item_content">
                            <h4 class="item_title">Yellow Blouse</h4>
                            <span class="item_price">$30.00</span>
                        </div>
                        <button type="button" class="remove_btn"><i class="fal fa-trash-alt"></i></button>
                    </li>
                    <li>
                        <div class="item_image">
                            <img src="{{ asset('assets/images/cart/cart_img_2.webp') }}"
                                alt="Getyootech - Gadgets Ecommerce Site Template">
                        </div>
                        <div class="item_content">
                            <h4 class="item_title">Yellow Blouse</h4>
                            <span class="item_price">$30.00</span>
                        </div>
                        <button type="button" class="remove_btn"><i class="fal fa-trash-alt"></i></button>
                    </li>
                    <li>
                        <div class="item_image">
                            <img src="{{ asset('assets/images/cart/cart_img_3.webp') }}"
                                alt="Getyootech - Gadgets Ecommerce Site Template">
                        </div>
                        <div class="item_content">
                            <h4 class="item_title">Yellow Blouse</h4>
                            <span class="item_price">$30.00</span>
                        </div>
                        <button type="button" class="remove_btn"><i class="fal fa-trash-alt"></i></button>
                    </li>
                </ul>

                <ul class="total_price ul_li_block mb_30 clearfix">
                    <li>
                        <span>Subtotal:</span>
                        <span>$90</span>
                    </li>
                    <li>
                        <span>Vat 5%:</span>
                        <span>$4.5</span>
                    </li>
                    <li>
                        <span>Discount 20%:</span>
                        <span>- $18.9</span>
                    </li>
                    <li>
                        <span>Total:</span>
                        <span>$75.6</span>
                    </li>
                </ul>

                <ul class="btns_group ul_li_block clearfix">
                    <li><a class="btn btn_primary" href="{{ route('phone_lab.cart') }}">View Cart</a></li>
                    <li><a class="btn btn_secondary" href="{{ route('phone_lab.checkout') }}">Checkout</a></li>
                </ul>
            </div>

            <div class="cart_overlay"></div>
        </div>
        <!-- sidebar cart - end
            ================================================== -->

        <!-- breadcrumb_section - start
            ================================================== -->
        <div class="breadcrumb_section">
            <div class="container">
                <ul class="breadcrumb_nav ul_li">
                    <li><a href="{{ route('phone_lab.index') }}">Home</a></li>
                    <li>Register</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb_section - end
            ================================================== -->

        <!-- register_section - start
            ================================================== -->
        <section class="register_section section_space">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <ul class="nav register_tabnav ul_li_center" role="tablist">
                            <li role="presentation">
                                <button class="active" data-bs-toggle="tab" data-bs-target="#signin_tab" type="button"
                                    role="tab" aria-controls="signin_tab" aria-selected="true">
                                    Sign In
                                </button>
                            </li>
                            <li role="presentation">
                                <button data-bs-toggle="tab" data-bs-target="#signup_tab" type="button" role="tab"
                                    aria-controls="signup_tab" aria-selected="false">
                                    Register
                                </button>
                            </li>
                        </ul>
                        <div class="register_wrap tab-content">
                            <div class="tab-pane fade show active" id="signin_tab" role="tabpanel">
                                <form action="#">
                                    <div class="form_item_wrap">
                                        <h3 class="input_title">User Name/Email*</h3>
                                        <div class="form_item">
                                            <label for="username_input"><i class="fas fa-user"></i></label>
                                            <input id="username_input" type="text" name="username"
                                                placeholder="User Name">
                                            <span>Ex:black-level help text here.</span>
                                        </div>
                                    </div>

                                    <div class="form_item_wrap">
                                        <h3 class="input_title">Password*</h3>
                                        <div class="form_item">
                                            <label for="password_input"><i class="fas fa-lock"></i></label>
                                            <input id="password_input" type="password" name="password"
                                                placeholder="Password">
                                        </div>
                                    </div>

                                    <div class="forget_pass_wrap align-items-center justify-content-between">
                                        <div class="checkbox_item m-0">
                                            <input id="remember_checkbox" type="checkbox">
                                            <label for="remember_checkbox">Remember Me</label>
                                        </div>
                                        <div class="forget_pass">
                                            <a href="#!">Forget Password?</a>
                                        </div>
                                    </div>

                                    <div class="text-start">
                                        <button type="submit" class="btn btn_secondary">Sign In Now</button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="signup_tab" role="tabpanel">
                                <form action="#">
                                    <div class="form_item_wrap">
                                        <h3 class="input_title">User Name*</h3>
                                        <div class="form_item">
                                            <label for="username_input2"><i class="fas fa-user"></i></label>
                                            <input id="username_input2" type="text" name="username"
                                                placeholder="User Name">
                                            <span>Ex:black-level help text here.</span>
                                        </div>
                                    </div>

                                    <div class="form_item_wrap">
                                        <h3 class="input_title">Password*</h3>
                                        <div class="form_item">
                                            <label for="password_input2"><i class="fas fa-lock"></i></label>
                                            <input id="password_input2" type="password" name="password"
                                                placeholder="Password">
                                        </div>
                                    </div>

                                    <div class="form_item_wrap">
                                        <h3 class="input_title">Email*</h3>
                                        <div class="form_item">
                                            <label for="email_input"><i class="fas fa-envelope"></i></label>
                                            <input id="email_input" type="email" name="email" placeholder="Email">
                                        </div>
                                    </div>

                                    <div class="text-start">
                                        <button type="submit" class="btn btn_secondary">Register Now</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- register_section - end
            ================================================== -->

       
    </main>
    <!-- main body - end
          ================================================== -->
@endsection
