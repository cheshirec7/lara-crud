@extends('layouts.app')
@section('title', 'Create Book :: '.config('app.name'))
@section('content')
    {{--{!! Form::open(['method' => 'POST', 'route' => ['admin.booksajax.store']]) !!}--}}
    <form id="frmAjaxCreate">
        <div class="card-header">
            <h4 class="card-title">Create New Book (Ajax)</h4>
        </div>
        <div class="card-body">
            @include('includes.partials.messages')
            @include ('admin.booksajax.form')
        </div>
        <div class="card-footer">
            {!! Form::submit('Create', ['class' => 'btn btn-primary btn-sm']) !!}
            {!! link_to('admin/booksajax', 'Cancel', ['class' => 'btn btn-warning btn-sm']) !!}
        </div>
    </form>
    {{--{!! Form::close() !!}--}}
@endsection
@push('after-scripts')
    <script>
        $(document).ready(function () {

            $("#frmAjaxCreate").submit(function (e) {

                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: '/admin/booksajax',
                    data: $("#frmAjaxCreate").serialize(),
                    success: function (data) {
                        if (data.status !== 200) {
                            window.location.reload(); //show session errors
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
