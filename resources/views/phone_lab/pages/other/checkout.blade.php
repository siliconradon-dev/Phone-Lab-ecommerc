@extends('phone_lab.layouts.app')

@section('title', 'Checkout - Getyootech - Gadgets Ecommerce Site Template')

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
                  <img src="{{ asset('assets/images/cart/cart_img_1.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                </div>
                <div class="item_content">
                  <h4 class="item_title">Yellow Blouse</h4>
                  <span class="item_price">$30.00</span>
                </div>
                <button type="button" class="remove_btn"><i class="fal fa-trash-alt"></i></button>
              </li>
              <li>
                <div class="item_image">
                  <img src="{{ asset('assets/images/cart/cart_img_2.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                </div>
                <div class="item_content">
                  <h4 class="item_title">Yellow Blouse</h4>
                  <span class="item_price">$30.00</span>
                </div>
                <button type="button" class="remove_btn"><i class="fal fa-trash-alt"></i></button>
              </li>
              <li>
                <div class="item_image">
                  <img src="{{ asset('assets/images/cart/cart_img_3.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
              <li>Check Out</li>
            </ul>
          </div>
        </div>
        <!-- breadcrumb_section - end
        ================================================== -->

        <!-- checkout_section - start
        ================================================== -->
        <section class="checkout_section section_space">
          <div class="container">
            <form action="#">
              <div class="form_area">
                <div class="reg_coupon_item">
                  <div class="content_wrap bg_default_yellow">
                    <button type="button" data-bs-toggle="collapse" data-bs-target="#login_collapse" aria-expanded="false" aria-controls="login_collapse">
                      <i class="fas fa-info-circle"></i>
                      <strong>Returning customer?</strong> Click here to login
                    </button>
                  </div>
                  <div class="collapse" id="login_collapse">
                    <div class="card card-body">
                      <div class="row">
                        <div class="col col-md-6 col-sm-6">
                          <div class="form_item">
                            <input type="email" name="email" placeholder="Your Email">
                          </div>
                        </div>
                        <div class="col col-md-6 col-sm-6">
                          <div class="form_item">
                            <input type="password" name="password" placeholder="Your Password">
                          </div>
                        </div>
                      </div>
                      <div class="btns_group">
                        <div class="checkbox_item">
                          <input id="remember_me" type="checkbox">
                          <label for="remember_me">Remember Me</label>
                        </div>
                        <button type="submit" class="btn btn_primary">Login Now</button>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="reg_coupon_item">
                  <div class="content_wrap bg_default_blue">
                    <button type="button" data-bs-toggle="collapse" data-bs-target="#coupon_collapse" aria-expanded="false" aria-controls="coupon_collapse">
                      <i class="fas fa-info-circle"></i>
                      <strong>Have a coupon? </strong> Click here to enter your code
                    </button>
                  </div>
                  <div class="collapse" id="coupon_collapse">
                    <div class="card card-body">
                      <div class="form_item">
                        <input type="text" name="coupon" placeholder="Coupon Code">
                      </div>
                      <button type="submit" class="btn btn_primary">Apply Coupon</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="checkout_widget bg-light">
                <h3 class="checkout_widget_title">Billing Details</h3>

                <div class="select_option clearfix">
                  <h4 class="input_title">Country *</h4>
                  <select>
                    <option data-display="Select Your Country">Select Your Option</option>
                    <option value="1" selected>United Kingdom (UK)</option>
                    <option value="2">United Kingdom (UK)</option>
                    <option value="3">United Kingdom (UK)</option>
                    <option value="4">United Kingdom (UK)</option>
                    <option value="5">United Kingdom (UK)</option>
                  </select>
                </div>

                <div class="row">
                  <div class="col col-md-6 col-sm-6">
                    <div class="form_item">
                      <h4 class="input_title">First Name</h4>
                      <input type="text" name="firstname" placeholder="First Name *">
                    </div>
                  </div>
                  <div class="col col-md-6 col-sm-6">
                    <div class="form_item">
                      <h4 class="input_title">Last Name</h4>
                      <input type="text" name="lastname" placeholder="Last Name *">
                    </div>
                  </div>
                </div>

                <div class="form_item">
                  <h4 class="input_title">Company Name</h4>
                  <input type="text" name="companyname" placeholder="Your Company Name">
                </div>

                <div class="form_item">
                  <h4 class="input_title">Address *</h4>
                  <input type="text" name="streetaddress" placeholder="Street Address">
                  <input type="text" name="apartmentaddress" placeholder="Apartment, suite, unit etc. (optional)">
                </div>

                <div class="form_item">
                  <h4 class="input_title">Town / City *</h4>
                  <input type="text" name="town" placeholder="Town / City">
                </div>

                <div class="row">
                  <div class="col col-md-6 col-sm-6">
                    <div class="form_item">
                      <h4 class="input_title">Country *</h4>
                      <input type="text" name="country" placeholder="Country">
                    </div>
                  </div>
                  <div class="col col-md-6 col-sm-6">
                    <div class="form_item">
                      <h4 class="input_title">Postcode / Zip *</h4>
                      <input type="text" name="postcode" placeholder="Postcode / Zip">
                    </div>
                  </div>
                </div>

                <div class="form_item mb-5">
                  <h4 class="input_title">Contact Info *</h4>
                  <input type="email" name="email" placeholder="Email Address">
                  <input type="tel" name="telephone" placeholder="Phone Number">
                </div>

                <div class="checkout_widget_title">
                  <h3>Ship to a different address?</h3>
                </div>
                <div class="form_item note_textarea mb-0">
                  <h4 class="input_title">Other Note</h4>
                  <textarea name="note" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                </div>
              </div>

              <div class="checkout_widget">
                <h3 class="checkout_widget_title">Your Order</h3>
                <div class="cart_table checkout_table">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>PRODUCT</th>
                        <th>PRICE</th>
                        <th>QUANTITY</th>
                        <th>TOTAL</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <div class="cart_product">
                            <img src="{{ asset('assets/images/compare/compare_img_1.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                            <h3>Your Product Title Here</h3>
                          </div>
                        </td>
                        <td><span class="price_text">$10.50</span></td>
                        <td><strong class="quantity_count">01</strong></td>
                        <td><span class="price_text">$10.50</span></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td><strong>Cart Subtotal</strong></td>
                        <td><strong>10.50</strong></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td><strong>Shipping and Handling</strong></td>
                        <td><strong class="free_text">Free</strong></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td><strong>Order Total</strong></td>
                        <td><strong class="total_text">10.50</strong></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="checkout_payment_method">
                <ul class="ul_li_block">
                  <li>
                    <div class="radio_item">
                      <input id="direct_bank_transfer" type="radio" name="payment_method" checked>
                      <label for="direct_bank_transfer">Direct Bank Transfer</label>
                    </div>
                    <div class="directly_payment_info">
                      Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order wonâ€™t be shipped until the funds have cleared in our account.
                    </div>
                  </li>

                  <li>
                    <div class="radio_item">
                      <input id="cheque_payment" type="radio" name="payment_method">
                      <label for="cheque_payment">Cheque Payment</label>
                    </div>
                  </li>

                  <li>
                    <div class="radio_item">
                      <input id="credit_cart" type="radio" name="payment_method">
                      <label for="credit_cart">Credit Cart</label>
                    </div>
                    <div class="payment_card">
                      <img src="{{ asset('assets/images/payments_icon_2.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    </div>
                  </li>

                  <li>
                    <div class="radio_item">
                      <input id="paypal_transfer" type="radio" name="payment_method">
                      <label for="paypal_transfer">Paypal</label>
                    </div>
                    <div class="payment_card">
                      <img src="{{ asset('assets/images/payments_icon_3.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    </div>
                  </li>
                </ul>
                <div class="load_more">
                  <button type="submit" class="btn btn_primary w-100">Place Order</button>
                </div>
              </div>
            </form>
          </div>
        </section>
        <!-- checkout_section - end
        ================================================== -->

       
      </main>
      <!-- main body - end
      ================================================== -->
@endsection