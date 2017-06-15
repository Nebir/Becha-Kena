@extends('layouts.master')

@section('title')
    Search Result
@endsection

@section('nav-links')
    <div class="collapse navbar-collapse" id="main-nav-collapse">
        <ul class="nav navbar-nav navbar-right text-uppercase">
            <li>
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
                    <h1>Search Results</h1>
                </div>
            </div>
        </div>
    </header>
    <!-- /Header -->



    <!-- start: popular section -->
    <section id="popular" class="popular white-bg">
        <div class="container">
            <div class="row">
                @foreach($productList as $product)
                    <div class="col-md-4">
                        <div class="product-card">
                            <a href="{{ route('product.show', $product) }}">
                                <img class="img-responsive center-block" alt="{{ $product->name }}" src="{{ $product->image }}">
                            </a>
                            <div class="row">
                                <div class="col-md-7">
                                    <a href="{{ route('product.show', $product) }}">
                                        <h4>{{ $product->name }}</h4>
                                    </a>
                                </div>
                                <div class="col-md-5">
                                    <span>৳ {{ $product->unit_price }}</span>
                                </div>
                            </div>
                            <p>{{ $product->description }}</p>
                        </div>
                    </div>

                @endforeach
            </div>

            <div class="text-center view-all-btn">
                <a href="{{ route('product') }}" class="btn btn-lg btn-default">View All Product</a>
            </div>
        </div>
    </section> <!-- /#popular -->
    <!-- end: popular section-->

@endsection

