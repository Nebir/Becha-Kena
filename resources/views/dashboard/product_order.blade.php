@extends('layouts.dashboard_master')

@section('title')
    Order History
@endsection

@section('content')
    <h1 class="text-center">Product Based Order List</h1>
    <hr>
    <table class="table table-bordered table-responsive table-striped">
        <tr>
            <th>Product Name</th>
            <th>Category</th>
            <th>Product Price</th>
            <th>Total Order</th>
            <th>Total Earnings</th>
            <th>Owner</th>
        </tr>
        @for($i=0; $i<$productCount; $i++)
            <tr class="text-center product-list-table">
                <td>{{ $productItems[$i]->name }}</td>
                <td>{{ $productItems[$i]->category->name }}</td>
                <td>{{ $productItems[$i]->unit_price }}</td>
                <td>{{ $productOrderCount[$i]}}</td>
                <td>{{$productOrderCount[$i] * $productItems[$i]->unit_price}}</td>
                <td>{{ $productItems[$i]->productOwner->name }}</td>
            </tr>
        @endfor
    </table>
@endsection