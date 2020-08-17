@extends('layouts.app')
@section('page-title', 'Configurações')

@section('content')
<h1>Configurações</h1>

<form action="{{ route('config.message') }}" method="POST">
    @method('PUT')
    @csrf
    <label for="message">Mensagem Inicial</label><br>

    <textarea name="message" id="message" cols="30" rows="10">{{ $config->message ?? old('message') }}</textarea>

    @error('message')
        <br>
        <span>
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <br>
    <button type="submit">Salvar</button>
</form>
@endsection