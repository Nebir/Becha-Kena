@extends('layouts.dashboard_master')

@section('title')
    Product List
@endsection

@section('content')
    <h1 class="text-center">All Products List</h1>
    <hr>
    <table class="table table-bordered table-responsive table-striped">
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Category</th>
            <th>Unit Price</th>
            <th>Available Quantity</th>
            <th>Owner</th>
            <th>Last Modified At</th>
            <th>Action</th>
        </tr>
        @foreach($products as $product)
            <tr class="text-center product-list-table">
                <td>
                    <img class="img-responsive center-block" src="{{ asset($product->image) }}" alt="">
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->unit_price }}</td>
                <td>{{ $product->available_quantity }}</td>
                <td>{{ $product->productOwner->name }}</td>
                <td>{{ $product->updated_at->format('d-m-Y')}}</td>
                <td><a class="btn btn-danger" href="{{ route('products.delete', $product->id) }}"><i class="ion-ios-trash-outline"></i></a></td>
            </tr>
        @endforeach
    </table>
@endsection