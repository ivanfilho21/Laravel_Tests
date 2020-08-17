@extends('_templates.basic')

@push('head-styles')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/table.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap" rel="stylesheet">
@endpush

@section('body')
    <header>
        <a class="logo" href="{{ route('home') }}">
            <img src="{{ asset('logo.png') }}" alt="Logo">
            <span class="txt">LOGO</span>
        </a>

        <nav>
            <ul class="nav-links">
                <li><a href="{{ route('home') }}">Início</a></li>
                <li><a href="{{ route('tarefas') }}">Tarefas</a></li>
                <li><a href="{{ route('pets') }}">Pets</a></li>
                <li><a href="{{ route('posts.index') }}">Posts</a></li>
            </ul>
        </nav>

        <a class="button" href="{{ route('admin') }}">Admin</a>
    </header>

    <main>
        <div class="container">@yield('main-content')</div>
    </main>
    
    <footer></footer>
@endsection