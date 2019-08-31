@extends("layout.my-template")

@section("content")
<div class="container">
	<h1>Produtos</h1>

	@if (empty($products))
	<div class="alert alert-warning">Você não tem produtos.</div>
	@else
	<table class="table table-striped table-bordered table-hover">
	@foreach ($products as $p)
		<tr class="{{ ($p->quantidade <= 1) ? "danger" : "" }}">
			<td>{{ $p->nome }}</td>
			<td>R$ {{ $p->valor }}</td>
			<td>{{ $p->descricao }}</td>
			<td>{{ $p->quantidade }}</td>
			<td>
				<a href="produto/{{ $p->id }}" class="btn btn-default">
					<span class="glyphicon glyphicon-search"></span>
				</a>
				<a href="produto/editar/{{ $p->id }}" class="btn btn-default">
					<span class="glyphicon glyphicon-pencil"></span>
				</a>
				<a href="produto/apagar/{{ $p->id }}" class="btn btn-default">
					<span class="glyphicon glyphicon-trash"></span>
				</a>
			</td>
		</tr>
	@endforeach
	</table>

	<h4>
		<span class="label label-danger pull-right">Baixo estoque</span>
	</h4>
	@endif
</div>
@stop