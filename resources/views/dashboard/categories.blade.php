@extends('layouts.dashboard_master')

@section('title')
    Categories
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h1 style="margin-top: 20px;">Add New Category</h1>
            <hr>
            {!! Form::open(['route' => 'category.create', 'method' => 'post', 'files' => true]) !!}
            <div class="form-group">
                {{ Form::text('name', null, ['id' => 'name', 'placeholder' => 'Category Name', 'required' => 'required', 'class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('image', 'Upload Product Image') }}
                {{ Form::file('image', null, ['id' => 'image', 'placeholder' => 'Category Image', 'class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <select name="parent_id" class="form-control">
                    <option value="{{ $categoryCount }}">Choose Parent Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                {{ Form::submit('Create', ['class' => 'btn btn-border-d btn-round']) }}
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-md-6">
            <table style="margin-top: 30px;" class="table table-bordered table-responsive table-striped">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Delete</th>
                </tr>
                @foreach($categories as $category)
                    <tr class="text-center product-list-table">
                        <td>
                            <img class="img-responsive center-block" src="{{ asset($category->image) }}" alt="">
                        </td>
                        <td>{{ $category->name }}</td>
                        <td><a href="{{ route('delete.catagory', $category->id) }}" class="btn btn-danger"><i class="ion-ios-trash-outline"></i></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection