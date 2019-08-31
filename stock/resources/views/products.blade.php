@extends("my-template")

<?php $products = array() ?>

@section("content")
<div class="container">
	<h1>Products</h1>

	@if (empty($products))
	<div class="alert alert-warning">Você não tem produtos.</div>
	@else
	<table class="table table-striped table-bordered table-hover">
	@foreach ($products as $p)
		<tr>
			<td>{{ $p->nome }}</td>
			<td>{{ $p->valor }}</td>
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
	@endif
</div>
@stop