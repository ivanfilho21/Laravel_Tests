@extends("layouts.my-template")

@section("content")

<h1>Novo Produto</h1>
<br>

@if (count($errors) > 0)
<div class="alert alert-danger">
	<h5>Foram encontrados os seguintes erros:</h5>
	<ul>
		@foreach ($errors->all() as $e)
		<li>{{ $e }}</li>
		@endforeach	
	</ul>
</div>
@endif


<form method="post" action="/produtos/save">
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}">
	<input type="hidden" name="id" value="{{ ! empty($p) ? $p->id : 0 }}">

	<div class="form-group">
		<label>Nome:</label>
		<input class="form-control" type="text" name="name" value="{{ old('name') ? old('name') : (! empty($p) ? $p->nome : '') }}">
	</div>

	<div class="form-group">
		<label>Descrição:</label>
		<input class="form-control" type="text" name="description" value="{{ old('description') ? old('description') : (! empty($p) ? $p->descricao : '') }}">
	</div>

	<div class="form-group">
		<label>Valor:</label>
		<input class="form-control" type="text" name="price" value="{{ old('price') ? old('price') : (! empty($p) ? $p->valor : '') }}">
	</div>

	<div class="form-group">
		<label>Quantidade:</label>
		<input class="form-control" type="text" name="qty" value="{{ old('qty') ? old('qty') : (! empty($p) ? $p->quantidade : '') }}">
	</div>

	<br>
	<div class="row">
	    <div class="col-md-2 col-centered text-center">
			<button class="btn btn-success" type="submit">{{ ! empty($p) ? "Editar" : "Adicionar" }} Produto</button>
	    </div>
	</div>
</form>

@stop