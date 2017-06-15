@extends('layouts.master')

@section('title')
    Home
@endsection

@section('nav-links')
    <div class="collapse navbar-collapse" id="main-nav-collapse">
        <ul class="nav navbar-nav navbar-right text-uppercase">
            <li class="active">
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li>
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

    <!-- Header -->
    <header id="header" class="header">
        <div class="container-fluid p-l-0 p-r-0">
            <div class="section-content overlay">
                <div class="valign-center">
                    <h1>Oreder In Online &amp; Get Your Product</h1>
                    <p>Start your shopping now !!!</p>

                    {!! Form::open(['route' => 'searchProduct', 'method' => 'post', 'class' => 'form-inline']) !!}
                    <div class="input-group">
                        {{ Form::text('nameSearch', null, ['id' => 'nameSearch', 'placeholder' => 'Search here...', 'class' => 'form-control']) }}
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary btn-lg subscribe-btn" value="Search">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                    {{--<div class="form-group">
                        {{ Form::submit('Search', ['class' => 'btn btn-success']) }}
                    </div>--}}
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </header>
    <!-- /Header -->

    <!-- start: popular section -->
    <section id="popular" class="popular white-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="section-title">
                        <h2>Top Products</h2>
                        <p class="section-sub-title">
                            from people's choice
                        </p> <!-- /.section-sub-title -->
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4">
                        <div class="product-card">
                            <a href="{{ route('product.show', $product) }}">
                                <img class="img-responsive center-block" alt="{{ $product->name }}" src="{{ $product->image }}">
                            </a>
                            <div class="row">
                                <div class="col-md-8">
                                    <a href="{{ route('product.show', $product) }}">
                                        <h4>{{ $product->name }}</h4>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <span>&pound; {{ $product->unit_price }}</span>
                                </div>
                            </div>
                            <p>{{ $product->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center view-all-btn">
                <a href="{{ route('product') }}" class="btn btn-lg btn-default">View All Products</a>
            </div>
        </div>
    </section> <!-- /#popular -->
    <!-- end: popular section-->

    {{-- start: Category section--}}
    <section class="category">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="section-title">
                        <h2>Popular Categories</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-md-4">
                        <div class="product-card">
                            <a href="{{ route('product.show', $product) }}">
                                <img class="img-responsive center-block" alt="{{ $product->name }}" src="{{ $product->image }}">
                            </a>
                            <div class="row">
                                <div class="col-md-8">
                                    <a href="">
                                        <h4>{{ $product->name }}</h4>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <span>&pound; {{ $product->unit_price }}</span>
                                </div>
                            </div>
                            <p>{{ $product->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center view-all-btn">
                <a href="#" class="btn btn-lg btn-default">View All Categories</a>
            </div>
        </div>
    </section>
    {{-- end: category section --}}

    <!--  begin testimonial section  -->
    <section class="testimonial white-bg">
        <div class="container">

            <div class="headline text-center">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="section-title">
                            <h2>Testimonials</h2>
                            <p class="section-sub-title">
                                Review about our job
                            </p> <!-- /.section-sub-title -->
                        </div>
                    </div>
                </div>
            </div> <!-- /.headline -->

            <div id="client-speech" class="owl-carousel owl-theme">

                <div class="item">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="client-box">
                                <div class="about-client">
                                    <img src="{{ url('images/client1.jpg') }}" alt="client1">
                                    <p class="client-intro">Dr Md. Zafar Iqbal</p>
                                </div> <!-- end of /.about-client -->
                                <div class="main-speech">
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                    </p>
                                </div> <!-- end of /.main-speech  -->
                            </div> <!-- end of /.client-box -->
                        </div>

                        <div class="col-md-6">
                            <div class="client-box">
                                <div class="about-client">
                                    <img src="{{ url('images/client2.jpg') }}" alt="client2">
                                    <p class="client-intro">Dr Md. Reza Selim</p>
                                </div> <!-- end of /.about-client -->
                                <div class="main-speech">
                                    <p>
                                        It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that.
                                    </p>
                                </div> <!-- end of /.main-speech  -->
                            </div> <!-- end of /.client-box -->
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="client-box">
                                <div class="about-client">
                                    <img src="{{ url('images/client3.jpg') }}" alt="client3">
                                    <p class="client-intro">Biswapriyo Chakrabarty</p>
                                </div> <!-- end of /.about-client -->
                                <div class="main-speech">
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                    </p>
                                </div> <!-- end of /.main-speech  -->
                            </div> <!-- end of /.client-box -->
                        </div>

                        <div class="col-md-6">
                            <div class="client-box">
                                <div class="about-client">
                                    <img src="{{ url('images/client4.jpg') }}" alt="client4">
                                    <p class="client-intro">Sadia Sultana</p>
                                </div> <!-- end of /.about-client -->
                                <div class="main-speech">
                                    <p>
                                        It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that.
                                    </p>
                                </div> <!-- end of /.main-speech  -->
                            </div> <!-- end of /.client-box -->
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="client-box">
                                <div class="about-client">
                                    <img src="{{ url('images/client5.jpg') }}" alt="client5">
                                    <p class="client-intro">Md. Saiful Islam</p>
                                </div> <!-- end of /.about-client -->
                                <div class="main-speech">
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                    </p>
                                </div> <!-- end of /.main-speech  -->
                            </div> <!-- end of /.client-box -->
                        </div>

                        <div class="col-md-6">
                            <div class="client-box">
                                <div class="about-client">
                                    <img src="{{ url('images/client6.jpg') }}" alt="client6">
                                    <p class="client-intro">Sheikh Nabil Mohammad</p>
                                </div> <!-- end of /.about-client -->
                                <div class="main-speech">
                                    <p>
                                        It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that.
                                    </p>
                                </div> <!-- end of /.main-speech  -->
                            </div> <!-- end of /.client-box -->
                        </div>
                    </div>
                </div>

            </div> <!-- end of /#client-speech  /.owl-carousel -->

        </div> <!-- end of .container -->
    </section>
    <!--  end of testimonial  section -->



@endsection