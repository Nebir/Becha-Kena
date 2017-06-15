@extends('layouts.master')

@section('title')
    Login
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
                        <img class="img-responsive" src="{{ Auth::user()->image }}" alt="{{ Auth::user()->name }}">
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
                <li class="active">
                    <a href="{{ route('login') }}">Login</a>
                </li>
            @endif
        </ul>
    </div><!-- nav links -->
@endsection

@section('content')
    <div class="login-page">
        <div class="page-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="login-content">
                            <h1 class="text-center">Log In</h1>
                            <div class="login-form">
                                {!! Form::open(['route' => 'login', 'method' => 'post']) !!}

                                    <div class="form-group">
                                        {{ Form::email('email', null, ['id' => 'email', 'placeholder' => 'Your Email Address', 'class' => 'form-control']) }}
                                    </div>

                                    <div class="form-group">
                                        {{ Form::password('password', ['id' => 'password', 'placeholder' => 'Your Password', 'class' => 'form-control']) }}
                                    </div>

                                    <div class="form-group">
                                        {{ Form::submit('Login', ['class' => 'btn btn-border-d btn-round']) }}
                                    </div>
                                {!! Form::close() !!}
                            </div> <!-- /.login-form -->
                        </div>
                    </div><!-- /.col-md-6 col-md-offset-3 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div> <!-- /.page-wrapper -->
    </div> <!-- /.login-page -->
@endsection