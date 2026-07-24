@extends('phone_lab.layouts.app')

@section('title', 'Blog Split - Getyootech - Gadgets Ecommerce Site Template')

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
              <li>Blog Split</li>
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
              <div class="col col-lg-8">
                <div class="blog_split_layout">
                  <a class="item_image" href="{{ route('phone_lab.blog_details') }}">
                    <img src="{{ asset('assets/images/blog/blog_14.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                      It is a long established fact that a reader will be distracted eget velit. Donec ac tempus ante. Fusce ultricies massa massa.
                    </p>
                    <a class="btn btn_gray" href="{{ route('phone_lab.blog_details') }}">REad More</a>
                  </div>
                </div>

                <div class="blog_split_layout">
                  <a class="item_image" href="{{ route('phone_lab.blog_details') }}">
                    <img src="{{ asset('assets/images/blog/blog_15.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                      It is a long established fact that a reader will be distracted eget velit. Donec ac tempus ante. Fusce ultricies massa massa.
                    </p>
                    <a class="btn btn_gray" href="{{ route('phone_lab.blog_details') }}">REad More</a>
                  </div>
                </div>

                <div class="blog_split_layout">
                  <a class="item_image" href="{{ route('phone_lab.blog_details') }}">
                    <img src="{{ asset('assets/images/blog/blog_14.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                      It is a long established fact that a reader will be distracted eget velit. Donec ac tempus ante. Fusce ultricies massa massa.
                    </p>
                    <a class="btn btn_gray" href="{{ route('phone_lab.blog_details') }}">REad More</a>
                  </div>
                </div>

                <div class="blog_split_layout">
                  <a class="item_image" href="{{ route('phone_lab.blog_details') }}">
                    <img src="{{ asset('assets/images/blog/blog_16.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                      It is a long established fact that a reader will be distracted eget velit. Donec ac tempus ante. Fusce ultricies massa massa.
                    </p>
                    <a class="btn btn_gray" href="{{ route('phone_lab.blog_details') }}">REad More</a>
                  </div>
                </div>

                <div class="blog_split_layout">
                  <a class="item_image" href="{{ route('phone_lab.blog_details') }}">
                    <img src="{{ asset('assets/images/blog/blog_17.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                      It is a long established fact that a reader will be distracted eget velit. Donec ac tempus ante. Fusce ultricies massa massa.
                    </p>
                    <a class="btn btn_gray" href="{{ route('phone_lab.blog_details') }}">REad More</a>
                  </div>
                </div>

                <div class="blog_split_layout">
                  <a class="item_image" href="{{ route('phone_lab.blog_details') }}">
                    <img src="{{ asset('assets/images/blog/blog_18.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
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
                      It is a long established fact that a reader will be distracted eget velit. Donec ac tempus ante. Fusce ultricies massa massa.
                    </p>
                    <a class="btn btn_gray" href="{{ route('phone_lab.blog_details') }}">REad More</a>
                  </div>
                </div>
                
                <div class="pagination_wrap pt-0">
                  <ul class="pagination_nav ul_li_right">
                    <li class="active"><a href="#!">1</a></li>
                    <li><a href="#!">2</a></li>
                    <li><a href="#!">3</a></li>
                    <li class="prev_btn"><a href="#!"><i class="fa-regular fa-angle-left"></i></a></li>
                    <li class="next_btn"><a href="#!"><i class="fa-regular fa-angle-right"></i></a></li>
                  </ul>
                </div>
              </div>

              <div class="col col-lg-4">
                <aside class="sidebar_section">
                  <div class="sb_widget2 ab_author text-center">
                    <div class="author_image">
                      <img src="{{ asset('assets/images/author/author_1.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                    </div>
                    <h3 class="author_name">About Author</h3>
                    <p>
                      It is a long established fact that a reader will be distracted eget velit. Donec ac tempus ante. 
                    </p>
                    <span class="author_signature">Author Signature</span>
                  </div>

                  <div class="sb_widget2">
                    <h3 class="sb_widget_title2">Categories</h3>
                    <ul class="sb_category_list2 ul_li_block">
                      <li><a href="#!">Audio</a></li>
                      <li><a href="#!">Company</a></li>
                      <li><a href="#!">Gallery</a></li>
                      <li><a href="#!">Image</a></li>
                      <li><a href="#!">Other</a></li>
                      <li><a href="#!">Travel</a></li>
                    </ul>
                  </div>

                  <div class="sb_widget2">
                    <h3 class="sb_widget_title2">Recent Posts</h3>
                    <ul class="recent_posts_list ul_li_block">
                      <li>
                        <div class="recent_post_item">
                          <a class="item_image" href="{{ route('phone_lab.blog_details') }}">
                            <img src="{{ asset('assets/images/recent_post/recent_post_img_1.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          </a>
                          <div class="item_content">
                            <h3 class="item_title">
                              <a href="{{ route('phone_lab.blog_details') }}">Aypi nonam</a>
                            </h3>
                            <span class="post_date">17 July 2024 </span>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="recent_post_item">
                          <a class="item_image" href="{{ route('phone_lab.blog_details') }}">
                            <img src="{{ asset('assets/images/recent_post/recent_post_img_2.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          </a>
                          <div class="item_content">
                            <h3 class="item_title">
                              <a href="{{ route('phone_lab.blog_details') }}">Aypi nonam</a>
                            </h3>
                            <span class="post_date">17 July 2024 </span>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="recent_post_item">
                          <a class="item_image" href="{{ route('phone_lab.blog_details') }}">
                            <img src="{{ asset('assets/images/recent_post/recent_post_img_3.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          </a>
                          <div class="item_content">
                            <h3 class="item_title">
                              <a href="{{ route('phone_lab.blog_details') }}">Aypi nonam</a>
                            </h3>
                            <span class="post_date">17 July 2024 </span>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>

                  <div class="sb_widget2">
                    <h3 class="sb_widget_title2">Tag products</h3>
                    <ul class="sb_tag_list ul_li">
                      <li><a href="#!">asian</a></li>
                      <li><a href="#!">brown</a></li>
                      <li><a href="#!">euro</a></li>
                      <li><a href="#!">risus</a></li>
                      <li><a href="#!">risus</a></li>
                    </ul>
                  </div>

                  <div class="sb_widget2">
                    <h3 class="sb_widget_title2">Instagram</h3>
                    <ul class="sb_instagram_shots ul_li zoom-gallery">
                      <li>
                        <a class="popup_image" href="{{ asset('assets/images/instagram/instagram_img_1.html') }}">
                          <img src="{{ asset('assets/images/instagram/instagram_img_1.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <i class="fab fa-instagram"></i>
                        </a>
                      </li>
                      <li>
                        <a class="popup_image" href="{{ asset('assets/images/instagram/instagram_img_2.html') }}">
                          <img src="{{ asset('assets/images/instagram/instagram_img_2.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <i class="fab fa-instagram"></i>
                        </a>
                      </li>
                      <li>
                        <a class="popup_image" href="{{ asset('assets/images/instagram/instagram_img_3.html') }}">
                          <img src="{{ asset('assets/images/instagram/instagram_img_3.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <i class="fab fa-instagram"></i>
                        </a>
                      </li>
                      <li>
                        <a class="popup_image" href="{{ asset('assets/images/instagram/instagram_img_4.html') }}">
                          <img src="{{ asset('assets/images/instagram/instagram_img_4.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <i class="fab fa-instagram"></i>
                        </a>
                      </li>
                      <li>
                        <a class="popup_image" href="{{ asset('assets/images/instagram/instagram_img_5.html') }}">
                          <img src="{{ asset('assets/images/instagram/instagram_img_5.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <i class="fab fa-instagram"></i>
                        </a>
                      </li>
                      <li>
                        <a class="popup_image" href="{{ asset('assets/images/instagram/instagram_img_6.html') }}">
                          <img src="{{ asset('assets/images/instagram/instagram_img_6.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                          <i class="fab fa-instagram"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </aside>
              </div>
            </div>
          </div>
        </section>
        <!-- blog_section - end
        ================================================== -->

       

      </main>
      <!-- main body - end
      ================================================== -->
@endsection