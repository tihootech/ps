<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'PS')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('img/favicon.jpg')}}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito|Material+Icons" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>

    <div id="app">

        @auth
            @include('includes.header')
        @endauth

        <main class="py-4">

            <div class="container-fluid">
                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {!! session('message') !!}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {!! session('error') !!}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul class="mt-3">
                            @foreach ($errors->all() as $error)
                                <li> {{$error}} </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('messages') && is_array(session('messages')))
                    <div class="alert alert-success" role="alert">
                        <ul class="mt-3">
                            @foreach (session('messages') as $msg)
                                <li> {!!$msg!!} </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')
            </div>

        </main>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>
</html>
