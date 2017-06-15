@extends('layouts.master')

@section('title')
    Profile
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
                <li class="dropdown active">
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
    <div class="login-page">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="login-content">
                        <h1 class="text-center">Edit Your Profile</h1>
                        <div class="login-form">
                            {!! Form::open(['route' => ['edit.profile', $user->id], 'method' => 'post', 'files' => true]) !!}
                            <div class="form-group">
                                {{ Form::label('name', 'Name') }}
                                {{ Form::text('name', $user->name, ['id' => 'name', 'placeholder' => 'Your User Name', 'class' => 'form-control']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('email', 'Email Address') }}
                                {{ Form::email('email', $user->email, ['id' => 'email', 'placeholder' => 'Your Email Address', 'class' => 'form-control']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('department', 'Department Name') }}
                                {{ Form::text('department', $user->department, ['id' => 'department', 'placeholder' => 'Your Department Name', 'class' => 'form-control']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('reg_no', 'Registration Number') }}
                                {{ Form::text('reg_no', $user->reg_no, ['id' => 'reg_no', 'placeholder' => 'Your Registration No.', 'class' => 'form-control']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('contact_no', 'Contact Number') }}
                                {{ Form::text('contact_no', $user->contact_no, ['id' => 'contact_no', 'placeholder' => 'Your Contact Number', 'class' => 'form-control']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('address', 'Address') }}
                                {{ Form::text('address', $user->address, ['id' => 'address', 'placeholder' => 'Your Address', 'class' => 'form-control']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::submit('Change', ['class' => 'btn btn-border-d btn-round']) }}
                            </div>
                            {!! Form::close() !!}
                        </div> <!-- /.login-form -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection