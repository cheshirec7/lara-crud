@extends('layouts.app')
@section('title', 'Create Book :: '.config('app.name'))
@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['admin.books.store']]) !!}
    <div class="card-header">
        <h4 class="card-title">Create New Book</h4>
    </div>
    <div class="card-body">
        @include('includes.partials.messages')
        @include ('admin.books.form')
    </div>
    <div class="card-footer">
        {!! Form::submit('Create', ['class' => 'btn btn-primary btn-sm']) !!}
        {!! link_to('admin/books', 'Cancel', ['class' => 'btn btn-warning btn-sm']) !!}
    </div>
    {!! Form::close() !!}
@endsection
