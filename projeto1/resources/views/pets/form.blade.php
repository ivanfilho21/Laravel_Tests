@extends('_templates.main')
@section('page-title', ($editMode ? 'Editar' : 'Novo').' Pet')

@section('main-content')
<h1>{{ $editMode ? 'Alteração de' : 'Novo' }} Pet</h1>

<form method="POST">
    @csrf

    <input type="text" name="nome" autocomplete="off" placeholder="Nome" value="{{ $editMode ? $pet->nome : old('nome') }}">
    <br>
    @error('nome')
        <span class="linha-erro">{{ $message }}</span>
        <br>
    @enderror
    
    <br>
    <label>Data de Nascimento</label>
    <br>
    <input type="date" name="data-nascimento" value="{{ $editMode ? $pet->data_nascimento : (old('data-nascimento') ?? date('Y-m-d')) }}">
    <br>
    @error('data-nascimento')
        <span class="linha-erro">{{ $message }}</span>
        <br>
    @enderror

    <br>
    <br>
    <input type="submit" value="{{ $editMode ? 'Salvar' : 'Adicionar' }}">
</form>
@endsection