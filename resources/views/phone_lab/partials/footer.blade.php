<section class="newsletter_section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col col-lg-6">
                <h2 class="newsletter_title text-white">
                    <i class="icofont-paper-plane"></i>Sign Up for Newsletter
                </h2>
            </div>
            <div class="col col-lg-6">
                <form action="{{ route('newsletter.subscribe') }}" method="POST">
                    @csrf
                    <div class="newsletter_form">
                        <input type="email" name="email" placeholder="Enter your email address">
                        <button type="submit" class="btn btn_danger">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- newsletter_section - end -->


<!-- Newsletter Confirmation Modal -->
@if(session('success_newsletter'))
<div class="modal fade" id="newsletterModal" tabindex="-1" aria-labelledby="newsletterModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 rounded-3">

      <!-- Header -->
      <div class="modal-header border-bottom">
        <h5 class="modal-title text-danger fw-semibold" id="newsletterModalLabel">
          Newsletter Subscription
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Body -->
      <div class="modal-body d-flex align-items-start gap-3">

        <!-- Icon -->
        <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
             style="width:44px;height:44px;">
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
               viewBox="0 0 24 24" fill="none" stroke="#8f0d02" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
          </svg>
        </div>

        <!-- Text -->
        <div>
          <p class="mb-1 fw-semibold text-dark">You're subscribed!</p>
          <p class="mb-0 text-muted small">
            Thanks for subscribing. You’ll receive latest updates and offers.
          </p>
        </div>

      </div>

      <!-- Footer -->
      <div class="modal-footer border-top">
        <button type="button" class="btn btn-danger px-4 rounded-2" data-bs-dismiss="modal">
          Close
        </button>
      </div>

    </div>
  </div>
</div>


@endif




<footer class="footer_section">
    <div class="footer_widget_area">
        <div class="container">
            <div class="row">
                <div class="col col-lg-4 col-md-6 col-sm-6">
                    <div class="footer_widget footer_about">
                        <div class="brand_logo">
                            <a class="brand_link" href="{{ route('phone_lab.index') }}">
                                @if ($siteSettings['site_logo']?? false)
                                    <img src="{{ asset($siteSettings['site_logo']) }}"
                                        alt="{{ $siteSettings['site_name'] ?? 'Site Name' }} Logo">
                                @else
                                    <img src="{{ asset('assets/images/logo/logo-placeholder.png') }}" alt="logo">
                                @endif
                            </a>
                        </div>
                        <p>
                            Discover the ultimate collection of top-brand smartphones and premium gadgets. Quality and reliability you can always count on. 
                        </p>
                        <ul class="social_round ul_li">
                            @if ($siteSettings['social_facebook']?? false)
                                <li><a href="{{ $siteSettings['social_facebook'] }}" target="_blank">
                                    <i class="icofont-facebook"></i></a></li>
                            @endif
                            @if ($siteSettings['social_instagram']?? false)
                                <li><a href="{{ $siteSettings['social_instagram'] }}" target="_blank">
                                    <i class="icofont-instagram"></i></a></li>
                            @endif
                            @if ($siteSettings['social_youtube']?? false)
                                <li><a href="{{ $siteSettings['social_youtube'] }}" target="_blank">
                                    <i class="icofont-youtube-play"></i></a></li>
                            @endif
                            @if ($siteSettings['social_tiktok']?? false)
                                <li>
                                    <a href="{{ $siteSettings['social_tiktok'] }}" target="_blank" class="social_icon tiktok_icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                             fill="currentColor" width="15" height="15">
                                            <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5
                                                     2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01
                                                     a6.33 6.33 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34
                                                     6.34 6.34 0 0 0 6.33-6.34V8.69a8.18 8.18 0 0 0 4.78 1.52V6.75a4.85 4.85 0 0
                                                     1-1.01-.06z"/>
                                        </svg>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="col col-lg-2 col-md-3 col-sm-6">
                    <div class="footer_widget footer_useful_links">
                        <h3 class="footer_widget_title text-uppercase">Quick Links</h3>
                        <ul class="ul_li_block">
                            <li><a href="{{ route('phone_lab.about') }}">About Us</a></li>
                            <li><a href="{{ route('phone_lab.contact') }}">Contact</a></li>
                            <li><a href="{{ route('phone_lab.shop_grid') }}">Products</a></li>
                            <li><a href="{{ route('user.login') }}">Login</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col col-lg-2 col-md-3 col-sm-6">
                    <div class="footer_widget footer_useful_links">
                        <h3 class="footer_widget_title text-uppercase">Custom area</h3>
                        <ul class="ul_li_block">
                            <li><a href="{{ route('user.dashboard') }}">My Account</a></li>
                            <li><a href="{{ route('phone_lab.order_tracking') }}">Tracking List</a></li>
                            <li><a href="{{ route('cart.index') }}">My Cart</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col col-lg-4 col-md-6 col-sm-6">
                    <div class="footer_widget footer_contact">
                        <h3 class="footer_widget_title text-uppercase">Contact Info</h3>
                        <p>
                            {{ $siteSettings['site_name'] ?? 'Site Name' }} - Store for all your gadgets needs. We provide a wide
                            range of electronic products, including smartphones, laptops, tablets, and accessories.
                            Our mission is to offer high-quality products at competitive prices, along with excellent
                            customer service. Whether you're looking for the latest tech or reliable gadgets,
                            {{ $siteSettings['site_name'] ?? 'Site Name' }} has you covered.
                        </p>
                        <div class="hotline_wrap">
                            <div class="footer_hotline">
                                <div class="item_icon">
                                    <i class="icofont-headphone-alt"></i>
                                </div>
                                <div class="item_content">
                                    <span class="hotline_number d-block mt-0">
                                        @if ($siteSettings['site_phone']?? false)
                                            {{ $siteSettings['site_phone'] }}
                                        @else
                                            +94 7X XXX XXXX
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="livechat_btn clearfix">
                                <a class="btn border_primary" href="{{ route('phone_lab.contact') }}">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer_bottom">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col col-md-8">
                    <p class="copyright_text">
                        All Rights Reserved | {{ $siteSettings['site_name'] ?? 'Website Name' }} |
                        Designed & Developed by Silicon Radon Networks (Pvt) Ltd
                    </p>
                </div>
                <div class="col col-md-2">
                    <div class="payment_method">
                        <img src="{{ asset('assets/images/payments_icon.webp') }}"
                            alt="Getyootech - Gadgets Ecommerce Site Template">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    .footer_section {
        background-color: #160e0c !important;
        color: #ffffff !important;
    }
    .footer_section .footer_widget_title {
        color: #ffffff !important;
    }
    .footer_section p,
    .footer_section ul li a {
        color: #cccccc !important;
    }
    .footer_section ul li a:hover {
        color: #ffffff !important;
    }
    .footer_bottom {
        background-color: #160e0c !important;
        text-align: center;
    }
    .copyright_text {
        color: #999999 !important;
    }
    .payment_method h4 {
        color: #ffffff !important;
    }
</style>

@if(session('success_newsletter'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalEl = document.getElementById('newsletterModal');

        if (modalEl) {
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    });
</script>
@endif