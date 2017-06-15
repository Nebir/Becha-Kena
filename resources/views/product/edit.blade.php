@extends('layouts.master')

@section('title')
    Update Product
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
    <div class="login-page">
        <div class="page-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="login-content">
                            <h1 class="text-center">Update Your Product</h1>
                            <div class="login-form">
                                {!! Form::open(['route' => ['product.update', $product->id], 'method' => 'put']) !!}
                                <div class="form-group">
                                    {{ Form::text('name', $product->name, ['id' => 'name', 'placeholder' => 'Product Name', 'required' => 'required', 'class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::textarea('description', $product->description, ['placeholder' => 'Product Description', 'required' => 'required', 'class' => 'form-control', 'rows' => '5']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::number('unit_price', $product->unit_price, ['id' => 'unit_price', 'placeholder' => 'Price (ex: $50.00)', 'required' => 'required', 'class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::number('available_quantity', $product->available_quantity, ['id' => 'available_quantity', 'max' => '50', 'min' => '1', 'placeholder' => 'Available Quantity', 'required' => 'required', 'class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    <select name="category_id" class="form-control" required ="required">
                                        <option>Select Product Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{$product->category_id == $category->id ? "selected" :''}}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('product_tag', 'Select Product Tags') }} <br>
                                    @foreach($tags as $tag)
                                        {{ Form::checkbox('product_tag[]', $tag->id, ['class' => 'checkbox-inline', 'checked' => $product->tags->contains($tag->id)]) }} {{ $tag->name }}
                                    @endforeach
                                </div>


                                <div class="form-group">
                                    {{ Form::submit('Update', ['class' => 'btn btn-border-d btn-round']) }}
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