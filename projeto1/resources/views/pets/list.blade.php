@extends('_templates.main')
@section('page-title', 'Pets')

@section('main-content')
<h1>Lista de Pets</h1>

<a href="{{ route('pets.create') }}">Novo Pet</a>

@if (empty($pets->count()))
<x-alert>
    @slot('alertType')
        Alerta
    @endslot
    Não há pets.
</x-alert>
@else
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Idade</th>
            <th>Nascimento</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pets as $pet)
            <tr>
                <td>{{ $pet->nome }}</td>
                <td>{{ $pet->idade }}</td>
                <td>{{ date('d/m/Y', strtotime($pet->data_nascimento)) }}</td>
                <td>
                    <a href="{{ route('pets.view', ['id' => $pet->id]) }}">Ver</a>
                    <a href="{{ route('pets.update', ['id' => $pet->id]) }}">Editar</a>
                    <a href="{{ route('pets.delete', ['id' => $pet->id]) }}" onclick="return confirm('Deseja mesmo apagar o pet?')">Apagar</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection