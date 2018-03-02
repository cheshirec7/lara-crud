@extends('layouts.app')
@section('title', 'View Book :: '.config('app.name'))
@section('content')
    <div class="card-header">
        <h4 class="card-title">Book #{{ $book->id }} (Ajax)</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <tbody>
                {{--<tr>--}}
                {{--<th>ID</th>--}}
                {{--<td>{{ $book->id }}</td>--}}
                {{--</tr>--}}
                <tr>
                    <th>Title</th>
                </tr>
                <tr>
                    <td>{{ $book->title }}</td>
                </tr>
                <tr>
                    <th>Content</th>
                </tr>
                <tr>
                    <td>{{ $book->author }}</td>
                </tr>
                <tr>
                    <th>Category</th>
                </tr>
                <tr>
                    <td>{{ $book->edition }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <a href="{!! route('admin.booksajax.edit', ['book' => $book->id]) !!}"
           title="Edit Book" class="btn btn-primary btn-sm">Edit
        </a>
        {!! link_to('admin/booksajax', 'Back', ['class' => 'btn btn-warning btn-sm']) !!}
    </div>
@endsection
