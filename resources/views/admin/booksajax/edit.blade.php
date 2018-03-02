@extends('layouts.app')
@section('title', 'Edit Book :: '.config('app.name'))
@section('content')
    {!! Form::model($book, ['id' => 'frmAjaxEdit', 'method' => 'PATCH', 'route' => ['admin.booksajax.update', $book->id]]) !!}
    <div class="card-header">
        <h4 class="card-title">Edit Book (Ajax)</h4>
    </div>
    <div class="card-body">
        @include('includes.partials.messages')
        @include ('admin.booksajax.form')
    </div>
    <div class="card-footer">
        {!! Form::submit('Update', ['class' => 'btn btn-primary btn-sm']) !!}
        {!! link_to('admin/booksajax', 'Cancel', ['class' => 'btn btn-warning btn-sm']) !!}
    </div>
    {!! Form::close() !!}
@endsection
@push('after-scripts')
    <script>
        $(document).ready(function () {

            $("#frmAjaxEdit").submit(function (e) {

                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: '/admin/booksajax/{!! $book->id !!}',
                    data: $("#frmAjaxEdit").serialize(),
                    success: function (data) {
                        if (data.status !== 200 && data.status !== 404) {
                            window.location.reload();  //show session errors
                        } else {
                            window.location = '/admin/booksajax';
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });

            });
        });
    </script>
@endpush


