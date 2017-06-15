<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') | {{ env('SITE_NAME') }}</title>

    <!-- Bootstrap core CSS -->

    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/green.css') }}" rel="stylesheet">
    <link href="{{ url('css/custom_dashboard.css') }}" rel="stylesheet">
    <link href="{{ url('css/style.css') }}" rel="stylesheet">
</head>


<body class="nav-md">

<div class="container">
    <div class="row row-eq-height">
        <div class="col-md-2">
            <div class="sidebar">
                <div class="navbar" style="border: 0;">
                    <a href="{{ route('home') }}" class="site_title">
                        <i class="ion-ios-home"></i> <span>Becha-Kena</span>
                    </a>
                </div>
                <div class="clearfix"></div>

                <!-- menu prile quick info -->
                <div class="profile">
                    <div class="profile_pic">
                        <img src="{{ asset($authUser->image) }}" alt="{{ $authUser->name }}" class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Welcome,</span>
                        <h2>{{ $authUser->name }}</h2>
                    </div>
                </div>
                <!-- /menu prile quick info -->

                <br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                    <div class="menu_section">
                        <ul class="nav side-menu">
                            <li><a href="{{ route('dashboard') }}">Main Dashboard</a></li>
                            <li><a><i class="ion-ios-people"></i>Users<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: none">
                                    <li><a href="{{ route('users') }}">All Users</a></li>
                                    <li><a href="{{ route('admins') }}">Admins</a></li>
                                    <li><a href="{{ route('blacklisted') }}">Blacklisted</a></li>
                                </ul>
                            </li>
                            <li><a><i class="ion-ios-briefcase"></i>Products<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: none">
                                    <li><a href="{{ route('products') }}">All Products</a></li>
                                    <li><a href="{{ route('products.pending') }}">Pending Products</a></li>
                                    <li><a href="{{route('categories')}}">Categories</a></li>
                                    {{-- vitorer page e pending product, deleted products er alada tab thakbe--}}
                                </ul>
                            </li>

                            <li><a><i class="ion-ios-compose"></i>Orders<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: none">
                                    <li><a href="{{ route('product.orders') }}">Product Based Orders</a></li>
                                    <li><a href="{{ route('orderHistory') }}">Order History</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /sidebar menu -->
            </div>
        </div>

        <!-- page content -->
        <div class="col-md-10 dashboard-content" role="main">
            @yield('dashboard_nav')

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    @yield('content')
                </div>

            </div>
            <br />
        </div>
    </div>
        <!-- /page content -->
</div>



<script src="{{ url('js/jquery-2.1.3.min.js') }}"></script>
<script src="{{ url('js/bootstrap.min.js') }}"></script>
<script src="{{ url('js/jquery.nicescroll.min.js') }}"></script>
<script src="{{ url('js/Chart.js') }}"></script>
<script src="{{ url('js/dashboard_script.js') }}"></script>

<!-- dashbord linegraph -->
@yield('scripts')


</body>

</html>
