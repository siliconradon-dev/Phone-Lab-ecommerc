@extends('phone_lab.layouts.app')

@section('title', 'Blog Masonry - Getyootech - Gadgets Ecommerce Site Template')

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
              <li>Blog Masonry</li>
            </ul>
          </div>
        </div>
        <!-- breadcrumb_section - end
        ================================================== -->

        <!-- blog_section - start
        ================================================== -->
        <section class="blog_section section_space">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col col-lg-4">
                <div class="bolg_standard border-0 pb-0">
                  <a class="item_image" href="{{ route('phone_lab.blog_details') }}">
                    <img src="{{ asset('assets/images/blog/blog_12.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                  </a>
                  <div class="item_content">
                    <ul class="post_meta ul_li">
                      <li>17 July 2024</li>
                      <li><a href="#!">admin</a></li>
                      <li>
                        <ul class="category_list ul_li">
                          <li><a href="#!">Company</a></li>
                          <li><a href="#!">Travel</a></li>
                        </ul>
                      </li>
                    </ul>
                    <h3 class="item_title">
                      <a href="{{ route('phone_lab.blog_details') }}">Aypi non habent claritatem insitam</a>
                    </h3>
                    <p>
                      It is a long established fact that a reader will be distracted eget velit. Donec ac tempus ante. Fusce ultricies massa massa. Fusce aliquam, purus eget sagittis vulputate, sapien libero hendrerit est, 
                    </p>
                    <a class="btn btn_gray" href="{{ route('phone_lab.blog_details') }}">REad More</a>
                  </div>
                </div>

                <div class="bolg_quote bg_default_blue text-white">
                  <h3 class="item_title text-white">
                    Duis imperdiet aliquam viverra. In odio neque, pharetra viv utas. 
                  </h3>
                  <span class="post_admin">Barbra Streisand</span>
                  <span class="icon"><i class="fas fa-link"></i></span>
                  <a class="global_link" href="{{ route('phone_lab.blog_details') }}"></a>
                </div>
                
                <div class="bolg_standard border-0 pb-0">
                  <a class="item_image" href="{{ route('phone_lab.blog_details') }}">
                    <img src="{{ asset('assets/images/blog/blog_5.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                  </a>
                  <div class="item_content">
                    <ul class="post_meta ul_li">
                      <li>17 July 2024</li>
                      <li><a href="#!">admin</a></li>
                      <li>
                        <ul class="category_list ul_li">
                          <li><a href="#!">Company</a></li>
                          <li><a href="#!">Travel</a></li>
                        </ul>
                      </li>
                    </ul>
                    <h3 class="item_title">
                      <a href="{{ route('phone_lab.blog_details') }}">Aypi non habent claritatem insitam</a>
                    </h3>
                    <p>
                      It is a long established fact that a reader will be distracted eget velit. Donec ac tempus ante. Fusce ultricies massa massa. Fusce aliquam, purus eget sagittis vulputate, sapien libero hendrerit est, 
                    </p>
                    <a class="btn btn_gray" href="{{ route('phone_lab.blog_details') }}">REad More</a>
                  </div>
                </div>
              </div>

              <div class="col col-lg-4">
                <div class="bolg_standard border-0 pb-0">
                  <a class="item_image" href="{{ route('phone_lab.blog_details') }}">
                    <img src="{{ asset('assets/images/blog/blog_5.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                  </a>
                  <div class="item_content">
                    <ul class="post_meta ul_li">
                      <li>17 July 2024</li>
                      <li><a href="#!">admin</a></li>
                      <li>
                        <ul class="category_list ul_li">
                          <li><a href="#!">Company</a></li>
                          <li><a href="#!">Travel</a></li>
                        </ul>
                      </li>
                    </ul>
                    <h3 class="item_title">
                      <a href="{{ route('phone_lab.blog_details') }}">Aypi non habent claritatem insitam</a>
                    </h3>
                    <p>
                      It is a long established fact that a reader will be distracted eget velit. Donec ac tempus ante. Fusce ultricies massa massa. Fusce aliquam, purus eget sagittis vulputate, sapien libero hendrerit est, 
                    </p>
                    <a class="btn btn_gray" href="{{ route('phone_lab.blog_details') }}">REad More</a>
                  </div>
                </div>

                <div class="bolg_standard border-0 pb-0">
                  <a class="item_image" href="{{ route('phone_lab.blog_details') }}">
                    <img src="{{ asset('assets/images/blog/blog_11.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                  </a>
                  <div class="item_content">
                    <ul class="post_meta ul_li">
                      <li>17 July 2024</li>
                      <li><a href="#!">admin</a></li>
                      <li>
                        <ul class="category_list ul_li">
                          <li><a href="#!">Company</a></li>
                          <li><a href="#!">Travel</a></li>
                        </ul>
                      </li>
                    </ul>
                    <h3 class="item_title">
                      <a href="{{ route('phone_lab.blog_details') }}">Aypi non habent claritatem insitam</a>
                    </h3>
                    <p>
                      It is a long established fact that a reader will be distracted eget velit. Donec ac tempus ante. Fusce ultricies massa massa. Fusce aliquam, purus eget sagittis vulputate, sapien libero hendrerit est, 
                    </p>
                    <a class="btn btn_gray" href="{{ route('phone_lab.blog_details') }}">REad More</a>
                  </div>
                </div>

                <div class="bolg_quote bg_default_yellow text-white">
                  <h3 class="item_title text-white">
                    Duis imperdiet aliquam viverra. In odio neque, pharetra viv utas. 
                  </h3>
                  <span class="post_admin">Barbra Streisand</span>
                  <span class="icon"><i class="fas fa-quote-right"></i></span>
                  <a class="global_link" href="{{ route('phone_lab.blog_details') }}"></a>
                </div>
              </div>

              <div class="col col-lg-4">
                <div class="bolg_standard border-0 pb-0">
                  <a class="item_image" href="{{ route('phone_lab.blog_details') }}">
                    <img src="{{ asset('assets/images/blog/blog_10.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                  </a>
                  <div class="item_content">
                    <ul class="post_meta ul_li">
                      <li>17 July 2024</li>
                      <li><a href="#!">admin</a></li>
                      <li>
                        <ul class="category_list ul_li">
                          <li><a href="#!">Company</a></li>
                          <li><a href="#!">Travel</a></li>
                        </ul>
                      </li>
                    </ul>
                    <h3 class="item_title">
                      <a href="{{ route('phone_lab.blog_details') }}">Aypi non habent claritatem insitam</a>
                    </h3>
                    <p>
                      It is a long established fact that a reader will be distracted eget velit. Donec ac tempus ante. Fusce ultricies massa massa. Fusce aliquam, purus eget sagittis vulputate, sapien libero hendrerit est, 
                    </p>
                    <a class="btn btn_gray" href="{{ route('phone_lab.blog_details') }}">REad More</a>
                  </div>
                </div>

                <div class="bolg_standard border-0 pb-0">
                  <a class="item_image" href="{{ route('phone_lab.blog_details') }}">
                    <img src="{{ asset('assets/images/blog/blog_13.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                  </a>
                  <div class="item_content">
                    <ul class="post_meta ul_li">
                      <li>17 July 2024</li>
                      <li><a href="#!">admin</a></li>
                      <li>
                        <ul class="category_list ul_li">
                          <li><a href="#!">Company</a></li>
                          <li><a href="#!">Travel</a></li>
                        </ul>
                      </li>
                    </ul>
                    <h3 class="item_title">
                      <a href="{{ route('phone_lab.blog_details') }}">Aypi non habent claritatem insitam</a>
                    </h3>
                    <p>
                      It is a long established fact that a reader will be distracted eget velit. Donec ac tempus ante. Fusce ultricies massa massa. Fusce aliquam, purus eget sagittis vulputate, sapien libero hendrerit est, 
                    </p>
                    <a class="btn btn_gray" href="{{ route('phone_lab.blog_details') }}">REad More</a>
                  </div>
                </div>
              </div>
            </div>
            <hr class="m-0">
            <div class="pagination_wrap">
              <ul class="pagination_nav ul_li_center">
                <li class="active"><a href="#!">1</a></li>
                <li><a href="#!">2</a></li>
                <li><a href="#!">3</a></li>
                <li class="prev_btn"><a href="#!"><i class="fa-regular fa-angle-left"></i></a></li>
                <li class="next_btn"><a href="#!"><i class="fa-regular fa-angle-right"></i></a></li>
              </ul>
            </div>
          </div>
        </section>
        <!-- blog_section - end
        ================================================== -->

       

      </main>
      <!-- main body - end
      ================================================== -->
@endsection