@extends('layouts.master')
@section('title')
    Products | SUST Becha Kena
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
            <li class="active">
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
                    <h1>Order In Online &amp; Get Your Product</h1>
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
    @include('partials.secondary_nav')


    <div id="loader" style="display: none; background: #444444; padding: 20px; color: #ffffff; text-align: center">
        <i class="fa fa-spin fa-circle-o-notch fa-2x"></i>
    </div>

    <section class="section light-gray-bg theme-list">
        <div class="container">
            <div class="section-content" id="filtered-themes">

            </div>
        </div>
    </section>






@endsection