@extends('phone_lab.layouts.app')

@section('title', 'Shopping Cart - Getyootech - Gadgets Ecommerce Site Template')

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
              <li>Cart</li>
            </ul>
          </div>
        </div>
        <!-- breadcrumb_section - end
        ================================================== -->

        <!-- cart_section - start
        ================================================== -->
        <section class="cart_section section_space">
          <div class="container">
            <div class="cart_update_wrap">
              <p class="mb-0"><i class="fal fa-check-square"></i> Shipping costs updated.</p>
            </div>

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
                  <tr>
                    <td>
                      <div class="cart_product">
                        <img src="{{ asset('assets/images/compare/compare_img_1.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <h3><a href="{{ route('phone_lab.shop_details') }}">Your Product Title Here</a></h3>
                      </div>
                    </td>
                    <td class="text-center"><span class="price_text">$10.50</span></td>
                    <td class="text-center">
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
                    </td>
                    <td class="text-center"><span class="price_text">$10.50</span></td>
                    <td class="text-center"><button type="button" class="remove_btn"><i class="fal fa-trash-alt"></i></button></td>
                  </tr>
                  <tr>
                    <td>
                      <div class="cart_product">
                        <img src="{{ asset('assets/images/compare/compare_img_2.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <h3><a href="{{ route('phone_lab.shop_details') }}">Your Product Title Here</a></h3>
                      </div>
                    </td>
                    <td class="text-center"><span class="price_text">$10.50</span></td>
                    <td class="text-center">
                      <form action="#">
                        <div class="quantity_input">
                          <button type="button" class="input_number_decrement">
                            <i class="fal fa-minus"></i>
                          </button>
                          <input class="input_number_2" type="text" value="1">
                          <button type="button" class="input_number_increment">
                            <i class="fal fa-plus"></i>
                          </button>
                        </div>
                      </form>
                    </td>
                    <td class="text-center"><span class="price_text">$10.50</span></td>
                    <td class="text-center"><button type="button" class="remove_btn"><i class="fal fa-trash-alt"></i></button></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="cart_btns_wrap">
              <div class="row">
                <div class="col col-lg-6">
                  <form action="#">
                    <div class="coupon_form form_item mb-0">
                      <input type="text" name="coupon" placeholder="Coupon Code...">
                      <button type="submit" class="btn btn_primary">Apply Coupon</button>
                      <div class="info_icon">
                        <i class="fas fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Your Info Here"></i>
                      </div>
                    </div>
                  </form>
                </div>

                <div class="col col-lg-6">
                  <ul class="btns_group ul_li_right">
                    <li><a class="btn border_black" href="#!">Update Cart</a></li>
                    <li><a class="btn btn_dark" href="#!">PROCEED TO CHECKOUT</a></li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col col-lg-6">
                <div class="calculate_shipping">
                  <h3 class="wrap_title">Calculate Shipping</h3>
                  <form action="#">
                    <div class="select_option clearfix">
                      <select>
                        <option data-display="Select Your Currency">Select Your Option</option>
                        <option value="1" selected>United Kingdom (UK)</option>
                        <option value="2">United Kingdom (UK)</option>
                        <option value="3">United Kingdom (UK)</option>
                        <option value="4">United Kingdom (UK)</option>
                        <option value="5">United Kingdom (UK)</option>
                      </select>
                    </div>
                    <div class="row">
                      <div class="col col-md-6">
                        <div class="form_item">
                          <input type="text" name="location" placeholder="State / Country">
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="form_item">
                          <input type="text" name="postalcode" placeholder="Postcode / ZIP">
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn_primary">Update Total</button>
                  </form>
                </div>
              </div>

              <div class="col col-lg-6">
                <div class="cart_total_table">
                  <h3 class="wrap_title">Cart Totals</h3>
                  <ul class="ul_li_block">
                    <li>
                      <span>Cart Subtotal</span>
                      <span>$52.50</span>
                    </li>
                    <li>
                      <span>Shipping and Handling</span>
                      <span>Free Shipping</span>
                    </li>
                    <li>
                      <span>Order Total</span>
                      <span class="total_price">$52.50</span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- cart_section - end
        ================================================== -->

       

      </main>
      <!-- main body - end
      ================================================== -->
@endsection