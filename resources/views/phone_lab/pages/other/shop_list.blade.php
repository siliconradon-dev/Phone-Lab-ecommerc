@extends('phone_lab.layouts.app')

@section('title', 'Product List - Getyootech - Gadgets Ecommerce Site Template')

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

        <!-- product quick view modal - start
        ================================================== -->
        <div class="modal fade" id="quickview_popup" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel2">Product Quick View</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="product_details">
                  <div class="container">
                    <div class="row">
                      <div class="col col-lg-6">
                        <div class="product_details_image p-0">
                          <img src="{{ asset('assets/images/details/product_details_img_1.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="product_details_content">
                          <h2 class="item_title">CURREN 8109 Watches</h2>
                          <p>
                            It is a long established fact that a reader will be distracted eget velit. Donec ac tempus ante. Fusce ultricies massa massa. Fusce aliquam, purus eget sagittis vulputate
                          </p>
                          <div class="item_review">
                            <ul class="rating_star ul_li">
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                            </ul>
                            <span class="review_value">3 Rating(s)</span>
                          </div>
                          <div class="item_price">
                            <span>$620.00</span>
                            <del>$720.00</del>
                          </div>

                          <hr>

                          <div class="item_attribute">
                            <h3 class="title_text">Options <span class="underline"></span></h3>
                            <form action="#">
                              <div class="row">
                                <div class="col col-md-6">
                                  <div class="select_option clearfix">
                                    <h4 class="input_title">Size *</h4>
                                    <select>
                                      <option data-display="- Please select -">Choose A Option</option>
                                      <option value="1">Some option</option>
                                      <option value="2">Another option</option>
                                      <option value="3" disabled>A disabled option</option>
                                      <option value="4">Potato</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col col-md-6">
                                  <div class="select_option clearfix">
                                    <h4 class="input_title">Color *</h4>
                                    <select>
                                      <option data-display="- Please select -">Choose A Option</option>
                                      <option value="1">Some option</option>
                                      <option value="2">Another option</option>
                                      <option value="3" disabled>A disabled option</option>
                                      <option value="4">Potato</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <span class="repuired_text">Repuired Fiields *</span>
                            </form>
                          </div>

                          <div class="quantity_wrap">
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

                            <div class="total_price">
                              Total: $620,99
                            </div>
                          </div>

                          <ul class="default_btns_group ul_li">
                            <li><a class="addtocart_btn" href="{{ route('phone_lab.shop_details') }}">Add To Cart</a></li>
                            <li><a href="#!"><i class="fa-solid fa-arrows-rotate"></i></a></li>
                            <li><a href="#!"><i class="fas fa-heart"></i></a></li>
                          </ul>

                          <ul class="default_share_links ul_li">
                            <li>
                              <a class="facebook" href="#!">
                                <span><i class="fab fa-facebook-square"></i> Like</span>
                                <small>10K</small>
                              </a>
                            </li>
                            <li>
                              <a class="twitter" href="#!">
                                <span><i class="fab fa-twitter-square"></i> Tweet</span>
                                <small>15K</small>
                              </a>
                            </li>
                            <li>
                              <a class="google" href="#!">
                                <span><i class="fab fa-google-plus-square"></i> Google+</span>
                                <small>20K</small>
                              </a>
                            </li>
                            <li>
                              <a class="share" href="#!">
                                <span><i class="fas fa-plus-square"></i> Share</span>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- product quick view modal - end
        ================================================== -->

        <!-- breadcrumb_section - start
        ================================================== -->
        <div class="breadcrumb_section">
          <div class="container">
            <ul class="breadcrumb_nav ul_li">
              <li><a href="{{ route('phone_lab.index') }}">Home</a></li>
              <li>Product List</li>
            </ul>
          </div>
        </div>
        <!-- breadcrumb_section - end
        ================================================== -->

        <!-- product_section - start
        ================================================== -->
        <section class="product_section section_space">
          <div class="container">
            <div class="row">
              <div class="col-lg-9">
                <div class="filter_topbar">
                  <div class="row align-items-center">
                    <div class="col col-md-4 col-sm-4">
                      <ul class="layout_btns nav" role="tablist">
                        <li role="presentation">
                          <button data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                            <i class="fa-solid fa-grid"></i>
                          </button>
                        </li>
                        <li role="presentation">
                          <button class="active" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                            <i class="fa-solid fa-list"></i>
                          </button>
                        </li>
                      </ul>
                    </div>

                    <div class="col col-md-4 col-sm-4">
                      <form action="#">
                        <div class="select_option clearfix">
                          <select>
                            <option data-display="Defaul Sorting">Select Your Option</option>
                            <option value="1">Sorting By Name</option>
                            <option value="2">Sorting By Price</option>
                            <option value="3">Sorting By Size</option>
                          </select>
                        </div>
                      </form>
                    </div>

                    <div class="col col-md-4 col-sm-4">
                      <div class="result_text">Showing 1-12 of 30 relults</div>
                    </div>
                  </div>
                </div>

                <hr>

                <div class="tab-content">
                  <div class="tab-pane fade" id="home" role="tabpanel">
                    <div class="product_wrap">
                      <div class="product_layout1">
                        <div class="item_badge hot_badge">
                          <span>HOT</span>
                        </div>
                        <div class="item_image">
                          <img src="{{ asset('assets/images/shop/product_img_11.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <img src="{{ asset('assets/images/shop/product_img_12.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <a class="quickview_btn" data-bs-toggle="modal" href="#quickview_popup" role="button">Quick View</a>
                        </div>
                        <div class="item_content">
                          <h3 class="item_title">
                            <a href="{{ route('phone_lab.shop_details') }}">CCTV Camara</a>
                          </h3>
                          <ul class="rating_star ul_li">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                          </ul>
                          <div class="item_price">
                            <span>$620.00</span>
                            <del>$720.00</del>
                          </div>
                          <ul class="item_btns_group ul_li">
                            <li><a class="addtocart_btn" href="{{ route('phone_lab.shop_details') }}">Add To Cart</a></li>
                            <li><a href="#!"><i class="fa-solid fa-arrows-rotate"></i></a></li>
                            <li><a href="#!"><i class="fas fa-heart"></i></a></li>
                          </ul>
                        </div>
                      </div>

                      <div class="product_layout1">
                        <div class="item_image">
                          <img src="{{ asset('assets/images/shop/product_img_12.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <img src="{{ asset('assets/images/shop/product_img_11.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <a class="quickview_btn" data-bs-toggle="modal" href="#quickview_popup" role="button">Quick View</a>
                        </div>
                        <div class="item_content">
                          <h3 class="item_title">
                            <a href="{{ route('phone_lab.shop_details') }}">N5000 Laptop</a>
                          </h3>
                          <ul class="rating_star ul_li">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                          </ul>
                          <div class="item_price">
                            <span>$720.00</span>
                          </div>
                          <ul class="item_btns_group ul_li">
                            <li><a class="addtocart_btn" href="{{ route('phone_lab.shop_details') }}">Add To Cart</a></li>
                            <li><a href="#!"><i class="fa-solid fa-arrows-rotate"></i></a></li>
                            <li><a href="#!"><i class="fas fa-heart"></i></a></li>
                          </ul>
                        </div>
                      </div>

                      <div class="product_layout1">
                        <div class="item_badge hot_badge">
                          <span>HOT</span>
                        </div>
                        <div class="item_image">
                          <img src="{{ asset('assets/images/shop/product_img_3.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <img src="{{ asset('assets/images/shop/product_img_13.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <a class="quickview_btn" data-bs-toggle="modal" href="#quickview_popup" role="button">Quick View</a>
                        </div>
                        <div class="item_content">
                          <h3 class="item_title">
                            <a href="{{ route('phone_lab.shop_details') }}">Anker SoundCore Life Q20</a>
                          </h3>
                          <ul class="rating_star ul_li">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                          </ul>
                          <div class="item_price">
                            <span>$620.00</span>
                            <del>$720.00</del>
                          </div>
                          <ul class="item_btns_group ul_li">
                            <li><a class="addtocart_btn" href="{{ route('phone_lab.shop_details') }}">Add To Cart</a></li>
                            <li><a href="#!"><i class="fa-solid fa-arrows-rotate"></i></a></li>
                            <li><a href="#!"><i class="fas fa-heart"></i></a></li>
                          </ul>
                        </div>
                      </div>

                      <div class="product_layout1">
                        <div class="item_badge new_badge">
                          <span>NEW</span>
                        </div>
                        <div class="item_image">
                          <img src="{{ asset('assets/images/shop/product_img_13.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <img src="{{ asset('assets/images/shop/product_img_3.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <a class="quickview_btn" data-bs-toggle="modal" href="#quickview_popup" role="button">Quick View</a>
                        </div>
                        <div class="item_content">
                          <h3 class="item_title">
                            <a href="{{ route('phone_lab.shop_details') }}">40 '' Vikan HD ULTRA</a>
                          </h3>
                          <ul class="rating_star ul_li">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                          </ul>
                          <div class="item_price">
                            <span>$720.00</span>
                          </div>
                          <ul class="item_btns_group ul_li">
                            <li><a class="addtocart_btn" href="{{ route('phone_lab.shop_details') }}">Add To Cart</a></li>
                            <li><a href="#!"><i class="fa-solid fa-arrows-rotate"></i></a></li>
                            <li><a href="#!"><i class="fas fa-heart"></i></a></li>
                          </ul>
                        </div>
                      </div>

                      <div class="product_layout1">
                        <div class="item_image">
                          <img src="{{ asset('assets/images/shop/product_img_17.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <img src="{{ asset('assets/images/shop/product_img_18.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <a class="quickview_btn" data-bs-toggle="modal" href="#quickview_popup" role="button">Quick View</a>
                        </div>
                        <div class="item_content">
                          <h3 class="item_title">
                            <a href="{{ route('phone_lab.shop_details') }}">CCTV Camara</a>
                          </h3>
                          <ul class="rating_star ul_li">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                          </ul>
                          <div class="item_price">
                            <span>$620.00</span>
                          </div>
                          <ul class="item_btns_group ul_li">
                            <li><a class="addtocart_btn" href="{{ route('phone_lab.shop_details') }}">Add To Cart</a></li>
                            <li><a href="#!"><i class="fa-solid fa-arrows-rotate"></i></a></li>
                            <li><a href="#!"><i class="fas fa-heart"></i></a></li>
                          </ul>
                        </div>
                      </div>

                      <div class="product_layout1">
                        <div class="item_image">
                          <img src="{{ asset('assets/images/shop/product_img_18.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <img src="{{ asset('assets/images/shop/product_img_17.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <a class="quickview_btn" data-bs-toggle="modal" href="#quickview_popup" role="button">Quick View</a>
                        </div>
                        <div class="item_content">
                          <h3 class="item_title">
                            <a href="{{ route('phone_lab.shop_details') }}">N5000 Laptop </a>
                          </h3>
                          <ul class="rating_star ul_li">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                          </ul>
                          <div class="item_price">
                            <span>$720.00</span>
                          </div>
                          <ul class="item_btns_group ul_li">
                            <li><a class="addtocart_btn" href="{{ route('phone_lab.shop_details') }}">Add To Cart</a></li>
                            <li><a href="#!"><i class="fa-solid fa-arrows-rotate"></i></a></li>
                            <li><a href="#!"><i class="fas fa-heart"></i></a></li>
                          </ul>
                        </div>
                      </div>

                      <div class="product_layout1">
                        <div class="item_badge sale_badge">
                          <span>SALE</span>
                        </div>
                        <div class="item_image">
                          <img src="{{ asset('assets/images/shop/product_img_12.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <img src="{{ asset('assets/images/shop/product_img_19.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <a class="quickview_btn" data-bs-toggle="modal" href="#quickview_popup" role="button">Quick View</a>
                        </div>
                        <div class="item_content">
                          <h3 class="item_title">
                            <a href="{{ route('phone_lab.shop_details') }}">Anker SoundCore Life Q20</a>
                          </h3>
                          <ul class="rating_star ul_li">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                          </ul>
                          <div class="item_price">
                            <span>$720.00</span>
                          </div>
                          <ul class="item_btns_group ul_li">
                            <li><a class="addtocart_btn" href="{{ route('phone_lab.shop_details') }}">Add To Cart</a></li>
                            <li><a href="#!"><i class="fa-solid fa-arrows-rotate"></i></a></li>
                            <li><a href="#!"><i class="fas fa-heart"></i></a></li>
                          </ul>
                        </div>
                      </div>

                      <div class="product_layout1">
                        <div class="item_image">
                          <img src="{{ asset('assets/images/shop/product_img_19.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <img src="{{ asset('assets/images/shop/product_img_12.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <a class="quickview_btn" data-bs-toggle="modal" href="#quickview_popup" role="button">Quick View</a>
                        </div>
                        <div class="item_content">
                          <h3 class="item_title">
                            <a href="{{ route('phone_lab.shop_details') }}">40 '' Vikan HD ULTRA</a>
                          </h3>
                          <ul class="rating_star ul_li">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                          </ul>
                          <div class="item_price">
                            <span>$620.00</span>
                          </div>
                          <ul class="item_btns_group ul_li">
                            <li><a class="addtocart_btn" href="{{ route('phone_lab.shop_details') }}">Add To Cart</a></li>
                            <li><a href="#!"><i class="fa-solid fa-arrows-rotate"></i></a></li>
                            <li><a href="#!"><i class="fas fa-heart"></i></a></li>
                          </ul>
                        </div>
                      </div>

                      <div class="product_layout1">
                        <div class="item_image">
                          <img src="{{ asset('assets/images/shop/product_img_4.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <img src="{{ asset('assets/images/shop/product_img_6.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <a class="quickview_btn" data-bs-toggle="modal" href="#quickview_popup" role="button">Quick View</a>
                        </div>
                        <div class="item_content">
                          <h3 class="item_title">
                            <a href="{{ route('phone_lab.shop_details') }}">Anker SoundCore Life Q20</a>
                          </h3>
                          <ul class="rating_star ul_li">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                          </ul>
                          <div class="item_price">
                            <span>$620.00</span>
                            <del>$720.00</del>
                          </div>
                          <ul class="item_btns_group ul_li">
                            <li><a class="addtocart_btn" href="{{ route('phone_lab.shop_details') }}">Add To Cart</a></li>
                            <li><a href="#!"><i class="fa-solid fa-arrows-rotate"></i></a></li>
                            <li><a href="#!"><i class="fas fa-heart"></i></a></li>
                          </ul>
                        </div>
                      </div>

                      <div class="product_layout1">
                        <div class="item_image">
                          <img src="{{ asset('assets/images/shop/product_img_6.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <img src="{{ asset('assets/images/shop/product_img_4.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <a class="quickview_btn" data-bs-toggle="modal" href="#quickview_popup" role="button">Quick View</a>
                        </div>
                        <div class="item_content">
                          <h3 class="item_title">
                            <a href="{{ route('phone_lab.shop_details') }}">40 '' Vikan HD ULTRA</a>
                          </h3>
                          <ul class="rating_star ul_li">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                          </ul>
                          <div class="item_price">
                            <span>$720.00</span>
                          </div>
                          <ul class="item_btns_group ul_li">
                            <li><a class="addtocart_btn" href="{{ route('phone_lab.shop_details') }}">Add To Cart</a></li>
                            <li><a href="#!"><i class="fa-solid fa-arrows-rotate"></i></a></li>
                            <li><a href="#!"><i class="fas fa-heart"></i></a></li>
                          </ul>
                        </div>
                      </div>

                      <div class="product_layout1">
                        <div class="item_badge sale_badge">
                          <span>SALE</span>
                        </div>
                        <div class="item_image">
                          <img src="{{ asset('assets/images/shop/product_img_20.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <img src="{{ asset('assets/images/shop/product_img_16.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <a class="quickview_btn" data-bs-toggle="modal" href="#quickview_popup" role="button">Quick View</a>
                        </div>
                        <div class="item_content">
                          <h3 class="item_title">
                            <a href="{{ route('phone_lab.shop_details') }}">CCTV Camara</a>
                          </h3>
                          <ul class="rating_star ul_li">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                          </ul>
                          <div class="item_price">
                            <span>$620.00</span>
                          </div>
                          <ul class="item_btns_group ul_li">
                            <li><a class="addtocart_btn" href="{{ route('phone_lab.shop_details') }}">Add To Cart</a></li>
                            <li><a href="#!"><i class="fa-solid fa-arrows-rotate"></i></a></li>
                            <li><a href="#!"><i class="fas fa-heart"></i></a></li>
                          </ul>
                        </div>
                      </div>

                      <div class="product_layout1">
                        <div class="item_image">
                          <img src="{{ asset('assets/images/shop/product_img_16.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <img src="{{ asset('assets/images/shop/product_img_20.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <a class="quickview_btn" data-bs-toggle="modal" href="#quickview_popup" role="button">Quick View</a>
                        </div>
                        <div class="item_content">
                          <h3 class="item_title">
                            <a href="{{ route('phone_lab.shop_details') }}">Anker SoundCore Life Q20</a>
                          </h3>
                          <ul class="rating_star ul_li">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                          </ul>
                          <div class="item_price">
                            <span>$720.00</span>
                          </div>
                          <ul class="item_btns_group ul_li">
                            <li><a class="addtocart_btn" href="{{ route('phone_lab.shop_details') }}">Add To Cart</a></li>
                            <li><a href="#!"><i class="fa-solid fa-arrows-rotate"></i></a></li>
                            <li><a href="#!"><i class="fas fa-heart"></i></a></li>
                          </ul>
                        </div>
                      </div>
                    </div>

                    <div class="pagination_wrap">
                      <ul class="pagination_nav ul_li_right">
                        <li class="active"><a href="#!">1</a></li>
                        <li><a href="#!">2</a></li>
                        <li><a href="#!">3</a></li>
                        <li class="prev_btn"><a href="#!"><i class="fa-regular fa-angle-left"></i></a></li>
                        <li class="next_btn"><a href="#!"><i class="fa-regular fa-angle-right"></i></a></li>
                      </ul>
                    </div>
                  </div>

                  <div class="tab-pane fade show active" id="profile" role="tabpanel">
                    <div class="product_layout2_wrap">
                      <div class="product_layout2">
                        <div class="item_image">
                          <div class="item_badge hot_badge">
                            <span>SALE</span>
                          </div>
                          <a class="image_wrap" href="{{ route('phone_lab.shop_details') }}">
                            <img src="{{ asset('assets/images/shop/product2_img_1.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          </a>
                        </div>
                        <div class="item_content">
                          <h3 class="item_title">
                            <a href="{{ route('phone_lab.shop_details') }}">CURREN 8109 Watches</a>
                          </h3>
                          <ul class="rating_star ul_li">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                          </ul>
                          <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                          </p>
                          <div class="item_price">
                            <span>$620.00</span>
                            <del>$720.00</del>
                          </div>
                          <ul class="item_btns_group ul_li">
                            <li><a class="addtocart_btn" href="{{ route('phone_lab.shop_details') }}">Add To Cart</a></li>
                            <li><a href="#!"><i class="fa-solid fa-arrows-rotate"></i></a></li>
                            <li><a href="#!"><i class="fas fa-heart"></i></a></li>
                          </ul>
                        </div>
                      </div>

                      <div class="product_layout2">
                        <div class="item_image">
                          <a class="image_wrap" href="{{ route('phone_lab.shop_details') }}">
                            <img src="{{ asset('assets/images/shop/product2_img_2.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          </a>
                        </div>
                        <div class="item_content">
                          <h3 class="item_title">
                            <a href="{{ route('phone_lab.shop_details') }}">CURREN 8109 Watches</a>
                          </h3>
                          <ul class="rating_star ul_li">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                          </ul>
                          <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                          </p>
                          <div class="item_price">
                            <span>$620.00</span>
                            <del>$720.00</del>
                          </div>
                          <ul class="item_btns_group ul_li">
                            <li><a class="addtocart_btn" href="{{ route('phone_lab.shop_details') }}">Add To Cart</a></li>
                            <li><a href="#!"><i class="fa-solid fa-arrows-rotate"></i></a></li>
                            <li><a href="#!"><i class="fas fa-heart"></i></a></li>
                          </ul>
                        </div>
                      </div>

                      <div class="product_layout2">
                        <div class="item_image">
                          <a class="image_wrap" href="{{ route('phone_lab.shop_details') }}">
                            <img src="{{ asset('assets/images/shop/product2_img_3.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          </a>
                        </div>
                        <div class="item_content">
                          <h3 class="item_title">
                            <a href="{{ route('phone_lab.shop_details') }}">CURREN 8109 Watches</a>
                          </h3>
                          <ul class="rating_star ul_li">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                          </ul>
                          <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                          </p>
                          <div class="item_price">
                            <span>$620.00</span>
                            <del>$720.00</del>
                          </div>
                          <ul class="item_btns_group ul_li">
                            <li><a class="addtocart_btn" href="{{ route('phone_lab.shop_details') }}">Add To Cart</a></li>
                            <li><a href="#!"><i class="fa-solid fa-arrows-rotate"></i></a></li>
                            <li><a href="#!"><i class="fas fa-heart"></i></a></li>
                          </ul>
                        </div>
                      </div>

                      <div class="product_layout2">
                        <div class="item_image">
                          <a class="image_wrap" href="{{ route('phone_lab.shop_details') }}">
                            <img src="{{ asset('assets/images/shop/product2_img_4.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          </a>
                        </div>
                        <div class="item_content">
                          <h3 class="item_title">
                            <a href="{{ route('phone_lab.shop_details') }}">CURREN 8109 Watches</a>
                          </h3>
                          <ul class="rating_star ul_li">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                          </ul>
                          <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                          </p>
                          <div class="item_price">
                            <span>$620.00</span>
                            <del>$720.00</del>
                          </div>
                          <ul class="item_btns_group ul_li">
                            <li><a class="addtocart_btn" href="{{ route('phone_lab.shop_details') }}">Add To Cart</a></li>
                            <li><a href="#!"><i class="fa-solid fa-arrows-rotate"></i></a></li>
                            <li><a href="#!"><i class="fas fa-heart"></i></a></li>
                          </ul>
                        </div>
                      </div>

                      <div class="product_layout2">
                        <div class="item_image">
                          <a class="image_wrap" href="{{ route('phone_lab.shop_details') }}">
                            <img src="{{ asset('assets/images/shop/product2_img_5.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          </a>
                        </div>
                        <div class="item_content">
                          <h3 class="item_title">
                            <a href="{{ route('phone_lab.shop_details') }}">CURREN 8109 Watches</a>
                          </h3>
                          <ul class="rating_star ul_li">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                          </ul>
                          <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                          </p>
                          <div class="item_price">
                            <span>$620.00</span>
                            <del>$720.00</del>
                          </div>
                          <ul class="item_btns_group ul_li">
                            <li><a class="addtocart_btn" href="{{ route('phone_lab.shop_details') }}">Add To Cart</a></li>
                            <li><a href="#!"><i class="fa-solid fa-arrows-rotate"></i></a></li>
                            <li><a href="#!"><i class="fas fa-heart"></i></a></li>
                          </ul>
                        </div>
                      </div>
                    </div>

                    <div class="pagination_wrap">
                      <ul class="pagination_nav ul_li_right">
                        <li class="active"><a href="#!">1</a></li>
                        <li><a href="#!">2</a></li>
                        <li><a href="#!">3</a></li>
                        <li class="prev_btn"><a href="#!"><i class="fa-regular fa-angle-left"></i></a></li>
                        <li class="next_btn"><a href="#!"><i class="fa-regular fa-angle-right"></i></a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 order-lg-first">
                <aside class="sidebar_section ps-0 mt-lg-0">
                  <div class="sb_widget sb_category">
                    <h3 class="sb_widget_title">Categories</h3>
                    <ul class="sb_category_list ul_li_block">
                      <li><a href="#!">Official electronic <span></span></a></li>
                      <li><a href="#!">Dell <span>(1375)</span></a></li>
                      <li><a href="#!">Asus <span>(1687)</span></a></li>
                      <li><a href="#!">HP <span>(1036)</span></a></li>
                      <li><a href="#!">Acer <span>(202)</span></a></li>
                      <li><a href="#!">Aivta <span>(525)</span></a></li>
                      <li><a href="#!">HP <span>(135)</span></a></li>
                      <li><a href="#!">Apple <span>(298)</span></a></li>
                      <li><a href="#!"><span>All Categories</span></a></li>
                    </ul>
                  </div>

                  <div class="sb_widget">
                    <h3 class="sb_widget_title">Your Filter</h3>
                    <div class="filter_sidebar">
                      <div class="fs_widget">
                        <h3 class="fs_widget_title">Category</h3>
                        <form action="#">
                          <div class="select_option clearfix">
                            <select>
                              <option data-display="Select Category">Select Your Option</option>
                              <option value="1" selected>HP Accessories</option>
                              <option value="2">Dell Accessories</option>
                              <option value="3">Apple Accessories</option>
                            </select>
                          </div>
                        </form>
                      </div>

                      <div class="fs_widget">
                        <h3 class="fs_widget_title">Manufacturer</h3>
                        <form action="#">
                          <ul class="fs_brand_list ul_li_block">
                            <li>
                              <div class="checkbox_item">
                                <input id="apple_brand" type="checkbox" name="brand_checkbox">
                                <label for="apple_brand">Apple <span>(19)</span></label>
                              </div>
                            </li>
                            <li>
                              <div class="checkbox_item">
                                <input id="asus_brand" type="checkbox" name="brand_checkbox">
                                <label for="asus_brand">Asus <span>(1)</span></label>
                              </div>
                            </li>
                            <li>
                              <div class="checkbox_item">
                                <input id="bank_oluvsen_brand" type="checkbox" name="brand_checkbox">
                                <label for="bank_oluvsen_brand">Bank & Oluvsen <span>(1)</span></label>
                              </div>
                            </li>
                          </ul>
                        </form>
                      </div>

                      <div class="fs_widget">
                        <h3 class="fs_widget_title">Price</h3>
                        <form action="#">
                          <div class="price-range-area clearfix">
                            <div class="price-text d-flex align-items-center">
                              <span>Range:</span>
                              <input type="text" id="amount" readonly>
                            </div>
                            <div id="slider-range" class="slider-range"></div>
                          </div>
                        </form>
                      </div>

                      <div class="fs_widget">
                        <h3 class="fs_widget_title">Average Rating</h3>
                        <ul class="average_rating_list ul_li_block">
                          <li>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span>(102)</span>
                          </li>
                          <li>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <span>(80)</span>
                          </li>
                          <li>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <span>(26)</span>
                          </li>
                          <li>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <span>(10)</span>
                          </li>
                          <li>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <span>(02)</span>
                          </li>
                        </ul>
                      </div>

                      <div class="fs_widget">
                        <h3 class="fs_widget_title">Filter by Memory</h3>
                        <ul class="filter_memory_list ul_li_block">
                          <li><a href="#!">256 GB or more <span>(12)</span></a></li>
                          <li><a href="#!">128 GB <span>(12)</span></a></li>
                          <li><a href="#!">16 GB <span>(6)</span></a></li>
                          <li><a href="#!">32 GB <span>(7)</span></a></li>
                          <li><a href="#!">64 GB <span>(9)</span></a></li>
                          <li><a href="#!">8 GB or less <span>(8)</span></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <div class="sb_widget latest_product_carousel mb-lg-0">
                    <div class="title_wrap">
                      <h3 class="area_title">Latest Products</h3>
                      <div class="carousel_nav">
                        <button type="button" class="vs4i_left_arrow"><i class="fa-regular fa-angle-left"></i></button>
                        <button type="button" class="vs4i_right_arrow"><i class="fa-regular fa-angle-right"></i></button>
                      </div>
                    </div>
                    <div class="vertical_slider_4item" data-slick='{"dots": false}'>
                      <div class="slider_item">
                        <div class="small_product_layout">
                          <a class="item_image" href="{{ route('phone_lab.shop_details') }}">
                            <img src="{{ asset('assets/images/latest_product/latest_product_1.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          </a>
                          <div class="item_content">
                            <h3 class="item_title">
                              <a href="{{ route('phone_lab.shop_details') }}">Product Sample</a>
                            </h3>
                            <ul class="rating_star ul_li">
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                            </ul>
                            <div class="item_price">
                              <span>$690.99</span>
                              <del>$720.00</del>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="slider_item">
                        <div class="small_product_layout">
                          <a class="item_image" href="{{ route('phone_lab.shop_details') }}">
                            <img src="{{ asset('assets/images/latest_product/latest_product_2.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          </a>
                          <div class="item_content">
                            <h3 class="item_title">
                              <a href="{{ route('phone_lab.shop_details') }}">Product Sample</a>
                            </h3>
                            <ul class="rating_star ul_li">
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                            </ul>
                            <div class="item_price">
                              <span>$690.99</span>
                              <del>$720.00</del>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="slider_item">
                        <div class="small_product_layout">
                          <a class="item_image" href="{{ route('phone_lab.shop_details') }}">
                            <img src="{{ asset('assets/images/latest_product/latest_product_3.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          </a>
                          <div class="item_content">
                            <h3 class="item_title">
                              <a href="{{ route('phone_lab.shop_details') }}">Product Sample</a>
                            </h3>
                            <ul class="rating_star ul_li">
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                            </ul>
                            <div class="item_price">
                              <span>$690.99</span>
                              <del>$720.00</del>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="slider_item">
                        <div class="small_product_layout">
                          <a class="item_image" href="{{ route('phone_lab.shop_details') }}">
                            <img src="{{ asset('assets/images/latest_product/latest_product_4.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          </a>
                          <div class="item_content">
                            <h3 class="item_title">
                              <a href="{{ route('phone_lab.shop_details') }}">Product Sample</a>
                            </h3>
                            <ul class="rating_star ul_li">
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                            </ul>
                            <div class="item_price">
                              <span>$690.99</span>
                              <del>$720.00</del>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="slider_item">
                        <div class="small_product_layout">
                          <a class="item_image" href="{{ route('phone_lab.shop_details') }}">
                            <img src="{{ asset('assets/images/latest_product/latest_product_1.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          </a>
                          <div class="item_content">
                            <h3 class="item_title">
                              <a href="{{ route('phone_lab.shop_details') }}">Product Sample</a>
                            </h3>
                            <ul class="rating_star ul_li">
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                            </ul>
                            <div class="item_price">
                              <span>$690.99</span>
                              <del>$720.00</del>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="slider_item">
                        <div class="small_product_layout">
                          <a class="item_image" href="{{ route('phone_lab.shop_details') }}">
                            <img src="{{ asset('assets/images/latest_product/latest_product_2.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          </a>
                          <div class="item_content">
                            <h3 class="item_title">
                              <a href="{{ route('phone_lab.shop_details') }}">Product Sample</a>
                            </h3>
                            <ul class="rating_star ul_li">
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                            </ul>
                            <div class="item_price">
                              <span>$690.99</span>
                              <del>$720.00</del>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="slider_item">
                        <div class="small_product_layout">
                          <a class="item_image" href="{{ route('phone_lab.shop_details') }}">
                            <img src="{{ asset('assets/images/latest_product/latest_product_3.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          </a>
                          <div class="item_content">
                            <h3 class="item_title">
                              <a href="{{ route('phone_lab.shop_details') }}">Product Sample</a>
                            </h3>
                            <ul class="rating_star ul_li">
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                            </ul>
                            <div class="item_price">
                              <span>$690.99</span>
                              <del>$720.00</del>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="slider_item">
                        <div class="small_product_layout">
                          <a class="item_image" href="{{ route('phone_lab.shop_details') }}">
                            <img src="{{ asset('assets/images/latest_product/latest_product_4.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          </a>
                          <div class="item_content">
                            <h3 class="item_title">
                              <a href="{{ route('phone_lab.shop_details') }}">Product Sample</a>
                            </h3>
                            <ul class="rating_star ul_li">
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                              <li><i class="fa-solid fa-star"></i></li>
                            </ul>
                            <div class="item_price">
                              <span>$690.99</span>
                              <del>$720.00</del>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </aside>
              </div>
            </div>
          </div>
        </section>
        <!-- product_section - end
        ================================================== -->

       

      </main>
      <!-- main body - end
      ================================================== -->
@endsection