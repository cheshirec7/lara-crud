@extends('layouts.app')
@section('title', 'View All Books (Ajax) :: '.config('app.name'))
{{--@push('after-styles')--}}
    {{--<style>--}}
        {{--div.dataTables_wrapper div.dataTables_info {--}}
            {{--padding-top: 0;--}}
        {{--}--}}
    {{--</style>--}}
{{--@endpush--}}
@section('content')
    <div class="card-header">
        {!! link_to_route('admin.booksajax.create', 'New Book', [], ['class' => 'btn btn-success btn-sm float-right',
            'title' => 'New Book', 'id' => 'btnCreate']) !!}
        <h4 class="card-title">All Books (Ajax)</h4>
    </div>
    <div class="card-body">
        @include('includes.partials.messages')
        <div class="table-responsive">
            <table id="books-table" class="table table-bordered table-striped table-sm table-hover">
                <thead class="thead-dark">
                <tr>
                    <th>Title&nbsp;</th>
                    <th>Author&nbsp;</th>
                    <th>Edition&nbsp;</th>
                    <th>Actions&nbsp;</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@push('after-scripts')
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    {!! Html::script("https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.js") !!}
    <script>
        $(document).ready(function () {
            $('#books-table').DataTable({
                processing: false,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{!! url("admin/booksajax/datatable") !!}',
                    type: 'get',
                    error: function (xhr, err) {
                        if (err === 'parsererror')
                            location.reload();
                    }
                },
                columns: [
                    {data: 'title', name: 'title'},
                    {data: 'author', name: 'author'},
                    {data: 'edition', name: 'edition'},
                    {data: 'actions', name: 'actions', sortable: false}
                ],
                language: {
                    emptyTable: 'No books found'
                }
            });
        });
    </script>
@endpush