@extends('phone_lab.layouts.app')

@section('title', 'Compare - Getyootech - Gadgets Ecommerce Site Template')

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
              <li>Compare</li>
            </ul>
          </div>
        </div>
        <!-- breadcrumb_section - end
        ================================================== -->

        <!-- compare_section - start
        ================================================== -->
        <section class="compare_section section_space">
          <div class="container">
            <div class="compare_table">
              <table class="table">
                <tbody>
                  <tr>
                    <td><h3>Product</h3></td>
                    <td>
                      <img src="{{ asset('assets/images/compare/compare_img_1.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                      <h4>Samsung Galaxy Note IV</h4>
                    </td>
                    <td>
                      <img src="{{ asset('assets/images/compare/compare_img_2.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                      <h4>Samsung Galaxy Note IV</h4>
                    </td>
                    <td>
                      <img src="{{ asset('assets/images/compare/compare_img_1.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                      <h4>Samsung Galaxy Note IV</h4>
                    </td>
                  </tr>
                  <tr>
                    <td><h3>Description</h3></td>
                    <td class="text-center">
                      <p>
                        Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis.
                      </p>
                    </td>
                    <td class="text-center">
                      <p>
                        Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis.
                      </p>
                    </td>
                    <td class="text-center">
                      <p>
                        Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis.
                      </p>
                    </td>
                  </tr>
                  <tr>
                    <td><h3>Color</h3></td>
                    <td class="text-center"><h3 class="text-primary">Blue</h3></td>
                    <td class="text-center"><h3 class="text-success">Green</h3></td>
                    <td class="text-center"><h3 class="text-danger">Red</h3></td>
                  </tr>
                  <tr>
                    <td><h3>Rating</h3></td>
                    <td>
                      <ul class="rating_star ul_li_center">
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                      </ul>
                    </td>
                    <td>
                      <ul class="rating_star ul_li_center">
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                      </ul>
                    </td>
                    <td>
                      <ul class="rating_star ul_li_center">
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                      </ul>
                    </td>
                  </tr>
                  <tr>
                    <td><h3>Stock</h3></td>
                    <td class="text-center">
                      <h3> 
                        <i class="fa-solid fa-cart-circle-check text-success"></i>
                        In Stock
                      </h3>
                    </td>
                    <td class="text-center">
                      <h3> 
                        <i class="fa-solid fa-cart-circle-check text-success"></i>
                        In Stock
                      </h3>
                    </td>
                    <td class="text-center">
                      <h3> 
                        <i class="fa-solid fa-cart-circle-xmark text-danger"></i>
                        Out Stock
                      </h3>
                    </td>
                  </tr>
                  <tr>
                    <td><h3>Add to cart</h3></td>
                    <td class="text-center"><a class="btn btn_gray" href="#!">Add To Cart</a></td>
                    <td class="text-center"><a class="btn btn_gray" href="#!">Add To Cart</a></td>
                    <td class="text-center"><a class="btn btn_gray" href="#!">Add To Cart</a></td>
                  </tr>
                  <tr>
                    <td><h3>Delete</h3></td>
                    <td class="text-center"><button class="remove_btn" type="button"><i class="fas fa-trash-alt"></i></button></td>
                    <td class="text-center"><button class="remove_btn" type="button"><i class="fas fa-trash-alt"></i></button></td>
                    <td class="text-center"><button class="remove_btn" type="button"><i class="fas fa-trash-alt"></i></button></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </section>
        <!-- compare_section - end
        ================================================== -->

        

      </main>
      <!-- main body - end
      ================================================== -->
@endsection