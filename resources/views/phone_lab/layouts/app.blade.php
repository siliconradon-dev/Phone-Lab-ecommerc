<!doctype html>
<html lang="en">
<head>


  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  	<meta http-equiv="x-ua-compatible" content="ie=edge">


  	<link rel="shortcut icon" href="{{ asset('assets/images/logo/favourite_icon.svg') }}">

  	<!-- fraimwork - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- icon font - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/stroke-gap-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/icofont.css') }}">

    <!-- animation - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">

    <!-- carousel - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick-theme.css') }}">

    <!-- popup - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/magnific-popup.css') }}">

    <!-- jquery-ui - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery-ui.css') }}">

    <!-- select option - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/nice-select.css') }}">

    <!-- custom - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    @stack('styles')

    <link rel="icon" href="{{ asset($siteSettings['site_favicon'] ?? 'default-favicon.ico') }}">

  <title>@yield('title', $siteSettings['site_name'] ?? 'Default Title')</title>
</head>
<body>
  <div class="body_wrap">
    <div class="backtotop">
      <a href="#" class="scroll">
        <i class="far fa-arrow-up"></i>
      </a>
    </div>

    <div id="preloader"></div>

    @include('phone_lab.partials.header')

    <main>
      @yield('content')
    </main>
    

    @include('phone_lab.partials.footer')
  </div>

<!-- fraimwork - jquery include -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap5-dropdown-ml-hack.js') }}"></script>

    <!-- carousel - jquery include -->
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>

    <!-- popup - jquery include -->
    <script src="{{ asset('assets/js/magnific-popup.min.js') }}"></script>

    <!-- jquery-ui - jquery include -->
    <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>

    <!-- off canvas sidebar - jquery include -->
    <script src="{{ asset('assets/js/mCustomScrollbar.js') }}"></script>

    <!-- select option - jquery include -->
    <script src="{{ asset('assets/js/nice-select.min.js') }}"></script>

    <!-- countdown timer - jquery include -->
    <script src="{{ asset('assets/js/countdown.js') }}"></script>

    <!-- counter up - jquery include -->
    <script src="{{ asset('assets/js/counterup.min.js') }}"></script>
    <script src="{{ asset('assets/js/waypoints.min.js') }}"></script>

    <!-- custom - jquery include -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const countdownElements = document.querySelectorAll('[data-countdown]');
            if (countdownElements.length === 0) return;

            function updateCountdowns() {
                const now = new Date().getTime();

                countdownElements.forEach(function (element) {
                    const countdownTime = new Date(element.getAttribute('data-countdown')).getTime();
                    const distance = countdownTime - now;

                    const timerSpan = element.querySelector('.countdown-timer');
                    if (!timerSpan) return;

                    if (distance < 0) {
                        timerSpan.innerHTML = "Ended";
                        element.classList.remove('text-danger');
                        element.classList.add('text-muted');
                    } else {
                        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        let displayStr = "";
                        if (days > 0) {
                            displayStr += days + "d ";
                        }
                        displayStr += hours.toString().padStart(2, '0') + "h " +
                                     minutes.toString().padStart(2, '0') + "m " +
                                     seconds.toString().padStart(2, '0') + "s";

                        timerSpan.innerHTML = displayStr;
                    }
                });
            }

            updateCountdowns();
            setInterval(updateCountdowns, 1000);
        });
    </script>

    @stack('scripts')
</body>
</html>



