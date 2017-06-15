@extends('layouts.master')

@section('title')
    Login | Admin
@endsection

@section('content')
    <div class="login-page">
        <div class="page-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="login-content">
                            <h1 class="text-center"> Admin Log In </h1>
                            <div class="login-form">
                                {!! Form::open(['route' => 'admin', 'method' => 'post']) !!}

                                <div class="form-group">
                                    {{ Form::text('name', null, ['id' => 'name', 'placeholder' => 'User Name', 'class' => 'form-control']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::password('password', ['id' => 'password', 'placeholder' => 'Password', 'class' => 'form-control']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::submit('Login', ['class' => 'btn btn-border-d btn-round']) }}
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