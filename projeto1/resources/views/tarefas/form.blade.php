@extends('_templates.main')
@section('page-title', ($editMode ? 'Editar' : 'Nova').' Tarefa')

@push('head-styles')
@endpush

@section('main-content')
<h1>{{ $editMode ? 'Alteração de Tarefa' : 'Nova Tarefa' }}</h1>

<form method="POST">
    @csrf

    <input type="text" name="titulo" autocomplete="off" placeholder="Título" value="{{ $editMode ? $tarefa->titulo : '' }}">
    <br>
    @error('titulo')
        <span class="linha-erro">{{ $message }}</span>
        <br>
    @enderror
    <label>
        <input type="checkbox" name="finalizada" {{ $editMode && $tarefa->resolvido ? 'checked' : '' }}>
        Resolvida
    </label>
    <br>
    <br>
    <input type="submit" value="{{ $editMode ? 'Salvar' : 'Adicionar' }}">
</form>
@endsection