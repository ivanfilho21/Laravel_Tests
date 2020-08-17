@extends('_templates.main')
@section('page-title', 'Home')

@push('head-styles')
@endpush

@section('main-content')
<div class="msg-inicio">
	<h3>Informações de Início</h3>

	<p>
		Bem vindo ao sistema. Esta mensagem pode ser alterada por um admin.
	</p>
</div>
@endsection