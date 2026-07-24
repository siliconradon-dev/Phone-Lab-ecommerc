<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/site_logo.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset($siteSettings['site_favicon'] ?? 'assets/img/favicon.png') }}" />
    @stack('title')
    @include('admin.libraries.styles')
</head>

<body>

    <body class="body">
        <!-- #wrapper -->
        <div id="wrapper">
            <!-- #page -->
            <div id="page" class="">
                <!-- layout-wrap -->
                <div class="layout-wrap">
                    <!-- preload -->
                    {{-- @include('admin.libraries.preloader') --}}
                    <!-- /preload -->
                    <!-- section-menu-left -->
                    @include('admin.components.SideNav')
                    <!-- /section-menu-left -->
                    <!-- section-content-right -->
                    <div class="section-content-right">
                        <!-- header-dashboard -->
                        @include('admin.components.header')
                        <!-- /header-dashboard -->
                        <!-- main-content -->
                        <div class="main-content">
                            <!-- main-content-wrap -->
                            <div class="main-content-inner">
                                <!-- main-content-wrap -->
                                @yield('index_content')
                                <!-- /main-content-wrap -->
                            </div>
                            <!-- /main-content-wrap -->
                            <!-- bottom-page -->
                            @include('admin.components.footer')
                            <!-- /bottom-page -->
                        </div>
                        <!-- /main-content -->
                    </div>
                    <!-- /section-content-right -->
                </div>
                <!-- /layout-wrap -->
            </div>
            <!-- /#page -->
        </div>
        <!-- /#wrapper -->

        <!-- Javascript -->
        @include('admin.libraries.scripts')
    </body>

</body>

</html>
