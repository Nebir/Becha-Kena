<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') | {{ env('SITE_NAME') }}</title>

    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ url('css/owl.theme.css') }}" rel="stylesheet">
    <link href="{{ url('css/bootstrap-multiselect.css') }}" rel="stylesheet">

    @yield('stylesheets')

    <link href="{{ url('css/style.css') }}" rel="stylesheet">

</head>
<body>
    <!-- site-navigation start -->
    <nav id="mainNavigation" class="navbar navbar-fixed-top" role="navigation">
        <div class="container">
    
            <div class="navbar-header">
    
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
    
                <!-- navbar logo -->
                <div class="navbar-brand">
                    <a href="{{ route('home') }}">
                        <i class="fa fa-shopping-cart"></i>
                        Becha-Kena
                    </a>
                </div>
                <!-- navbar logo -->
    
            </div><!-- /.navbar-header -->
    
            <!-- nav links -->
            @yield('nav-links')
    
    
        </div><!-- /.container -->
    </nav>
    <!-- site-navigation end -->

    <div class="body-content">
        @yield('content')
    </div>

    <!-- begin:footer -->
    <section id="footer" class="footer">
        <!-- begin:copyright -->
        <div class="container">
            <div class="row">
                <div class="col-md-6 copyright">
                    <p class="text-left">Copyright &copy; SUST Becha-Kena 2017. All Right Reserved.</p>
                </div>
                <div class="col-md-6">
                    <p class="text-right"> Developed by CSE Dept. SUST</p>
                </div>
            </div>
        </div>
    </section>
    <!-- end footer -->


    <script src="{{ url('js/jquery-2.1.3.min.js') }}"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
    <script src="{{ url('js/owl.carousel.min.js') }}"></script>
    <script src="{{ url('js/bootstrap-multiselect.js') }}"></script>

    @yield('scripts')

    <script src="{{ url('js/script.js') }}"></script>
</body>
</html>
