@extends('_templates.main')
@section('page-title', 'Posts')

@section('main-content')
<h1>Lista de Posts</h1>

<a href="{{ route('posts.create') }}">Novo Post</a>

@if (empty($posts->count()))
<x-alert>
    @slot('alertType')
        Alerta
    @endslot
    Não há posts.
</x-alert>
@else
<table>
    <thead>
        <tr>
            <th>Título</th>
            <th>Conteúdo</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
            <tr>
                <td>{{ $post->titulo }}</td>
                <td>{{ $post->body }}</td>
                <td>
                    <a href="{{ route('posts.show', ['post' => $post->id]) }}">Ver</a>
                    <a href="{{ route('posts.edit', ['post' => $post->id]) }}">Editar</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection