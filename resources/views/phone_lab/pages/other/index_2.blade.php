@extends('phone_lab.layouts.app')

@section('title', 'Home V.2 - Getyootech - Gadgets Ecommerce Site Template')

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

        <!-- slider_section - start
        ================================================== -->
        <section class="slider_section slider_2">
          <div class="container">
            <div class="row justify-content-end">
              <div class="col col-lg-9">
                <div class="main_slider" data-slick='{"arrows": false}'>
                  <div class="slider_item">
                    <div class="slider_content">
                      <h3 class="small_title" data-animation="fadeInUp2" data-delay=".2s">Tech Products</h3>
                      <h4 class="big_title" data-animation="fadeInUp2" data-delay=".4s">UP TO 30% OFF SPEAKERS</h4>
                      <p data-animation="fadeInUp2" data-delay=".6s">The Best Gadgets Collection 2024</p>
                      <div class="item_price" data-animation="fadeInUp2" data-delay=".6s">
                        <del>$520.00</del>
                        <span class="sale_price">$460.00</span>
                      </div>
                      <a class="btn btn_primary" href="{{ route('phone_lab.shop_details') }}" data-animation="fadeInUp2" data-delay=".8s">Start Buying</a>
                    </div>

                    <div class="slider_image" data-animation="fadeInRight" data-delay=".4s">
                      <img src="{{ asset('assets/images/slider/slider_image_2.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    </div>
                  </div>

                  <div class="slider_item">
                    <div class="slider_content">
                      <h3 class="small_title" data-animation="fadeInUp2" data-delay=".2s">Tech Products</h3>
                      <h4 class="big_title" data-animation="fadeInUp2" data-delay=".4s">UP TO 30% OFF SPEAKERS</h4>
                      <p data-animation="fadeInUp2" data-delay=".6s">The Best Gadgets Collection 2024</p>
                      <div class="item_price" data-animation="fadeInUp2" data-delay=".6s">
                        <del>$520.00</del>
                        <span class="sale_price">$460.00</span>
                      </div>
                      <a class="btn btn_primary" href="{{ route('phone_lab.shop_details') }}" data-animation="fadeInUp2" data-delay=".8s">Start Buying</a>
                    </div>

                    <div class="slider_image" data-animation="fadeInRight" data-delay=".4s">
                      <img src="{{ asset('assets/images/slider/slider_image_2.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    </div>
                  </div>

                  <div class="slider_item">
                    <div class="slider_content">
                      <h3 class="small_title" data-animation="fadeInUp2" data-delay=".2s">Tech Products</h3>
                      <h4 class="big_title" data-animation="fadeInUp2" data-delay=".4s">UP TO 30% OFF SPEAKERS</h4>
                      <p data-animation="fadeInUp2" data-delay=".6s">The Best Gadgets Collection 2024</p>
                      <div class="item_price" data-animation="fadeInUp2" data-delay=".6s">
                        <del>$520.00</del>
                        <span class="sale_price">$460.00</span>
                      </div>
                      <a class="btn btn_primary" href="{{ route('phone_lab.shop_details') }}" data-animation="fadeInUp2" data-delay=".8s">Start Buying</a>
                    </div>

                    <div class="slider_image" data-animation="fadeInRight" data-delay=".4s">
                      <img src="{{ asset('assets/images/slider/slider_image_2.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- slider_section - end
        ================================================== -->

        <!-- promotion_section - start
        ================================================== -->
        <section class="promotion_section">
          <div class="container">
            <div class="row">
              <div class="col col-lg-6">
                <div class="promotion_banner">
                  <div class="item_image">
                    <img src="{{ asset('assets/images/promotion/banner_img_1.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                  </div>
                  <div class="item_content">
                    <h3 class="item_title">Protective Sleeves</h3>
                    <p>
                      It is a long established fact that a reader will be distracted
                    </p>
                    <a class="btn btn_primary" href="{{ route('phone_lab.shop_details') }}">Shop Now</a>
                  </div>
                </div>
              </div>

              <div class="col col-lg-6">
                <div class="promotion_banner">
                  <div class="item_image">
                    <img src="{{ asset('assets/images/promotion/banner_img_2.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                  </div>
                  <div class="item_content">
                    <h3 class="item_title">Nutrillet Blender</h3>
                    <p>
                      It is a long established fact that a reader will be distracted
                    </p>
                    <a class="btn btn_primary" href="{{ route('phone_lab.shop_details') }}">Shop Now</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- promotion_section - end
        ================================================== -->

        <!-- viewed_products_section - start
        ================================================== -->
        <section class="viewed_products_section section_space pb-0">
          <div class="container">
            <div class="section_title mb-0">
              <h2 class="title_text"><i class="fa-duotone fa-trophy-star"></i> Recently Viewed Products</h2>
            </div>
            <div class="viewed_products_wrap arrows_topright">
              <div class="viewed_products_carousel row" data-slick='{"dots": false}'>
                <div class="slider_item col">
                  <div class="viewed_product_item">
                    <div class="item_image">
                      <img src="{{ asset('assets/images/viewed_products/viewed_product_img_1.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    </div>
                    <div class="item_content">
                      <h3 class="item_title">Electronics</h3>
                      <ul class="ul_li_block">
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Computers</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Laptop</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Macbook</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Accessories</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">More...</a></li>
                      </ul>
                    </div>
                  </div>

                  <div class="viewed_product_item">
                    <div class="item_image">
                      <img src="{{ asset('assets/images/viewed_products/viewed_product_img_2.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    </div>
                    <div class="item_content">
                      <h3 class="item_title">PC & Laptop</h3>
                      <ul class="ul_li_block">
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Computers</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Laptop</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Macbook</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Accessories</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">More...</a></li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="slider_item col">
                  <div class="viewed_product_item">
                    <div class="item_image">
                      <img src="{{ asset('assets/images/viewed_products/viewed_product_img_3.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    </div>
                    <div class="item_content">
                      <h3 class="item_title">Tables & Mobiles</h3>
                      <ul class="ul_li_block">
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Computers</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Laptop</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Macbook</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Accessories</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">More...</a></li>
                      </ul>
                    </div>
                  </div>

                  <div class="viewed_product_item">
                    <div class="item_image">
                      <img src="{{ asset('assets/images/viewed_products/viewed_product_img_4.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    </div>
                    <div class="item_content">
                      <h3 class="item_title">Accessories</h3>
                      <ul class="ul_li_block">
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Computers</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Laptop</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Macbook</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Accessories</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">More...</a></li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="slider_item col">
                  <div class="viewed_product_item">
                    <div class="item_image">
                      <img src="{{ asset('assets/images/viewed_products/viewed_product_img_5.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    </div>
                    <div class="item_content">
                      <h3 class="item_title">TV & Audio</h3>
                      <ul class="ul_li_block">
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Computers</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Laptop</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Macbook</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Accessories</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">More...</a></li>
                      </ul>
                    </div>
                  </div>

                  <div class="viewed_product_item">
                    <div class="item_image">
                      <img src="{{ asset('assets/images/viewed_products/viewed_product_img_6.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    </div>
                    <div class="item_content">
                      <h3 class="item_title">Gameing</h3>
                      <ul class="ul_li_block">
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Computers</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Laptop</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Macbook</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Accessories</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">More...</a></li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="slider_item col">
                  <div class="viewed_product_item">
                    <div class="item_image">
                      <img src="{{ asset('assets/images/viewed_products/viewed_product_img_1.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    </div>
                    <div class="item_content">
                      <h3 class="item_title">Electronics</h3>
                      <ul class="ul_li_block">
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Computers</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Laptop</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Macbook</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Accessories</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">More...</a></li>
                      </ul>
                    </div>
                  </div>

                  <div class="viewed_product_item">
                    <div class="item_image">
                      <img src="{{ asset('assets/images/viewed_products/viewed_product_img_2.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    </div>
                    <div class="item_content">
                      <h3 class="item_title">PC & Laptop</h3>
                      <ul class="ul_li_block">
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Computers</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Laptop</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Macbook</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Accessories</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">More...</a></li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="slider_item col">
                  <div class="viewed_product_item">
                    <div class="item_image">
                      <img src="{{ asset('assets/images/viewed_products/viewed_product_img_3.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    </div>
                    <div class="item_content">
                      <h3 class="item_title">Tables & Mobiles</h3>
                      <ul class="ul_li_block">
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Computers</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Laptop</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Macbook</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Accessories</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">More...</a></li>
                      </ul>
                    </div>
                  </div>

                  <div class="viewed_product_item">
                    <div class="item_image">
                      <img src="{{ asset('assets/images/viewed_products/viewed_product_img_4.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    </div>
                    <div class="item_content">
                      <h3 class="item_title">Accessories</h3>
                      <ul class="ul_li_block">
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Computers</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Laptop</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Macbook</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Accessories</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">More...</a></li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="slider_item col">
                  <div class="viewed_product_item">
                    <div class="item_image">
                      <img src="{{ asset('assets/images/viewed_products/viewed_product_img_5.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    </div>
                    <div class="item_content">
                      <h3 class="item_title">TV & Audio</h3>
                      <ul class="ul_li_block">
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Computers</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Laptop</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Macbook</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Accessories</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">More...</a></li>
                      </ul>
                    </div>
                  </div>

                  <div class="viewed_product_item">
                    <div class="item_image">
                      <img src="{{ asset('assets/images/viewed_products/viewed_product_img_6.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    </div>
                    <div class="item_content">
                      <h3 class="item_title">Gameing</h3>
                      <ul class="ul_li_block">
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Computers</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Laptop</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Macbook</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">Accessories</a></li>
                        <li><a href="{{ route('phone_lab.shop_grid') }}">More...</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel_nav">
                <button type="button" class="vpc_left_arrow"><i class="fa-regular fa-angle-left"></i></button>
                <button type="button" class="vpc_right_arrow"><i class="fa-regular fa-angle-right"></i></button>
              </div>
            </div>
          </div>
        </section>
        <!-- viewed_products_section - end
        ================================================== -->

        <!-- new_arrivals_section - start
        ================================================== -->
        <section class="new_arrivals_section section_space">
          <div class="container">
            <div class="section_title mb-0">
              <h2 class="title_text"><i class="fa-duotone fa-sparkles"></i> New Arrivals</h2>
            </div>
            <div class="row newarrivals_products">
              <div class="col col-lg-5">
                <div class="deals_product_layout2 text-center">
                  <a class="global_link" href="{{ route('phone_lab.shop_details') }}"></a>
                  <div class="bg_area">
                    <div class="item_image">
                      <img src="{{ asset('assets/images/deals/deals_product_2.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    </div>
                    <div class="offter_type text-start">
                      <span>Special</span>
                      <span>Offer</span>
                    </div>
                    <div class="item_badge">
                      <span>Save <strong>30%</strong></span>
                    </div>
                    <div class="item_price">
                      <span>$520.00</span>
                      <del>$620.00</del>
                    </div>
                    <h3 class="item_title">VR Vase</h3>
                    <div class="available_content_wrap">
                      <span>Already Sold : <strong>7</strong></span>
                      <span>Available : <strong>38</strong></span>
                    </div>
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="countdown_wrap">
                      <span class="title_text">Hurry Up ! Offer ends in</span>
                      <ul class="countdown_timer ul_li_center" data-countdown="2025/3/24"></ul>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col col-lg-7">
                <div class="new_arrivals_carousel arrows_topright">
                  <div class="common_carousel_2" data-slick='{"dots": false}'>
                    <div class="slider_item">
                      <div class="product_layout1">
                        <div class="item_badge sale_badge">
                          <span>SALE</span>
                        </div>
                        <div class="item_image">
                          <img src="{{ asset('assets/images/shop/product_img_1.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <img src="{{ asset('assets/images/shop/product_img_4.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                            <span>$690.99</span>
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
                          <img src="{{ asset('assets/images/shop/product_img_4.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <img src="{{ asset('assets/images/shop/product_img_1.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <a class="quickview_btn" data-bs-toggle="modal" href="#quickview_popup" role="button">Quick View</a>
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
                          <div class="item_price">
                            <span>$690.99</span>
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

                    <div class="slider_item">
                      <div class="product_layout1">
                        <div class="item_image">
                          <img src="{{ asset('assets/images/shop/product_img_2.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <img src="{{ asset('assets/images/shop/product_img_5.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                        <div class="item_image">
                          <img src="{{ asset('assets/images/shop/product_img_5.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <img src="{{ asset('assets/images/shop/product_img_2.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <a class="quickview_btn" data-bs-toggle="modal" href="#quickview_popup" role="button">Quick View</a>
                        </div>
                        <div class="item_content">
                          <h3 class="item_title">
                            <a href="{{ route('phone_lab.shop_details') }}">Fashionable Touch</a>
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

                    <div class="slider_item">
                      <div class="product_layout1">
                        <div class="item_badge hot_badge">
                          <span>NEW</span>
                        </div>
                        <div class="item_image">
                          <img src="{{ asset('assets/images/shop/product_img_3.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                          <img src="{{ asset('assets/images/shop/product_img_6.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <img src="{{ asset('assets/images/shop/product_img_3.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <a class="quickview_btn" data-bs-toggle="modal" href="#quickview_popup" role="button">Quick View</a>
                        </div>
                        <div class="item_content">
                          <h3 class="item_title">
                            <a href="{{ route('phone_lab.shop_details') }}">Samsung Galaxy Note IV</a>
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

                    <div class="slider_item">
                      <div class="product_layout1">
                        <div class="item_badge sale_badge">
                          <span>SALE</span>
                        </div>
                        <div class="item_image">
                          <img src="{{ asset('assets/images/shop/product_img_1.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <img src="{{ asset('assets/images/shop/product_img_4.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                            <span>$690.99</span>
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
                          <img src="{{ asset('assets/images/shop/product_img_4.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <img src="{{ asset('assets/images/shop/product_img_1.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <a class="quickview_btn" data-bs-toggle="modal" href="#quickview_popup" role="button">Quick View</a>
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
                          <div class="item_price">
                            <span>$690.99</span>
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

                    <div class="slider_item">
                      <div class="product_layout1">
                        <div class="item_image">
                          <img src="{{ asset('assets/images/shop/product_img_2.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <img src="{{ asset('assets/images/shop/product_img_5.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                        <div class="item_image">
                          <img src="{{ asset('assets/images/shop/product_img_5.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <img src="{{ asset('assets/images/shop/product_img_2.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <a class="quickview_btn" data-bs-toggle="modal" href="#quickview_popup" role="button">Quick View</a>
                        </div>
                        <div class="item_content">
                          <h3 class="item_title">
                            <a href="{{ route('phone_lab.shop_details') }}">Fashionable Touch</a>
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

                    <div class="slider_item">
                      <div class="product_layout1">
                        <div class="item_badge hot_badge">
                          <span>NEW</span>
                        </div>
                        <div class="item_image">
                          <img src="{{ asset('assets/images/shop/product_img_3.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                          <img src="{{ asset('assets/images/shop/product_img_6.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <img src="{{ asset('assets/images/shop/product_img_3.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <a class="quickview_btn" data-bs-toggle="modal" href="#quickview_popup" role="button">Quick View</a>
                        </div>
                        <div class="item_content">
                          <h3 class="item_title">
                            <a href="{{ route('phone_lab.shop_details') }}">Samsung Galaxy Note IV</a>
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
                  </div>

                  <div class="carousel_nav">
                    <button type="button" class="cc2_left_arrow"><i class="fa-regular fa-angle-left"></i></button>
                    <button type="button" class="cc2_right_arrow"><i class="fa-regular fa-angle-right"></i></button>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </section>
        <!-- new_arrivals_section - end
        ================================================== -->

        <!-- product_section - start
        ================================================== -->
        <div class="container">
          <div class="row">
            <div class="col col-lg-3">
              <div class="row">
                <div class="col col-lg-12 col-md-6">
                  <div class="latest_product_carousel">
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
                </div>
                <div class="col col-lg-12 col-md-6">
                  <div class="blog_carousel_wrap">
                    <div class="title_wrap">
                      <h3 class="area_title">From the Blog</h3>
                      <div class="carousel_nav">
                        <button type="button" class="cc1_left_arrow"><i class="fa-regular fa-angle-left"></i></button>
                        <button type="button" class="cc1_right_arrow"><i class="fa-regular fa-angle-right"></i></button>
                      </div>
                    </div>
                    <div class="common_carousel_1" data-slick='{"dots": false}'>
                      <div class="slider_item">
                        <div class="blog_standard_small">
                          <a class="item_image" href="{{ route('phone_lab.blog_details') }}">
                            <img src="{{ asset('assets/images/blog/blog_1.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          </a>
                          <div class="item_content">
                            <ul class="post_meta ul_li">
                              <li>17 July 2024</li>
                              <li><a href="#!">admin</a></li>
                            </ul>
                            <h3 class="item_title">
                              <a href="{{ route('phone_lab.blog_details') }}">Aypi non habent claritatem insitam</a>
                            </h3>
                            <p>
                              It is a long established fact that a reader will be distracted eget velit. Donec ac tempus ante. 
                            </p>
                          </div>
                        </div>
                      </div>

                      <div class="slider_item">
                        <div class="blog_standard_small">
                          <a class="item_image" href="{{ route('phone_lab.blog_details') }}">
                            <img src="{{ asset('assets/images/blog/blog_1.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          </a>
                          <div class="item_content">
                            <ul class="post_meta ul_li">
                              <li>17 July 2024</li>
                              <li><a href="#!">admin</a></li>
                            </ul>
                            <h3 class="item_title">
                              <a href="{{ route('phone_lab.blog_details') }}">Aypi non habent claritatem insitam</a>
                            </h3>
                            <p>
                              It is a long established fact that a reader will be distracted eget velit. Donec ac tempus ante. 
                            </p>
                          </div>
                        </div>
                      </div>

                      <div class="slider_item">
                        <div class="blog_standard_small">
                          <a class="item_image" href="{{ route('phone_lab.blog_details') }}">
                            <img src="{{ asset('assets/images/blog/blog_1.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          </a>
                          <div class="item_content">
                            <ul class="post_meta ul_li">
                              <li>17 July 2024</li>
                              <li><a href="#!">admin</a></li>
                            </ul>
                            <h3 class="item_title">
                              <a href="{{ route('phone_lab.blog_details') }}">Aypi non habent claritatem insitam</a>
                            </h3>
                            <p>
                              It is a long established fact that a reader will be distracted eget velit. Donec ac tempus ante. 
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col col-lg-9">
              <div class="promotion_banner2">
                <a class="global_link" href="{{ route('phone_lab.shop_details') }}"></a>
                <div class="item_content">
                  <h3 class="item_subtitle">Sale Offer <span>- 20%</span> Off This Week</h3>
                  <h4 class="item_title">
                    <span class="d-block">
                      Accessories
                    </span>
                    Naturally Colorful 2024
                  </h4>
                  <div class="item_price"><small>Starting at</small> $1024.00</div>
                </div>
                <div class="item_image">
                  <img src="{{ asset('assets/images/promotion/banner_img_3.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                </div>
              </div>

              <div class="product_wrap">
                <div class="product_layout1">
                  <div class="item_badge hot_badge">
                    <span>SALE</span>
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
                    <span>SALE</span>
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
                    <img src="{{ asset('assets/images/shop/product_img_14.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    <img src="{{ asset('assets/images/shop/product_img_9.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                    <img src="{{ asset('assets/images/shop/product_img_9.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    <img src="{{ asset('assets/images/shop/product_img_14.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                  <div class="item_image">
                    <img src="{{ asset('assets/images/shop/product_img_15.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    <img src="{{ asset('assets/images/shop/product_img_16.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                  <div class="item_badge new_badge">
                    <span>NEW</span>
                  </div>
                  <div class="item_image">
                    <img src="{{ asset('assets/images/shop/product_img_16.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    <img src="{{ asset('assets/images/shop/product_img_15.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
              </div>
            </div>
          </div>
        </div>
        <!-- product_section - end
        ================================================== -->

        <!-- brand_section - start
        ================================================== -->
        <div class="brand_section section_space">
          <div class="container">
            <div class="brand_carousel">
              <div class="slider_item">
                <a class="product_brand_logo" href="#!">
                  <img src="{{ asset('assets/images/brand/brand_1.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                  <img src="{{ asset('assets/images/brand/brand_1.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                </a>
              </div>
              <div class="slider_item">
                <a class="product_brand_logo" href="#!">
                  <img src="{{ asset('assets/images/brand/brand_2.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                  <img src="{{ asset('assets/images/brand/brand_2.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                </a>
              </div>
              <div class="slider_item">
                <a class="product_brand_logo" href="#!">
                  <img src="{{ asset('assets/images/brand/brand_3.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                  <img src="{{ asset('assets/images/brand/brand_3.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                </a>
              </div>
              <div class="slider_item">
                <a class="product_brand_logo" href="#!">
                  <img src="{{ asset('assets/images/brand/brand_4.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                  <img src="{{ asset('assets/images/brand/brand_4.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                </a>
              </div>
              <div class="slider_item">
                <a class="product_brand_logo" href="#!">
                  <img src="{{ asset('assets/images/brand/brand_5.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                  <img src="{{ asset('assets/images/brand/brand_5.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- brand_section - end
        ================================================== -->

       

       

      </main>
      <!-- main body - end
      ================================================== -->
@endsection