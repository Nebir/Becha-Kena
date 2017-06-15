@extends('layouts.master')

@section('title')
    Alert
@endsection
@section('content')
    <div class="container">
        <div class="row text-center">
            <div class="col-md-6 col-md-offset-3">
                <div style="padding: 100px 0px;">
                    <h4>
                        You are blacklisted. You have cancelled your order previously.
                    </h4>
                    <p>
                        Are you serious now to order products?
                        {{--<a href="{{ route('removeblacklist',[$blacklisted->id]) }}" class="btn btn-success">Yes</a>
                        <a href="{{ route('home') }}" class="btn btn-danger">No</a>--}}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection