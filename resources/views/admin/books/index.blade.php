@extends('layouts.app')
@section('title', 'View All Books :: '.config('app.name'))
@section('content')
    <div class="card-header">
        {!! link_to_route('admin.books.create', 'New Book', [], ['class' => 'btn btn-success btn-sm float-right',
            'title' => 'New Book', 'id' => 'btnCreate']) !!}
        <h4 class="card-title">All Books</h4>
    </div>
    <div class="card-body">
        @include('includes.partials.messages')
        <div class="table-responsive">
            <table class="table table-striped table-sm table-hover">
                <thead>
                <tr>
                    {{--<th>#</th>--}}
                    <th>Title</th>
                    <th>Author</th>
                    <th>Edition</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($books as $book)
                    <tr>
                        {{-- <td>{{ $loop->iteration or $item->id }}</td>--}}
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->edition }}</td>
                        <td>
                            <a href="{!! route('admin.books.show', ['book' => $book->id]) !!}" title="View Book"
                               class="btn btn-info btn-sm">View
                            </a>
                            <a href="{!! route('admin.books.edit', ['book' => $book->id]) !!}"
                               title="Edit Book" class="btn btn-primary btn-sm">Edit
                            </a>
                            <a href="{!! route('admin.books.destroy', ['book' => $book->id]) !!}"
                               title="Delete Book"
                               data-method="delete"
                               data-trans-title="Are you sure you want to delete book:"
                               data-trans-text="{{ $book->title }}" class="btn btn-sm btn-danger">Del
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{--<div class="pagination-wrapper"> {!! $books->appends(['search' => Request::get('search')])->render() !!} </div>--}}
        </div>
    </div>
@endsection

