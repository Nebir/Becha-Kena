@extends('layouts.master')

@section('title')
    About
@endsection

@section('nav-links')
    <div class="collapse navbar-collapse" id="main-nav-collapse">
        <ul class="nav navbar-nav navbar-right text-uppercase">
            <li>
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li class="active">
                <a href="{{ route('about') }}">About US</a>
            </li>
            <li>
                <a href="{{ route('product') }}">All Products</a>
            </li>
            {{--<li>
                <a href="{{ route('contact') }}">contact</a>
            </li>--}}

            @if(Auth::check())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle profile-picture" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <img class="img-responsive" src="{{ asset(Auth::user()->image) }}" alt="{{ Auth::user()->name }}">
                        {{ Auth::user()->name }}
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        @if(Auth::user()->role != 'Admin')
                            <li>
                                <a href="{{ route('profile') }}">Profile</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}">Logout</a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('profile') }}">Profile</a>
                            </li>
                            <li>
                                <a href="{{ route('dashboard') }}">DashBoard</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}">Logout</a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li>
                    <a href="{{ route('checkout') }}" class="checkout-link">
                        <i class="ion-ios-cart"></i>
                        <span class="badge">4</span>
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ route('registration') }}">Register</a>
                </li>
                <li>
                    <a href="{{ route('login') }}">Login</a>
                </li>
            @endif
        </ul>
    </div><!-- nav links -->
@endsection

@section('content')
    <!-- header begin -->
    <header class="about-page-head">
        <div class="header-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <ol class="breadcrumb">
                            <li><a href="{{ route('home') }}">home</a></li>
                            <li class="active">about us</li>
                        </ol> <!-- end of /.breadcrumb -->

                    </div>
                </div>
            </div> <!-- /.container -->
        </div> <!-- /.header-wrapper -->
    </header> <!-- /.page-head (header end) -->

    <div class="main-content">

        <!-- begin our story section -->

        <section class="bg-white story">
            <div class="container">
                <div class="headline text-center">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <h2 class="section-title">Our Story</h2>
                        </div>
                    </div>
                </div> <!-- /.headline -->

                <div class="row">
                    <div class="col-md-10 col-md-offset-1 text-center">
                        <p class="story-description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed elit eu ipsum aliquam mattis ac eget tortor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam interdum at neque sed lobortis. Fusce hendrerit in erat a ullamcorper. Donec tincidunt ornare rutrum. Vestibulum quis risus vitae velit vulputate tristique. Donec nec tortor metus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Quisque blandit mauris in orci iaculis, non fermentum nisl.
                        </p> <!-- /.story-description -->
                    </div>
                </div>
            </div>
        </section>
        <!-- end of our story section -->


        <!-- begin our designation section -->


        <div class="container">
            <div class="headline text-center">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <h2 class="section-title">Development Team</h2>
                    </div>
                </div>
            </div> <!-- /.headline -->
        </div>


        <div class="doctor-list">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="doctor-meta">
                            <div class="doctor-img">
                                <img class="img-responsive center-block" src="images/masum-sir.jpg" alt="">
                            </div>
                            <div class="doctor-info">
                                <div class="row">
                                    <div class="doctor-name text-center">
                                        Md. Masum
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="position text-center">
                                        Associate Professor, CSE Dept. SUST <br> <i>Project Co-ordinator</i>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="doctor-des text-center">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recu nisi nostrum sunt cum, consequuntur.
                                        </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="doctor-social text-center">
                                        <ul class="contact">
                                            <li class="online-contact">
                                                <a href="#" data-toggle="tooltip" title="Share in Facebook"><i class="fa fa-facebook"></i></a>
                                            </li>
                                            <li class="online-contact">
                                                <a href="#" data-toggle="tooltip" title="Connect with Skype"><i class="fa fa-skype"></i></a>
                                            </li>
                                            <li class="online-contact">
                                                <a href="#" data-toggle="tooltip" title="Share in Google +"><i class="fa fa-google-plus"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="doctor-meta">
                            <div class="doctor-img">
                                <img class="img-responsive center-block" src="images/nebir.jpg" alt="">
                            </div>
                            <div class="doctor-info">
                                <div class="row">
                                    <div class="doctor-name text-center">
                                        Md. Mustafij Nebir
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="position text-center">
                                        Student, CSE Dept. SUST <br> <i>Developer</i>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="doctor-des text-center">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recu nisi nostrum sunt cum, consequuntur.
                                        </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="doctor-social text-center">
                                        <ul class="contact">
                                            <li class="online-contact">
                                                <a href="#" data-toggle="tooltip" title="Share in Facebook"><i class="fa fa-facebook"></i></a>
                                            </li>
                                            <li class="online-contact">
                                                <a href="#" data-toggle="tooltip" title="Connect with Skype"><i class="fa fa-skype"></i></a>
                                            </li>
                                            <li class="online-contact">
                                                <a href="#" data-toggle="tooltip" title="Share in Google +"><i class="fa fa-google-plus"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="doctor-meta">
                            <div class="doctor-img">
                                <img class="img-responsive center-block" src="images/shuvo.jpg" alt="">
                            </div>
                            <div class="doctor-info">
                                <div class="row">
                                    <div class="doctor-name text-center">
                                        Tarmim Haque Shuvo
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="position text-center">
                                        Student, CSE Dept. SUST <br> <i>Developer</i>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="doctor-des text-center">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recu nisi nostrum sunt cum, consequuntur.
                                        </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="doctor-social text-center">
                                        <ul class="contact">
                                            <li class="online-contact">
                                                <a href="#" data-toggle="tooltip" title="Share in Facebook"><i class="fa fa-facebook"></i></a>
                                            </li>
                                            <li class="online-contact">
                                                <a href="#" data-toggle="tooltip" title="Connect with Skype"><i class="fa fa-skype"></i></a>
                                            </li>
                                            <li class="online-contact">
                                                <a href="#" data-toggle="tooltip" title="Share in Google +"><i class="fa fa-google-plus"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of designation section -->
@endsection