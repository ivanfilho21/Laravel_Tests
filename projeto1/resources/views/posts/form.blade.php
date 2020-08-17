@extends('_templates.main')
@section('page-title', ($editMode ? 'Editar' : 'Novo').' Post')

@section('main-content')
<h1>{{ $editMode ? 'Alteração de' : 'Novo' }} Post</h1>

<form action="{{ $formAction }}" method="POST">
    @csrf
    @if ($editMode)
        @method('PUT')
    @endif

    <input type="text" name="titulo" autocomplete="off" placeholder="titulo" value="{{ $editMode ? $post->titulo : old('titulo') }}">
    <br>
    @error('titulo')
        <span class="linha-erro">{{ $message }}</span>
        <br>
    @enderror
    
    <br>
    <label>Conteúdo</label>
    <br>
    <textarea name="conteudo" cols="20" rows="15">{{ $editMode ? $post->body : old('conteudo') }}</textarea>
    <br>
    @error('conteudo')
        <span class="linha-erro">{{ $message }}</span>
        <br>
    @enderror
    
    <br>
    <br>
    <input type="submit" value="{{ $editMode ? 'Salvar' : 'Adicionar' }}">
</form>
@endsection