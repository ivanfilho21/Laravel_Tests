@extends("layout.my-template")

@section("content")
<h1>{{ $p->nome }}</h1>
<ul>
	<li><b>Nome:</b> {{ $p->nome }}</li>
	<li><b>Valor:</b> R$ {{ $p->valor }}</li>
	<li><b>Descrição:</b> {{ $p->descricao }}</li>
	<li><b>Quantidade:</b> {{ $p->quantidade }}</li>
</ul>
@stop