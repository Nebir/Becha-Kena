@extends('layouts.dashboard_master')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container">
        <section class="dashboard-index contact-address bg-white">
            <div class="row">

                <div class="col-md-4 col-xs-12">
                    <div class="address-info">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="address-info-icon text-center center-block bg-light-gray">
                                    <i class="fa fa-users"></i>
                                </div> <!-- /.address-info-icon -->
                            </div>

                            <div class="col-md-8 address-info-desc">
                                <h3>Registered Users</h3>
                                <p>{{ $userCount }}</p>
                            </div> <!-- /.address-info-desc -->

                        </div>
                    </div> <!-- /.address-info -->
                </div>

                <div class="col-md-4 col-xs-12">
                    <div class="address-info">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="address-info-icon text-center center-block bg-light-gray">
                                    <i class="fa fa-briefcase"></i>
                                </div> <!-- /.address-info-icon -->
                            </div>

                            <div class="col-md-8 address-info-desc">
                                <h3>Total Products</h3>
                                <p>{{ $productCount }}</p>
                            </div> <!-- /.address-info-desc -->

                        </div>
                    </div> <!-- /.address-info -->
                </div>

                <div class="col-md-4 col-xs-12">
                    <div class="address-info">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="address-info-icon text-center center-block bg-light-gray">
                                    <i class="fa fa-cart-arrow-down"></i>
                                </div> <!-- /.address-info-icon -->
                            </div>

                            <div class="col-md-8 address-info-desc">
                                <h3>Completed Orders</h3>
                                <p>{{ $completedOrdersCount }}</p>
                            </div> <!-- /.address-info-desc -->

                        </div>
                    </div> <!-- /.address-info -->
                </div>

            </div>
        </section>
        <section class="dashboard-index">
            <div class="row">
                <div class="col-md-4">
                    <div class="daily-order-info-box">
                        <p class="dashboard-card-header text-center">Daily Order Information</p>
                        <div class="daily-info">
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <h1>{{ $dailyOrderCount }}</h1>
                                    <h4>Order is placed</h4>
                                </div>
                                <div class="col-md-6">
                                    <h1>{{ $price_total }}</h1>
                                    <h4>Total price of Orders</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="daily-order-info-box">
                        <p class="dashboard-card-header text-center">Last 5 Orders</p>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-responsive table-bordered table-striped" style="margin-bottom: 0px;">
                                    <tr>
                                        <th>Customer</th>
                                        <th>Product</th>
                                        <th>Owner</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                    @foreach($lastOrders as $lastOrder)
                                        <tr class="text-center product-list-table">
                                            <td>{{ $lastOrder->order->customer->name }}</td>
                                            <td>{{ $lastOrder->productItem->name }}</td>
                                            <td>{{ $lastOrder->productItem->productOwner->name }}</td>
                                            <td>{{ $lastOrder->total_price }}</td>
                                            <td>{{ $lastOrder->created_at->format('d-m-Y')}}</td>
                                            <td>
                                                @if($lastOrder->status == '1')
                                                    <p style="color: green;">Completed</p>
                                                @else
                                                    <p style="color: red;">Pending...</p>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="monthly-chart">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center">Monthly Order Statistics</h1>
                    <canvas id="monthlyChart"></canvas>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        var ctx = document.getElementById("monthlyChart").getContext("2d");
        var data = {
            labels: {{ json_encode($daysArray) }},
            datasets: [
                {
                    label: "My First dataset",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: {{ json_encode($dailyOrderCounts) }}
                }
            ]
        };
        var myLine = new Chart(ctx).Line(data);
    </script>
@endsection