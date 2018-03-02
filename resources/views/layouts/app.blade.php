<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel CRUD App">
    <meta name="author" content="Eric Totten">
    {{--@yield('meta')--}}

    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <title>@yield('title', config('app.name'))</title>

    {{--<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon.png">--}}
    {{--<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">--}}
    {{--<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">--}}
    {{--<link rel="manifest" href="/manifest.json">--}}
    {{--<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#b8171c">--}}
    {{--<meta name="theme-color" content="#ffffff">--}}

    {{--@stack('before-styles')--}}
    <link href="{!! asset('css/app.css') !!}" rel="stylesheet">
    @stack('after-styles')
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{!! url('/') !!}">
                {!! config('app.name', 'Laravel') !!}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                </ul>
                <ul class="navbar-nav ml-auto">
                    {{--@guest--}}
                        {{--<li><a class="nav-link" href="{!! route('login') !!}">Login</a></li>--}}
                        {{--<li><a class="nav-link" href="{!! route('register') !!}">Register</a></li>--}}
                    {{--@else--}}
                        <li class="nav-item dropdown">
                            {{--<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"--}}
                               {{--data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                {{--{{ Auth::user()->name }} <span class="caret"></span>--}}
                            {{--</a>--}}
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menu <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{!! route('admin.books.index') !!}">Books</a>
                                <a class="dropdown-item" href="{!! route('admin.booksajax.index') !!}">BooksAjax</a>
                                {{--<a class="dropdown-item" href="{!! route('logout') !!}"--}}
                                   {{--onclick="event.preventDefault();--}}
                                   {{--document.getElementById('logout-form').submit();">Logout--}}
                                {{--</a>--}}
                                {{--<form id="logout-form" action="{!! route('logout') !!}" method="POST"--}}
                                      {{--style="display: none;">--}}
                                    {{--@csrf--}}
                                {{--</form>--}}
                            </div>
                        </li>
                    {{--@endguest--}}
                </ul>
            </div>
        </div>
    </nav>
    <main class="py-4">
        <div class="cssload-container" style="display: none;">
            <div class="cssload-speeding-wheel"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
{{--@stack('before-scripts')--}}
<script src="{!! asset('js/app.js') !!}"></script>
@stack('after-scripts')
</body>
</html>
