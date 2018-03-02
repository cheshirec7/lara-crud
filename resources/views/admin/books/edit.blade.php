@extends('layouts.app')
@section('title', 'Edit Book :: '.config('app.name'))
@section('content')
    {!! Form::model($book, ['method' => 'PATCH', 'route' => ['admin.books.update', $book->id]]) !!}
    <div class="card-header">
        <h4 class="card-title">Edit Book</h4>
    </div>
    <div class="card-body">
        @include('includes.partials.messages')
        @include ('admin.books.form')
    </div>
    <div class="card-footer">
        {!! Form::submit('Update', ['class' => 'btn btn-primary btn-sm']) !!}
        {!! link_to('admin/books', 'Cancel', ['class' => 'btn btn-warning btn-sm']) !!}
    </div>
    {!! Form::close() !!}
@endsection

