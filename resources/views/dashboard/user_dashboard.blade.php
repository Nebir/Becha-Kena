@extends('layouts.dashboard_master')

@section('title')
    Dashboard
@endsection

@section('dashboard_nav')
    <nav id="comparisonNavigation" class="navbar" role="navigation">
        <ul class="nav navbar-nav">
            <li class="active">
                <a href="{{ route('dashboard', $authUser->id) }}">Main Dashboard</a>
            </li>
        </ul>
    </nav>
@endsection

@section('content')
    <div class="daily-info">
        <div class="row">
            @include('includes.danger_alert')
            @include('includes.success_alert')
        </div>

        <div class="row">
            <div class="col-md-6">
                <h1>Daily Order Infomation</h1>
                <div class="row">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="monthly-stat">
        <div class="row">
            <div class="col-md-12">
                <h1>Monthly Order Statistics</h1>
                <!-- bar chart of monthly order -->
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>
    </div>

@endsection

