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
    <section class="single-product-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="row single-product-content">
                        <div class="col-sm-6">
                            <img class="img-responsive center-block" src="{{ $product->image }}" alt="{{ $product->name }}">
                        </div>
                        <div class="col-sm-6">
                            <h2 class="product-title font-alt">{{ $product->name }}</h2>
                            <div class="price font-alt">
                                <span class="amount">৳ {{ $product->unit_price }}</span>
                            </div>
                            <br>
                            <p><strong>Product Owner:</strong> {{$product->productOwner->name}}</p>
                            <p><strong>Contact:</strong> {{ $product->productOwner->contact_no }}</p>
                        </div>
                    </div>
                    <div class="row single-product-content">
                        <div class="col-sm-12">
                            <p>
                                <strong>Product Info: </strong>{{$product->description}}
                            </p>
                            <p>
                                <strong>Tags:</strong>
                                @foreach($product->tags as $tag )
                                    <a href="">{{ $tag->name }}</a>
                                @endforeach
                            </p>
                        </div>
                    </div>
                    <div class="row single-product-content">
                        {!! Form::open(['url' => route('product.order',$product->id), 'method' => 'post']) !!}

                        <div class="form-group col-sm-6">
                            {{ Form::number('qty', 1, ['id' => 'qty', 'max' => '40', 'min' => '1', 'required' => 'required', 'class' => 'form-control input-lg']) }}
                        </div>
                        <div class="form-group col-sm-6">
                            {{ Form::submit('Add To Cart', ['class' => 'btn btn-block btn-round btn-b btn-atc']) }}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="col-sm-6">
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
                            <div class="col-md-4">
                                <h4>Total: ৳{{ \Cart::total() }}</h4>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('clearCart') }}" class="btn btn-danger pull-right">Clear All</a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('checkout') }}" class="btn btn-success pull-right">Checkout</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

{{--  Related Products have to be added  --}}



@endsection