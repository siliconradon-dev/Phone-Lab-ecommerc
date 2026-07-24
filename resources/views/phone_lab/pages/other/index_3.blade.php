@extends('phone_lab.layouts.app')

@section('title', 'Home V.3 - Getyootech - Gadgets Ecommerce Site Template')

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
        <section class="slider_section slider_3">
          <div class="main_slider mb-0" data-slick='{"arrows": false}'>
            <div class="slider_item">
              <div class="container">
                <div class="row align-items-center justify-content-lg-between">
                  <div class="col col-lg-4">
                    <div class="slider_image" data-animation="fadeInLeft" data-delay=".4s">
                      <img src="{{ asset('assets/images/slider/slider_image_3.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    </div>
                  </div>

                  <div class="col col-lg-4">
                    <div class="slider_content text-center">
                      <h3 class="small_title" data-animation="fadeInUp2" data-delay=".2s">Tech Products</h3>
                      <h4 class="big_title" data-animation="fadeInUp2" data-delay=".4s">Clothing UP TO 30% OFF SPEAKERS</h4>
                      <p data-animation="fadeInUp2" data-delay=".6s">The Best Gadgets Collection 2024</p>
                      <div class="item_price justify-content-center" data-animation="fadeInUp2" data-delay=".6s">
                        <del>$520.00</del>
                        <span class="sale_price">$460.00</span>
                      </div>
                      <a class="btn btn_primary" href="{{ route('phone_lab.shop_details') }}" data-animation="fadeInUp2" data-delay=".8s">Start Buying</a>
                    </div>
                  </div>

                  <div class="col col-lg-4">
                    <div class="slider_image" data-animation="fadeInRight" data-delay=".4s">
                      <img src="{{ asset('assets/images/slider/slider_image_4.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="slider_item">
              <div class="container">
                <div class="row align-items-center justify-content-lg-between">
                  <div class="col col-lg-4">
                    <div class="slider_image" data-animation="fadeInLeft" data-delay=".4s">
                      <img src="{{ asset('assets/images/slider/slider_image_3.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    </div>
                  </div>

                  <div class="col col-lg-4">
                    <div class="slider_content text-center">
                      <h3 class="small_title" data-animation="fadeInUp2" data-delay=".2s">Tech Products</h3>
                      <h4 class="big_title" data-animation="fadeInUp2" data-delay=".4s">Clothing UP TO 30% OFF SPEAKERS</h4>
                      <p data-animation="fadeInUp2" data-delay=".6s">The Best Gadgets Collection 2024</p>
                      <div class="item_price justify-content-center" data-animation="fadeInUp2" data-delay=".6s">
                        <del>$520.00</del>
                        <span class="sale_price">$460.00</span>
                      </div>
                      <a class="btn btn_primary" href="{{ route('phone_lab.shop_details') }}" data-animation="fadeInUp2" data-delay=".8s">Start Buying</a>
                    </div>
                  </div>

                  <div class="col col-lg-4">
                    <div class="slider_image" data-animation="fadeInRight" data-delay=".4s">
                      <img src="{{ asset('assets/images/slider/slider_image_4.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="slider_item">
              <div class="container">
                <div class="row align-items-center justify-content-lg-between">
                  <div class="col col-lg-4">
                    <div class="slider_image" data-animation="fadeInLeft" data-delay=".4s">
                      <img src="{{ asset('assets/images/slider/slider_image_3.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    </div>
                  </div>

                  <div class="col col-lg-4">
                    <div class="slider_content text-center">
                      <h3 class="small_title" data-animation="fadeInUp2" data-delay=".2s">Tech Products</h3>
                      <h4 class="big_title" data-animation="fadeInUp2" data-delay=".4s">Clothing UP TO 30% OFF SPEAKERS</h4>
                      <p data-animation="fadeInUp2" data-delay=".6s">The Best Gadgets Collection 2024</p>
                      <div class="item_price justify-content-center" data-animation="fadeInUp2" data-delay=".6s">
                        <del>$520.00</del>
                        <span class="sale_price">$460.00</span>
                      </div>
                      <a class="btn btn_primary" href="{{ route('phone_lab.shop_details') }}" data-animation="fadeInUp2" data-delay=".8s">Start Buying</a>
                    </div>
                  </div>

                  <div class="col col-lg-4">
                    <div class="slider_image" data-animation="fadeInRight" data-delay=".4s">
                      <img src="{{ asset('assets/images/slider/slider_image_4.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="slider_item">
              <div class="container">
                <div class="row align-items-center justify-content-lg-between">
                  <div class="col col-lg-4">
                    <div class="slider_image" data-animation="fadeInLeft" data-delay=".4s">
                      <img src="{{ asset('assets/images/slider/slider_image_3.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    </div>
                  </div>

                  <div class="col col-lg-4">
                    <div class="slider_content text-center">
                      <h3 class="small_title" data-animation="fadeInUp2" data-delay=".2s">Tech Products</h3>
                      <h4 class="big_title" data-animation="fadeInUp2" data-delay=".4s">Clothing UP TO 30% OFF SPEAKERS</h4>
                      <p data-animation="fadeInUp2" data-delay=".6s">The Best Gadgets Collection 2024</p>
                      <div class="item_price justify-content-center" data-animation="fadeInUp2" data-delay=".6s">
                        <del>$520.00</del>
                        <span class="sale_price">$460.00</span>
                      </div>
                      <a class="btn btn_primary" href="{{ route('phone_lab.shop_details') }}" data-animation="fadeInUp2" data-delay=".8s">Start Buying</a>
                    </div>
                  </div>

                  <div class="col col-lg-4">
                    <div class="slider_image" data-animation="fadeInRight" data-delay=".4s">
                      <img src="{{ asset('assets/images/slider/slider_image_4.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
        <section class="promotion_section section_space pt-5">
          <div class="container">
            <div class="row promotion_banner_wrap">
              <div class="col col-lg-6">
                <div class="promotion_banner3 big_item">
                  <div class="item_badge">
                    <div class="text-center">
                      <span>Save</span>
                      <strong>30%</strong>
                    </div>
                  </div>
                  <a href="{{ route('phone_lab.product_details') }}" class="global_link"></a>
                  <div class="item_content">
                    <h3 class="item_subtitle">Featured Product</h3>
                    <h4 class="item_title">Branding Laptop</h4>
                  </div>
                  <div class="item_image justify-content-end">
                    <img src="{{ asset('assets/images/promotion/banner_img_4.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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

                <div class="row">
                  <div class="col col-md-6 col-sm-6">
                    <div class="promotion_banner3">
                      <a href="{{ route('phone_lab.product_details') }}" class="global_link"></a>
                      <div class="item_content">
                        <h3 class="item_subtitle">Featured Product</h3>
                        <h4 class="item_title">iPhone</h4>
                      </div>
                      <div class="item_image justify-content-end">
                        <img src="{{ asset('assets/images/promotion/banner_img_5.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                      </div>
                    </div>
                  </div>

                  <div class="col col-md-6 col-sm-6">
                    <div class="promotion_banner3">
                      <a href="{{ route('phone_lab.product_details') }}" class="global_link"></a>
                      <div class="item_content">
                        <h3 class="item_subtitle">Featured Product</h3>
                        <h4 class="item_title">CC TV Camera</h4>
                      </div>
                      <div class="item_image justify-content-center">
                        <img src="{{ asset('assets/images/promotion/banner_img_6.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- promotion_section - end
        ================================================== -->

        <!-- product_section - start
        ================================================== -->
        <section class="product_section">
          <div class="container">
            <ul class="tabs_nav nav" role="tablist">
              <li role="presentation">
                <button class="active" data-bs-toggle="tab" data-bs-target="#bestseller_tab" type="button" role="tab" aria-selected="true">Best Seller</button>
              </li>
              <li role="presentation">
                <button data-bs-toggle="tab" data-bs-target="#ourproduct_tab" type="button" role="tab" aria-selected="false">Our Product</button>
              </li>
              <li role="presentation">
                <button data-bs-toggle="tab" data-bs-target="#newproduct_tab" type="button" role="tab" aria-selected="false">New Product</button>
              </li>
              <li role="presentation">
                <button data-bs-toggle="tab" data-bs-target="#hotdeal_tab" type="button" role="tab" aria-selected="false">Hot Deal</button>
              </li>
            </ul>

            <div class="tab-content tad_has_carousel">
              <div class="tab-pane fade show active" id="bestseller_tab" role="tabpanel">
                <div class="product_carousel_wrap arrows_topright">
                  <div class="best_seller_carousel" data-slick='{"dots": false}'>
                    <div class="product_layout1">
                      <div class="item_badge sale_badge">
                        <span>SALE</span>
                      </div>
                      <div class="item_image">
                        <img src="{{ asset('assets/images/shop/product_img_6.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_7.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                        <img src="{{ asset('assets/images/shop/product_img_7.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_6.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                        <img src="{{ asset('assets/images/shop/product_img_8.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_9.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                        <img src="{{ asset('assets/images/shop/product_img_9.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_8.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                      <div class="item_badge hot_badge">
                        <span>HOT</span>
                      </div>
                      <div class="item_image">
                        <img src="{{ asset('assets/images/shop/product_img_10.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_6.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                      <div class="item_badge sale_badge">
                        <span>SALE</span>
                      </div>
                      <div class="item_image">
                        <img src="{{ asset('assets/images/shop/product_img_6.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_10.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                        <img src="{{ asset('assets/images/shop/product_img_7.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_8.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                        <img src="{{ asset('assets/images/shop/product_img_8.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_7.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                        <img src="{{ asset('assets/images/shop/product_img_9.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_10.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                      <div class="item_badge hot_badge">
                        <span>HOT</span>
                      </div>
                      <div class="item_image">
                        <img src="{{ asset('assets/images/shop/product_img_10.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_9.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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

                  <div class="carousel_nav">
                    <button type="button" class="bsc_left_arrow"><i class="fa-regular fa-angle-left"></i></button>
                    <button type="button" class="bsc_right_arrow"><i class="fa-regular fa-angle-right"></i></button>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="ourproduct_tab" role="tabpanel">
                <div class="product_carousel_wrap arrows_topright">
                  <div class="common_carousel_3" data-slick='{"dots": false}'>
                    <div class="product_layout1">
                      <div class="item_badge sale_badge">
                        <span>SALE</span>
                      </div>
                      <div class="item_image">
                        <img src="{{ asset('assets/images/shop/product_img_6.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_7.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                        <img src="{{ asset('assets/images/shop/product_img_7.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_6.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                        <img src="{{ asset('assets/images/shop/product_img_8.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_9.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                        <img src="{{ asset('assets/images/shop/product_img_9.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_8.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                      <div class="item_badge hot_badge">
                        <span>HOT</span>
                      </div>
                      <div class="item_image">
                        <img src="{{ asset('assets/images/shop/product_img_10.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_6.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                      <div class="item_badge sale_badge">
                        <span>SALE</span>
                      </div>
                      <div class="item_image">
                        <img src="{{ asset('assets/images/shop/product_img_6.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_10.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                        <img src="{{ asset('assets/images/shop/product_img_7.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_8.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                        <img src="{{ asset('assets/images/shop/product_img_8.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_7.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                        <img src="{{ asset('assets/images/shop/product_img_9.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_10.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                      <div class="item_badge hot_badge">
                        <span>HOT</span>
                      </div>
                      <div class="item_image">
                        <img src="{{ asset('assets/images/shop/product_img_10.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_9.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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

                  <div class="carousel_nav">
                    <button type="button" class="cc3_left_arrow"><i class="fa-regular fa-angle-left"></i></button>
                    <button type="button" class="cc3_right_arrow"><i class="fa-regular fa-angle-right"></i></button>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="newproduct_tab" role="tabpanel">
                <div class="product_carousel_wrap arrows_topright">
                  <div class="new_product_carousel" data-slick='{"dots": false}'>
                    <div class="product_layout1">
                      <div class="item_badge sale_badge">
                        <span>SALE</span>
                      </div>
                      <div class="item_image">
                        <img src="{{ asset('assets/images/shop/product_img_6.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_7.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                        <img src="{{ asset('assets/images/shop/product_img_7.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_6.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                        <img src="{{ asset('assets/images/shop/product_img_8.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_9.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                        <img src="{{ asset('assets/images/shop/product_img_9.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_8.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                      <div class="item_badge hot_badge">
                        <span>HOT</span>
                      </div>
                      <div class="item_image">
                        <img src="{{ asset('assets/images/shop/product_img_10.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_6.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                      <div class="item_badge sale_badge">
                        <span>SALE</span>
                      </div>
                      <div class="item_image">
                        <img src="{{ asset('assets/images/shop/product_img_6.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_10.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                        <img src="{{ asset('assets/images/shop/product_img_7.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_8.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                        <img src="{{ asset('assets/images/shop/product_img_8.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_7.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                        <img src="{{ asset('assets/images/shop/product_img_9.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_10.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                      <div class="item_badge hot_badge">
                        <span>HOT</span>
                      </div>
                      <div class="item_image">
                        <img src="{{ asset('assets/images/shop/product_img_10.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_9.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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

                  <div class="carousel_nav">
                    <button type="button" class="npc_left_arrow"><i class="fa-regular fa-angle-left"></i></button>
                    <button type="button" class="npc_right_arrow"><i class="fa-regular fa-angle-right"></i></button>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="hotdeal_tab" role="tabpanel">
                <div class="product_carousel_wrap arrows_topright">
                  <div class="hot_deal_carousel" data-slick='{"dots": false}'>
                    <div class="product_layout1">
                      <div class="item_badge sale_badge">
                        <span>SALE</span>
                      </div>
                      <div class="item_image">
                        <img src="{{ asset('assets/images/shop/product_img_6.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_7.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                        <img src="{{ asset('assets/images/shop/product_img_7.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_6.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                        <img src="{{ asset('assets/images/shop/product_img_8.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_9.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                        <img src="{{ asset('assets/images/shop/product_img_9.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_8.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                      <div class="item_badge hot_badge">
                        <span>HOT</span>
                      </div>
                      <div class="item_image">
                        <img src="{{ asset('assets/images/shop/product_img_10.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_6.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                      <div class="item_badge sale_badge">
                        <span>SALE</span>
                      </div>
                      <div class="item_image">
                        <img src="{{ asset('assets/images/shop/product_img_6.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_10.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                        <img src="{{ asset('assets/images/shop/product_img_7.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_8.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                        <img src="{{ asset('assets/images/shop/product_img_8.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_7.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                        <img src="{{ asset('assets/images/shop/product_img_9.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_10.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                      <div class="item_badge hot_badge">
                        <span>HOT</span>
                      </div>
                      <div class="item_image">
                        <img src="{{ asset('assets/images/shop/product_img_10.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        <img src="{{ asset('assets/images/shop/product_img_9.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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

                  <div class="carousel_nav">
                    <button type="button" class="hdc_left_arrow"><i class="fa-regular fa-angle-left"></i></button>
                    <button type="button" class="hdc_right_arrow"><i class="fa-regular fa-angle-right"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- product_section - end
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

        <!-- calltoaction_section - start
        ================================================== -->
        <section class="calltoaction_section section_space" style="background-image: url('assets/images/calltoaction/bg_1.html');">
          <div class="container">
            <div class="row align-items-center">
              <div class="col col-lg-6 order-last">
                <div class="item_image">
                  <img src="{{ asset('assets/images/calltoaction/controlar.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                </div>
              </div>
              <div class="col col-lg-6">
                <div class="item_content">
                  <h2>Gaming Accessories</h2>
                  <h3>Sonny PlayStation DUALSHOCK 4 Wireless Multy Color Controller</h3>
                  <div class="item_price">
                    <span class="sale_price">$580.99</span>
                    <del>$630.99</del>
                  </div>
                  <a class="btn btn_primary" href="{{ route('phone_lab.product_details') }}">Start Buying</a>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- calltoaction_section - end
        ================================================== -->

        <!-- category_section - start
        ================================================== -->
        <section class="category_section section_space pb-0">
          <div class="container">
            <div class="section_title mb-0">
              <h2 class="title_text"><i class="fa-duotone fa-fire"></i> Top Categories</h2>
            </div>
            <div class="top_category_wrap arrows_topright">
              <div class="top_category_carousel" data-slick='{"dots": false}'>
                <div class="slider_item">
                  <div class="category_boxed">
                    <a href="{{ route('phone_lab.shop_grid') }}">
                      <span class="item_image">
                        <img src="{{ asset('assets/images/categories/category_1.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                      </span>
                      <span class="item_title">Smart Watches</span>
                    </a>
                  </div>
                </div>

                <div class="slider_item">
                  <div class="category_boxed">
                    <a href="{{ route('phone_lab.shop_grid') }}">
                      <span class="item_image">
                        <img src="{{ asset('assets/images/categories/category_2.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                      </span>
                      <span class="item_title">Handy Camera</span>
                    </a>
                  </div>
                </div>

                <div class="slider_item">
                  <div class="category_boxed">
                    <a href="{{ route('phone_lab.shop_grid') }}">
                      <span class="item_image">
                        <img src="{{ asset('assets/images/categories/category_3.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                      </span>
                      <span class="item_title">CCTV  Camera</span>
                    </a>
                  </div>
                </div>

                <div class="slider_item">
                  <div class="category_boxed">
                    <a href="{{ route('phone_lab.shop_grid') }}">
                      <span class="item_image">
                        <img src="{{ asset('assets/images/categories/category_4.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                      </span>
                      <span class="item_title">Headphones</span>
                    </a>
                  </div>
                </div>

                <div class="slider_item">
                  <div class="category_boxed">
                    <a href="{{ route('phone_lab.shop_grid') }}">
                      <span class="item_image">
                        <img src="{{ asset('assets/images/categories/category_5.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                      </span>
                      <span class="item_title">Zambo Speaker</span>
                    </a>
                  </div>
                </div>

                <div class="slider_item">
                  <div class="category_boxed">
                    <a href="{{ route('phone_lab.shop_grid') }}">
                      <span class="item_image">
                        <img src="{{ asset('assets/images/categories/category_1.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                      </span>
                      <span class="item_title">Smart Watches</span>
                    </a>
                  </div>
                </div>

                <div class="slider_item">
                  <div class="category_boxed">
                    <a href="{{ route('phone_lab.shop_grid') }}">
                      <span class="item_image">
                        <img src="{{ asset('assets/images/categories/category_2.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                      </span>
                      <span class="item_title">Handy Camera</span>
                    </a>
                  </div>
                </div>

                <div class="slider_item">
                  <div class="category_boxed">
                    <a href="{{ route('phone_lab.shop_grid') }}">
                      <span class="item_image">
                        <img src="{{ asset('assets/images/categories/category_3.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                      </span>
                      <span class="item_title">CCTV  Camera</span>
                    </a>
                  </div>
                </div>

                <div class="slider_item">
                  <div class="category_boxed">
                    <a href="{{ route('phone_lab.shop_grid') }}">
                      <span class="item_image">
                        <img src="{{ asset('assets/images/categories/category_4.webp') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                      </span>
                      <span class="item_title">Headphones</span>
                    </a>
                  </div>
                </div>

                <div class="slider_item">
                  <div class="category_boxed">
                    <a href="{{ route('phone_lab.shop_grid') }}">
                      <span class="item_image">
                        <img src="{{ asset('assets/images/categories/category_5.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                      </span>
                      <span class="item_title">Zambo Speaker</span>
                    </a>
                  </div>
                </div>
              </div>
              <div class="carousel_nav">
                <button type="button" class="tc_left_arrow"><i class="fa-regular fa-angle-left"></i></button>
                <button type="button" class="tc_right_arrow"><i class="fa-regular fa-angle-right"></i></button>
              </div>
            </div>

          </div>
        </section>
        <!-- category_section - end
        ================================================== -->

        <!-- viewed_products_section - start
        ================================================== -->
        <section class="viewed_products_section section_space">
          <div class="container">
            <div class="section_title mb-0">
              <h2 class="title_text"><i class="fa-duotone fa-eye"></i> Recently Viewed Products</h2>
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

        <!-- policy_section - start
        ================================================== -->
        <section class="policy_section">
          <div class="policy_item">
            <div class="item_icon">
              <i class="icon icon-Truck"></i>
            </div>
            <div class="item_content">
              <h3 class="item_title">Free Shipping</h3>
              <p>
                Free shipping on all US order
              </p>
            </div>
          </div>

          <div class="policy_item">
            <div class="item_icon">
              <i class="icon icon-Headset"></i>
            </div>
            <div class="item_content">
              <h3 class="item_title">Support 24/7</h3>
              <p>
                Contact us 24 hours a day
              </p>
            </div>
          </div>

          <div class="policy_item">
            <div class="item_icon">
              <i class="icon icon-Wallet"></i>
            </div>
            <div class="item_content">
              <h3 class="item_title">100% Money Back</h3>
              <p>
                You have 30 days to Return
              </p>
            </div>
          </div>

          <div class="policy_item">
            <div class="item_icon">
              <i class="fa-light fa-rocket"></i>
            </div>
            <div class="item_content">
              <h3 class="item_title">30 Days Return</h3>
              <p>
                If goods have problems
              </p>
            </div>
          </div>

          <div class="policy_item">
            <div class="item_icon">
              <i class="icon icon-Dollars"></i>
            </div>
            <div class="item_content">
              <h3 class="item_title">Payment Secure</h3>
              <p>
                We ensure secure payment
              </p>
            </div>
          </div>
        </section>
        <!-- policy_section - end
        ================================================== -->

        <!-- promotion_section - start
        ================================================== -->
        <section class="promotion_section section_space">
          <div class="container">
            <div class="row promotion_banner_wrap">
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

       

      </main>
      <!-- main body - end
      ================================================== -->
@endsection