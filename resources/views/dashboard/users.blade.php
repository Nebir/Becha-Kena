@extends('layouts.dashboard_master')

@section('title')
    User List
@endsection

@section('content')
    <h1 class="text-center">All User List</h1>
    <hr>
    <table class="table table-bordered table-responsive table-striped">
        <tr>
            <th>Name</th>
            <th>Department</th>
            <th>Registration No.</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Registration Date</th>
            <th>Action</th>
        </tr>
        @foreach($users as $user)
            <tr class="text-center product-list-table">
                <td>{{ $user->name }}</td>
                <td>{{ $user->department }}</td>
                <td>{{ $user->reg_no }}</td>
                <td>{{ $user->contact_no }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->created_at->format('d-m-Y')}}</td>
                <td>
                        <a data-toggle="tooltip" title="Add to blacklist" href="{{ route('make.blacklist', $user->id) }}" class="btn btn-danger">
                            <i class="ion-alert"></i>
                        </a>
                        <a data-toggle="tooltip" title="Make Admin" href="{{ route('make.admin', $user->id) }}" class="btn btn-info">
                            <i class="ion-gear-a"></i>
                        </a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection