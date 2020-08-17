@extends('_templates.main')
@section('page-title', $pet->nome)

@section('main-content')
<h1>{{ $pet->nome }}</h1>

<p>
    Seu pet nasceu em {{ date('d/m/Y', strtotime($pet->data_nascimento)) }}
    e tem {{ $pet->idade }} ano{{ $pet->idade == 1 ? '' : 's' }} de idade.
</p>

<hr>
<p>Criado em: {{ date('d/m/Y', strtotime($pet->criado_em)) }} às {{ date('H:i:s', strtotime($pet->criado_em)) }}</p>
<p>Atualizado em: {{ date('d/m/Y', strtotime($pet->atualizado_em)) }} às {{ date('H:i:s', strtotime($pet->atualizado_em)) }}</p>

@endsection