@extends('layouts.site')

@section('css')

@endsection

@section('content')
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/dashboard') }}">Home</a>
            @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                <example-component/>
            </div>

            <div class="links">
                <a href="https://laravel.com/docs">Docs</a>
                <a href="https://github.com/devnicholas/larapages">GitHub</a>
            </div>

            @if (session('error'))
            <div class="error">{{ session('error') }}</div>
            @endif
        </div>
    </div>
@endsection