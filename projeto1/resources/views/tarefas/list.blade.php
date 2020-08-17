@extends('_templates.main')
@section('page-title', 'Tarefas')

@push('head-styles')
@endpush

@section('main-content')
    <h1>Lista de Tarefas</h1>

    <a href="{{ route('tarefas.add') }}">Nova Tarefa</a>

    @if (empty($tarefas))
    <x-alert>
        @slot('alertType')
            Alerta
        @endslot
        Não há tarefas.
    </x-alert>
    @else
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Situação</th>
                <th>Opções</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tarefas as $tarefa)
                <tr>
                    <td>{{ $tarefa->titulo }}</td>
                    <td>{{ $tarefa->resolvido ? 'Resolvida' : 'Em aberto' }}</td>
                    <td>
                        <a href="{{ route('tarefas.view', ['id' => $tarefa->id]) }}">Ver</a>
                        <a href="{{ route('tarefas.edit', ['id' => $tarefa->id]) }}">Editar</a>
                        <a href="{{ route('tarefas.delete', ['id' => $tarefa->id]) }}" onclick="return confirm('Deseja mesmo apagar a tarefa?')">Apagar</a>
                        <a href="{{ route('tarefas.toggleCheck', ['id' => $tarefa->id]) }}">{{ $tarefa->resolvido ? 'Desmarcar' : 'Marcar' }} como Resolvida</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
@endsection