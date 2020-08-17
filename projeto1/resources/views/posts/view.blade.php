@extends('_templates.main')
@section('page-title', $post->titulo)

@section('main-content')
<h1>{{ $post->titulo }}</h1>

<div>
    {{ $post->body }}
</div>

<hr>
<p>Criado em: {{ $post->created_at }}</p>
<p>Criado em: {{ $post->updated_at }}</p>

<br><br>
<a href="{{ route('posts.edit', ['post' => $post->id]) }}">Editar</a>
<br>
<br>
<form method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Deseja mesmo apagar este post?')">Delete</button>
</form>
@endsection