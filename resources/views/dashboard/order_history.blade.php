@extends('layouts.dashboard_master')

@section('title')
    Order History
@endsection

@section('content')
    <h1 class="text-center">All Order List</h1>
    <hr>
    <table class="table table-bordered table-responsive table-striped">
        <tr>
            <th>Customer</th>
            <th>Product Name</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Owner</th>
            <th>Status</th>
        </tr>
        @foreach($orderDetails as $orderDetail)
            <tr class="text-center product-list-table">
                <td>{{ $orderDetail->order->customer->name }}</td>
                <td>{{ $orderDetail->productItem->name }}</td>
                <td>{{ $orderDetail->total_price }}</td>
                <td>{{ $orderDetail->created_at->format('d-m-Y')}}</td>
                <td>{{ $orderDetail->productItem->productOwner->name }}</td>
                <td>
                    @if($orderDetail->status == '1')
                        <p style="color: green;">Completed</p>
                    @else
                        <p style="color: red;">Pending...</p>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
@endsection