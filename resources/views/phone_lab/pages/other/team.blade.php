@extends('phone_lab.layouts.app')

@section('title', 'Team - Getyootech - Gadgets Ecommerce Site Template')

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
              <li>Team</li>
            </ul>
          </div>
        </div>
        <!-- breadcrumb_section - end
        ================================================== -->

        <!-- team_section - start
        ================================================== -->
        <section class="team_section section_space">
          <div class="container">

            <div class="row justify-content-center">
              <div class="col col-md-7">
                <div class="team_section_title text-center">
                  <h2 class="title_text">Meet Our Team</h2>
                  <p class="mb-0">
                    Our experienced team is dedicated to providing expert advice, quality products, and exceptional customer service to help you stay connected with the latest technology. 
                  </p>
                </div>
              </div>
            </div>

            <div class="row justify-content-center">
              <div class="col col-lg-3 col-md-4 col-sm-6">
                <div class="team_item">
                  <div class="team_image">
                    <img src="{{ asset('assets/images/team/team_1.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                  </div>
                  <div class="team_content">
                    <h3 class="team_member_name">Harry Dor</h3>
                    <span class="team_member_title">CEO/Founder</span>
                  </div>
                </div>
              </div>

              <div class="col col-lg-3 col-md-4 col-sm-6">
                <div class="team_item">
                  <div class="team_image">
                    <img src="{{ asset('assets/images/team/team_2.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                  </div>
                  <div class="team_content">
                    <h3 class="team_member_name">John Swim</h3>
                    <span class="team_member_title">Fashion Designer</span>
                  </div>
                </div>
              </div>

              <div class="col col-lg-3 col-md-4 col-sm-6">
                <div class="team_item">
                  <div class="team_image">
                    <img src="{{ asset('assets/images/team/team_3.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                  </div>
                  <div class="team_content">
                    <h3 class="team_member_name">Harry Dor</h3>
                    <span class="team_member_title">CEO/Founder</span>
                  </div>
                </div>
              </div>

              <div class="col col-lg-3 col-md-4 col-sm-6">
                <div class="team_item">
                  <div class="team_image">
                    <img src="{{ asset('assets/images/team/team_4.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                  </div>
                  <div class="team_content">
                    <h3 class="team_member_name">John Swim</h3>
                    <span class="team_member_title">Fashion Designer</span>
                  </div>
                </div>
              </div>

              <div class="col col-lg-3 col-md-4 col-sm-6">
                <div class="team_item">
                  <div class="team_image">
                    <img src="{{ asset('assets/images/team/team_5.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                  </div>
                  <div class="team_content">
                    <h3 class="team_member_name">Harry Dor</h3>
                    <span class="team_member_title">CEO/Founder</span>
                  </div>
                </div>
              </div>

              <div class="col col-lg-3 col-md-4 col-sm-6">
                <div class="team_item">
                  <div class="team_image">
                    <img src="{{ asset('assets/images/team/team_6.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                  </div>
                  <div class="team_content">
                    <h3 class="team_member_name">John Swim</h3>
                    <span class="team_member_title">Fashion Designer</span>
                  </div>
                </div>
              </div>

              <div class="col col-lg-3 col-md-4 col-sm-6">
                <div class="team_item">
                  <div class="team_image">
                    <img src="{{ asset('assets/images/team/team_7.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                  </div>
                  <div class="team_content">
                    <h3 class="team_member_name">Harry Dor</h3>
                    <span class="team_member_title">CEO/Founder</span>
                  </div>
                </div>
              </div>

              <div class="col col-lg-3 col-md-4 col-sm-6">
                <div class="team_item">
                  <div class="team_image">
                    <img src="{{ asset('assets/images/team/team_8.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                  </div>
                  <div class="team_content">
                    <h3 class="team_member_name">John Swim</h3>
                    <span class="team_member_title">Fashion Designer</span>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </section>
        <!-- team_section - end
        ================================================== -->

     

      </main>
      <!-- main body - end
      ================================================== -->
@endsection