@extends('_templates.main')
@section('page-title', $tarefa->titulo)

@push('head-styles')
@endpush

@section('main-content')
<h1>{{ $tarefa->titulo }}</h1>
<p>Tarefa {{ $tarefa->resolvido ? 'resolvida' : 'em aberto' }}.</p>
@endsection