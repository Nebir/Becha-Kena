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
<div class="profile-page">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="profile-information">
                    <div class="profile-picture">
                        <img class="img-responsive center-block" src="{{ asset($user->image) }}" alt="{{$user->name}}">
                        <div class="avatar-change">
                            <i class="ion-ios-camera-outline" data-toggle="modal" data-target="#avatarModal"></i>
                        </div>
                    </div>
                    <h3 class="text-center">{{$user->name}}</h3>
                    <div class="user-information">
                        <ul>
                            <li>
                                <i class="ion-ios-email-outline"></i>
                                <span>{{$user->email}}</span>
                            </li>
                            <li>
                                <i class="ion-ios-location-outline"></i>
                                <span>{{$user->address}}</span>
                            </li>
                            <li>
                                <i class="ion-ios-telephone-outline"></i>
                                <span>{{$user->contact_no}}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('edit.profile') }}" class="btn btn-border-d btn-round">Edit Bio</a>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#yourProducts" aria-controls="yourProducts" role="tab" data-toggle="tab">Your Products</a></li>
                        <li role="presentation"><a href="#purchaseHistory" aria-controls="purchaseHistory" role="tab" data-toggle="tab">Purchase History</a></li>
                        <li role="presentation"><a href="#orderOfYourProduct" aria-controls="orderOfYourProduct" role="tab" data-toggle="tab">Order of Your Product</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="yourProducts">
                            <div class="row tab-header">
                                <div class="col-md-6">
                                    <h3>List of Your Own Products</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('product.create') }}" class="btn btn-border-d btn-round">
                                        Add New Item
                                    </a>
                                </div>
                            </div>
                            <div class="product-list">
                                <table class="table table-responsive table-bordered table-striped">
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Unit Price</th>
                                        <th>Quantity</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach($productRows as $productRow)
                                        <tr class="text-center product-list-table">
                                            <td><img class="img-responsive center-block img-thumbnail" src="{{ asset($productRow->image) }}" alt="{{ $productRow->name }}"></td>
                                            <td>{{ $productRow->name }}</td>
                                            <td>{{ $productRow->category->name }}</td>
                                            <td> $ {{ $productRow->unit_price }}</td>
                                            <td>{{ $productRow->available_quantity }}</td>
                                            <td>
                                                @if($productRow->status == '1')
                                                    <div class="button-group">
                                                        <a href="{{ route('product.edit', $productRow->id) }}" class="btn btn-border-d btn-round">Edit</a>
                                                        <a href="{{ route('product.delete', $productRow->id) }}" class="btn btn-border-d btn-round">Delete</a>
                                                    </div>
                                                @else
                                                    <p>Pending...</p>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="purchaseHistory">
                            <div class="purchase-history-tab">
                                <table class="table table-bordered table-responsive table-striped">
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Product Price</th>
                                        <th>Purchasing Quantity</th>
                                        <th>Total Price</th>
                                        <th>Purchasing Date</th>
                                    </tr>
                                    @foreach($purchasingList as $purchase)
                                        @foreach($purchase->orderProductItems as $item)
                                            <tr class="text-center">
                                                <td>{{ $item->productItem->name }}</td>
                                                <td>{{ $item->unit_price }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->total_price }}</td>
                                                <td>{{ $item->created_at->format('Y.m.d') }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="orderOfYourProduct">
                            <div class="purchase-history-tab">
                                <table class="table table-bordered table-responsive table-striped">
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Contact No.</th>
                                        <th>Address</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Order Date</th>
                                    </tr>
                                    @foreach($pending_orders as $pending_order)
                                        <tr class="text-center">
                                            <td>{{ $pending_order->order->customer->name }}</td>
                                            <td>{{ $pending_order->order->customer->contact_no }}</td>
                                            <td>{{ $pending_order->order->customer->address }}</td>
                                            <td>{{ $pending_order->productItem->name }}</td>
                                            <td>{{ $pending_order->quantity }}</td>
                                            <td>{{ $pending_order->total_price }}</td>
                                            <td>{{ $pending_order->created_at->format('Y.m.d') }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                {{--purchse history--}}
                {{--kara kara order korche seta --}}
                {{--own product list--}}
            </div>

            <!-- Modal -->
            <div class="modal fade" id="avatarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Change Your Avatar</h4>
                        </div>
                        <div class="modal-body text-center">
                            {!! Form::open(['route' => ['edit.avatar', $user->id], 'method' => 'post', 'files' => true]) !!}
                                <div class="form-group">
                                    {{ Form::label('image', 'Choose Your Avatar') }}
                                    {{ Form::file('image', null, ['id' => 'image', 'class' => 'form-control center-block']) }}
                                </div>
                            <div class="form-group">
                                {{ Form::submit('Save Your Change', ['class' => 'btn btn-border-d btn-round']) }}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection