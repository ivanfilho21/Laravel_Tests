@extends("layout.my-template")

@section("content")

<h1>Novo Produto</h1>
<br>

<form method="post" action="/produtos/add">
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}">

	<div class="form-group">
		<label>Nome:</label>
		<input class="form-control" type="text" name="name">
	</div>

	<div class="form-group">
		<label>Descrição:</label>
		<input class="form-control" type="text" name="description">
	</div>

	<div class="form-group">
		<label>Valor:</label>
		<input class="form-control" type="text" name="price">
	</div>

	<div class="form-group">
		<label>Quantidade:</label>
		<input class="form-control" type="text" name="qty">
	</div>

	<br>
	<div class="row">
	    <div class="col-md-2 col-centered text-center">
			<button class="btn btn-success" type="submit">Adicionar Produto</button>
	    </div>
	</div>
</form>

@stop