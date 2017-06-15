@extends('layouts.dashboard_master')

@section('title')
    Admins
@endsection

@section('content')
    <h1 class="text-center">Admin List</h1>
    <hr>
    <table class="table table-bordered table-responsive table-striped">
        <tr>
            <th>Name</th>
            <th>Department</th>
            <th>Registration No.</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
        @foreach($users as $user)
            <tr class="text-center product-list-table">
                <td>{{ $user->name }}</td>
                <td>{{ $user->department }}</td>
                <td>{{ $user->reg_no }}</td>
                <td>{{ $user->contact_no }}</td>
                <td>{{ $user->address }}</td>
                <td>
                    <a href="{{ route('remove.admin', $user->id) }}" class="btn btn-danger">Remove Adminship</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection