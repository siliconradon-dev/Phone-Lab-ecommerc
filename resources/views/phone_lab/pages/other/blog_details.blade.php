@extends('phone_lab.layouts.app')

@section('title', 'Blog Details - Getyootech - Gadgets Ecommerce Site Template')

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
              <li>Blog Details</li>
            </ul>
          </div>
        </div>
        <!-- breadcrumb_section - end
        ================================================== -->

        <!-- blog_details - start
        ================================================== -->
        <section class="blog_details section_space">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col col-lg-8">
                <div class="details_image">
                  <img src="{{ asset('assets/images/details/blog_details_img_1.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                </div>
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
                <h2 class="details_item_title">
                  Aypi non habent claritatem insitam
                </h2>
                <p>
                  Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum dictum magna. Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus.Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque. 
                </p>
                <ul class="info_list ul_li_block">
                  <li>Vivamus eget nibh. Etiam cursus leo vel metus. </li>
                  <li>Nulla facilisi. Aenean nec eros. </li>
                  <li>Vestibulum ante ipsum primis in faucibus orci luctus et.</li>
                </ul>
                <ul class="image_list ul_li">
                  <li>
                    <img src="{{ asset('assets/images/details/blog_details_img_2.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                  </li>
                  <li>
                    <img src="{{ asset('assets/images/details/blog_details_img_3.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                  </li>
                  <li>
                    <img src="{{ asset('assets/images/details/blog_details_img_4.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                  </li>
                  <li>
                    <img src="{{ asset('assets/images/details/blog_details_img_5.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                  </li>
                  <li>
                    <img src="{{ asset('assets/images/details/blog_details_img_6.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                  </li>
                </ul>
                <p>
                  Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum dictum magna. Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus.Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque. 
                </p>

                <div class="tag_social_wrap">
                  <div class="row align-items-center">
                    <div class="col col-md-7">
                      <ul class="tag_list ul_li">
                        <li><a href="#!">Branding</a></li>
                        <li><a href="#!">UI Design</a></li>
                        <li><a href="#!">Booking</a></li>
                        <li><a href="#!">Statup</a></li>
                        <li><a href="#!">Landing</a></li>
                      </ul>
                    </div>

                    <div class="col col-md-5">
                      <ul class="social_round2 ul_li_right">
                        <li><a href="#!"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#!"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#!"><i class="fab fa-vimeo-v"></i></a></li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="related_post_area">
                  <h3 class="area_title">Related Posts</h3>
                  <ul class="related_post_wrap ul_li">
                    <li>
                      <div class="recent_post_item">
                        <a class="item_image" href="{{ route('phone_lab.blog_details') }}">
                          <img src="{{ asset('assets/images/recent_post/recent_post_img_1.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        </a>
                        <div class="item_content">
                          <h3 class="item_title">
                            <a href="{{ route('phone_lab.blog_details') }}">
                              Lorem ipsum dolor sit amet, consectetuer adipis
                            </a>
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
                            <a href="{{ route('phone_lab.blog_details') }}">
                              Lorem ipsum dolor sit amet.
                            </a>
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
                            <a href="{{ route('phone_lab.blog_details') }}">
                              Dolor sit amet, consectetuer.
                            </a>
                          </h3>
                          <span class="post_date">17 July 2024 </span>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>

                <div class="comment_area">
                  <h3 class="area_title">Comments</h3>
                  <ul class="comment_list ul_li_block">
                    <li>
                      <div class="comment_item clearfix">
                        <div class="thumbnail_wrap">
                          <img src="{{ asset('assets/images/comment/cmnt_thumb_1.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        </div>
                        <div class="content_wrap">
                          <h4 class="hero_name">John Smith, <span class="comment_date">17 July 2024</span></h4>
                          <p>
                            Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. 
                          </p>
                          <button type="button" class="reply_btn"><i class="fas fa-reply"></i></button>
                        </div>
                      </div>
                      <ul class="comment_list ul_li_block">
                        <li>
                          <div class="comment_item clearfix">
                            <div class="thumbnail_wrap">
                              <img src="{{ asset('assets/images/comment/cmnt_thumb_2.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                            </div>
                            <div class="content_wrap">
                              <h4 class="hero_name">Admin, <span class="comment_date">17 July 2024</span></h4>
                              <p>
                                Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. 
                              </p>
                              <button type="button" class="reply_btn"><i class="fas fa-reply"></i></button>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </li>

                    <li>
                      <div class="comment_item clearfix">
                        <div class="thumbnail_wrap">
                          <img src="{{ asset('assets/images/comment/cmnt_thumb_3.html') }}" alt="Getyootech - Gadgets Ecommerce Site Template">
                        </div>
                        <div class="content_wrap">
                          <h4 class="hero_name">John Smith, <span class="comment_date">17 July 2024</span></h4>
                          <p>
                            Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. 
                          </p>
                          <button type="button" class="reply_btn"><i class="fas fa-reply"></i></button>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>

                <div class="comment_form_area">
                  <h3 class="area_title">Leave a Comments</h3>
                  <form action="#">
                    <div class="border_wrap">
                      <div class="form_wrap">
                        <p class="mb-4">
                          Make sure you enter the (*) required information where indicated.
                        </p>
                        <div class="row">
                          <div class="col col-md-6">
                            <div class="form_item">
                              <h4 class="input_title">Name<sup>*</sup></h4>
                              <input type="text" name="name">
                            </div>
                          </div>
                          <div class="col col-md-6">
                            <div class="form_item">
                              <h4 class="input_title">Email Address<sup>*</sup></h4>
                              <input type="email" name="email">
                            </div>
                          </div>
                        </div>

                        <div class="form_item">
                          <h4 class="input_title">Website URL</h4>
                          <input type="text" name="website">
                        </div>

                        <div class="form_item">
                          <h4 class="input_title">Message</h4>
                          <textarea name="comment"></textarea>
                        </div>
                      </div>
                      <div class="btn_wrap">
                        <button type="submit" class="btn btn_primary">Submit Comment</button>
                      </div>
                    </div>
                  </form>
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
        <!-- blog_details - end
        ================================================== -->

        

      </main>
      <!-- main body - end
      ================================================== -->
@endsection