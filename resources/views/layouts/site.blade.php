<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Plugins -->
    @foreach(config('app.plugins') as $plugin)
        @if($plugin['active'])
            @foreach($plugin['files'] as $file)
                @if($file['type']=='js')
                    <script src="{{ $file['location'] }}" defer></script>
                @elseif($file['type']=='css')
                    <link href="{{ $file['location'] }}" rel="stylesheet">
                @endif
            @endforeach
        @endif
    @endforeach

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    <div id="app">
        @include('globals.header')
        @yield('content')
        @include('globals.footer')   
    </div>
    <!-- Scripts -->
    @yield('js')
</body>
</html>
