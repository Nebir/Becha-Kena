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
                <li class="active">
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
    <section class="checkout-page">
        <div class="container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="cart">
                <h3 class="text-center">Your Cart</h3>
                <table class="table table-bordered text-center table-responsive table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                        <th>Remove</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach(\Cart::content() as $row)
                        <tr>
                            <td>
                                <p><strong>{{ $row->name }}</strong></p>
                            </td>
                            <td> {{ $row->qty }} </td>
                            <td>৳ {{ $row->price }}</td>
                            <td>৳ {{ $row->subtotal }}</td>
                            <td><a href="{{route('cancel.order', $row->rowId)}}"><i class="ion-ios-trash-outline"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="text-right">Total: ৳{{ \Cart::total() }}</h4>
                    </div>
                </div>

            </div>

            {{--<h3 class="text-center" style="margin-bottom: 30px;">Give Your Information</h3>--}}
            {!! Form::open(['url' => route('checkout'), 'method' => 'post']) !!}

            {{--<div class="form-group col-sm-6">
                {{ Form::text('address', null, ['id' => 'address', 'placeholder' => 'Your Address', 'required' => 'required', 'class' => 'form-control input-lg']) }}
            </div>
            <div class="form-group col-sm-6">
                {{ Form::text('phone', null, ['id' => 'phone',  'placeholder' => 'Mobile No.', 'required' => 'required', 'class' => 'form-control input-lg']) }}
            </div>--}}
            <div class="form-group col-sm-12 text-center">
                {{ Form::submit('Purchase', ['class' => 'btn btn-round btn-b btn-atc']) }}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
    </section>

@endsection