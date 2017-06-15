@extends('layouts.master')

@section('title')
    Registration
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
                <li class="active">
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
    <div class="login-page">
        <div class="page-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="login-content">
                            <h1 class="text-center">Registration</h1>
                            <div class="login-form">
                                {!! Form::open(['route' => 'registration', 'method' => 'post', 'files' => true]) !!}
                                <div class="form-group">
                                    {{ Form::label('name', 'Name *') }}
                                    {{ Form::text('name', null, ['id' => 'name', 'placeholder' => 'Your Name', 'class' => 'form-control']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('email', 'Email Address *') }}
                                    {{ Form::email('email', null, ['id' => 'email', 'placeholder' => 'Your Email Address', 'class' => 'form-control']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('password', 'Password *') }}
                                    {{ Form::password('password', ['id' => 'password', 'placeholder' => 'Your Password', 'class' => 'form-control']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('password_confirmation', 'Confirm Password *') }}
                                    {{ Form::password('password_confirmation', ['id' => 'password_confirmation', 'placeholder' => 'Repeat Password', 'class' => 'form-control']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('img', 'Upload Your Image') }}
                                    {{ Form::file('img', null, ['id' => 'img', 'placeholder' => 'Your Image', 'class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('department', 'Choose Your Department *') }}
                                    <select name="department" class="form-control">
                                        <option>Your Department</option>
                                        <option value="CSE">CSE</option>
                                        <option value="EEE">EEE</option>
                                        <option value="SE">SE</option>
                                        <option value="CEP">CEP</option>
                                        <option value="IPE">IPE</option>
                                        <option value="CEE">CEE</option>
                                        <option value="ME">ME</option>
                                    </select>
                                </div>

                                {{--<div class="form-group">
                                    {{ Form::label('department', 'Department Name *') }}
                                    {{ Form::text('department', null, ['id' => 'department', 'placeholder' => 'Your Department Name', 'class' => 'form-control']) }}
                                </div>--}}

                                <div class="form-group">
                                    {{ Form::label('reg_no', 'Registration Number *') }}
                                    {{ Form::text('reg_no', null, ['id' => 'reg_no', 'placeholder' => 'Your Registration No.', 'class' => 'form-control']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('contact_no', 'Contact Number *') }}
                                    {{ Form::text('contact_no', null, ['id' => 'contact_no', 'placeholder' => 'Your Contact Number', 'class' => 'form-control']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('address', 'Address *') }}
                                    {{ Form::text('address', null, ['id' => 'address', 'placeholder' => 'Your Address', 'class' => 'form-control']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::submit('Register', ['class' => 'btn btn-border-d btn-round']) }}
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