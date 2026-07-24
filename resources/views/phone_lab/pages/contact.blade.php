@extends('phone_lab.layouts.app')

@section('title', $siteSettings['site_name'] . ' - Contact')

@section('content')
    <main>

        
        <!-- breadcrumb_section - start
                                ================================================== -->
        <div class="breadcrumb_section">
            <div class="container">
                <ul class="breadcrumb_nav ul_li">
                    <li><a href="{{ route('phone_lab.index') }}">Home</a></li>
                    <li>Contact Us</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb_section - end
                                ================================================== -->

        <!-- contact_section - start
                                ================================================== -->


        <section class="contact_section section_space">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-6">
                        <div class="contact_info_wrap">
                            <h3 class="contact_title">Address Information</h3>
                            <p>
                               Visit our store to explore the latest smartphones and premium mobile accessories in person. Our team is ready to guide you to the perfect tech choice. 
                            </p>
                            <div class="row">
                                <div class="col col-md-12">
                                    <div class="contact_info_list">
                                        <ul class="ul_li_block">
                                            <li>
                                                @if ($siteSettings['site_name'])
                                                    {{ $siteSettings['site_name'] ?? 'Website Name' }}
                                                @else
                                                    Website Name
                                                @endif
                                            </li>
                                            <li>
                                                @if ($siteSettings['site_address']?? false)
                                                    {{ $siteSettings['site_address'] }}
                                                @else
                                                    Store Location
                                                @endif
                                            </li>
                                            <li>
                                                @if ($siteSettings['site_email']?? false)
                                                    {{ $siteSettings['site_email'] }}
                                                @else
                                                    yourinfo@gmail.com
                                                @endif
                                            </li>
                                            <li>
                                                @if ($siteSettings['site_phone'] ?? false)
                                                    {{ $siteSettings['site_phone'] }}
                                                @else
                                                    +94 7X XXX XXXX
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                  <div class="col col-lg-6">
    <div class="contact_info_wrap">
        <h3 class="contact_title">Get in Touch & Inform Us</h3>
        <p>
            Have any questions, feedback, or inquiries about our products and services? Drop us a message below, and our team will get back to you as soon as possible. 
        </p>

        {{-- Success Message --}}
        @if(session('success'))
            <div style="color: green; margin-bottom: 15px; font-weight: 600;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('feedback.store') }}" method="POST">
            @csrf

            <div class="form_item">
                <input type="text" name="name" placeholder="Your Name" value="{{ old('name') }}">
                @error('name')
                    <small style="color:red">{{ $message }}</small>
                @enderror
            </div>

            <div class="row">
                <div class="col col-md-6 col-sm-6">
                    <div class="form_item">
                        <input type="email" name="email" placeholder="Your Email" value="{{ old('email') }}">
                        @error('email')
                            <small style="color:red">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col col-md-6 col-sm-6">
                    <div class="form_item">
                        <input type="text" name="subject" placeholder="Your Subject" value="{{ old('subject') }}">
                        @error('subject')
                            <small style="color:red">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form_item">
                <textarea name="message" placeholder="Message">{{ old('message') }}</textarea>
                @error('message')
                    <small style="color:red">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn_primary">
                Send Message
            </button>
        </form>
    </div>
</div>
                </div>
            </div>
        </section>
        <!-- contact_section - end================================================== -->

        <!-- contact_section - start================================================== -->
        <div class="map_section">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.531295640378!2d80.6381086!3d7.2940442!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae36755287699a3%3A0x73c6251ad8d48d23!2sMegha%20Mobile%20(Pvt)%20Ltd!5e0!3m2!1sen!2slk!4v1780983904323!5m2!1sen!2slk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <!-- contact_section - end================================================== -->

        
                               
                            

    </main>
   
@endsection


@if(session('success'))
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('successModal');
    const btn = document.getElementById('closeSuccess');

    btn.addEventListener('click', function () {
        modal.style.display = 'none';
    });
});



</script>
@endif