@extends('phone_lab.layouts.app')

@section('title', $siteSettings['site_name'] . ' - About Us')

@section('content')
    <main>

        <!-- breadcrumb_section - start
                ================================================== -->
        <div class="breadcrumb_section">
            <div class="container">
                <ul class="breadcrumb_nav ul_li">
                    <li><a href="{{ route('phone_lab.index') }}">Home</a></li>
                    <li>About Us</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb_section - end
                ================================================== -->

        <!-- about_section - start
                ================================================== -->
        <section class="about_section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col col-md-6 order-last">
                        <div class="about_image">
                            <img src="{{ asset('/assets/images/about/about_image.png') }}" alt="About Image">
                        </div>
                    </div>
                    <div class="col col-md-6">
                        <div class="about_content">
                            <h3 class="about_title">About us
                            </h3>
                            <p>
                                At Megha Mobile (Pvt) Ltd, we believe in connecting you with the best of the tech world. We specialize in offering an extensive collection of genuine smartphones, high-quality mobile accessories, and cutting-edge gadgets designed to elevate your everyday digital experience.
Our commitment is built on three core pillars: providing 100% original products, offering highly competitive market prices, and delivering exceptional customer service. Whether you are looking for the latest flagship phone or reliable accessories to protect your device, we ensure a seamless and trustworthy shopping experience tailored to your needs.
                            </p>
                            <ul class="counter_wrap ul_li">
                                <li>
                                    <span class="counter">12</span>
                                    <small>Years Experience</small>
                                </li>
                                <li>
                                    <span><strong class="counter">10</strong>K</span>
                                    <small>Happy Customers</small>
                                </li>
                                <li>
                                    <span><strong class="counter">100</strong>%</span>
                                    <small>Clients Satisfaction</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about_section - end
                ================================================== -->

        <!-- service_section - start
                ================================================== -->
        <section class="service_section bg_gray section_space">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col col-lg-4 col-md-6 col-sm-6">
                        <div class="service_boxed">
                            <div class="item_icon">
                                <i class="icon icon-Wrench"></i>
                                <i class="icon icon-Wrench"></i>
                            </div>
                            <h3 class="item_title">
                                Creative Design
                            </h3>
                            <p>
                               Premium build quality and sleek designs selected from the world's top smartphone and accessory brands to match your modern lifestyle. 
                            </p>
                        </div>
                    </div>

                    <div class="col col-lg-4 col-md-6 col-sm-6">
                        <div class="service_boxed">
                            <div class="item_icon">
                                <i class="icon icon-Dollars"></i>
                                <i class="icon icon-Dollars"></i>
                            </div>
                            <h3 class="item_title">
                                Money Back Guarantee
                            </h3>
                            <p>
                               Shop with complete confidence! We offer a hassle-free money-back guarantee and official warranties on all genuine smartphones and accessories. 
                            </p>
                        </div>
                    </div>

                    <div class="col col-lg-4 col-md-6 col-sm-6">
                        <div class="service_boxed">
                            <div class="item_icon">
                                <i class="icon icon-Phone2"></i>
                                <i class="icon icon-Phone2"></i>
                            </div>
                            <h3 class="item_title">
                                Online Support 24/7
                            </h3>
                            <p>
                               Our dedicated customer support team is always available to assist you with product inquiries, tracking, and technical guidance anytime you need.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- service_section - end
                ================================================== -->

        <!-- team_section - start
                ================================================== -->
        <section class="team_section section_space">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col col-lg-7 col-md-8 col-sm-10">
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
                                <img src="{{ asset('assets/images/team/team_5.jpg') }}"
                                    alt="Getyootech - Gadgets Ecommerce Site Template">
                            </div>
                            <div class="team_content">
                                <h3 class="team_member_name">Emma</h3>
                                <span class="team_member_title">Founder</span>
                            </div>
                        </div>
                    </div>

                    <div class="col col-lg-3 col-md-4 col-sm-6">
                        <div class="team_item">
                            <div class="team_image">
                                <img src="{{ asset('assets/images/team/team_2.png') }}"
                                    alt="Getyootech - Gadgets Ecommerce Site Template">
                            </div>
                            <div class="team_content">
                                <h3 class="team_member_name">John Swim</h3>
                                <span class="team_member_title">Sales Manager</span>
                            </div>
                        </div>
                    </div>

                    <div class="col col-lg-3 col-md-4 col-sm-6">
                        <div class="team_item">
                            <div class="team_image">
                                <img src="{{ asset('assets/images/team/team_3.jpg') }}"
                                    alt="Getyootech - Gadgets Ecommerce Site Template">
                            </div>
                            <div class="team_content">
                                <h3 class="team_member_name">Olivia</h3>
                                <span class="team_member_title">Marketing Manager</span>
                            </div>
                        </div>
                    </div>

                    <div class="col col-lg-3 col-md-4 col-sm-6">
                        <div class="team_item">
                            <div class="team_image">
                                <img src="{{ asset('assets/images/team/team_4.jpg') }}"
                                    alt="Getyootech - Gadgets Ecommerce Site Template">
                            </div>
                            <div class="team_content">
                                <h3 class="team_member_name">Sophia</h3>
                                <span class="team_member_title">Product Manager</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
      

     
     

    </main>
    <!-- main body - end
              ================================================== -->
@endsection
